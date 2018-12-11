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
}
