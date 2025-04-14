<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyAgenda_gambar extends Model
{
    protected $table = 'myagenda_gambar';
    protected $primaryKey = 'myagenda_gambar_id';
    protected $fillable = [
        'myagenda_gambar_sekolah_id',
        'myagenda_gambar_media',
        'myagenda_gambar_tanggal',
        'myagenda_gambar_deskripsi'
    ];
}
