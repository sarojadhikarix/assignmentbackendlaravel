<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\website;
use Illuminate\Support\Facades\Auth;
use App\Transformers\WebsiteTransformer;

use App\Transformers\WebsiteTransformer;

class WebsiteController extends Controller
{
    public function store(Request $request){

         
        if(auth()->guard('api')->user() != null){
            try{
                $this->validate(request(), [
                    'url' => 'required',
                    'user_id' => 'required',
                    'validated' => 'required',
                    'category_id' => 'required',
                ]); 

                $website = new website;
                $website->url = $request->url;
                $website->user_id = $request->user_id;
                $website->validated = $request->validated;
                $website->category_id = $request->category_id;

                if ($request->status) {
                    $website->status = $request->status;
                }else{
                    $website->status = false;
                }
                $website->save();

            }catch (\PDOException $e){
                $returnData = array(
                    'message' => 'Could not add.'
                );
                return response()->json($returnData);
            }
                $returnData = array(
                    'message' => 'Website Added.'
                );
            return response()->json($returnData);
        }else{
            $returnData = array(
                'message' => 'authenticated.'
            );
            return response()->json($returnData);
        }
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
        if(auth()->guard('api')->user() != null){
        $this->validate(request(), [
            'url' => 'required',
            'validated' => 'required',
            'category_id' => 'required',
        ]); 
        try{

            if ($request->status) {
                $status = $request->status;
            }else{
                $status = false;
            }

        website::where('id', $request->id)->update([
            'url' => $request -> url,
            'validated' => $request -> validated,
            'category_id' => $request -> category_id,
            'status' => $status,
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
        }else{
            $returnData = array(
                'message' => 'Unauthenticated.'
            );
            return response()->json($returnData);

        }
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

    public function search(Request $request){
        $keyword = $request->keyword;
        if($keyword != ''){
            $websites = website::Search($keyword)->get();
                if(count($websites) > 0){
                    return fractal()
                    ->collection($websites)
                    ->parseIncludes(['category'])
                    ->transformWith(new WebsiteTransformer)
                    ->toArray();
                 }else{
                    $returnData = array(
                        'message' => "Don't have any records."
                    );
                    return response()->json($returnData);
                 }
        } else{
            $returnData = array(
                'message' => "Input was not given."
            );
            return response()->json($returnData);
        }

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
