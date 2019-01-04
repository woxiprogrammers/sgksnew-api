<?php
namespace App\Http\Controllers\CustomTraits;

use App\ClassifiedImages;
use App\ClassifiedPackages;
use App\Classifieds;
use App\ClassifiedsTranslations;
use App\Cities;
use App\PackageRules;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

trait ClassifiedTrait{

    public function listing(Request $request){
         try{
             $take = 10;
             $page_id = ($request->page_id);
             $skip = $page_id * $take;
             $data = array();
             $ids = array();
             $classifiedData = array();
             if($request->has('sgks_city')){
                 $ids = Classifieds::where('city_id',$request->sgks_city)
                     ->pluck('id')->toArray();
             }
             if (count($ids) > 0) {
                 $classifiedData = Classifieds::orderBy('id', 'desc')
                     ->whereIn('id', $ids)
                     ->where('is_active', true)
                     ->skip($skip)->take($take)
                     ->get()->toArray();
             }

             if(count($classifiedData) == 0) {
                 $page_id = "";
             } else {
                 $page_id = $page_id + 1;
             }

             $count = 0;
             foreach ($classifiedData as $classified) {
                 $classifiedPackage = ClassifiedPackages::where('id',$classified['package_id'])->first();
                 $classifiedPackageType = PackageRules::where('id',$classifiedPackage['id'])->first();

                 if ($request->has('language_id')) {
                     $classifiedTranslationData = ClassifiedsTranslations::where('language_id', $request->language_id)
                         ->where('classified_id', $classified['id'])
                         ->get()->toArray();
                     if (count($classifiedTranslationData) > 0) {
                         $data[] = array(
                             'id' => $classified['id'],
                             'title' => ($classifiedTranslationData[0]['title'] != null) ? $classifiedTranslationData[0]['title'] : $classified['title'],
                             'class_desc' => ($classifiedTranslationData[0]['classified_desc'] != null) ? $classifiedTranslationData[0]['classified_desc'] : $classified['description'],
                             'class_pkg' => $classifiedPackage['slug'],
                             'class_type' => $classifiedPackageType['package_desc'],
                             'city' => Cities::where('id', $classified['city_id'])->value('name'),
                             'created_at' => date('Y',strtotime($classified['created_at'])),
                         );
                     } else {
                         $data[] = array(
                             'id' => $classified['id'],
                             'title' => $classified['title'],
                             'class_desc' => $classified['description'],
                             'class_pkg' => $classifiedPackage['slug'],
                             'class_type' => $classifiedPackageType['package_desc'],
                             'city' => Cities::where('id', $classified['city_id'])->value('name'),
                             'created_at' => date('Y',strtotime($classified['created_at'])),
                         );
                     }

                 } else {
                     $data[] = array(
                         'id' => $classified['id'],
                         'title' => $classified['title'],
                         'class_desc' => $classified['description'],
                         'class_pkg' => $classifiedPackage['slug'],
                         'class_type' => $classifiedPackageType['package_desc'],
                         'city' => Cities::where('id', $classified['city_id'])->value('name'),
                         'created_at' => date('Y',strtotime($classified['created_at'])),
                     );
                 }

                 $classifiedImgData = array();
                 $classifiedImageData = ClassifiedImages::where('classified_id', $classified['id'])
                     ->orderBy('id', 'ASC')
                     ->get()->toArray();
                 foreach ($classifiedImageData as $classifiedImage) {
                     $classifiedImg = null;
                     $createClassifiedDirectoryName = sha1($classified['id']);
                     $classifiedImg = env('SGKSWEB_BASEURL') . env('CLASSIFIED_IMAGES_UPLOAD') . DIRECTORY_SEPARATOR . $createClassifiedDirectoryName . DIRECTORY_SEPARATOR . $classifiedImage['image_url'];
                     $classifiedImgData[] = $classifiedImg;
                 }
                 $data[$count]['class_images'] = $classifiedImgData;
                 $count++;
             }
            $message = "Success";
            $status = 200;
        }catch(\Exception $e){
            $message = "Something went wrong";
            $status = 500;
            $data = [
                'action' => 'Get all classified',
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