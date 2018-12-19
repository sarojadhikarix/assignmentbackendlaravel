<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rating_clacs extends Model
{
    protected $table = 'rating_clacs';
    protected $fillable =['total_rate', 'total_users', 'website_id'];
    protected $primaryKey = 'id';
    
    public $timestamp = true;
}
