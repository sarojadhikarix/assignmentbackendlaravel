<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
    protected $table = 'ratings';
    protected $fillable =['user_id', 'website_id', 'rating'];
    protected $primaryKey = 'id';
    
    public $timestamp = true;
}
