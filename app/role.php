<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $table = 'roles';
    protected $fillable =['title'];
    protected $primaryKey = 'id';
    
    public $timestamp = false;
}
