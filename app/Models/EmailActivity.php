<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailActivity extends Model
{
    use HasFactory;
    protected $table = 'email_activities';

    /** The attributes that are mass assignable.*/
    protected $fillable = [
        'sender_user_id', 'subject', 'text', 'html'
    ];
}
