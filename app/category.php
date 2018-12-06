<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'categories';
    protected $fillable =['title'];
    protected $primaryKey = 'id';
    
    public $timestamp = true;


    public function websites()
    {
       return $this->hasMany(website::class)->orderBy('id', 'asc');
    }

    public function scopeSearch($query, $keyword){
        if($keyword != ''){
   
          
            return $query->where(function($query) use ($keyword){      
                            $searchKeyword = preg_split('/\s+/', $keyword, -1, PREG_SPLIT_NO_EMPTY);
                            foreach ($searchKeyword as $val) {
                              $query->where('title', 'like', '%' .$val. '%');
                                }
                            })
                         ->orderBy('id', 'asc');
                         
                       }
    }
}
