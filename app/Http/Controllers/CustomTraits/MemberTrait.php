<?php
namespace App\Http\Controllers\CustomTraits;

use App\BloodGroup;
use App\Cities;
use App\MemberTranslations;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Members;
use Illuminate\Support\Facades\File;

trait MemberTrait{

    public function listing(Request $request){
         try{
             $take = 10;
             $page_id = ($request->page_id);
             $skip = $page_id * $take;
             $data = array();
             $ids = array();
             if($request->has('sgks_city')){
                 $ids = Members::where('city_id',$request->sgks_city)
                     ->pluck('id')->toArray();
             }

             if($request->has('search_fullname')){
                    $ids = Members::whereRaw("CONCAT(first_name,' ',middle_name,' ',last_name) ilike '%".$request->search_fullname."%'")
                                    ->whereIn('id', $ids)
                                    ->pluck('id')->toArray();
             }

             $memberData = Members::whereIn('id', $ids)
                                    ->where('is_active', true)
                                    ->skip($skip)->take($take)
                                    ->get()->toArray();
             if(count($memberData) == 0) {
                 $page_id = "";
             } else {
                 $page_id = $page_id + 1;
             }


             foreach ($memberData as $member) {
                 if ($request->has('language_id')) {
                     $memDataInOtherLang = MemberTranslations::where('language_id', $request->language_id)
                                            ->where('member_id', $member['id'])
                                            ->get()->toArray();
                     if (count($memDataInOtherLang) > 0) {
                         $data[] = array(
                             'id' => $member['id'],
                             'first_name' => ucwords($memDataInOtherLang[0]['first_name']),
                             'middle_name' => ucwords($memDataInOtherLang[0]['middle_name']),
                             'last_name' => ucwords($memDataInOtherLang[0]['last_name']),
                             'address' => ucwords($memDataInOtherLang[0]['address']),
                             'city' => Cities::where('id', $member['city_id'])->value('name'),
                             'gender' => $member['gender'],
                             'mobile' => $member['mobile'],
                             'date_of_birth' => $member['date_of_birth'],
                             'email' => $member['email'],
                             'blood_group' => BloodGroup::where('id', $member['blood_group_id'])->value('blood_group_type'),
                             'latitude' => $member['latitude'],
                             'longitude' => $member['longitude'],
                             'member_image_url' => env('SGKSWEB_BASEURL').env('MEMBER_IMAGE_UPLOAD').sha1($member['id']).DIRECTORY_SEPARATOR.$member['profile_image'],
                             'created_at' => $member['created_at'],
                             'updated_at' => $member['updated_at']
                         );
                     } else {
                         $data[] = array(
                             'id' => $member['id'],
                             'first_name' => ucwords($member['first_name']),
                             'middle_name' => ucwords($member['middle_name']),
                             'last_name' => ucwords($member['last_name']),
                             'address' => ucwords($member['address']),
                             'city' => Cities::where('id', $member['city_id'])->value('name'),
                             'gender' => $member['gender'],
                             'mobile' => $member['mobile'],
                             'date_of_birth' => $member['date_of_birth'],
                             'email' => $member['email'],
                             'blood_group' => BloodGroup::where('id', $member['blood_group_id'])->value('blood_group_type'),
                             'latitude' => $member['latitude'],
                             'longitude' => $member['longitude'],
                             'member_image_url' => env('SGKSWEB_BASEURL').env('MEMBER_IMAGE_UPLOAD').sha1($member['id']).DIRECTORY_SEPARATOR.$member['profile_image'],
                             'created_at' => $member['created_at'],
                             'updated_at' => $member['updated_at']
                         );
                     }

                 } else {
                     $data[] = array(
                         'id' => $member['id'],
                         'first_name' => ucwords($member['first_name']),
                         'middle_name' => ucwords($member['middle_name']),
                         'last_name' => ucwords($member['last_name']),
                         'address' => ucwords($member['address']),
                         'city' => Cities::where('id', $member['city_id'])->value('name'),
                         'gender' => $member['gender'],
                         'mobile' => $member['mobile'],
                         'date_of_birth' => $member['date_of_birth'],
                         'email' => $member['email'],
                         'blood_group' => BloodGroup::where('id', $member['blood_group_id'])->value('blood_group_type'),
                         'latitude' => $member['latitude'],
                         'longitude' => $member['longitude'],
                         'member_image_url' => env('SGKSWEB_BASEURL').env('MEMBER_IMAGE_UPLOAD').sha1($member['id']).DIRECTORY_SEPARATOR.$member['profile_image'],
                         'created_at' => $member['created_at'],
                         'updated_at' => $member['updated_at']
                     );
                 }

             }
            $message = "Success";
            $status = 200;
        }catch(\Exception $e){
            $message = "Fail";
            $status = 500;
            $data = [
                'action' => 'Get all members Listing with Search',
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

    public function addMember(Request $request) {
        try{
            $data = $request->all();
            $membersData['first_name'] = $data['first_name'];
            $membersData['middle_name'] = $data['middle_name'];
            $membersData['last_name'] = $data['last_name'];
            if(array_key_exists('gender',$data)){
                $membersData['gender'] = $data['gender'];
            }
            $membersData['address'] = $data['address'];
            $membersData['date_of_birth'] = $data['date_of_birth'];
            $membersData['blood_group_id'] = $data['blood_group_id'];
            $membersData['mobile'] = $data['mobile'];
            $membersData['email'] = $data['email'];
            $membersData['city_id'] = $data['city_id'];
            $membersData['longitude'] = null; // currently No functionality
            $membersData['latitude'] = null;
            $createMember = Members::create($membersData);

            if($request->has('profile_images')){
                $createMemberDirectoryName = sha1($createMember->id);
                $tempUploadFile = env('WEB_PUBLIC_PATH').env('MEMBER_TEMP_IMAGE_UPLOAD').$data['profile_images'];
                if(File::exists($tempUploadFile)){
                    $imageUploadNewPath = env('WEB_PUBLIC_PATH').env('MEMBER_IMAGE_UPLOAD').DIRECTORY_SEPARATOR.$createMemberDirectoryName;
                    if(!file_exists($imageUploadNewPath)) {
                        File::makeDirectory($imageUploadNewPath, $mode = 0777, true, true);
                    }
                    $imageUploadNewPath .= DIRECTORY_SEPARATOR.$data['profile_images'];
                    File::move($tempUploadFile,$imageUploadNewPath);
                    $createMember->update([
                        'profile_image' => $data['profile_images'],
                    ]);
                }
            }
            $message = "Member Added Successfully";
            $status = 200;
            $response = [
                'message' => $message,
            ];
            return response()->json($response,$status);

        }catch(\Exception $exception){
            $message = "Fail";
            $status = 500;
            $data = [
                'action' => 'Member Add',
                'exception' => $exception->getMessage(),
                'params' => $request->all()
            ];
            Log::critical(json_encode($data));
        }
        $response = [
            'message' => $message,
        ];
        return response()->json($response,$status);
    }


}