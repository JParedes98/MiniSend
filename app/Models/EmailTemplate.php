<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use HasFactory;
    protected $table = 'email_templates';

    /** The attributes that are mass assignable.*/
    protected $fillable = [
        'user_owner_id', 'content'
    ];

    // RELATIONSHIPS
    public function owner(){
        return $this->belongsTo('App\Models\User', 'user_owner_id');
    }

    public function emails(){
        return $this->hasMany('App\Models\EmailActivity', 'template_id');
    }
}
