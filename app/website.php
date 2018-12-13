<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class website extends Model
{
    protected $table = 'websites';
    protected $fillable =['url', 'user_id', 'validated', 'category_id', 'status', 'logo','big_logo', 'description', 'age_restrict', 'parent_site_id', 'language_id'];
    protected $primaryKey = 'id';
    
    public $timestamp = true;

    public function category()
    {
       return $this->belongsTo(category::class);
    }


    public function scopeSearch($query, $keyword){
        if($keyword != ''){
   
          
            return $query->where(function($query) use ($keyword){      
                            $searchKeyword = preg_split('/\s+/', $keyword, -1, PREG_SPLIT_NO_EMPTY);
                            foreach ($searchKeyword as $val) {
                              $query->where('url', 'like', '%' .$val. '%');
                                }
                            })
                         ->orderBy('id', 'asc')->where('status', '=', 1);
                         
                       }
    }

}
