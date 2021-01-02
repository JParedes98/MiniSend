<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailAttachment extends Model
{
    use HasFactory;
    protected $table = 'email_attachments';

    /** The attributes that are mass assignable.*/
    protected $fillable = [
        'email_id', 'name', 'extension', 'object'
    ];

    // RELATIONSHIPS
    public function email(){
        return $this->belongsTo('App\Models\EmailActivity', 'email_id');
    }
}
