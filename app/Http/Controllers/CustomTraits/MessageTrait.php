<?php
namespace App\Http\Controllers\CustomTraits;

use App\Messages;
use App\MessageTranslations;
use App\Cities;
use App\MessageTypes;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

trait MessageTrait{

    public function listing(Request $request){
        try{
            $data = array();
            if ($request->has('year')) {
                $year = $request->year;
            } else {
                $year = date("Y");
            }
            $ids = Messages::whereYear('created_at', '=', $year)->pluck('id')->toArray();

            if (count($ids) > 0) {
                $messageData = Messages::orderBy('id', 'ASC')
                    ->get()->toArray(); //all city data
            } else {
                $messageData = Messages::orderBy('id', 'ASC')
                    ->whereIn('id', $ids)
                    ->get()->toArray(); //all city data
            }
            foreach ($messageData as $sgksMessage) {
                if ($request->has('language_id')) {
                    $messageTranslationData = MessageTranslations::where('language_id', $request->language_id)
                        ->where('message_id', $sgksMessage['id'])
                        ->get()->toArray();
                    if (count($messageTranslationData) > 0) {
                        $data[] = array(
                            'id' => $sgksMessage['id'],
                            'title' => $messageTranslationData[0]['title'],
                            'msg_desc' => $messageTranslationData[0]['description'],
                            'msg_img' => env('SGKSWEB_BASEURL').env('MESSAGE_IMAGES_UPLOAD'). DIRECTORY_SEPARATOR.sha1($sgksMessage['id']).DIRECTORY_SEPARATOR.$sgksMessage['image_url'],
                            'msg_type' => MessageTypes::where('id' , $sgksMessage['message_type_id'])->value('slug'),
                            'sgks_city' => Cities::where('id', $sgksMessage['city_id'])->value('name'),
                        );
                    } else {
                        $data[] = array(
                            'id' => $sgksMessage['id'],
                            'title' => $sgksMessage['title'],
                            'msg_desc' => $sgksMessage['description'],
                            'msg_img' => env('SGKSWEB_BASEURL').env('MESSAGE_IMAGES_UPLOAD'). DIRECTORY_SEPARATOR.sha1($sgksMessage['id']).DIRECTORY_SEPARATOR.$sgksMessage['image_url'],
                            'msg_type' => MessageTypes::where('id' , $sgksMessage['message_type_id'])->value('slug'),
                            'sgks_city' => Cities::where('id', $sgksMessage['city_id'])->value('name'),
                        );
                    }

                } else {
                    $data[] = array(
                        'id' => $sgksMessage['id'],
                        'title' => $sgksMessage['title'],
                        'msg_desc' => $sgksMessage['description'],
                        'msg_img' => env('SGKSWEB_BASEURL').env('MESSAGE_IMAGES_UPLOAD'). DIRECTORY_SEPARATOR.sha1($sgksMessage['id']).DIRECTORY_SEPARATOR.$sgksMessage['image_url'],
                        'msg_type' => MessageTypes::where('id' , $sgksMessage['message_type_id'])->value('slug'),
                        'sgks_city' => Cities::where('id', $sgksMessage['city_id'])->value('name'),
                    );
                }

            }

            $message = "Success";
            $status = 200;
        }catch(\Exception $e){
            $message = "Somethimg went wrong";
            $status = 500;
            $data = [
                'action' => 'Get all Message data',
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