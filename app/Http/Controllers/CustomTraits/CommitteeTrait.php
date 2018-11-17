<?php
namespace App\Http\Controllers\CustomTraits;

use App\Cities;
use App\CommitteeMembers;
use App\CommitteeMembersTranslations;
use App\Committees;
use App\CommitteesTranslations;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

trait CommitteeTrait{

    public function listing(Request $request){
         try{
             $data = array();
             $committeeData = Committees::where('is_active',true)
                 ->orderBy('id', 'ASC')
                 ->get()->toArray(); //all city data
             $count = 0;
             foreach ($committeeData as $committee) {
                 if ($request->has('language_id')) {
                     $committeeTranslationData = CommitteesTranslations::where('language_id', $request->language_id)
                         ->where('committee_id', $committee['id'])
                         ->get()->toArray();
                     if (count($committeeTranslationData) > 0) {
                        $data[] = array(
                            'id' => $committee['id'],
                            'name' => ($committeeTranslationData[0]['committee_name'] != null) ? $committeeTranslationData[0]['committee_name'] : $committee['committee_name'],
                            'description' => ($committeeTranslationData[0]['description']) ? ($committeeTranslationData[0]['description']) : $committee['description'],
                            'city' => Cities::where('id', $committee['city_id'])->value('name'),
                            "year"=> "2018",
                            'created_at' => $committee['created_at'],
                            'updated_at' => $committee['updated_at']
                        );
                     } else {
                         $data[] = array(
                             'id' => $committee['id'],
                             'name' => $committee['committee_name'],
                             'description' => $committee['description'],
                             'city' => Cities::where('id', $committee['city_id'])->value('name'),
                             "year"=> "2018",
                             'created_at' => $committee['created_at'],
                             'updated_at' => $committee['updated_at']
                         );
                     }
                 } else {
                     $data[] = array(
                         'id' => $committee['id'],
                         'name' => $committee['committee_name'],
                         'description' => $committee['description'],
                         'city' => Cities::where('id', $committee['city_id'])->value('name'),
                         "year"=> "2018",
                         'created_at' => $committee['created_at'],
                         'updated_at' => $committee['updated_at']
                     );
                 }
                 $memData = array();
                 $committeeMemberData = CommitteeMembers::where('committee_id', $committee['id'])
                     ->orderBy('id', 'ASC')
                     ->get()->toArray();
                 foreach ($committeeMemberData as $committeMember) {
                     $memberImg = null;
                     if($committeMember['profile_image'] != null) {
                         $createMemberDirectoryName = sha1($committeMember['id']);
                         $memberImg = env('SGKSWEB_BASEURL').env('COMMITTEE_MEMBER_IMAGES_UPLOAD').DIRECTORY_SEPARATOR.$createMemberDirectoryName.DIRECTORY_SEPARATOR.$committeMember['profile_image'];
                     }

                     if ($request->has('language_id')) {
                         $committeeMemberTranslationData = CommitteeMembersTranslations::where('language_id', $request->language_id)
                             ->where('member_id', $committeMember['id'])
                             ->get()->toArray();
                         if (count($committeeMemberTranslationData) > 0) {
                             $memData[] = array(
                                 'id' => $committeMember['id'],
                                 'fullname' => ($committeeMemberTranslationData[0]['full_name'] != null) ? $committeeMemberTranslationData[0]['full_name'] : $committeMember['full_name'],
                                 'member_image' => $memberImg,
                                 'area' => Cities::where('id', $committee['city_id'])->value('name'),
                                 "cont_number"=> $committeMember['mobile_number'],
                                 "email_id"=> $committeMember['email_id'],
                                 'created_at' => $committeMember['created_at'],
                                 'updated_at' => $committeMember['updated_at']
                             );
                         } else {
                             $memData[] = array(
                                 'id' => $committeMember['id'],
                                 'fullname' => $committeMember['full_name'],
                                 'member_image' => $memberImg,
                                 'area' => Cities::where('id', $committee['city_id'])->value('name'),
                                 "cont_number"=> $committeMember['mobile_number'],
                                 "email_id"=> $committeMember['email_id'],
                                 'created_at' => $committeMember['created_at'],
                                 'updated_at' => $committeMember['updated_at']
                             );
                         }
                     } else {
                         $memData[] = array(
                             'id' => $committeMember['id'],
                             'fullname' => $committeMember['full_name'],
                             'member_image' => $memberImg,
                             'area' => Cities::where('id', $committee['city_id'])->value('name'),
                             "cont_number"=> $committeMember['mobile_number'],
                             "email_id"=> $committeMember['email_id'],
                             'created_at' => $committeMember['created_at'],
                             'updated_at' => $committeMember['updated_at']
                         );
                     }

                 }
                 $data[$count]['members'] = $memData;
                 $count++;
             }
            $message = "Success";
            $status = 200;
        }catch(\Exception $e){
            $message = "Fail";
            $status = 500;
            $data = [
                'action' => 'Get all committee & Committee members data',
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