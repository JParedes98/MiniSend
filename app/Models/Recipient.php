<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    use HasFactory;
    protected $table = 'recipients';

    /** The attributes that are mass assignable.*/
    protected $fillable = [
        'email'
    ];

    // RELATIONSHIPS
    public function contacts(){
        return $this->belongsToMany('App\Models\User', 'user_contacts', 'user_id', 'recipient_id');
    }
}
