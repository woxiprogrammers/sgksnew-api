<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Otp;

class OtpVerificationController extends Controller
{
    public function getOtp(Request $request){
        try{
            $mobile_no = $request['mobile_number'];
            if($mobile_no == null){
                $message = "Please Enter a Valid Mobile No.";
                $status = 412;
            }else{
                $otp = $this->generateOtp();
                $apiKey = urlencode(env('SMS_KEY'));
                $numbers = array($mobile_no);
                $sender = urlencode('TXTLCL');
                $sms = rawurlencode('Your OTP is '.$otp);
                $numbers = implode(',', $numbers);
                // Prepare data for POST request
                $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $sms);
                // Send the POST request with cURL
                $ch = curl_init('https://api.textlocal.in/send/');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $smsStatus = curl_exec($ch);
                curl_close($ch);
                $status = 200;
                $message = "Sms sent successfully";
                $otpGen = new Otp();
                $otpGen['mobile_no'] = $mobile_no;
                $otpGen['otp'] = $otp;
                $otpGen->save();
            }
        }catch (\Exception $e){
            $message= "Fail";
            $status = 500;
            $data = [
                'action' => 'get otp',
                'exception' => $e->getMessage(),
                'params' => $request->all()
            ];
            Log::critical(json_encode($data));
        }
        $response = [
            'message' => $message,
        ];
        return response()->json($response,$status);
    }
    public function verifyOtp(Request $request){
        try{
            $mobile_no = $request['mobile_number'];
            $userotp = $request['otp'];
            $otp = Otp::where('mobile_no',$mobile_no)->orderBy('id','desc')->first();
            if($otp['otp'] == $userotp) {
                $message = "Valid Otp";
                $status = 200;
                $otp->delete();
            }else{
                $message = "Invalid Otp...Please Enter Correct Otp";
                $status = 412;
            }
        }catch(\Exception $e){
            $message = "Fail";
            $status = 500;
            $data = [
                'action' => 'verify otp',
                'exception' => $e->getMessage(),
                'params' => $request->all()
            ];
            Log::critical(json_encode($data));
        }
        $response = [
            'message' => $message,
        ];
        return response()->json($response,$status);
    }
    public function generateOtp(){
        try{
            $OTPCODE = rand(111111,999999);
            return $OTPCODE;
        }catch(\Exception $e){
            $data = [
                'action' => 'generateOtp',
                'exception' => $e->getMessage(),
            ];
            Log::critical(json_encode($data));
        }
    }
}