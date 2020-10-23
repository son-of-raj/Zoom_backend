<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use MacsiDigital\Zoom\Facades\Zoom;
use app\Entry\Entrys;
use App\Api_keys;
use App\User;
use GuzzleHttp\Client;
use MacsiDigital\API\Support\Authentication\JWT;

class zoomController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
public function CreateMeeting_Send(Request $request)
    {
        
        try {
            date_default_timezone_set('Asia/Kolkata');
            $data = array();
            // echo new Carbon(date("Y-m-d", strtotime($request->date))."T".$request->time."Z");
            // die();
            $api_tbl = Api_keys::where('email_id', $request->email_id)->count();
            if($api_tbl == 0){
                   $api_table = Api_keys::where('flag', '=', '0')->first();
                    if($api_table !=''){
                        $jwtToken = JWT::generateToken(['iss' => $api_table->api_key, 'exp' => time() + config('zoom.token_life')], $api_table->secret);
                        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
                        $response = $client->request('POST', '/v2/users/me/meetings', [
                            "headers" => [
                                "Authorization" => "Bearer $jwtToken"
                            ],
                            'json' => [
                                "topic" => $request->topic,
                                "type" => 2,
                                // 'start_time' => new Carbon(date("Y-m-d", strtotime($request->date))."T".$request->time."Z"),
                                "start_time" => $request->date."T".$request->time.":00Z",
                                "duration" => $request->duration, // 30 mins
                                // "password" => "123456"s
                            ],
                        ]);
                 
                        $details = json_decode($response->getBody());
                        $api_table->email_id = $request->email_id;
                        $api_table->meeting_id = $details->id;
                        $api_table->topic = $request->topic;
                        $api_table->meet_duration = $request->duration;
                        $api_table->meet_date = $request->date;
                        $api_table->meet_time = $request->time;
                        $api_table->meeting_link = "http://3.6.147.217:8080/meeting?nickname=Participent&meetingId=".$details->id."&password=".$details->encrypted_password;
                        $api_table->flag = 1;
                        $data["meeting_id"] =  $details->id;
                        $data["password"] =  $details->encrypted_password;
                        $data["start_time"] =  $details->start_time;
                        $data["api_key"] =  $api_table->api_key;
                        $data["secret"] =  $api_table->secret;
                        $data["url"] =  "http://3.6.147.217:8080/meeting?nickname=".$request->email_id."&meetingId=".$details->id."&password=".$details->encrypted_password;
                        if($api_table->save()){
                            echo json_encode(array("status"=> "true","msg"=> "successful","data"=> $data));
                        }
                    }else{
                     echo json_encode(array("status"=> "false","msg"=> "All api Keys are busy"));
                    }
            }else{
                 echo json_encode(array("status"=> "false","msg"=> "you have already used this email id"));
            }
        
        } catch (\Exception $e) {
            echo json_encode(array("status"=> "false","msg"=> "some error occured"));
        }
    
    }
    
    public function all_list(Request $request)
    {
        try {
            $data = array();
            $i = 0;
            $api_table = Api_keys::where('flag', '=', '1')->get();
            foreach($api_table as $api_tbl){
                $data[$i]['topic'] = $api_tbl->topic;
                $data[$i]['api_key'] = $api_tbl->api_key;
                $data[$i]['secret'] = $api_tbl->secret;
                $data[$i]['meet_time'] = $api_tbl->meet_time;
                $data[$i]['meet_date'] = $api_tbl->meet_date;
                $data[$i]['meet_duration'] = $api_tbl->meet_duration;
                $data[$i]['flag'] = $api_tbl->flag;
                $data[$i]['meeting_id'] = $api_tbl->meeting_id;
                $data[$i]['email_id'] = $api_tbl->email_id;
                $data[$i]['meeting_link'] = $api_tbl->meeting_link;
                $i = $i+1;
            }
            echo json_encode(array("status"=> "true","msg"=> "successful","data"=> $data));
        } catch (\Exception $e) {
            echo json_encode(array("status"=> "false","msg"=> "some error occured"));
        }
    
    }
    
    public function task_schedule()
    {
        
        date_default_timezone_set("Asia/Kolkata"); 
        $api_table = Api_keys::where('flag', '=', '1')->get();
        foreach($api_table as $table) 
        {
            $jwtToken = JWT::generateToken(['iss' => $table->api_key, 'exp' => time() + config('zoom.token_life')], $table->secret);
            $header = array('Authorization'=>'Bearer'.$jwtToken,"Content-type"=>"Application/json");
            $client = new \GuzzleHttp\Client();
            $request = $client->get('https://api.zoom.us/v2/meetings/'.$table->meeting_id,array('headers' => $header));
            $payload = json_decode($request->getBody()->getContents());
            // echo $payload->start_time;
            $array_date_time = (explode("T",$payload->start_time));
            $array_time = (explode("Z",$array_date_time[1]));
            $meeting_date= $array_date_time[0];
            
            $meeting_time = $array_time[0];
            $today_date = date("Y-m-d");
            $currentTime = date('h:i:s');
             $current_time = \Carbon\Carbon::now()->timestamp;
            if($meeting_date == $today_date){
        	    if((strtotime($meeting_time) + 120) < $current_time && $payload->status=='waiting'){
        	    $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
                $response = $client->request('DELETE', '/v2/meetings/'.$table->meeting_id, [
                    "headers" => [
                        "Authorization" => "Bearer $jwtToken"
                    ]
                ]);
                $table->flag =0;
                $table->meeting_id ='';
                $table->email_id ='';
                $table->topic ='';
                $table->meet_time ='';
                $table->meet_date ='';
                $table->meet_duration ='';
                $table->meeting_link ='';
                $table->save();
        	         echo "Meeting Deleted";
        	     }
        	 	  else{
        	 	      echo "Meeting Not yet done or Meeting in Progress";
        	 	  }
            }
                	
        }
    }


    public function createMeeting_view_page()
    {
        return view('create_meeting');
    }

    public function createMeeting(Request $request)
    {   
        date_default_timezone_set('Asia/Kolkata');
        $jwtToken = JWT::generateToken(['iss' => 'AD_cc07wSHmlMvtJ_UYWCA', 'exp' => time() + config('zoom.token_life')], 'sCfl8ooAQ1o5SfBOQq8FtoUY4sMCxfEJ5QiB');
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
        $response = $client->request('POST', '/v2/users/me/meetings', [
            "headers" => [
                "Authorization" => "Bearer $jwtToken"
            ],
            'json' => [
                "topic" => "Let's learn Laravel",
                "type" => 2,
                "start_time" => "2020-10-16T14:00:00Z",
                "duration" => "30", // 30 mins
                "password" => "123456"
            ],
        ]);
 
        $data = json_decode($response->getBody());
        echo '-';
        print_r($data);
        
        // date_default_timezone_set('Asia/Kolkata');
        // $validator = $request->validate([
        //     'password' => 'max:8',
        //     'date' => 'after:yesterday'
        // ]);
        // if(strtotime($request->date) == strtotime(date('Y-m-d')) && time() > strtotime($request->time)){
        //     return redirect('/zoom/meetings')->with('timeError', 'Time must be greater than '.date("h:i", time()));
        // }
        // $akash = new Entry;
        // $akash->api="asasa";
        // $user = Zoom::user()->find('me');
        // $meeting = Zoom::meeting()->make([
        //     'topic' => $request->topic,
        //     'type' => 2,
        //     'start_time' =>  new Carbon(date("Y-m-d", strtotime($request->date))." ".$request->time),
        //     'duration' => $request->duration,
        //     'password' => $request->password,
        //     'agenda' => $request->description,
        //     'settings' => [
        //         'host_video' => 0,
        //         'participant_video' => 0,
        //         'waiting_room' => 0,
        //         'join_before_host' => 0,
        //         'audio' => 'both',
        //         'auto_recording' => 'none',
        //         'approval_type' => 0,
        //         'mute_upon_entry' => 0,
        //     ]
        // ]);
        // $user->meetings()->save($meeting);
        // return redirect('/meetings-list');
    }

    // public function jwtRequest() 
    // {
    //     $jwtToken = JWT::generateToken(['iss' => '3WAdQsivSc60EX7XlPQMdQ', 'exp' => time() + config('zoom.token_life')], 'WoTAtiKXIKn4qjiIwCyxZVt9sHjo5wonFA5N');
        
    //     return Client::baseUrl(config('zoom.base_url'))->withToken($jwtToken);
    // }

    public function meetingsList(Request $request)
    {
        $meetings = Zoom::user()->find('me')->meetings;
        return view('meetingList', compact('meetings'));
    }

    public function deleteMeeting($id)
    {
    //     // $meeting = Zoom::user()->find('me')->meetings()->find($id);
    //     // $meeting->delete();
    //     // return redirect('/meetings-list');
    }

    public function startmeet()
    {
        return view('startMeeting');
    }

    public function user_detail(Request $request)
    {
       $key = auth()->user()->api_key;
       $secret = auth()->user()->secret;
    }
}