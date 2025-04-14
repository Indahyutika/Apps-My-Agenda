<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\MyAgenda_agenda;
use App\MyAgenda_agendadetail;
use App\MyAgenda_user;
use Carbon\Carbon;
use App\MyAgenda_sekolah;
use Illuminate\Support\Facades\Mail;
use App\Mail\AgendaReminderMail;
use App\MyAgenda_user as AppMyAgenda_user;

class SendAgendaReminder extends Command
{
    protected $signature = 'agenda:reminder';
    protected $description = 'Mengirim email pengingat untuk agenda yang akan dimulai dalam 3 hari';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info("Mulai cek agenda dari H-3 sampai H-1");
    
        $agenda_ditemukan = false;
    
        // Loop dari H-3 ke H-1
        for ($i = 3; $i >= 1; $i--) {
            $target_date = Carbon::now()->addDays($i)->toDateString();
            $this->info("Cek agenda untuk tanggal: $target_date");
    
            $agendas = MyAgenda_agendadetail::whereDate('myagenda_agendadetail_tgl_awal', '<=', $target_date)
            ->whereDate('myagenda_agendadetail_tgl_akhir', '>=', $target_date)
            ->get();        
    
            if ($agendas->count() > 0) {
                $this->info("Agenda ditemukan untuk H-$i: " . $agendas->count());
                $agenda_ditemukan = true;
    
                foreach ($agendas as $agenda) {
                    $main_agenda = MyAgenda_agenda::find($agenda->myagenda_agendadetail_agenda_id);
    
                    if (!$main_agenda) {
                        $this->error("Agenda utama tidak ditemukan.");
                        continue;
                    }
    
                    $sekolah = MyAgenda_sekolah::find($main_agenda->myagenda_agenda_sekolah_id);
    
                    if (!$sekolah || !$sekolah->myagenda_sekolah_email) {
                        $this->error("Sekolah tidak ditemukan atau tidak punya email.");
                        continue;
                    }
    
                    try {
                        $email_recipients = [$sekolah->myagenda_sekolah_email];
    
                        if (!empty($agenda->myagenda_agendadetail_email_pic)) {
                            $email_recipients[] = $agenda->myagenda_agendadetail_email_pic;
                        }
    
                        Mail::to($email_recipients)->send(new AgendaReminderMail($agenda, $sekolah));
                        $this->info("Email dikirim ke: " . implode(', ', $email_recipients));
                    } catch (\Exception $e) {
                        $this->error("Gagal kirim email: " . $e->getMessage());
                    }
                }
    
                break; // stop loop kalau sudah ketemu agenda
            }
        }
    
        if (!$agenda_ditemukan) {
            $this->info("Tidak ada agenda ditemukan dari H-3 sampai H-1.");
        }
    
        $this->info("Selesai kirim reminder.");
    }
    
}

