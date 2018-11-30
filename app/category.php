<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'categories';
    protected $fillable =['title'];
    protected $primaryKey = 'id';
    
    public $timestamp = true;
}
