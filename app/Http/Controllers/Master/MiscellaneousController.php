<?php

namespace App\Http\Controllers\Master;

use App\BloodGroup;
use App\Cities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class MiscellaneousController extends Controller
{
    public function getBloodGroupMaster(Request $request) {
        try{
            $data = BloodGroup::get(['id as blood_id','blood_group_type as blood_group'])->toArray();
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
            if($cityName != null){
                $data = Cities::where('is_active', true)
                      ->where('name','ilike',"%".$cityName."%")
                      ->get(['id as city_id', 'name as city_name'])->toArray();
            }else {
                $data = Cities::where('is_active', true)->get(['id as city_id', 'name as city_name'])->toArray();
            }
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
            $filename = mt_rand(1,10000000000).sha1(time()).".{$extension}";
            file_put_contents($tempImageUploadPath.DIRECTORY_SEPARATOR.$filename,base64_decode($request['image']));
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
