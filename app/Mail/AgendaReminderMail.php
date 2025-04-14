<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AgendaReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $agenda;
    public $sekolah;

    public function __construct($agenda, $sekolah)
    {
        $this->agenda = $agenda;
        $this->sekolah = $sekolah;
    }

    public function build()
    {
        return $this->subject('Pengingat Agenda: ' . $this->agenda->myagenda_agendadetail_kegiatan)
                    ->view('emails.reminder')
                    ->with([
                        'agenda' => $this->agenda,
                        'sekolah' => $this->sekolah, 
                    ]);
    }
}

