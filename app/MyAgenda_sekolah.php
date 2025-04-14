<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyAgenda_sekolah extends Model
{
    protected $table = 'myagenda_sekolah';
    protected $primaryKey = 'myagenda_sekolah_id';
    protected $fillable = [
        'myagenda_sekolah_logo',
        'myagenda_sekolah_nama',
        'myagenda_sekolah_email',
        'myagenda_sekolah_akreditasi',
        'myagenda_sekolah_tlp',
        'myagenda_sekolah_provinsi',
        'myagenda_sekolah_kab_kota',
        'myagenda_sekolah_kec',
        'myagenda_sekolah_kel',
        'myagenda_sekolah_kodepos',
        'myagenda_sekolah_alamat'
    ];

    public function user()
    {
        return $this->belongsTo(MyAgenda_user::class, 'myagenda_sekolah_user_id', 'myagenda_user_id');
    }

    public function provinsi()
    {
        return $this->belongsTo(IndoRegionProvince::class, 'myagenda_sekolah_provinsi', 'id');
    }

    public function kabkota()
    {
        return $this->belongsTo(IndoRegionRegency::class, 'myagenda_sekolah_kab_kota', 'id');
    }

    public function kec()
    {
        return $this->belongsTo(IndoRegionDistrict::class, 'myagenda_sekolah_kec', 'id');
    }

    public function kel()
    {
        return $this->belongsTo(IndoRegionVillage::class, 'myagenda_sekolah_kel', 'id');
    }

    public function sekolah()
    {
        return $this->hasMany(MyAgenda_sekolah::class('myagenda_sekolah_id', 'myagenda_agenda_sekolah_id'));
    }
}
