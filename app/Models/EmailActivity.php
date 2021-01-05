<?php

namespace App\Models;

use Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailActivity extends Model
{
    use HasFactory;
    protected $table = 'email_activities';

    /** The attributes that are mass assignable.*/
    protected $fillable = [
        'subject', 'text', 'html', 'recipient_id', 'sender_id',
    ];

    // RELATIONSHIPS
    public function sender(){
        return $this->belongsTo('App\Models\User', 'sender_id');
    }

    public function recipient(){
        return $this->belongsTo('App\Models\Recipient', 'recipient_id');
    }

    public function attachment(){
        return $this->hasOne('App\Models\EmailAttachment', 'email_id');
    }

}
