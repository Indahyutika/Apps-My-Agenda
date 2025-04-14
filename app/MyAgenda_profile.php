<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyAgenda_profile extends Model
{
    protected $table = 'myagenda_profile';
    protected $primaryKey = 'myagenda_profile_id';
    protected $fillable = [
        'myagenda_profile_foto',
        'myagenda_profile_nama'
    ];

    public function user()
    {
        return $this->belongsTo(MyAgenda_user::class, 'myagenda_profile_user_id', 'myagenda_user_id');
    }
}
