<?php
namespace App\Http\Controllers\CustomTraits;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

trait MemberTrait{

    public function listing(Request $request){
         try{
             
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
            'data' => $data
        ];
        return response()->json($response,$status);
    }


}