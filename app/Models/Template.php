<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;
    protected $table = 'templates';

    /** The attributes that are mass assignable.*/
    protected $fillable = [
        'owner_id', 'name', 'content'
    ];

    // RELATIONSHIPS
    public function owner(){
        return $this->belongsTo('App\Models\User', 'owner_id');
    }
}
