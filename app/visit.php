<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class visit extends Model
{
    protected $table = 'count_visit';
    protected $fillable =['count', 'website_id'];
    protected $primaryKey = 'id';
    
    public $timestamp = true;

}
