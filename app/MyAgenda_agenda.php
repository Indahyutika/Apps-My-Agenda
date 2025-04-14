<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyAgenda_agenda extends Model
{
    protected $table = 'myagenda_agenda';
    protected $primaryKey = 'myagenda_agenda_id';
    protected $fillable = [
        'myagenda_agenda_sekolah_id',
        'myagenda_agenda_judul',
        'myagenda_agenda_tanggal'
    ];

    public function sekolah()
    {
        return $this->belongsTo(MyAgenda_sekolah::class, 'myagenda_agenda_sekolah_id', 'myagenda_sekolah_id');
    }

    public function agendaDetails()
{
    return $this->hasMany(MyAgenda_agendadetail::class, 'myagenda_agendadetail_agenda_id', 'myagenda_agenda_id');
}
}
