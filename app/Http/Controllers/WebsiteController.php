<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\website;

class WebsiteController extends Controller
{
    public function store(Request $request){
        $website = new website;
        $website->url = $request->url;
        $website->user_id = $request->user_id;
        $website->validated = $request->validated;
        $website->category_id = $request->category_id;

        if (Auth::check() && $request->status) {
            $website->status = $request->status;
        }else{
            $website->status = false;
        }
        $website->save();
    }

    public function find($id)
    {
        $website = website::find($id);
        if(count($website)){
            return fractal()
            ->item($website)
            ->parseIncludes([])
            ->transformWith(new WebsiteTransformer)
            ->toArray();
        }
        else{
            return response()->json([
                'data' => [
                    'status' => 'not_found']
                ]);
        }
    }

    public function index(){
        $websites= website::get();
        return fractal()
            ->collection($websites)
            ->parseIncludes(['category'])
            ->transformWith(new WebsiteTransformer)
            ->toArray();
    }

    public function update(Request $request)
    {
        try{
        website::where('id', $request->id)->update([
            'url' => $request -> url,
            'validated' => $request -> validated,
            'category_id' => $request -> category_id,
            'status' => $request -> status,
        ]);
        }catch (\PDOException $e){
            $returnData = array(
                'message' => 'Could not update.'
            );
            return response()->json($returnData);
        }
            $returnData = array(
                'message' => 'Updated.'
            );
        return response()->json($returnData);
    }

    public function delete($id)
    {
        try{
            website::find($id)->delete();
        }catch (\PDOException $e){
            $returnData = array(
                'message' => 'Could not delete.'
            );
            return response()->json($returnData);
        }
        $returnData = array(
            'message' => 'Deleted.'
        );
    return response()->json($returnData);
    }

}
