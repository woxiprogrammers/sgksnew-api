<?php
namespace App\Http\Controllers\CustomTraits;

use App\Events;
use App\EventsTranslations;
use App\EventImages;
use App\Cities;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

trait EventTrait{

    public function listing(Request $request){
         try{
             $data = array();
             if ($request->has('year') && $request->year != null) {
                 $year = $request->year;
             } else {
                 $year = date("Y");
             }
             $ids = Events::whereYear('created_at', '=', $year)->pluck('id')->toArray();

             if($request->has('sgks_city')){
                 $ids = Events::where('city_id',$request->sgks_city)
                     ->whereIn('id',$ids)
                     ->pluck('id')->toArray();
             }
             if (count($ids) > 0) {
                 $eventData = Events::orderBy('id', 'DESC')
                     ->whereIn('id', $ids)
                     ->get()->toArray();
             } else {
                 $eventData = Events::orderBy('id', 'DESC')
                     ->get()->toArray();
             }
             $count = 0;
             foreach ($eventData as $event) {
                 if ($request->has('language_id')) {
                     $eventTranslationData = EventsTranslations::where('language_id', $request->language_id)
                         ->where('event_id', $event['id'])
                         ->get()->toArray();
                     if (count($eventTranslationData) > 0) {
                         $data[] = array(
                             'id' => $event['id'],
                             'event_name' => ($eventTranslationData[0]['event_name'] != null) ? $eventTranslationData[0]['event_name'] : $event['event_name'],
                             'desc' => ($eventTranslationData[0]['description'] != null) ? $eventTranslationData[0]['description'] : $event['description'],
                             'venue' => ($eventTranslationData[0]['venue'] != null) ? $eventTranslationData[0]['venue']  : $event['venue'],
                             'city' => Cities::where('id', $event['city_id'])->value('name'),
                             'event_date' => date('d M y',strtotime($event['start_date']))." to ".date('d M y',strtotime($event['end_date'])),
                             'year' => date('Y',strtotime($event['start_date'])),
                         );
                     } else {
                         $data[] = array(
                             'id' => $event['id'],
                             'event_name' => $event['event_name'],
                             'desc' => $event['description'],
                             'venue' => $event['venue'],
                             'city' => Cities::where('id', $event['city_id'])->value('name'),
                             'event_date' => date('d M y',strtotime($event['start_date']))." to ".date('d M y',strtotime($event['end_date'])),
                             'year' => date('Y',strtotime($event['start_date'])),
                         );
                     }

                 } else {
                     $data[] = array(
                         'id' => $event['id'],
                         'event_name' => $event['event_name'],
                         'desc' => $event['description'],
                         'venue' => $event['venue'],
                         'city' => Cities::where('id', $event['city_id'])->value('name'),
                         'event_date' => date('d M y',strtotime($event['start_date']))." to ".date('d M y',strtotime($event['end_date'])),
                         'year' => date('Y',strtotime($event['start_date'])),
                     );
                 }

                 $EventImgData = array();
                 $eventImageData = EventImages::where('event_id', $event['id'])
                     ->orderBy('id', 'ASC')
                     ->get()->toArray();
                 foreach ($eventImageData as $eventImage) {
                     $evnImg = null;
                     $createEventDirectoryName = sha1($event['id']);
                     $evnImg = env('SGKSWEB_BASEURL') . env('EVENT_IMAGES_UPLOAD') . DIRECTORY_SEPARATOR . $createEventDirectoryName . DIRECTORY_SEPARATOR . $eventImage['url'];
                     $EventImgData[] = $evnImg;
                 }
                 $data[$count]['event_images'] = $EventImgData;
                 $count++;
             }

             $message = "Success";
             $status = 200;
        }catch(\Exception $e){
             $message = "Fail";
             $status = 500;
             $data = [
                 'action' => 'Get all Event data',
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