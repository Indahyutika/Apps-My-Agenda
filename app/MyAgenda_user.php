<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class MyAgenda_user extends Authenticatable
{
    use Notifiable;

    protected $table = 'myagenda_user';
    protected $primaryKey = 'myagenda_user_id';

    protected $fillable = [
        'myagenda_user_nama',
        'myagenda_user_email',
        'myagenda_user_password',
        'myagenda_user_role'
    ];

    protected $hidden = [
        'myagenda_user_password',
    ];

    public function getAuthPassword()
    {
        return $this->myagenda_user_password;
    }

    public function myagenda_sekolah()
    {
        return $this->hasOne(MyAgenda_sekolah::class, 'myagenda_sekolah_user_id', 'myagenda_user_id');
    }

    public function myagenda_profile()
    {
        return $this->hasOne(MyAgenda_profile::class, 'myagenda_profile_user_id', 'myagenda_user_id');
    }
}
