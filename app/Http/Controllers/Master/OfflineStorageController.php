<?php

namespace App\Http\Controllers\Master;

use App\CityTranslations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\AccountImages;
use App\Accounts;
use App\AccountsTranslations;
use App\BloodGroup;
use App\Cities;
use App\ClassifiedImages;
use App\ClassifiedPackages;
use App\ClassifiedsTranslations;
use App\CommitteeMembers;
use App\CommitteeMembersTranslations;
use App\Committees;
use App\CommitteesTranslations;
use App\EventImages;
use App\Events;
use App\EventsTranslations;
use App\Members;
use App\MemberTranslations;
use App\MessageTranslations;
use App\Classifieds;
use App\Messages;
use App\MessageTypes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class OfflineStorageController extends Controller
{

    public function localStorageOffline(Request $request) {
        try{
            $members = array();
            $events = array();
            $memberEn = array();
            $eventEn = array();
            $accountEn = array();
            $committeeEn = array();
            $classifiedEn = array();
            $cityEn = array();
            $committeeMembersEn = array();
            $messageEn = array();
            $accounts = array();
            $committees = array();
            $messages = array();
            $classifieds = array();
            $cities = array();
            $committeeMembersGj = array();
            $date = Carbon::now()->toDateTimeString();
            if($request->has('current_timestamp') && ($request->current_timestamp == null || $request->current_timestamp == '')) {

                //City Data
                $citiesData = Cities::orderBy('id','ASC')->get()->toArray();
                foreach ($citiesData as $city){
                    $cityEn[] = array(
                        'id' => $city['id'],
                        'name' => $city['name'],
                        'state_id' => $city['state_id'],
                        'is_active' => $city['is_active'],
                        'city_member_count' => Members::where('city_id',$city['id'])->get()->count(),
                        'created_at' => $city['created_at'],
                        'updated_at' => $city['updated_at'],
                     );
                }
                $cities = array(
                  'city_en' => $cityEn,
                  'city_gj' => CityTranslations::orderBy('id','ASC')->get()->toArray(),
                );
                //members data
                $membersData = Members::orderBy('id','ASC')->get()->toArray();
                $memberGj = MemberTranslations::orderBy('id','ASC')->get()->toArray();
                foreach ($membersData as $memberData) {
                    $memberEn[] = array(
                        'id' => $memberData['id'],
                        'first_name' => $memberData['first_name'],
                        'middle_name' => $memberData['middle_name'],
                        'last_name' => $memberData['last_name'],
                        'address' => $memberData['address'],
                        'gender' => $memberData['gender'],
                        'date_of_birth' => date('d-m-Y',strtotime($memberData['date_of_birth'])),
                        'blood_group' => BloodGroup::where('id', $memberData['blood_group_id'])->value('slug'),
                        'blood_group_id' => $memberData['blood_group_id'],
                        'mobile' => $memberData['mobile'],
                        'email' => $memberData['email'],
                        'city' => Cities::where('id', $memberData['city_id'])->value('name'),
                        'city_id' => $memberData['city_id'],
                        'longitude' => $memberData['longitude'],
                        'latitude' => $memberData['latitude'],
                        'profile_image' => ($memberData['profile_image'] != null) ? env('SGKSWEB_BASEURL') . env('MEMBER_IMAGE_UPLOAD') . sha1($memberData['id']) . DIRECTORY_SEPARATOR . $memberData['profile_image'] : null,
                        'is_active' => $memberData['is_active'],
                        'created_at' => $memberData['created_at'],
                        'updated_at' => $memberData['updated_at'],
                    );
                }
                $members = array(
                    'member_en' => $memberEn,
                    'member_gj' => $memberGj,
                );

                //Event Data
                $eventsData = Events::orderBy('id','ASC')->get()->toArray();
                $eventGj = EventsTranslations::orderBy('id','ASC')->get()->toArray();
                foreach ($eventsData as $eventData){
                    $EventImgData = array();
                    $eventImageData = EventImages::where('event_id', $eventData['id'])
                        ->orderBy('id', 'ASC')
                        ->get()->toArray();
                    foreach ($eventImageData as $eventImage) {
                        $evnImg = null;
                        $createEventDirectoryName = sha1($eventData['id']);
                        $evnImg = env('SGKSWEB_BASEURL') . env('EVENT_IMAGES_UPLOAD') . DIRECTORY_SEPARATOR . $createEventDirectoryName . DIRECTORY_SEPARATOR . $eventImage['url'];
                        $EventImgData[] = $evnImg;
                    }
                    $eventEn[] = array(
                        'id' =>  $eventData['id'],
                        'event_name' =>  $eventData['event_name'],
                        'description' =>  $eventData['description'],
                        'venue' =>  $eventData['venue'],
                        'event_date' => date('d M y',strtotime($eventData['start_date']))." to ".date('d M y',strtotime($eventData['end_date'])),
                        'is_active' =>  $eventData['is_active'],
                        'city' => Cities::where('id',$eventData['city_id'])->value('name'),
                        'city_id' =>  $eventData['city_id'],
                        'event_images' => $EventImgData,
                        'created_at' =>  $eventData['created_at'],
                        'updated_at' =>  $eventData['updated_at'],
                        'year' => date('Y',strtotime($eventData['start_date'])),
                    );
                }
                $events = array(
                    'event_en' => $eventEn,
                    'event_gj' => $eventGj,
                );

                //Account Data
                $accountsData = Accounts::orderBy('id','ASC')->get()->toArray();
                $accountGj = AccountsTranslations::orderBy('id','ASC')->get()->toArray();
                foreach ($accountsData as $accountData){
                    $AccountImgData = array();
                    $accountImageData = AccountImages::where('account_id', $accountData['id'])
                        ->orderBy('id', 'ASC')
                        ->get()->toArray();
                    foreach ($accountImageData as $accountImage) {
                        $accImg = null;
                        $createMemberDirectoryName = sha1($accountData['id']);
                        $accImg = env('SGKSWEB_BASEURL') . env('ACCOUNT_IMAGES_UPLOAD') . DIRECTORY_SEPARATOR . $createMemberDirectoryName . DIRECTORY_SEPARATOR . $accountImage['url'];
                        $AccountImgData[] = $accImg;
                    }
                    $accountEn[] = array(
                        'id' =>  $accountData['id'],
                        'name' =>  $accountData['name'],
                        'description' =>  $accountData['description'],
                        'is_active' =>  $accountData['is_active'],
                        'city' => Cities::where('id',$accountData['city_id'])->value('name'),
                        'city_id' =>  $accountData['city_id'],
                        'account_images' => $AccountImgData,
                        'created_at' =>  $accountData['created_at'],
                        'updated_at' =>  $accountData['updated_at'],
                        'year' => date('Y',strtotime($accountData['created_at'])),
                    );
                }
                $accounts = array(
                    'account_en' => $accountEn,
                    'account_gj' => $accountGj,
                );

                //committee Data
                $committeesData = Committees::orderBy('id','ASC')->get()->toArray();
                $committeeGj = CommitteesTranslations::orderBy('id','ASC')->get()->toArray();
                foreach ($committeesData as $committeeData){
                    $committeeMembersData = CommitteeMembers::where('committee_id',$committeeData['id'])->orderBy('id','ASC')->get()->toArray();
                    foreach ($committeeMembersData as $committeeMemberData){
                        $committeeMembersEn[] = array(
                            'id' =>  $committeeMemberData['id'],
                            'committee_id' =>  $committeeMemberData['committee_id'],
                            'fullname' =>  $committeeMemberData['full_name'],
                            'designation' =>  $committeeMemberData['designation'],
                            'cont_number' =>  $committeeMemberData['mobile_number'],
                            'email_id' =>  $committeeMemberData['email_id'],
                            'is_active' =>  $committeeMemberData['is_active'],
                            'area' => Cities::where('id',$committeeData['city_id'])->value('name'),
                            'profile_image' => ($committeeMemberData['profile_image'] != null) ? env('SGKSWEB_BASEURL').env('COMMITTEE_MEMBER_IMAGES_UPLOAD').DIRECTORY_SEPARATOR.sha1($committeeMemberData['id']).DIRECTORY_SEPARATOR.$committeeMemberData['profile_image'] : null,
                            'created_at' =>  $committeeMemberData['created_at'],
                            'updated_at' =>  $committeeMemberData['updated_at'],
                        );
                    }

                    $memberIds = CommitteeMembers::where('committee_id',$committeeData['id'])
                        ->pluck('id')->toArray();
                    $committeeMembersDataGj = CommitteeMembersTranslations::whereIn('member_id', $memberIds)
                        ->orderBy('id','ASC')
                        ->get()->toArray();
                    foreach ($committeeMembersDataGj as $committeeMemberDataGj){
                        $committeeMembersGj[] = array(
                            'id' => $committeeMemberDataGj['id'],
                            'language_id' => $committeeMemberDataGj['language_id'],
                            'member_id' => $committeeMemberDataGj['member_id'],
                            'created_at' => $committeeMemberDataGj['created_at'],
                            'updated_at' => $committeeMemberDataGj['updated_at'],
                            'fullname' => $committeeMemberDataGj['full_name'],
                        );
                    }
                    $committeeMembers = array(
                        'member_en' => $committeeMembersEn,
                        'member_gj' => $committeeMembersGj,
                    );
                    $committeeMembersEn = $committeeMembersGj =  [];
                    $committeeEn[] = array(
                        'id' =>  $committeeData['id'],
                        'name' =>  $committeeData['committee_name'],
                        'description' =>  $committeeData['description'],
                        'is_active' =>  $committeeData['is_active'],
                        'city' => Cities::where('id',$committeeData['city_id'])->value('name'),
                        'city_id' =>  $committeeData['city_id'],
                        'created_at' =>  $committeeData['created_at'],
                        'updated_at' =>  $committeeData['updated_at'],
                        'members' => $committeeMembers,
                    );
                }
                $committees = array(
                    'committee_en' => $committeeEn,
                    'committee_gj' => $committeeGj,
                );


                //Message Data
                $messagesData = Messages::orderBy('id','ASC')->get()->toArray();
                $messageGj = MessageTranslations::orderBy('id','ASC')->get()->toArray();
                foreach ($messagesData as $messageData){
                    $messageEn[] = array(
                        'id' =>  $messageData['id'],
                        'title' =>  $messageData['title'],
                        'description' =>  $messageData['description'],
                        'message_type' =>  MessageTypes::where('id',$messageData['message_type_id'])->value('slug'),
                        'message_type_id' =>  $messageData['message_type_id'],
                        'is_active' =>  $messageData['is_active'],
                        'city' => Cities::where('id',$messageData['city_id'])->value('name'),
                        'city_id' =>  $messageData['city_id'],
                        'message_date' =>  date('jS M Y',strtotime($messageData['message_date'])),
                        'image_url' => ($messageData['image_url'] != null) ? env('SGKSWEB_BASEURL').env('MESSAGE_IMAGES_UPLOAD'). DIRECTORY_SEPARATOR.sha1($messageData['id']).DIRECTORY_SEPARATOR.$messageData['image_url'] : null,
                        'created_at' =>  $messageData['created_at'],
                        'updated_at' =>  $messageData['updated_at'],
                    );
                }
                $messages = array(
                    'message_en' => $messageEn,
                    'message_gj' => $messageGj,
                );

                //Classified Data
                $classifiedsData = Classifieds::orderBy('id','ASC')->get()->toArray();
                $classifiedGj = ClassifiedsTranslations::orderBy('id','ASC')->get()->toArray();
                foreach ($classifiedsData as $classifiedData){
                    $classifiedImgData = array();
                    $classifiedImageData = ClassifiedImages::where('classified_id', $classifiedData['id'])
                        ->orderBy('id', 'ASC')
                        ->get()->toArray();
                    foreach ($classifiedImageData as $classifiedImage) {
                        $classifiedImg = null;
                        $createClassifiedDirectoryName = sha1($classifiedData['id']);
                        $classifiedImg = env('SGKSWEB_BASEURL') . env('CLASSIFIED_IMAGES_UPLOAD') . DIRECTORY_SEPARATOR . $createClassifiedDirectoryName . DIRECTORY_SEPARATOR . $classifiedImage['image_url'];
                        $classifiedImgData[] = $classifiedImg;
                    }
                    $classifiedEn[] = array(
                        'id' =>  $classifiedData['id'],
                        'title' =>  $classifiedData['title'],
                        'description' =>  $classifiedData['description'],
                        'package_type' =>  ClassifiedPackages::where('id',$classifiedData['package_id'])->value('slug'),
                        'package_id' =>  $classifiedData['package_id'],
                        'is_active' =>  $classifiedData['is_active'],
                        'city' => Cities::where('id',$classifiedData['city_id'])->value('name'),
                        'city_id' =>  $classifiedData['city_id'],
                        'classified_images' => $classifiedImgData,
                        'created_at' =>  $classifiedData['created_at'],
                        'updated_at' =>  $classifiedData['updated_at'],
                    );
                }
                $classifieds = array(
                    'classified_en' => $classifiedEn,
                    'classified_gj' => $classifiedGj,
                );

            } else {
                //new city data
                $citiesData = Cities::where('is_active',true)->where('updated_at','>=',$request->current_timestamp)->orderBy('id','ASC')->get()->toArray();
                foreach ($citiesData as $city){
                    $cityEn[] = array(
                        'id' => $city['id'],
                        'name' => $city['name'],
                        'state_id' => $city['state_id'],
                        'is_active' => $city['is_active'],
                        'city_member_count' => Members::where('city_id',$city['id'])->get()->count(),
                        'created_at' => $city['created_at'],
                        'updated_at' => $city['updated_at'],
                    );
                }
                $cityIds = Cities::where('is_active',true)->where('updated_at','>=',$request->current_timestamp)->pluck('id')->toArray();
                $cities = array(
                    'city_en' => $cityEn,
                    'city_gj' => CityTranslations::whereIn('city_id',$cityIds)->orWhere('updated_at','>=',$request->current_timestamp)->orderBy('id','ASC')->get()->toArray(),
                );


                // Member new Data
                $membersData = Members::where('is_active',true)->where('updated_at','>=',$request->current_timestamp)
                    ->orderBy('id','ASC')
                    ->get()->toArray();
                $members = array();
                foreach ($membersData as $memberData) {
                    $memberEn[] = array(
                        'id' => $memberData['id'],
                        'first_name' => $memberData['first_name'],
                        'middle_name' => $memberData['middle_name'],
                        'last_name' => $memberData['last_name'],
                        'address' => $memberData['address'],
                        'gender' => $memberData['gender'],
                        'date_of_birth' => date('d-m-Y',strtotime($memberData['date_of_birth'])),
                        'blood_group' => BloodGroup::where('id', $memberData['blood_group_id'])->value('slug'),
                        'blood_group_id' => $memberData['blood_group_id'],
                        'mobile' => $memberData['mobile'],
                        'email' => $memberData['email'],
                        'city' => Cities::where('id', $memberData['city_id'])->value('name'),
                        'city_id' => $memberData['city_id'],
                        'longitude' => $memberData['longitude'],
                        'latitude' => $memberData['latitude'],
                        'profile_image' => ($memberData['profile_image'] != null) ? env('SGKSWEB_BASEURL') . env('MEMBER_IMAGE_UPLOAD') . sha1($memberData['id']) . DIRECTORY_SEPARATOR . $memberData['profile_image'] : null,
                        'is_active' => $memberData['is_active'],
                        'created_at' => $memberData['created_at'],
                        'updated_at' => $memberData['updated_at'],
                    );
                }
                $membersIds = Members::where('is_active',true)->where('updated_at','>=',$request->current_timestamp)
                    ->pluck('id')->toArray();
                $memberGj = MemberTranslations::whereIn('member_id', $membersIds)
                    ->orWhere('updated_at','>=',$request->current_timestamp)
                    ->orderBy('id','ASC')
                    ->get()->toArray();
                $members = array(
                    'member_en' => $memberEn,
                    'member_gj' => $memberGj,
                );

                //Events new data
                $eventsData = Events::where('is_active',true)->where('updated_at','>=',$request->current_timestamp)
                    ->orderBy('id','ASC')
                    ->get()->toArray();
                foreach ($eventsData as $eventData){
                    $EventImgData = array();
                    $eventImageData = EventImages::where('event_id', $eventData['id'])
                        ->orderBy('id', 'ASC')
                        ->get()->toArray();
                    foreach ($eventImageData as $eventImage) {
                        $evnImg = null;
                        $createEventDirectoryName = sha1($eventData['id']);
                        $evnImg = env('SGKSWEB_BASEURL') . env('EVENT_IMAGES_UPLOAD') . DIRECTORY_SEPARATOR . $createEventDirectoryName . DIRECTORY_SEPARATOR . $eventImage['url'];
                        $EventImgData[] = $evnImg;
                    }
                    $eventEn[] = array(
                        'id' =>  $eventData['id'],
                        'event_name' =>  $eventData['event_name'],
                        'description' =>  $eventData['description'],
                        'venue' =>  $eventData['venue'],
                        'event_date' => date('d M y',strtotime($eventData['start_date']))." to ".date('d M y',strtotime($eventData['end_date'])),
                        'is_active' =>  $eventData['is_active'],
                        'city' => Cities::where('id',$eventData['city_id'])->value('name'),
                        'city_id' =>  $eventData['city_id'],
                        'event_images' => $EventImgData,
                        'created_at' =>  $eventData['created_at'],
                        'updated_at' =>  $eventData['updated_at'],
                        'year' => date('Y',strtotime($eventData['start_date'])),
                    );
                }
                $eventsIds = Events::where('is_active',true)->where('updated_at','>=',$request->current_timestamp)
                    ->pluck('id')->toArray();
                $eventGj = EventsTranslations::whereIn('event_id', $eventsIds)
                    ->orWhere('updated_at','>=',$request->current_timestamp)
                    ->orderBy('id','ASC')
                    ->get()->toArray();
                $events = array(
                    'event_en' => $eventEn,
                    'event_gj' => $eventGj,
                );

                //Account new data
                $accountsData = Accounts::where('is_active',true)->where('updated_at','>=',$request->current_timestamp)
                    ->orderBy('id','ASC')
                    ->get()->toArray();
                foreach ($accountsData as $accountData){
                    $AccountImgData = array();
                    $accountImageData = AccountImages::where('account_id', $accountData['id'])
                        ->orderBy('id', 'ASC')
                        ->get()->toArray();
                    foreach ($accountImageData as $accountImage) {
                        $accImg = null;
                        $createMemberDirectoryName = sha1($accountData['id']);
                        $accImg = env('SGKSWEB_BASEURL') . env('ACCOUNT_IMAGES_UPLOAD') . DIRECTORY_SEPARATOR . $createMemberDirectoryName . DIRECTORY_SEPARATOR . $accountImage['url'];
                        $AccountImgData[] = $accImg;
                    }
                    $accountEn[] = array(
                        'id' =>  $accountData['id'],
                        'name' =>  $accountData['name'],
                        'description' =>  $accountData['description'],
                        'is_active' =>  $accountData['is_active'],
                        'city' => Cities::where('id',$accountData['city_id'])->value('name'),
                        'city_id' =>  $accountData['city_id'],
                        'account_images' => $AccountImgData,
                        'created_at' =>  $accountData['created_at'],
                        'updated_at' =>  $accountData['updated_at'],
                        'year' => date('Y',strtotime($accountData['created_at'])),
                    );
                }
                $accountIds = Accounts::where('is_active',true)->where('updated_at','>=',$request->current_timestamp)
                    ->pluck('id')->toArray();
                $accountGj = AccountsTranslations::whereIn('account_id', $accountIds)
                    ->orWhere('updated_at','>=',$request->current_timestamp)
                    ->orderBy('id','ASC')
                    ->get()->toArray();
                $accounts = array(
                    'account_en' => $accountEn,
                    'account_gj' => $accountGj,
                );

                //committee new data
                $rawCommitteesIds = Committees::join('committee_members','committee_members.committee_id','=','committees.id')
                            ->where('committees.updated_at','>=',$request->current_timestamp)
                            ->orWhere('committee_members.updated_at','>=',$request->current_timestamp)
                            ->orderBy('committees.id','ASC')
                            ->pluck('committees.id')->toArray();
                $committeesIds = array_unique($rawCommitteesIds);
                $committeesData = Committees::whereIn('id',$committeesIds)->get()->toArray();
                foreach ($committeesData as $committeeData){
                    $committeeMembersData = CommitteeMembers::where('is_active',true)->where('committee_id',$committeeData['id'])
                        ->Where('updated_at','>=',$request->current_timestamp)
                        ->orderBy('id','ASC')
                        ->get()->toArray();
                    foreach ($committeeMembersData as $committeeMemberData){
                        $committeeMembersEn[] = array(
                            'id' =>  $committeeMemberData['id'],
                            'committee_id' =>  $committeeMemberData['committee_id'],
                            'fullname' =>  $committeeMemberData['full_name'],
                            'designation' =>  $committeeMemberData['designation'],
                            'cont_number' =>  $committeeMemberData['mobile_number'],
                            'email_id' =>  $committeeMemberData['email_id'],
                            'is_active' =>  $committeeMemberData['is_active'],
                            'area' => Cities::where('id',$committeeData['city_id'])->value('name'),
                            'profile_image' => ($committeeMemberData['profile_image'] != null) ? env('SGKSWEB_BASEURL').env('COMMITTEE_MEMBER_IMAGES_UPLOAD').DIRECTORY_SEPARATOR.sha1($committeeMemberData['id']).DIRECTORY_SEPARATOR.$committeeMemberData['profile_image'] : null,
                            'created_at' =>  $committeeMemberData['created_at'],
                            'updated_at' =>  $committeeMemberData['updated_at'],
                        );
                    }
                    $memberIds = CommitteeMembers::where('is_active',true)->where('committee_id',$committeeData['id'])
                        ->Where('updated_at','>=',$request->current_timestamp)
                        ->pluck('id')->toArray();
                    $committeeMembersDataGj = CommitteeMembersTranslations::whereIn('member_id', $memberIds)
                        ->orWhere('updated_at','>=',$request->current_timestamp)
                        ->orderBy('id','ASC')
                        ->get()->toArray();
                    foreach ($committeeMembersDataGj as $committeeMemberDataGj){
                        $committeeMembersGj[] = array(
                            'id' => $committeeMemberDataGj['id'],
                            'language_id' => $committeeMemberDataGj['language_id'],
                            'member_id' => $committeeMemberDataGj['member_id'],
                            'created_at' => $committeeMemberDataGj['created_at'],
                            'updated_at' => $committeeMemberDataGj['updated_at'],
                            'fullname' => $committeeMemberDataGj['full_name'],
                        );
                    }
                    $committeeMembers = array(
                        'members_en' => $committeeMembersEn,
                        'members_gj' => $committeeMembersGj,
                    );
                    $committeeMembersEn = $committeeMembersGj =  [];
                    $committeeEn[] = array(
                        'id' =>  $committeeData['id'],
                        'name' =>  $committeeData['committee_name'],
                        'description' =>  $committeeData['description'],
                        'is_active' =>  $committeeData['is_active'],
                        'city' => Cities::where('id',$committeeData['city_id'])->value('name'),
                        'city_id' =>  $committeeData['city_id'],
                        'created_at' =>  $committeeData['created_at'],
                        'updated_at' =>  $committeeData['updated_at'],
                        'members' => $committeeMembers,
                    );
                }
                $committeeIds = Committees::where('is_active',true)->where('updated_at','>=',$request->current_timestamp)
                    ->pluck('id')->toArray();
                $committeeGj = CommitteesTranslations::whereIn('committee_id', $committeeIds)
                    ->orWhere('updated_at','>=',$request->current_timestamp)
                    ->orderBy('id','ASC')
                    ->get()->toArray();
                $committees = array(
                    'committee_en' => $committeeEn,
                    'committee_gj' => $committeeGj,
                );

                //new Message Data
                $messagesData = Messages::where('is_active',true)->where('updated_at','>=',$request->current_timestamp)
                    ->orderBy('id','ASC')
                    ->get()->toArray();
                foreach ($messagesData as $messageData){
                    $messageEn[] = array(
                        'id' =>  $messageData['id'],
                        'title' =>  $messageData['title'],
                        'description' =>  $messageData['description'],
                        'message_type' =>  MessageTypes::where('id',$messageData['message_type_id'])->value('slug'),
                        'message_type_id' =>  $messageData['message_type_id'],
                        'is_active' =>  $messageData['is_active'],
                        'city' => Cities::where('id',$messageData['city_id'])->value('name'),
                        'city_id' =>  $messageData['city_id'],
                        'message_date' =>  date('jS M Y',strtotime($messageData['message_date'])),
                        'image_url' => ($messageData['image_url'] != null) ? env('SGKSWEB_BASEURL').env('MESSAGE_IMAGES_UPLOAD'). DIRECTORY_SEPARATOR.sha1($messageData['id']).DIRECTORY_SEPARATOR.$messageData['image_url'] : null,
                        'created_at' =>  $messageData['created_at'],
                        'updated_at' =>  $messageData['updated_at'],
                    );
                }
                $messageIds = Messages::where('is_active',true)->where('updated_at','>=',$request->current_timestamp)
                    ->pluck('id')->toArray();
                $messageGj = MessageTranslations::whereIn('message_id', $messageIds)
                    ->orWhere('updated_at','>=',$request->current_timestamp)
                    ->orderBy('id','ASC')
                    ->get()->toArray();
                $messages = array(
                    'message_en' => $messageEn,
                    'message_gj' => $messageGj,
                );

                //new classified data
                $classifiedsData = Classifieds::where('is_active',true)->where('updated_at','>=',$request->current_timestamp)
                    ->orderBy('id','ASC')
                    ->get()->toArray();
                foreach ($classifiedsData as $classifiedData){
                    $classifiedImgData = array();
                    $classifiedImageData = ClassifiedImages::where('classified_id', $classifiedData['id'])
                        ->orderBy('id', 'ASC')
                        ->get()->toArray();
                    foreach ($classifiedImageData as $classifiedImage) {
                        $classifiedImg = null;
                        $createClassifiedDirectoryName = sha1($classifiedData['id']);
                        $classifiedImg = env('SGKSWEB_BASEURL') . env('CLASSIFIED_IMAGES_UPLOAD') . DIRECTORY_SEPARATOR . $createClassifiedDirectoryName . DIRECTORY_SEPARATOR . $classifiedImage['image_url'];
                        $classifiedImgData[] = $classifiedImg;
                    }
                    $classifiedEn[] = array(
                        'id' =>  $classifiedData['id'],
                        'title' =>  $classifiedData['title'],
                        'description' =>  $classifiedData['description'],
                        'package_type' =>  ClassifiedPackages::where('id',$classifiedData['package_id'])->value('slug'),
                        'package_id' =>  $classifiedData['package_id'],
                        'is_active' =>  $classifiedData['is_active'],
                        'city' => Cities::where('id',$classifiedData['city_id'])->value('name'),
                        'city_id' =>  $classifiedData['city_id'],
                        'classified_images' => $classifiedImgData,
                        'created_at' =>  $classifiedData['created_at'],
                        'updated_at' =>  $classifiedData['updated_at'],
                    );
                }
                $classifiedIds = Classifieds::where('is_active',true)->where('updated_at','>=',$request->current_timestamp)
                    ->pluck('id')->toArray();
                $classifiedGj = ClassifiedsTranslations::whereIn('classified_id', $classifiedIds)
                    ->orWhere('updated_at','>=',$request->current_timestamp)
                    ->orderBy('id','ASC')
                    ->get()->toArray();
                $classifieds = array(
                    'classified_en' => $classifiedEn,
                    'classified_gj' => $classifiedGj,
                );

            }
            $message = "Success";
            $status = 200;
        }catch(\Exception $e){
            $message = "Fail";
            $status = 500;
            $data = [
                'action' => 'Get Master list',
                'exception' => $e->getMessage(),
                'params' => $request->all()
            ];
            Log::critical(json_encode($data));
        }
        $response = [
            'message' => $message,
            'current_timestamp' => $date,
            'cities' => $cities,
            'members' => $members,
            'events' => $events,
            'accounts' => $accounts,
            'committees' => $committees,
            'messages' => $messages,
            'classifieds' => $classifieds,
        ];
        return response()->json($response,$status);
    }
}
