<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndoRegionDistrict extends Model
{
    protected $table = 'indoregion_districts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'regency_id',
        'name'
    ]; 

    /**
     *
     */
    public function regency()
    {
        return $this->belongsTo(IndoRegionRegency::class, 'regency_id', 'id');
    }

    /**
     * 
     */
    public function villages()
    {
        return $this->hasMany(IndoRegionVillage::class, 'district_id', 'id');
    }

    /**
     *
     */
    public function sekolah()
    {
        return $this->hasMany(MyAgenda_sekolah::class, 'myagenda_sekolah_kec', 'id');
    }
}
