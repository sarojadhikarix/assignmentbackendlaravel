<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use Illuminate\Support\Facades\Auth;

use App\Transformers\CategoryBriefTransformer;

class CategoryController extends Controller
{
    public function store(Request $request){

        $this->validate(request(), [
            'title' => 'required',
            'parent_id' => 'required',
        ]); 

        if(auth()->guard('api')->user() != null){
            $category = new category;
            $category->title = $request->title;
            $category->parent_id = $request->parent_id;
            
                $category->save();
            

                $returnData = array(
                    'message' => 'Saved.'
                );
                return response()->json($returnData);
            
        }else{
            $returnData = array(
                'message' => 'Unauthenticated.'
            );
            return response()->json($returnData);
        }
    }

    public function find($id)
    {
        $category = category::find($id);
        if(count($category)){
            return fractal()
            ->item($category)
            ->parseIncludes([])
            ->transformWith(new CategoryBriefTransformer)
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
        $categories= category::get();
        return fractal()
            ->collection($categories)
            ->parseIncludes(['websites'])
            ->transformWith(new CategoryBriefTransformer)
            ->toArray();
    }

    public function update(Request $request)
    {
 

        if(auth()->guard('api')->user() != null){
            $this->validate(request(), [
                'title' => 'required',
                'parent_id' => 'required',
            ]);
        try{
            category::where('id', $request->id)->update([
                'title' => $request -> title,
                'parent_id' => $request -> parent_id,
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
            category::find($id)->delete();
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
            $categories = category::Search($keyword)->get();
                if(count($categories) > 0){
                    return fractal()
                    ->collection($categories)
                    ->parseIncludes(['category'])
                    ->transformWith(new CategoryBriefTransformer)
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
}
