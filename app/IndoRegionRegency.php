<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndoRegionRegency extends Model
{
    protected $table = 'indoregion_regencies';
    protected $primaryKey = 'id';
    protected $fillable = [
        'province_id',
        'name'
    ]; 

    /**
     * 
     */
    public function province()
    {
        return $this->belongsTo(IndoRegionProvince::class, 'province_id', 'id');
    }

    /**
     *
     */
    public function districts()
    {
        return $this->hasMany(IndoRegionDistrict::class, 'regency_id', 'id');
    }

    /**
     * 
     */
    public function sekolah()
    {
        return $this->hasMany(MyAgenda_sekolah::class, 'myagenda_sekolah_kab_kota', 'id');
    }
}
