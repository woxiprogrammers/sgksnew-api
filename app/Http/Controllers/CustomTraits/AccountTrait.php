<?php
namespace App\Http\Controllers\CustomTraits;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

trait AccountTrait{

    public function listing(Request $request){
         try{
             $displayLength = 5;
             $totalRecords = $request->page_id * $displayLength;
             $page_id = 1;
             $data = array(
                       array(
                          "id" => 1,
                          "name" => "Happy BD PQR!",
                          "account_image_url" => "https://res.cloudinary.com/dwzmsvp7f/image/fetch/q_75,f_auto,w_400/https%3A%2F%2Fmedia.insider.in%2Fimage%2Fupload%2Fc_crop%2Cg_custom%2Fv1519627969%2Fr134laaeo4imjznt4nsw.jpg",
                        ),array(
                          "id" => 2,
                          "name" => "Happy BD PQR!",
                          "account_image_url" => "https://www.eventfaqs.com/Uploads/News/Content/vow31.jpg",
                        ),array(
                          "id" => 3,
                          "name" => "Happy BD PQR!",
                          "account_image_url" => "https://res.cloudinary.com/dwzmsvp7f/image/fetch/q_75,f_auto,w_400/https%3A%2F%2Fmedia.insider.in%2Fimage%2Fupload%2Fc_crop%2Cg_custom%2Fv1519627969%2Fr134laaeo4imjznt4nsw.jpg",
                        ),array(
                          "id" => 4,
                          "name" => "Happy BD PQR!",
                          "account_image_url" => "https://www.eventfaqs.com/Uploads/News/Content/vow31.jpg",
                        ),array(
                          "id" => 5,
                          "name" => "Happy BD PQR!",
                          "account_image_url" => "https://res.cloudinary.com/dwzmsvp7f/image/fetch/q_75,f_auto,w_400/https%3A%2F%2Fmedia.insider.in%2Fimage%2Fupload%2Fc_crop%2Cg_custom%2Fv1519627969%2Fr134laaeo4imjznt4nsw.jpg",
                        ),array(
                          "id" => 6,
                          "name" => "Happy BD PQR!",
                          "account_image_url" => "https://res.cloudinary.com/dwzmsvp7f/image/fetch/q_75,f_auto,w_400/https%3A%2F%2Fmedia.insider.in%2Fimage%2Fupload%2Fc_crop%2Cg_custom%2Fv1519627969%2Fr134laaeo4imjznt4nsw.jpg",
                        ),array(
                          "id" => 7,
                          "name" => "Happy BD PQR!",
                          "account_image_url" => "https://www.eventfaqs.com/Uploads/News/Content/vow31.jpg",
                        ),array(
                          "id" => 8,
                          "name" => "Happy BD PQR!",
                          "account_image_url" => "https://res.cloudinary.com/dwzmsvp7f/image/fetch/q_75,f_auto,w_400/https%3A%2F%2Fmedia.insider.in%2Fimage%2Fupload%2Fc_crop%2Cg_custom%2Fv1519627969%2Fr134laaeo4imjznt4nsw.jpg",
                        ),array(
                          "id" => 9,
                          "name" => "Happy BD PQR!",
                          "account_image_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7",
                        ),array(
                          "id" => 10,
                          "name" => "Happy BD PQR!",
                          "account_image_url" => "https://res.cloudinary.com/dwzmsvp7f/image/fetch/q_75,f_auto,w_400/https%3A%2F%2Fmedia.insider.in%2Fimage%2Fupload%2Fc_crop%2Cg_custom%2Fv1519627969%2Fr134laaeo4imjznt4nsw.jpg",
                        ),array(
                          "id" => 11,
                          "name" => "Happy BD PQR!",
                          "account_image_url" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7",
                        ),
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