<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndoRegionProvince extends Model
{
    protected $table = 'indoregion_provinces';
    protected $primaryKey = 'id';
    protected $fillable = ['name']; 

    /**
     * 
     */
    public function regencies()
    {
        return $this->hasMany(IndoRegionRegency::class, 'province_id', 'id');
    }

    /**
     * 
     */
    public function sekolah()
    {
        return $this->hasMany(MyAgenda_sekolah::class, 'myagenda_sekolah_provinsi', 'id');
    }
}
