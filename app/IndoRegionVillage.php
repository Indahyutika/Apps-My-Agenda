<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndoRegionVillage extends Model
{
    protected $table = 'indoregion_villages';
    protected $primaryKey = 'id';
    protected $fillable = [
        'district_id',
        'name'
    ]; 

    /**
     * 
     */
    public function district()
    {
        return $this->belongsTo(IndoRegionDistrict::class, 'district_id', 'id');
    }

    /**
     *
     */
    public function sekolah()
    {
        return $this->hasMany(MyAgenda_sekolah::class, 'myagenda_sekolah_kel', 'id');
    }
}
