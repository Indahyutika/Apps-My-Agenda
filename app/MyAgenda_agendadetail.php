<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MyAgenda_agendadetail extends Model
{
    protected $table = 'myagenda_agendadetail';
    protected $primaryKey = 'myagenda_agendadetail_id';
    protected $fillable = [
        'myagenda_agendadetail_agenda_id',
        'myagenda_agendadetail_kegiatan',
        'myagenda_agendadetail_tgl_awal',
        'myagenda_agendadetail_tgl_akhir',
        'myagenda_agendadetail_jumlah_hari',
        'myagenda_agendadetail_deskripsi',
        'myagenda_agendadetail_pic',
        'myagenda_agendadetail_email_pic',
        'myagenda_agendadetail_status'
    ];

    public function agenda()
    {
        return $this->belongsTo(MyAgenda_agenda::class, 'myagenda_agendadetail_agenda_id', 'myagenda_agenda_id');
    }

    public function getStatusAttribute()
    {
        if (!$this->myagenda_agendadetail_tgl_awal || !$this->myagenda_agendadetail_tgl_akhir) {
            return 'Tanggal tidak valid';
        }

        $today = Carbon::today();
        $startDate = Carbon::parse($this->myagenda_agendadetail_tgl_awal);
        $endDate = Carbon::parse($this->myagenda_agendadetail_tgl_akhir);

        if ($today->lt($startDate)) {
            return 'Belum Terlaksana';
        } elseif ($today->between($startDate, $endDate)) {
            return 'Sedang Terlaksana';
        } else {
            return 'Sudah Terlaksana';
        }
    }
}
