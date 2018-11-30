<?php

namespace App\Http\Controllers\Master;

use App\DrawerWebviewDetailsTranslations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DrawerWebview;
use App\DrawerWebviewDetails;

class WebviewController extends Controller
{	

	public function healthPlus($sgks_city, $language_id) {
        try{
            $cityId = $sgks_city;
            $languageId = $language_id;
            $webView = DrawerWebview::where('slug','health-plus')->value('id');
            if($cityId != null){
                $healthPlusData = DrawerWebviewDetails::where('drawer_web_id',$webView)
                    ->where('city_id',$cityId)
                    ->get(['id', 'description'])->toArray();
            } else {
                $healthPlusData = DrawerWebviewDetails::where('drawer_web_id',$webView)
                    ->get(['id', 'description'])
                    ->toArray();
            }
            foreach ($healthPlusData as $healthPlus) {
                if ($languageId != null) {
                    $healthPlusDataInGujarati = DrawerWebviewDetailsTranslations::where('drawer_webview_details_id', $healthPlus['id'])
                        ->where('language_id',$languageId)
                        ->get()->toArray();

                    if (count($healthPlusDataInGujarati) > 0) {
                        $data = ($healthPlusDataInGujarati[0]['description'] != null) ? $healthPlusDataInGujarati[0]['description'] : $healthPlus['description'];
                    } else {
                        $data = $healthPlus['description'];
                    }
                } else {
                    $data = $healthPlus['description'];
                }
            }
            $message = "Success";
            $status = 200;
        }catch(\Exception $e){
            dd($e->getMessage());
            $message = "Fail";
            $status = 500;
            $data = [
                'action' => 'Get Health Plus',
                'exception' => $e->getMessage(),
            ];
            Log::critical(json_encode($data));
        }
        $response = [
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response,$status);

	    /*$id = DrawerWebview::where('slug','health-plus')->value('id');
        $data = DrawerWebviewDetails::where('drawer_web_id',$id)->value('description');
	    $data1 = "<html><h1>SGKS - Health plus</h1></html>";
        return $data;*/
    }

    public function privacyPolicy($sgks_city, $language_id) {

        try{
            $cityId = $sgks_city;
            $languageId = $language_id;
            $data = null;
            $webView = DrawerWebview::where('slug','privacy-policy')->value('id');
            if($cityId != null){
                $privacyPolicyData = DrawerWebviewDetails::where('drawer_web_id',$webView)
                    ->where('city_id',$cityId)
                    ->get(['id', 'description'])->toArray();
            } else {
                $privacyPolicyData = DrawerWebviewDetails::where('drawer_web_id',$webView)
                    ->get(['id', 'description'])
                    ->toArray();
            }
            foreach ($privacyPolicyData as $privacyPolicy) {
                if ($languageId != null) {
                    $privacyPolicyDataInGujarati = DrawerWebviewDetailsTranslations::where('drawer_webview_details_id', $privacyPolicy['id'])
                        ->where('language_id',$languageId)
                        ->get()->toArray();

                    if (count($privacyPolicyDataInGujarati) > 0) {
                        $data = ($privacyPolicyDataInGujarati[0]['description'] != null) ? $privacyPolicyDataInGujarati[0]['description'] : $privacyPolicy['description'];
                    } else {
                        $data = $privacyPolicy['description'];
                    }
                } else {
                    $data = $privacyPolicy['description'];
                }
            }
            $message = "Success";
            $status = 200;
        }catch(\Exception $e){
            dd($e->getMessage());
            $message = "Fail";
            $status = 500;
            $data = [
                'action' => 'Get Health Plus',
                'exception' => $e->getMessage(),
            ];
            Log::critical(json_encode($data));
        }
        $response = [
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response,$status);

	    /*$id = DrawerWebview::where('slug','privacy-policy')->value('id');
        $data = DrawerWebviewDetails::where('drawer_web_id',$id)->value('description');
	    $data1 = "<html><h1>SGKS - Privacy Policy</h1></html>";
        return $data;*/
    }

