<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class website extends Model
{
    protected $table = 'websites';
    protected $fillable =['url', 'user_id', 'validated', 'category_id', 'status'];
    protected $primaryKey = 'id';
    
    public $timestamp = true;

    public function category()
    {
       return $this->belongsTo(category::class);
    }
}
