<?php
namespace App\Http\Controllers\CustomTraits;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

trait EventTrait{

    public function listing(Request $request){
         try{
             $displayLength = 5;
             $totalRecords = $request->page_id * $displayLength;
             $page_id = 1;
             $data = array(
                       array(
                           'id'=> 1,
                            "event_name" => "hello  Event One",
                            "desc" => "hi hello",
                            "event_date"=> "29th feb 2016 to 30th feb 2017",
                            "year"=> "2017",
                            "event_images" => array(
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7"
                            )
                        ),array(
                           'id'=> 2,
                            "event_name" => "hello  Event Two",
                            "desc" => "hi hello",
                            "event_date"=> "29th feb 2016 to 30th feb 2017",
                            "year"=> "2017",
                            "event_images" => array(
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7"
                            )
                        ),array(
                           'id'=> 3,
                            "event_name" => "hello  Event Three",
                            "desc" => "hi hello",
                            "event_date"=> "29th feb 2016 to 30th feb 2017",
                            "year"=> "2017",
                            "event_images" => array(
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7"
                            )
                        ),array(
                           'id'=> 4,
                            "event_name" => "hello  Event Four",
                            "desc" => "hi hello",
                            "event_date"=> "29th feb 2016 to 30th feb 2017",
                            "year"=> "2017",
                            "event_images" => array(
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7"
                            )
                        ),array(
                           'id'=> 5,
                            "event_name" => "hello  Event Five",
                            "desc" => "hi hello",
                            "event_date"=> "29th feb 2016 to 30th feb 2017",
                            "year"=> "2017",
                            "event_images" => array(
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7"
                            )
                        ),array(
                           'id'=> 6,
                            "event_name" => "hello  Event Six",
                            "desc" => "hi hello",
                            "event_date"=> "29th feb 2016 to 30th feb 2017",
                            "year"=> "2017",
                            "event_images" => array(
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7"
                            )
                        ),array(
                           'id'=> 7,
                            "event_name" => "hello  Event Seven",
                            "desc" => "hi hello",
                            "event_date"=> "29th feb 2016 to 30th feb 2017",
                            "year"=> "2017",
                            "event_images" => array(
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7"
                            )
                        ),array(
                           'id'=> 8,
                            "event_name" => "hello  Event Eight",
                            "desc" => "hi hello",
                            "event_date"=> "29th feb 2016 to 30th feb 2017",
                            "year"=> "2017",
                            "event_images" => array(
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7"
                            )
                        ),array(
                           'id'=> 9,
                            "event_name" => "hello  Event Nine",
                            "desc" => "hi hello",
                            "event_date"=> "29th feb 2016 to 30th feb 2017",
                            "year"=> "2017",
                            "event_images" => array(
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7"
                            )
                        ),array(
                           'id'=> 10,
                            "event_name" => "hello  Event Ten",
                            "desc" => "hi hello",
                            "event_date"=> "29th feb 2016 to 30th feb 2017",
                            "year"=> "2017",
                            "event_images" => array(
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7"
                            )
                        ),array(
                           'id'=> 11,
                            "event_name" => "hello  Event Eleven",
                            "desc" => "hi hello",
                            "event_date"=> "29th feb 2016 to 30th feb 2017",
                            "year"=> "2017",
                            "event_images" => array(
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7"
                            )
                        ),array(
                           'id'=> 12,
                            "event_name" => "hello  Event Tweleve",
                            "desc" => "hi hello",
                            "event_date"=> "29th feb 2016 to 30th feb 2017",
                            "year"=> "2017",
                            "event_images" => array(
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7"
                            )
                        ),array(
                           'id'=> 13,
                            "event_name" => "hello  Event Thirteen",
                            "desc" => "hi hello",
                            "event_date"=> "29th feb 2016 to 30th feb 2017",
                            "year"=> "2017",
                            "event_images" => array(
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7"
                            )
                        ),array(
                           'id'=> 14,
                            "event_name" => "hello  Event Fourteen",
                            "desc" => "hi hello",
                            "event_date"=> "29th feb 2016 to 30th feb 2017",
                            "year"=> "2017",
                            "event_images" => array(
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7"
                            )
                        ),array(
                           'id'=> 15,
                            "event_name" => "hello  Event Fifteen",
                            "desc" => "hi hello",
                            "event_date"=> "29th feb 2016 to 30th feb 2017",
                            "year"=> "2017",
                            "event_images" => array(
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7"
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