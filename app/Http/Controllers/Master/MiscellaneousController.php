<?php

namespace App\Http\Controllers\Master;

use App\BloodGroup;
use App\Cities;
use App\CityTranslations;
use App\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class MiscellaneousController extends Controller
{
    public function getBloodGroupMaster(Request $request) {
        try{
            $data = BloodGroup::orderBy('id','ASC')->get(['id as blood_id','blood_group_type as blood_group'])->toArray();
            $message = "Success";
            $status = 200;
        }catch(\Exception $e){
            $message = "Fail";
            $status = 500;
            $data = [
                'action' => 'Get Bloodgroup list',
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

    public function getCity(Request $request) {
        try{
            $cityName = $request->search_city;
            $cityresultData = array();
            if($cityName != null){
                $cityresultData = Cities::where('is_active', true)
                      ->where('name','ilike',"%".$cityName."%")
                      ->orderBy('name','asc')
                      ->get(['id as city_id', 'name as city_name'])->toArray();
            } else {
                $cityresultData = Cities::where('is_active', true)
                    ->orderBy('name','asc')
                    ->get(['id as city_id', 'name as city_name'])
                    ->toArray();
            }

            $data = array();
            foreach ($cityresultData as $cityData) {
                $memberCount = Members::where('city_id',$cityData['city_id'])
                                        ->get()->count();
                $cityTranslationData = CityTranslations::where('city_id', $cityData['city_id'])
                    ->get()->toArray();
                if ($request->has('language_id') && $request->language_id == $cityTranslationData[0]['language_id']) {
                    $cityTranslationData = CityTranslations::where('language_id', $request->language_id)
                        ->where('city_id', $cityData['city_id'])
                        ->get()->toArray();
                    if (count($cityTranslationData) > 0) {
                        $data[] = array(
                            'city_id' => $cityData['city_id'],
                            'city_name' => ($cityTranslationData[0]['name'] != null) ? $cityTranslationData[0]['name'] : $cityData['city_name'],
                            'city_name_gj' => $cityTranslationData[0]['name'],
                            'city_name_en' => $cityData['city_name'],
                            'city_member_count' => $memberCount,
                        );
                    } else {
                        $data[] = array(
                            'city_id' => $cityData['city_id'],
                            'city_name' => $cityData['city_name'],
                            'city_name_gj' => $cityTranslationData[0]['name'],
                            'city_name_en' => $cityData['city_name'],
                            'city_member_count' => $memberCount,
                        );
                    }

                } else {
                        $data[] = array(
                            'city_id' => $cityData['city_id'],
                            'city_name' => $cityData['city_name'],
                            'city_name_gj' => $cityTranslationData[0]['name'],
                            'city_name_en' => $cityData['city_name'],
                            'city_member_count' => $memberCount,
                    );
                }
            }
            $message = "Success";
            $status = 200;
        }catch(\Exception $e){
            $message = "Fail";
            $status = 500;
            $data = [
                'action' => 'Get Cities list',
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

    public function imageUpload(Request $request){
        try{

            switch ($request['image_for']){
                case 'profile_img' :
                    $tempUploadPath = env('WEB_PUBLIC_PATH').env('MEMBER_TEMP_IMAGE_UPLOAD');
                    break;
                default :
                    $tempUploadPath = '';
            }
            $tempImageUploadPath = $tempUploadPath;
            if (!file_exists($tempImageUploadPath)) {
                File::makeDirectory($tempImageUploadPath, $mode = 0777, true, true);
            }
	        $extension = $request['extension'];
            $filename = mt_rand(1,10000000000).sha1(time()).".".$extension;
            file_put_contents($tempImageUploadPath.DIRECTORY_SEPARATOR.$filename, base64_decode($request['image']));
            $message = "Success";
            $status = 200;
        }catch (\Exception $e){
            $data = [
                'action' => 'Save temporary Images',
                'exception' => $e->getMessage(),
                'request' => $request->all()
            ];
            $message = $e->getMessage();
            $status = 500;
            $filename = null;
            Log::critical(json_encode($data));
        }
        $response = [
            "message" => $message,
            "filename" => $filename
        ];
        return response()->json($response,$status);
    }
}
