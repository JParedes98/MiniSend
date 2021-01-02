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

    // RELATIONSHIPS
    public function owner(){
        return $this->belongsTo('App\Models\User', 'sender_user_id');
    }

    public function template(){
        return $this->belongsTo('App\Models\EmailTemplate', 'template_id');
    }

    public function recipients(){
        return $this->belongsToMany('App\Models\EmailRecipient', 'email_related_recipients', 'email_id', 'recipient_id');
    }

    public function attachments(){
        return $this->hasMany('App\Models\EmailAttachment', 'user_owner_id');
    }
}
