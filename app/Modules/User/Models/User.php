<?php

namespace App\Modules\User\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


use App\Modules\Fonction\Models\Fonction;
use App\Modules\Claim\Models\Claim;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded=["id"];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function fonction(){
        return $this->belongsTo(Fonction::class);
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        "username",
        "lastName",
        "firstName",
        "phoneNumber",
        "fonction_id",
    ];




    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
