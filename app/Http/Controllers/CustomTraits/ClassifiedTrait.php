<?php
namespace App\Http\Controllers\CustomTraits;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

trait ClassifiedTrait{

    public function listing(Request $request){
         try{
             $displayLength = 5;
             $totalRecords = $request->page_id * $displayLength;
             $page_id = 1;
             $data = array(
                       array(
                            "id" => 1,
                            "title" => "hello  Classified One",
                            "class_desc" => "hi hello",
                            "class_pkg" => "29th feb 2016 to 30th feb 2017",
                            "created_at" => "2018",
                            "class_type" => "My Class Type One",
                            "class_images"=> array (
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7"
                            )
                        ),array(
                            "id" => 2,
                            "title" => "hello  Classified Two",
                            "class_desc" => "hi hello",
                            "class_pkg" => "29th feb 2016 to 30th feb 2017",
                            "created_at" => "2018",
                            "class_type" => "My Class Type One",
                            "class_images"=> array (
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRoSdF5DygpeZoyfYV6nHcKZ32boVcmGpLIEuDzGPRMlPxp-S5H"
                            )
                        ),array(
                            "id" => 3,
                            "title" => "hello  Classified Three",
                            "class_desc" => "hi hello",
                            "class_pkg" => "29th feb 2016 to 30th feb 2017",
                            "created_at" => "2018",
                            "class_type" => "My Class Type One",
                            "class_images"=> array (
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7"
                            )
                        ),array(
                            "id" => 4,
                            "title" => "hello  Classified Four",
                            "class_desc" => "hi hello",
                            "class_pkg" => "29th feb 2016 to 30th feb 2017",
                            "created_at" => "2018",
                            "class_type" => "My Class Type One",
                            "class_images"=> array (
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRoSdF5DygpeZoyfYV6nHcKZ32boVcmGpLIEuDzGPRMlPxp-S5H",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7"
                            )
                        ),array(
                            "id" => 5,
                            "title" => "hello  Classified Five",
                            "class_desc" => "hi hello",
                            "class_pkg" => "29th feb 2016 to 30th feb 2017",
                            "created_at" => "2018",
                            "class_type" => "My Class Type One",
                            "class_images"=> array (
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7"
                            )
                        ),array(
                            "id" => 6,
                            "title" => "hello  Classified Six",
                            "class_desc" => "hi hello",
                            "class_pkg" => "29th feb 2016 to 30th feb 2017",
                            "created_at" => "2018",
                            "class_type" => "My Class Type One",
                            "class_images"=> array (
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRoSdF5DygpeZoyfYV6nHcKZ32boVcmGpLIEuDzGPRMlPxp-S5H"
                            )
                        ),array(
                            "id" => 7,
                            "title" => "hello  Classified Seven",
                            "class_desc" => "hi hello",
                            "class_pkg" => "29th feb 2016 to 30th feb 2017",
                            "created_at" => "2018",
                            "class_type" => "My Class Type One",
                            "class_images"=> array (
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7"
                            )
                        ),array(
                            "id" => 8,
                            "title" => "hello  Classified Eight",
                            "class_desc" => "hi hello",
                            "class_pkg" => "29th feb 2016 to 30th feb 2017",
                            "created_at" => "2018",
                            "class_type" => "My Class Type One",
                            "class_images"=> array (
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRoSdF5DygpeZoyfYV6nHcKZ32boVcmGpLIEuDzGPRMlPxp-S5H",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7"
                            )
                        ),array(
                            "id" => 9,
                            "title" => "hello  Classified One 11",
                            "class_desc" => "hi hello",
                            "class_pkg" => "29th feb 2016 to 30th feb 2017",
                            "created_at" => "2018",
                            "class_type" => "My Class Type One",
                            "class_images"=> array (
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7"
                            )
                        ),array(
                            "id" => 10,
                            "title" => "hello  Classified Two 22",
                            "class_desc" => "hi hello",
                            "class_pkg" => "29th feb 2016 to 30th feb 2017",
                            "created_at" => "2018",
                            "class_type" => "My Class Type One",
                            "class_images"=> array (
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRoSdF5DygpeZoyfYV6nHcKZ32boVcmGpLIEuDzGPRMlPxp-S5H"
                            )
                        ),array(
                            "id" => 11,
                            "title" => "hello  Classified Three 33",
                            "class_desc" => "hi hello",
                            "class_pkg" => "29th feb 2016 to 30th feb 2017",
                            "created_at" => "2018",
                            "class_type" => "My Class Type One",
                            "class_images"=> array (
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7"
                            )
                        ),array(
                            "id" => 12,
                            "title" => "hello  Classified Four 44",
                            "class_desc" => "hi hello",
                            "class_pkg" => "29th feb 2016 to 30th feb 2017",
                            "created_at" => "2018",
                            "class_type" => "My Class Type One",
                            "class_images"=> array (
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQvg1kO4EfJf6kyCiDeA-PRp-XNwg8DqsucY_OrkHjXqKd2HB2p",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAhcP9INehHWSK8ML7ONJaWefGjtrObCdQw3DbXiuZ016TRUw7",
                              "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRoSdF5DygpeZoyfYV6nHcKZ32boVcmGpLIEuDzGPRMlPxp-S5H",
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