<?php
namespace App\Http\Controllers\CustomTraits;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Members;
use Illuminate\Support\Facades\File;

trait MemberTrait{

    public function listing(Request $request){
         try{
             $displayLength = 5;
             $totalRecords = $request->page_id * $displayLength;
             $page_id = 1;
             $data = array(
                     array(
                         'id'=> 1,
                          'surname'=> 'Vaghela',
                          'native_place'=> 'Sampar',
                          'sgks_city'=> 'PUNE',
                          'member_id'=> '1-1',
                          'first_name'=> 'Gokal',
                          'middle_name'=> 'Rajabhai',
                          'gender'=> 'Male',
                          'mobile'=> '9371277787',
                          'birth_date'=> '1942-05-20',
                          'area'=> 'Somwar Peth',
                          'latitude'=> '18.507315',
                          'longitude'=> '73.8022309',
                          'member_image_url'=> 'https=>//scontent.fpnq4-1.fna.fbcdn.net/v/t1.0-9/16196015_10154888128487744_6901111466535510271_n.png?_nc_cat=0&oh=7c376a1d2a48b490c25f842966b160ae&oe=5C2F0CE9',
                          'blood_group'=> 'B+',
                          'marital_status'=> 'Single',
                          'address'=> array (
                            'address_line'=> '210, Somwar Peth, Shree Apartment',
                            'area'=> 'Somwar Peth',
                            'city'=> 'Pune',
                            'country'=> 'IN',
                            'id'=> '1',
                            'landmark'=> 'near nageshwar temple',
                            'pincode'=> '411011',
                            'state'=> 'MH'
                          )
                      ),
                     array(
                          'id'=> 2,
                          'surname'=> 'Vaghela',
                          'native_place'=> 'Sampar',
                          'sgks_city'=> 'PUNE',
                          'member_id'=> '1-2',
                          'first_name'=> 'Ram',
                          'middle_name'=> 'Rajabhai',
                          'gender'=> 'Male',
                          'mobile'=> '9371277777',
                          'birth_date'=> '1942-05-20',
                          'area'=> 'Somwar Peth',
                          'latitude'=> '18.507315',
                          'longitude'=> '73.8022309',
                          'member_image_url'=> 'https=>//scontent.fpnq4-1.fna.fbcdn.net/v/t1.0-9/16196015_10154888128487744_6901111466535510271_n.png?_nc_cat=0&oh=7c376a1d2a48b490c25f842966b160ae&oe=5C2F0CE9',
                          'blood_group'=> 'B+',
                          'marital_status'=> 'Single',
                          'address'=> array (
                            'address_line'=> '210, Somwar Peth, Shree Apartment',
                            'area'=> 'Somwar Peth123',
                            'city'=> 'Pune',
                            'country'=> 'IN',
                            'id'=> '1',
                            'landmark'=> 'near nageshwar temple',
                            'pincode'=> '411011',
                            'state'=> 'MH'
                          )
                      ),
                      array(
                          'id'=> 3,
                          'surname'=> 'Vaghela',
                          'native_place'=> 'Sampar',
                          'sgks_city'=> 'PUNE',
                          'member_id'=> '1-3',
                          'first_name'=> 'Ramesh',
                          'middle_name'=> 'Rajabhai',
                          'gender'=> 'Male',
                          'mobile'=> '9331277777',
                          'birth_date'=> '1942-07-20',
                          'area'=> 'Somwar Peth',
                          'latitude'=> '18.507315',
                          'longitude'=> '73.8022309',
                          'member_image_url'=> 'https=>//scontent.fpnq4-1.fna.fbcdn.net/v/t1.0-9/16196015_10154888128487744_6901111466535510271_n.png?_nc_cat=0&oh=7c376a1d2a48b490c25f842966b160ae&oe=5C2F0CE9',
                          'blood_group'=> 'B+',
                          'marital_status'=> 'Single',
                          'address'=> array (
                            'address_line'=> '2234410, Somwar Peth, Shree Apartment',
                            'area'=> 'Somwar Peth123',
                            'city'=> 'Pune',
                            'country'=> 'IN',
                            'id'=> '1',
                            'landmark'=> 'near nageshwar temple',
                            'pincode'=> '411011',
                            'state'=> 'MH'
                          )
                      ),
                      array(
                          'id'=> 4,
                          'surname'=> 'Vaghela',
                          'native_place'=> 'Sampar',
                          'sgks_city'=> 'PUNE',
                          'member_id'=> '1-4',
                          'first_name'=> 'Rajesh',
                          'middle_name'=> 'Rajabhai',
                          'gender'=> 'Male',
                          'mobile'=> '9331277777',
                          'birth_date'=> '1942-07-20',
                          'area'=> 'Somwar Peth',
                          'latitude'=> '18.507315',
                          'longitude'=> '73.8022309',
                          'member_image_url'=> 'https=>//scontent.fpnq4-1.fna.fbcdn.net/v/t1.0-9/16196015_10154888128487744_6901111466535510271_n.png?_nc_cat=0&oh=7c376a1d2a48b490c25f842966b160ae&oe=5C2F0CE9',
                          'blood_group'=> 'B+',
                          'marital_status'=> 'Single',
                          'address'=> array (
                            'address_line'=> '2234410,qq Somwar Peth, Shree Apartment',
                            'area'=> 'Somwar Peth123',
                            'city'=> 'Pune',
                            'country'=> 'IN',
                            'id'=> '1',
                            'landmark'=> 'near nageshwar temple',
                            'pincode'=> '411011',
                            'state'=> 'MH'
                          )
                      ),
                      array(
                          'id'=> 5,
                          'surname'=> 'Vaghela',
                          'native_place'=> 'Sampar',
                          'sgks_city'=> 'PUNE',
                          'member_id'=> '1-5',
                          'first_name'=> 'Rupesh',
                          'middle_name'=> 'Rajabhai',
                          'gender'=> 'Male',
                          'mobile'=> '9331266777',
                          'birth_date'=> '1942-07-20',
                          'area'=> 'Somwar Peth',
                          'latitude'=> '18.507315',
                          'longitude'=> '73.8022309',
                          'member_image_url'=> 'https=>//scontent.fpnq4-1.fna.fbcdn.net/v/t1.0-9/16196015_10154888128487744_6901111466535510271_n.png?_nc_cat=0&oh=7c376a1d2a48b490c25f842966b160ae&oe=5C2F0CE9',
                          'blood_group'=> 'B+',
                          'marital_status'=> 'Single',
                          'address'=> array (
                            'address_line'=> '2234410,qq Somwar Peth, Shree Apartment',
                            'area'=> 'Somwar Peth123',
                            'city'=> 'Pune',
                            'country'=> 'IN',
                            'id'=> '1',
                            'landmark'=> 'near nageshwar temple',
                            'pincode'=> '411011',
                            'state'=> 'MH'
                          )
                      ),
                      array(
                          'id'=> 6,
                          'surname'=> 'Vaghela',
                          'native_place'=> 'Sampar',
                          'sgks_city'=> 'PUNE',
                          'member_id'=> '1-3',
                          'first_name'=> 'Rames2h',
                          'middle_name'=> 'Rajabhai',
                          'gender'=> 'Male',
                          'mobile'=> '9331277777',
                          'birth_date'=> '1942-07-20',
                          'area'=> 'Somwar Peth',
                          'latitude'=> '18.507315',
                          'longitude'=> '73.8022309',
                          'member_image_url'=> 'https=>//scontent.fpnq4-1.fna.fbcdn.net/v/t1.0-9/16196015_10154888128487744_6901111466535510271_n.png?_nc_cat=0&oh=7c376a1d2a48b490c25f842966b160ae&oe=5C2F0CE9',
                          'blood_group'=> 'B+',
                          'marital_status'=> 'Single',
                          'address'=> array (
                            'address_line'=> '2234410, Somwar Peth, Shree Apartment',
                            'area'=> 'Somwar Peth123',
                            'city'=> 'Pune',
                            'country'=> 'IN',
                            'id'=> '1',
                            'landmark'=> 'near nageshwar temple',
                            'pincode'=> '411011',
                            'state'=> 'MH'
                          )
                      ),
                      array(
                          'id'=> 7,
                          'surname'=> 'Vaghela',
                          'native_place'=> 'Sampar',
                          'sgks_city'=> 'PUNE',
                          'member_id'=> '1-4',
                          'first_name'=> 'Rajes3h',
                          'middle_name'=> 'Rajabhai',
                          'gender'=> 'Male',
                          'mobile'=> '9331277777',
                          'birth_date'=> '1942-07-20',
                          'area'=> 'Somwar Peth',
                          'latitude'=> '18.507315',
                          'longitude'=> '73.8022309',
                          'member_image_url'=> 'https=>//scontent.fpnq4-1.fna.fbcdn.net/v/t1.0-9/16196015_10154888128487744_6901111466535510271_n.png?_nc_cat=0&oh=7c376a1d2a48b490c25f842966b160ae&oe=5C2F0CE9',
                          'blood_group'=> 'B+',
                          'marital_status'=> 'Single',
                          'address'=> array (
                            'address_line'=> '2234410,qq Somwar Peth, Shree Apartment',
                            'area'=> 'Somwar Peth123',
                            'city'=> 'Pune',
                            'country'=> 'IN',
                            'id'=> '1',
                            'landmark'=> 'near nageshwar temple',
                            'pincode'=> '411011',
                            'state'=> 'MH'
                          )
                      ),
                      array(
                          'id'=> 8,
                          'surname'=> 'Vaghela',
                          'native_place'=> 'Sampar',
                          'sgks_city'=> 'PUNE',
                          'member_id'=> '1-5',
                          'first_name'=> 'Rup33esh',
                          'middle_name'=> 'Rajabhai',
                          'gender'=> 'Male',
                          'mobile'=> '9331266777',
                          'birth_date'=> '1942-07-20',
                          'area'=> 'Somwar Peth',
                          'latitude'=> '18.507315',
                          'longitude'=> '73.8022309',
                          'member_image_url'=> 'https=>//scontent.fpnq4-1.fna.fbcdn.net/v/t1.0-9/16196015_10154888128487744_6901111466535510271_n.png?_nc_cat=0&oh=7c376a1d2a48b490c25f842966b160ae&oe=5C2F0CE9',
                          'blood_group'=> 'B+',
                          'marital_status'=> 'Single',
                          'address'=> array (
                            'address_line'=> '2234410,qq Somwar Peth, Shree Apartment',
                            'area'=> 'Somwar Peth123',
                            'city'=> 'Pune',
                            'country'=> 'IN',
                            'id'=> '1',
                            'landmark'=> 'near nageshwar temple',
                            'pincode'=> '411011',
                            'state'=> 'MH'
                          )
                      ),
                      array(
                          'id'=> 9,
                          'surname'=> 'Vaghela',
                          'native_place'=> 'Sampar',
                          'sgks_city'=> 'PUNE',
                          'member_id'=> '1-3',
                          'first_name'=> 'Ramesh',
                          'middle_name'=> 'Rajabhai',
                          'gender'=> 'Male',
                          'mobile'=> '9331277777',
                          'birth_date'=> '1942-07-20',
                          'area'=> 'Somwar Peth',
                          'latitude'=> '18.507315',
                          'longitude'=> '73.8022309',
                          'member_image_url'=> 'https=>//scontent.fpnq4-1.fna.fbcdn.net/v/t1.0-9/16196015_10154888128487744_6901111466535510271_n.png?_nc_cat=0&oh=7c376a1d2a48b490c25f842966b160ae&oe=5C2F0CE9',
                          'blood_group'=> 'B+',
                          'marital_status'=> 'Single',
                          'address'=> array (
                            'address_line'=> '2234410, Somwar Peth, Shree Apartment',
                            'area'=> 'Somwar Peth123',
                            'city'=> 'Pune',
                            'country'=> 'IN',
                            'id'=> '1',
                            'landmark'=> 'near nageshwar temple',
                            'pincode'=> '411011',
                            'state'=> 'MH'
                          )
                      ),
                      array(
                          'id'=> 10,
                          'surname'=> 'Vaghela',
                          'native_place'=> 'Sampar',
                          'sgks_city'=> 'PUNE',
                          'member_id'=> '1-4',
                          'first_name'=> 'Rajeseeh',
                          'middle_name'=> 'Rajabhai',
                          'gender'=> 'Male',
                          'mobile'=> '9331277777',
                          'birth_date'=> '1942-07-20',
                          'area'=> 'Somwar Peth',
                          'latitude'=> '18.507315',
                          'longitude'=> '73.8022309',
                          'member_image_url'=> 'https=>//scontent.fpnq4-1.fna.fbcdn.net/v/t1.0-9/16196015_10154888128487744_6901111466535510271_n.png?_nc_cat=0&oh=7c376a1d2a48b490c25f842966b160ae&oe=5C2F0CE9',
                          'blood_group'=> 'B+',
                          'marital_status'=> 'Single',
                          'address'=> array (
                            'address_line'=> '2234410,qq Somwar Peth, Shree Apartment',
                            'area'=> 'Somwar Peth123',
                            'city'=> 'Pune',
                            'country'=> 'IN',
                            'id'=> '1',
                            'landmark'=> 'near nageshwar temple',
                            'pincode'=> '411011',
                            'state'=> 'MH'
                          )
                      ),
                      array(
                          'id'=> 11,
                          'surname'=> 'Vaghela',
                          'native_place'=> 'Sampar',
                          'sgks_city'=> 'PUNE',
                          'member_id'=> '1-5',
                          'first_name'=> 'Rupe333sh',
                          'middle_name'=> 'Rajabhai',
                          'gender'=> 'Male',
                          'mobile'=> '9331266777',
                          'birth_date'=> '1942-07-20',
                          'area'=> 'Somwar Peth',
                          'latitude'=> '18.507315',
                          'longitude'=> '73.8022309',
                          'member_image_url'=> 'https=>//scontent.fpnq4-1.fna.fbcdn.net/v/t1.0-9/16196015_10154888128487744_6901111466535510271_n.png?_nc_cat=0&oh=7c376a1d2a48b490c25f842966b160ae&oe=5C2F0CE9',
                          'blood_group'=> 'B+',
                          'marital_status'=> 'Single',
                          'address'=> array (
                            'address_line'=> '2234410,qq Somwar Peth, Shree Apartment',
                            'area'=> 'Somwar Peth123',
                            'city'=> 'Pune',
                            'country'=> 'IN',
                            'id'=> '1',
                            'landmark'=> 'near nageshwar temple',
                            'pincode'=> '411011',
                            'state'=> 'MH'
                          )
                      ),
                      array(
                          'id'=> 12,
                          'surname'=> 'Vaghela',
                          'native_place'=> 'Sampar',
                          'sgks_city'=> 'PUNE',
                          'member_id'=> '1-5',
                          'first_name'=> 'Rupe33sh',
                          'middle_name'=> 'Rajabhai',
                          'gender'=> 'Male',
                          'mobile'=> '9331266777',
                          'birth_date'=> '1942-07-20',
                          'area'=> 'Somwar Peth',
                          'latitude'=> '18.507315',
                          'longitude'=> '73.8022309',
                          'member_image_url'=> 'https=>//scontent.fpnq4-1.fna.fbcdn.net/v/t1.0-9/16196015_10154888128487744_6901111466535510271_n.png?_nc_cat=0&oh=7c376a1d2a48b490c25f842966b160ae&oe=5C2F0CE9',
                          'blood_group'=> 'B+',
                          'marital_status'=> 'Single',
                          'address'=> array (
                            'address_line'=> '2234410,qq Somwar Peth, Shree Apartment',
                            'area'=> 'Somwar Peth123',
                            'city'=> 'Pune',
                            'country'=> 'IN',
                            'id'=> '1',
                            'landmark'=> 'near nageshwar temple',
                            'pincode'=> '411011',
                            'state'=> 'MH'
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