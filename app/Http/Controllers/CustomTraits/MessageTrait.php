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
            $take = 10;
            $page_id = ($request->page_id);
            $skip = $page_id * $take;
            $data = array();
            $ids = array();
            $png = '.png';
            if($request->has('sgks_city')){
                $ids = Messages::where('city_id',$request->sgks_city)
                    ->pluck('id')->toArray();
            }
            $messageData = array();

            if (count($ids) > 0) {
                $messageData = Messages::orderBy('id', 'desc')
                    ->whereIn('id', $ids)
                    ->skip($skip)->take($take)
                    ->get()->toArray(); //all city data
            }

            if(count($messageData) == 0) {
                $page_id = "";
            } else {
                $page_id = $page_id + 1;
            }

            foreach ($messageData as $sgksMessage) {
                $messageType = MessageTypes::where('id',$sgksMessage['message_type_id'])->value('slug');
                if ($request->has('language_id')) {
                    $messageTranslationData = MessageTranslations::where('language_id', $request->language_id)
                        ->where('message_id', $sgksMessage['id'])
                        ->get()->toArray();
                    if (count($messageTranslationData) > 0) {
                        $data[] = array(
                            'id' => $sgksMessage['id'],
                            'title' => ($messageTranslationData[0]['title'] != null) ?  $messageTranslationData[0]['title'] : $sgksMessage['title'],
                            'msg_desc' => ($messageTranslationData[0]['description'] != null) ? $messageTranslationData[0]['description'] : $sgksMessage['description'],
                            'msg_img' => ($sgksMessage['image_url'] != null) ? env('SGKSWEB_BASEURL').env('MESSAGE_IMAGES_UPLOAD'). DIRECTORY_SEPARATOR.sha1($sgksMessage['id']).DIRECTORY_SEPARATOR.$sgksMessage['image_url'] :
                                env('SGKSWEB_BASEURL').env('MESSAGE_TYPE_IMAGES').DIRECTORY_SEPARATOR.$messageType.$png,
                            'msg_type' => MessageTypes::where('id' , $sgksMessage['message_type_id'])->value('slug'),
                            'sgks_city' => Cities::where('id', $sgksMessage['city_id'])->value('name'),
                        );
                    } else {
                        $data[] = array(
                            'id' => $sgksMessage['id'],
                            'title' => $sgksMessage['title'],
                            'msg_desc' => $sgksMessage['description'],
                            'msg_img' => ($sgksMessage['image_url'] != null) ? env('SGKSWEB_BASEURL').env('MESSAGE_IMAGES_UPLOAD'). DIRECTORY_SEPARATOR.sha1($sgksMessage['id']).DIRECTORY_SEPARATOR.$sgksMessage['image_url'] :
                                env('SGKSWEB_BASEURL').env('MESSAGE_TYPE_IMAGES').DIRECTORY_SEPARATOR.$messageType.$png,
                            'msg_type' => MessageTypes::where('id' , $sgksMessage['message_type_id'])->value('slug'),
                            'sgks_city' => Cities::where('id', $sgksMessage['city_id'])->value('name'),
                        );
                    }

                } else {
                    $data[] = array(
                        'id' => $sgksMessage['id'],
                        'title' => $sgksMessage['title'],
                        'msg_desc' => $sgksMessage['description'],
                        'msg_img' => ($sgksMessage['image_url'] != null) ? env('SGKSWEB_BASEURL').env('MESSAGE_IMAGES_UPLOAD'). DIRECTORY_SEPARATOR.sha1($sgksMessage['id']).DIRECTORY_SEPARATOR.$sgksMessage['image_url'] :
                            env('SGKSWEB_BASEURL').env('MESSAGE_TYPE_IMAGES').DIRECTORY_SEPARATOR.$messageType.$png,
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
            'page_id' => $page_id
        ];
        return response()->json($response,$status);
    }


}