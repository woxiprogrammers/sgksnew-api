<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebviewController extends Controller
{	

	public function healthPlus() {
	    $data = "<html><h1>SGKS - Health plus</h1></html>";
        return $data;
    }

    public function privacyPolicy() {
	    $data = "<html><h1>SGKS - Privacy Policy</h1></html>";
        return $data;
    }

    public function help() {
	    $data = "<html><h1>SGKS - Help</h1></html>";
        return $data;
    }

    public function qa() {
	    $data = "<html><h1>SGKS - Q and A</h1></html>";
        return $data;
    }

    public function contactUs() {
	    $data = "<html><h1>SGKS - Contact Us</h1></html>";
        return $data;
    }

    public function masterList(Request $request) {
	    try{
             $data['sgks_area'] = array(
                        array(
                       	'id' => 1,
                       	'area_name' => 'Karvenagar'
                       ),
                       array(
                       	'id' => 2,
                       	'area_name' => 'Sangvi'
                       )
                   );

             $data['suggestionbox_category'] = array(
                       array(
                       	'id' => 1,
                       	'name' => 'Cultural'
                       ),
                       array(
                       	'id' => 2,
                       	'name' => 'Social'
                       )
                   );

             $data['sgks_messages'] = array(
                       1,2,3,4
                      );

             $data['sgks_buzz'] = array(
                        "id" =>  1,
    					"msg_img" => "http://sgksapi.woxi.co.in/uploads/userdata/family/no_image.png"
                      );

             $data['sgks_classified'] = array(
                        1,2,3,4
                      );

            $message = "Success";
            $status = 200;
        }catch(\Exception $e){
            $message = "Fail";
            $status = 500;
            $data = [
                'action' => 'Get Master list',
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

    public function addMeToSgks(Request $request) {
    	try{
            $fullname = $request->fullname;
            $contact_number = $request->contact_number;
            $sgks_city = $request->sgks_city;
			$data = null;
            $message = "Member Added Successfully";
            $status = 200;
        }catch(\Exception $e){
            $message = "Fail";
            $status = 500;
            $data = [
                'action' => 'Add me to SGKS',
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

	public function sgksSuggestion(Request $request) {
    	try{
            $is_suggestion = $request->is_suggestion;
			$suggestion_cat = $request->suggestion_cat;
			$sgks_city = $request->sgks_city;
			$suggestion_message = $request->suggestion_message;

			$data = null;
            $message = "Thanks for your suggestion.";
            $status = 200;
        }catch(\Exception $e){
            $message = "Fail";
            $status = 500;
            $data = [
                'action' => 'SGKS Suggestiobn',
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

    public function minimumSupportedVersion(Request $request){
        try{
            $status = 200;
            $message = "Successfully Listed";
            $data['minimum_app_version'] = env('MINIMUM_APP_VERSION');
            $data['current_app_version'] = env('CURRENT_APP_VERSION');
            $data['maximum_app_version'] = env('MAXIMUM_APP_VERSION');
        }catch(\Exception $e){
            $message = "Something went wrong.";
            $status = 500;
            $data = [
                'action' => 'Minimum supported Version',
                'exception' => $e->getMessage()
            ];
            Log::critical(json_encode($data));
        }
        $response = [
            "message" => $message,
            "data" => $data
        ];
        return response()->json($response,$status);
    }
}
