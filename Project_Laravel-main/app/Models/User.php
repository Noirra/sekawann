<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_fullname',
        'user_username',
        'user_password',
        'user_email',
        'user_notelp',
        'user_alamat',
        'user_profil_url',
        'user_level',
        'user_status',
    ];

    protected $hidden = [
        'user_password',
    ];

    protected $casts = [
        'user_status' => 'boolean',
    ];
}
