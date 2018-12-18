<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\website_validation;
use Carbon\Carbon;
class WebsiteValidation extends Controller
{
    public function add(Request $request){
        try{
            $this->validate(request(), [
                'website_id' => 'required',
                'user_id' => 'required',
            ]); 
            
            $validation = new website_validation;
            $validation -> website_id = $request->website_id;
            $validation -> user_id = $request->user_id;
            $validation -> status = $request->status;
            $validation -> validation_code = md5(microtime());
            $validation -> expire_date = Carbon::now()->addYears(1);

            if ($request->status) {
                $validation->status = $request->status;
            }else{
                $validation->status = false;
            }

            $data = website_validation::where('website_id', $request->website_id)->where('user_id', $request->user_id)->first();

            if(!$data){
                $validation->save();

                $returnData = array(
                    'message' => 'Validation Added.'
                );
                return response()->json($returnData);
            }else{
                $returnData = array(
                    'message' => 'You alrealy have created validation for this website.'
                );
                return response()->json($returnData);
            }
        }catch (\PDOException $e){
            $returnData = array(
                'message' => 'Could not add. ' . $e
            );
            return response()->json($returnData);
        }
            
    
    }
}
