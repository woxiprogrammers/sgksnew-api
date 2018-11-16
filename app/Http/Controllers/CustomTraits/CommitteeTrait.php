<?php
namespace App\Http\Controllers\CustomTraits;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

trait CommitteeTrait{

    public function listing(Request $request){
         try{
             $displayLength = 5;
             $totalRecords = $request->page_id * $displayLength;
             $page_id = 1;
             $data = array(
                       array(
                           'id'=> 1,
                            "name" => "SGKS Nari Shakti",
                            "description" => "",
                            "city"=> "Pune",
                            "year"=> "2017",
                              "members" => array(
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
                        ),array(
                           'id'=> 2,
                            "name" => "SGKS Committee 1",
                            "description" => "",
                            "city"=> "Pune",
                            "year"=> "2017",
                              "members" => array(
                                  array(
                                    "fullname"=>"Jinal A1",
                                    "designation"=>"Precident A1",
                                    "member_image"=>"http://www.mocky.io/v2/5b87dba02e0000f81a05fb7d",
                                    "area"=>"Pune",
                                    "cont_number"=>"8446185105",
                                    "email_id"=>"jinal@gmail.com"
                                  ),array(
                                    "fullname"=>"Jinal B1",
                                    "designation"=>"Precident B1",
                                    "member_image"=>"http://www.mocky.io/v2/5b87dba02e0000f81a05fb7d",
                                    "area"=>"Pune",
                                    "cont_number"=>"8446185105",
                                    "email_id"=>"jinal@gmail.com"
                                ),array(
                                    "fullname"=>"Jinal C1",
                                    "designation"=>"Precident C1",
                                    "member_image"=>"http://www.mocky.io/v2/5b87dba02e0000f81a05fb7d",
                                    "area"=>"Pune",
                                    "cont_number"=>"8446185105",
                                    "email_id"=>"jinal@gmail.com"
                                )
                          )
                        ),array(
                           'id'=> 3,
                            "name" => "SGKS Committee 2",
                            "description" => "",
                            "city"=> "Pune",
                            "year"=> "2017",
                              "members" => array(
                                  array(
                                    "fullname"=>"Jinal A2",
                                    "designation"=>"Precident A1",
                                    "member_image"=>"http://www.mocky.io/v2/5b87dba02e0000f81a05fb7d",
                                    "area"=>"Pune",
                                    "cont_number"=>"8446185105",
                                    "email_id"=>"jinal@gmail.com"
                                  ),array(
                                    "fullname"=>"Jinal B2",
                                    "designation"=>"Precident B1",
                                    "member_image"=>"http://www.mocky.io/v2/5b87dba02e0000f81a05fb7d",
                                    "area"=>"Pune",
                                    "cont_number"=>"8446185105",
                                    "email_id"=>"jinal@gmail.com"
                                ),array(
                                    "fullname"=>"Jinal C2",
                                    "designation"=>"Precident C1",
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