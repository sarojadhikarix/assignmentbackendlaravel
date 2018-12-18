<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class website_validation extends Model
{
    protected $table = 'website_validation';
    protected $fillable =['website_id', 'user_id', 'validation_code', 'expire_date', 'status'];
    protected $primaryKey = 'id';
    
    public $timestamp = true;

}
