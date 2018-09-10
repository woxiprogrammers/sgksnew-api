<?php
namespace App\Http\Controllers\CustomTraits;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

trait MessageTrait{

    public function listing(Request $request){
         try{
             $displayLength = 5;
             $totalRecords = $request->page_id * $displayLength;
             $page_id = 1;
             $data = array(
                       array(
                          "id" => 1,
                          "title" => "Happy BD PQR!",
                          "msg_desc" => "Happy BD PQR.",
                          "msg_img" => "https://goo.gl/images/6GoWWT",
                          "msg_type" => "birthday",
                          "sgks_city" => "PUNE"
                        ),
                        array(
                          "id" => 2,
                          "title" => "Happy BD ABC!",
                          "msg_desc" => "Happy BD ABC.",
                          "msg_img" => "https://goo.gl/images/6GoWWT",
                          "msg_type" => "birthday",
                          "sgks_city" => "PUNE"
                        ),
                        array(
                           "id" => 3,
                          "title" => "Happy BD XYZ!",
                          "msg_desc" => "Happy BD PQR.",
                          "msg_img" => "https://goo.gl/images/6GoWWT",
                          "msg_type" => "general",
                          "sgks_city" => "PUNE"
                        ),
                        array(
                          "id" => 4,
                          "title" => "Happy BD QWERTY!",
                          "msg_desc" => "Happy BD PQR.",
                          "msg_img" => "https://goo.gl/images/6GoWWT",
                          "msg_type" => "achievement",
                          "sgks_city" => "PUNE"
                        ),
                        array(
                          "id" => 5,
                          "title" => "Happy BD ASDF!",
                          "msg_desc" => "Happy BD PQR.",
                          "msg_img" => "https://goo.gl/images/6GoWWT",
                          "msg_type" => "nidhan",
                          "sgks_city" => "PUNE"
                          )
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
            'data' => $data,
            'page_id' => $page_id
        ];
        return response()->json($response,$status);
    }


}