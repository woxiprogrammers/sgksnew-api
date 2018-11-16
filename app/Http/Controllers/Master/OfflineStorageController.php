<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfflineStorageController extends Controller
{

    public function localStorageOffline(Request $request){
        try{

            $data['current_timestamp'] = '2018-12-31 12:59:59';
            $data['messages'] = array(
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
            $data['members'] = array(
                array(
                      "member_id" => 1,
                      "sgks_family_id"=> "1",
                      "sgks_member_id"=> "ABC",
                      "sgks_city"=> "PUNE",
                      "family_id"=> "1",
                      "first_name"=> "ABC",
                      "middle_name"=> "WER",
                      "surname"=> "1",
                      "gender" => "Male",
                      "mobile"=> "PUNE",
                      "email"=> "aqwe@gmail.com",
                      "memLatitude"=> "17.999",
                      "memLongitude" => "-243.999",
                      "image_url"=> "1",
                      "marital_status"=> "single"
                ),
                array(
                    "member_id" => 2,
                    "sgks_family_id"=> "1",
                    "sgks_member_id"=> "ABC",
                    "sgks_city"=> "PUNE",
                    "family_id"=> "1",
                    "first_name"=> "ABC1",
                    "middle_name"=> "WER1",
                    "surname"=> "1",
                    "gender" => "Male",
                    "mobile"=> "PUNE",
                    "email"=> "aqwe@gmail.com",
                    "memLatitude"=> "",
                    "memLongitude" => "1",
                    "image_url"=> "1",
                    "marital_status"=> "single"
                )
            );
            $data['committees'] = array(
                array(
                      "name" => "User Name",
                      "description" => "1",
                      "sgks_city" => "PUNE",
                      "committee_id" => 1,
                      "comm_mem_details" => array(
                                array(
                                    "fullname"=>"Jinal A",
                                    "designation"=>"Precident A",
                                    "member_image"=>"http://www.mocky.io/v2/5b87dba02e0000f81a05fb7d",
                                    "area"=>"Pune",
                                    "cont_number"=>"8446185105",
                                    "email_id"=>"jinal@gmail.com"
                                ),array(
                                    "fullname"=>"Jinal B",
                                    "designation"=>"Precident B",
                                    "member_image"=>"http://www.mocky.io/v2/5b87dba02e0000f81a05fb7d",
                                    "area"=>"Pune",
                                    "cont_number"=>"8446185105",
                                    "email_id"=>"jinal@gmail.com"
                                ),array(
                                    "fullname"=>"Jinal C",
                                    "designation"=>"Precident C",
                                    "member_image"=>"http://www.mocky.io/v2/5b87dba02e0000f81a05fb7d",
                                    "area"=>"Pune",
                                    "cont_number"=>"8446185105",
                                    "email_id"=>"jinal@gmail.com"
                                )
                            )
                     )
            );
            $message = "Success";
            $status = 200;
        }catch(\Exception $e){
            $message = "Fail";
            $status = 500;
            $data = [
                'action' => 'Offline Storage data',
                'exception' => $e->getMessage(),
                'params' => $request->all()
            ];
            Log::critical(json_encode($data));
        }
        $response = [
            'message' => $message,
            'data' => $data,
        ];
        return response()->json($response,$status);
    }

}
