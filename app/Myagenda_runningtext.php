<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Myagenda_runningtext extends Model
{
    protected $table = 'myagenda_runningtext';
    protected $primaryKey = 'myagenda_runningtext_id';
    protected $fillable = [
        'myagenda_runningtext_sekolah_id',
        'myagenda_runningtext_judul',
        'myagenda_runningtext_konten',
        'myagenda_runningtext_tgl_mulai',
        'myagenda_runningtext_tgl_akhir'
    ];
}
