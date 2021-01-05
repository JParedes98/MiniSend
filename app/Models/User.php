<?php

namespace App\Models;

use DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // RELATIONSHIPS
    public function sent_emails(){
        return $this->hasMany('App\Models\EmailActivity', 'sender_id');
    }

    public function inbox_emails(){
        return $this->hasMany('App\Models\EmailActivity', 'recipient_id');
    }

    public function templates(){
        return $this->hasMany('App\Models\Template', 'owner_id');
    }

    public function contacts(){
        return $this->belongsToMany('App\Models\Recipient', 'user_contacts', 'user_id', 'recipient_id');
    }
}
