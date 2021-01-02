<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailRecipient extends Model
{
    use HasFactory;
    protected $table = 'email_recipients';

    /** The attributes that are mass assignable.*/
    protected $fillable = [
        'related_user_id', 'email'
    ];
}
