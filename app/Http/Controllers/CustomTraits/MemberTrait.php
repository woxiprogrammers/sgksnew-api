<?php
namespace App\Http\Controllers\CustomTraits;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

trait MemberTrait{

    public function listing(Request $request){
         try{
             
          $data = array(
                [
                  "id"=> 1,
                  "surname"=> "Vaghela",
                ],
            );
            $message = "Success";
            $status = 200;
        }catch(\Exception $e){
            $message = "Fail";
            $status = 500;
            $data = [
                'action' => 'Get all members',
                'exception' => $e->getMessage(),
                'params' => $request->all()
            ];
            Log::critical(json_encode($data));
        }
        $response = [
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response,$status);
    }


}