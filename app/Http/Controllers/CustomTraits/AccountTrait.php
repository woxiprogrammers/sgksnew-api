<?php
namespace App\Http\Controllers\CustomTraits;

use App\AccountImages;
use App\Accounts;
use App\AccountsTranslations;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

trait AccountTrait{

    public function listing(Request $request){
         try{
             $data = array();
             if ($request->has('year')) {
                 $year = $request->year;
             } else {
                 $year = date("Y");
             }
             $ids = Accounts::whereYear('created_at', '=', $year)->pluck('id')->toArray();

             if($request->has('sgks_city')){
                 $ids = Accounts::where('city_id',$request->sgks_city)
                     ->whereIn('id',$ids)
                     ->pluck('id')->toArray();
             }

             $accountData = Accounts::orderBy('id', 'DESC')
                 ->whereIn('id', $ids)
                 ->get()->toArray(); //all city data

             $count = 0;
             foreach ($accountData as $account) {
                 if ($request->has('language_id')) {
                     $accountTranslationData = AccountsTranslations::where('language_id', $request->language_id)
                         ->where('account_id', $account['id'])
                         ->get()->toArray();
                     if (count($accountTranslationData) > 0) {
                         $data[] = array(
                             'id' => $account['id'],
                             'name' => ($accountTranslationData[0]['name'] != null) ? $accountTranslationData[0]['name'] : $account['name'],
                             'description' => ($accountTranslationData[0]['description']) ? $accountTranslationData[0]['description'] : $account['description'],
                             'created_at' => $account['created_at'],
                             'updated_at' => $account['updated_at']
                         );
                     } else {
                         $data[] = array(
                             'id' => $account['id'],
                             'name' => $account['name'],
                             'description' => $account['description'],
                             'created_at' => $account['created_at'],
                             'updated_at' => $account['updated_at']
                         );
                     }
                 } else {
                     $data[] = array(
                         'id' => $account['id'],
                         'name' => $account['name'],
                         'description' => $account['description'],
                         'created_at' => $account['created_at'],
                         'updated_at' => $account['updated_at']
                     );
                 }
                 $AccountImgData = array();
                 $accountImageData = AccountImages::where('account_id', $account['id'])
                     ->orderBy('id', 'ASC')
                     ->get()->toArray();
                 foreach ($accountImageData as $accountImage) {
                     $accImg = null;
                     $createMemberDirectoryName = sha1($account['id']);
                     $accImg = env('SGKSWEB_BASEURL') . env('ACCOUNT_IMAGES_UPLOAD') . DIRECTORY_SEPARATOR . $createMemberDirectoryName . DIRECTORY_SEPARATOR . $accountImage['url'];
                     $AccountImgData[] = $accImg;
                 }
                 $data[$count]['accounts_images'] = $AccountImgData;
                 $count++;
             }

            $message = "Success";
            $status = 200;
        }catch(\Exception $e){
            $message = "Fail";
            $status = 500;
            $data = [
                'action' => 'Get all Accounts data',
                'exception' => $e->getMessage(),
                'params' => $request->all()
            ];
            Log::critical(json_encode($data));
        }
        $response = [
            'message' => $message,
            'data' => $data,
        ];
        return response()->json($response,$status);
    }


}