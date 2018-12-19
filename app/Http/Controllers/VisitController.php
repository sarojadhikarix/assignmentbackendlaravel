<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\visit;

class VisitController extends Controller
{
    public function add($website_id){
        try{
        $visit_count = visit::where('website_id', $website_id)->first();
        if($visit_count){
            visit::where('id', $visit_count->id)->update([
                'count' => $visit_count->count + 1,
            ]);

            $returnData = array(
                'message' => 'Visit Counted'
            );
            return response()->json($returnData);
        }else{
            $visit = new visit;
            $visit -> count = 1;
            $visit -> website_id = $website_id;

            $visit->save();
            $returnData = array(
                'message' => 'First visit recorded.'
            );
            return response()->json($returnData);
        }
    }catch (\PDOException $e){
        $returnData = array(
            'message' => 'Could not update.'
        );
        return response()->json($returnData);
    }
    }
}
