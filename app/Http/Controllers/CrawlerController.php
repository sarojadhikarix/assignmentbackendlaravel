<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrawlerController extends Controller
{
    public function crawler($url){
            
                $handle = fopen('http://www.'.$url, 'r');
                if (! $handle){
                    return "Page doesn't exist.";
                }
                $contents = stream_get_contents($handle);
                fclose($handle);

                preg_match_all("/<title.*>*<.title>/", $contents, $title);
                
                $pos = strpos($title[0][0], '>', 1) + 1;
                $title = substr( $title[0][0], $pos, -8);

                $result = array(
                    "title" => $title,
            
                );
                
                return response()->json($result);
    }

    public function checkIfValidated($url){
            
        $handle = fopen('http://www.'.$url, 'r');
        if (! $handle){
            return "Page doesn't exist.";
        }
        $contents = stream_get_contents($handle);
        fclose($handle);

        preg_match_all("/<validate.*>*<.validate>/", $contents, $key);
        
        if(count($key[0])>0){
            $pos = strpos($key[0][0], '>', 1) + 1;
            $key = substr( $key[0][0], $pos, -11);
            
            if($key == '123456789'){
                return 'true';
            }
        }
        

        return 'false';


    }
}
