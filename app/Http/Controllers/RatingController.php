<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\rating;
use App\rating_clacs;

class RatingController extends Controller
{
    public function addRating(Request $request){
        try{
            $rating_calculation = rating_clacs::where('website_id', $request->website_id)->first();
            if($rating_calculation){
                rating_clacs::where('id', $rating_calculation->id)->update([
                    'total_rate' => $rating_calculation->total_rate + $request->rating,
                    'total_users' => $rating_calculation->total_users + 1,
                ]);
                
            }else{
                $rating_clacs = new rating_clacs;
                $rating_clacs -> total_rate = $request->rating;
                $rating_clacs -> total_users = 1;
                $rating_clacs -> website_id = $request->website_id;
    
                $rating_clacs->save();

                
            }

            $rating_calculation = rating_clacs::where('website_id', $request->website_id)->first();

            $rating = rating::where('rating_calc_id', $rating_calculation->id)->first();

            if($rating){
                rating::where('rating_calc_id', $rating_calculation->id)->update([
                    'rating' => $rating_calculation->total_rate / $rating_calculation->total_users,
                ]);
    
                $returnData = array(
                    'message' => 'Rating added.'
                );
                
            }else{
                $rating = new rating;
                $rating -> website_id = $request->website_id;
                $rating -> rating = $rating_calculation->total_rate / $rating_calculation->total_users;
                $rating -> rating_calc_id = $rating_calculation->id;
    
                $rating->save();
                $returnData = array(
                    'message' => 'First rating recorded.'
                );
                
            }


        }catch (\PDOException $e){
            $returnData = array(
                'message' => 'Could not update.',
                'error' => $e,
            );
           
        }
        

        return response()->json($returnData);
    }
}