    public function help($sgks_city, $language_id) {
        try{
            $cityId = $sgks_city;
            $languageId = $language_id;
            $data = null;
            $webView = DrawerWebview::where('slug','help')->value('id');
            if($cityId != null){
                $helpData = DrawerWebviewDetails::where('drawer_web_id',$webView)
                    ->where('city_id',$cityId)
                    ->get(['id', 'description'])->toArray();
            } else {
                $helpData = DrawerWebviewDetails::where('drawer_web_id',$webView)
                    ->get(['id', 'description'])
                    ->toArray();
            }
            foreach ($helpData as $help) {
                if ($languageId != null) {
                    $helpDataInGujarati = DrawerWebviewDetailsTranslations::where('drawer_webview_details_id', $help['id'])
                        ->where('language_id',$languageId)
                        ->get()->toArray();

                    if (count($helpDataInGujarati) > 0) {
                        $data = ($helpDataInGujarati[0]['description'] != null) ? $helpDataInGujarati[0]['description'] : $help['description'];
                    } else {
                        $data = $help['description'];
                    }
                } else {
                    $data = $help['description'];
                }
            }
            $message = "Success";
            $status = 200;
        }catch(\Exception $e){
            dd($e->getMessage());
            $message = "Fail";
            $status = 500;
            $data = [
                'action' => 'Get Health Plus',
                'exception' => $e->getMessage(),
            ];
            Log::critical(json_encode($data));
        }
        $response = [
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response,$status);


        /*$id = DrawerWebview::where('slug','help')->value('id');
        $data = DrawerWebviewDetails::where('drawer_web_id',$id)->value('description');
        $data1 = "<html><h1>SGKS - Help</h1></html>";
        return $data;*/
    }

    public function qa($sgks_city, $language_id) {
        try{
            $cityId = $sgks_city;
            $languageId = $language_id;
            $data = null;
            $webView = DrawerWebview::where('slug','qa')->value('id');
            if($cityId != null){
                $qaData = DrawerWebviewDetails::where('drawer_web_id',$webView)
                    ->where('city_id',$cityId)
                    ->get(['id', 'description'])->toArray();
            } else {
                $qaData = DrawerWebviewDetails::where('drawer_web_id',$webView)
                    ->get(['id', 'description'])
                    ->toArray();
            }
            foreach ($qaData as $qa) {
                if ($languageId != null) {
                    $qaDataInGujarati = DrawerWebviewDetailsTranslations::where('drawer_webview_details_id', $qa['id'])
                        ->where('language_id',$languageId)
                        ->get()->toArray();

                    if (count($qaDataInGujarati) > 0) {
                        $data = ($qaDataInGujarati[0]['description'] != null) ? $qaDataInGujarati[0]['description'] : $qa['description'];
                    } else {
                        $data = $qa['description'];
                    }
                } else {
                    $data = $qa['description'];
                }
            }
            $message = "Success";
            $status = 200;
        }catch(\Exception $e){
            dd($e->getMessage());
            $message = "Fail";
            $status = 500;
            $data = [
                'action' => 'Get Health Plus',
                'exception' => $e->getMessage(),
            ];
            Log::critical(json_encode($data));
        }
        $response = [
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response,$status);
       /* $id = DrawerWebview::where('slug','qa')->value('id');
        $data = DrawerWebviewDetails::where('drawer_web_id',$id)->value('description');
	    $data1 = "<html><h1>SGKS - Q and A</h1></html>";
        return $data;*/
    }

    public function contactUs($sgks_city, $language_id) {
        try{
            $cityId = $sgks_city;
            $languageId = $language_id;
            $data = null;
            $webView = DrawerWebview::where('slug','contact-us')->value('id');
            if($cityId != null){
                $contactUsData = DrawerWebviewDetails::where('drawer_web_id',$webView)
                    ->where('city_id',$cityId)
                    ->get(['id', 'description'])->toArray();
            } else {
                $contactUsData = DrawerWebviewDetails::where('drawer_web_id',$webView)
                    ->get(['id', 'description'])
                    ->toArray();
            }
            foreach ($contactUsData as $contactUs) {
                if ($languageId != null) {
                    $contactUsDataInGujarati = DrawerWebviewDetailsTranslations::where('drawer_webview_details_id', $contactUs['id'])
                        ->where('language_id',$languageId)
                        ->get()->toArray();

                    if (count($contactUsDataInGujarati) > 0) {
                        $data = ($contactUsDataInGujarati[0]['description'] != null) ? $contactUsDataInGujarati[0]['description'] : $contactUs['description'];
                    } else {
                        $data = $contactUs['description'];
                    }
                } else {
                    $data = $contactUs['description'];
                }
            }
            $message = "Success";
            $status = 200;
        }catch(\Exception $e){
            dd($e->getMessage());
            $message = "Fail";
            $status = 500;
            $data = [
                'action' => 'Get Health Plus',
                'exception' => $e->getMessage(),
            ];
            Log::critical(json_encode($data));
        }
        $response = [
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response,$status);
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
