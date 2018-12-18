<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\website_validation;
use App\website;
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

        
        if(isset($key[0][0])){
            $pos = strpos($key[0][0], '>', 1) + 1;
            $key = substr( $key[0][0], $pos, -11);
            
            $validation = website_validation::where('validation_code', $key)->first();
            if($validation){
                try{
                    website_validation::where('id', $validation->id)->update([
                        'status' => 1,
                        //others property
                    ]);

                    website::where('id', $validation->website_id)->update([
                        'validated' => 1,
                        //others property
                    ]);
                    $returnData = array(
                        'message' => 'Successfully validated.'
                    );
                    return response()->json($returnData);

                    }catch (\PDOException $e){
                        $returnData = array(
                            'message' => 'Something worng while validating! Please try again...'
                        );
                        return response()->json($returnData);
                    }
            }else{
                $returnData = array(
                    'message' => 'wrong validaton'
                );
                return response()->json($returnData);
            }
        }
        

        $returnData = array(
            'message' => 'Do not have validation on your website.'
        );
        return response()->json($returnData);


    }
}
