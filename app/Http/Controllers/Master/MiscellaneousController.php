<?php

namespace App\Http\Controllers\Master;

use App\BloodGroup;
use App\Cities;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MiscellaneousController extends Controller
{
    public function getBloodGroupMaster(Request $request) {
        try{
            $data = BloodGroup::where('is_active',true)->get(['id as blood_id','blood_group_type as blood_group'])->toArray();
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
            $data = Cities::where('is_active',true)->get(['id as city_id','name as city_name'])->toArray();
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
}
