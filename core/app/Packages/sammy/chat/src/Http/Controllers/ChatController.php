<?php

/**
 * Created by PhpStorm.
 * User: kalya
 * Date: 1/5/2016
 * Time: 10:24 AM
 */
namespace Sammy\Chat\Http\Controllers;


use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Sammy\Assignment\Http\Requests\AssignmentRequest;
use Sammy\UserManage\Models\User;
use Sammy\Assignment\Models\Assignment;
use Sammy\permissions\Models\Permission;
use Illuminate\Http\Request;
use Response;
use Sentinel;
use Hash;
use Activation;
use GuzzleHttp;







class ChatController extends Controller
{

	/*
    |--------------------------------------------------------------------------
    | Document  Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders the "marketing page" for the application and
    | is configured to only allow guests. Like most of the other sample
    | controllers, you are free to modify or remove it as you desire.
    |
    */

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('guest');
	}
	/**
	 * Show the user add screen to the user.
	 *
	 * @return Response
	 */
	public function jsonList()
	{
		$data = Assignment::all();
		$jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
			array_push($rowData,$i);
			array_push($rowData,DATE($value->created_at));
			array_push($rowData,$value-> studentName );
			array_push($rowData,$value->email);
			array_push($rowData,$value->phoneNo);
			array_push($rowData,$value->type);
			array_push($rowData, ' <a href="'.asset('attachments/'. $value->id .'/'.$value->studentAttachment .'').'" class="btn-xs btn-primary btn-outline btn-round " download>Attachment</a>');
			array_push($rowData,'<div class="progress" style="width:100px"><div class="progress-bar progress-bar-sm" style="width:'. $value->progress .'%;" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-percent="50"></div></div>');
			array_push($rowData, ' <a onclick="window.location.href=\'' . url('assignment/edit/' . $value->id) . '\'" class="btn btn-info">View</a>');
			array_push($jsonList, $rowData);
			$i++;

		}
		return Response::json(array('data' => $jsonList));

	}

	/**
	 * accept a Document
	 * @param  Request $request Document id
	 * @return Json           	json object with status of success or failure
	 */
	public function accept(Request $request)
	{
		if($request->ajax()){
			$id = $request->input('id');
			$document = Assignment::find($id);
			if($document){
				$document->status = 1;
				$document->save();
				return response()->json(['status' => 'success']);
			}else{
				return response()->json(['status' => 'invalid_id']);
			}
		}else{
			return response()->json(['status' => 'not_ajax']);
		}
	}
        
       
	/**
	 * reject a Document
	 * @param  Request $request Document id
	 * @return Json           	json object with status of success or failure
	 */
	public function reject(Request $request)
	{
		if($request->ajax()){
			$id = $request->input('id');
			$document = Assignment::find($id);
			if($document){
				$document->status = 2;
				$document->progress = 0;
				$document->save();


				$assignement =  Assignment::find($id);
				$writers=  User::find($assignement->assignto);

				$msge = "Assignment Reject by admin Ref- " . $id;
				$data = 'username=myassignment.lk&password=Mypassword123&src=Essayasia&dst='.$writers->mobileNo.'&msg='.$msge.'&dr=1';

				$to = $writers->email;
				$subject = 'Assignment rejected by admin Ref- '.$id;
				
				$headers = "From:essayasia.com <no-reply@essayasia.com>"."\r\n";
				$headers .= 'Cc: auto.myassignment.lk@gmail.com' . "\r\n";
				$headers.= "MIME-Version: 1.0"."\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1"."\r\n";
				
				mail($to,$subject,$msge,$headers);


				return response()->json(['status' => 'success','url' =>$data]);
			}else{
				return response()->json(['status' => 'invalid_id']);
			}
		}else{
			return response()->json(['status' => 'not_ajax']);
		}
	}

        /**
	 * reject a Document
	 * @param  Request $request Document id
	 * @return Json           	json object with status of success or failure
	 */
	public function addView(Request $request)
	{
  
           $users=Sentinel::getUser();
           $chatfor='0';          
           if(isset($request->id)){
            $chatfor=$request->id;
           }
           else{
               $chatfor='0';
           }
           
            if($users->roles[0]->id==9){
            $user = DB::table('users')->join('role_users', 'role_users.user_id', '=', 'users.id')->where('role_users.role_id','8')->orwhere('role_users.role_id','10')->where('status','1')->orderBy('username', 'ASC')->lists('users.first_name','users.id');				
           
            
            }
           else{
               $user = DB::table('users')->join('role_users', 'role_users.user_id', '=', 'users.id')->where('role_users.role_id','9')->orwhere('role_users.role_id','8')->orwhere('role_users.role_id','10')->where('status','1')->orderBy('username', 'ASC')->lists('users.first_name','users.id');				
           }
          
          
          if($users->roles[0]->id==9){
            $user2 = DB::table('users')->join('role_users', 'role_users.user_id', '=', 'users.id')->where('role_users.role_id','8')->orwhere('role_users.role_id','10')->where('status','1')->orderBy('username', 'ASC')->lists('users.last_name','users.id');				
                      
            }
           else{
               $user2 = DB::table('users')->join('role_users', 'role_users.user_id', '=', 'users.id')->where('role_users.role_id','9')->orwhere('role_users.role_id','8')->orwhere('role_users.role_id','10')->where('status','1')->orderBy('username', 'ASC')->lists('users.last_name','users.id');				
           }
        
            return view('Chat::add')->with([
                'first_name'=>$user,
                'last_name'=>$user2,
                'chatfor'=>$chatfor
            ]);
            
            
        }
        
        
        
        public function listView(Request $request)
	{        
            return view('Chat::list');
        }
        
        public function jsonLists(Request $request)
	{
		if($request->ajax()){
			
			$user = Sentinel::getUser();
                       
                         if($user->roles[0]->id ==9 ){
                            $data = DB::table('chat_sessions')->where('chat_sessions.session_to',$user->id)->orwhere('chat_sessions.session_from',$user->id)->get();             
                         }
                         else{
                             $data = DB::table('chat_sessions')->get();    
                         }
			$jsonList = array();
			$i=1;
			foreach ($data as $key => $chatsession) {
				$dd = array();
				array_push($dd, $i);
                                    //DB::table('users')->where('id',$chatsession->session_to)->first();
                                
                                $userfors=DB::table('users')->where('id',$chatsession->session_from)->pluck('username');
                                
                              
				                array_push($dd,$userfors);
				                
				               
				                 $tousers=DB::table('users')->where('id',$chatsession->session_to)->pluck('username');;
                                array_push($dd,$tousers);
                                
                                if( $chatsession->status ==1){
                                    array_push($dd,'<span style="color:red;">Ended</span>');
                                }
                                else{
                                    array_push($dd,'<span style="color:green;">Ongoing</span>');
                                }
                                
                                $from='0';
                                $to='0';
                                array_push($dd, '<a href="#" class="blue" onclick="window.location.href=\''.url('chat/edit/'.$chatsession->id).'/'.$from.'/'.$to.'\'" data-toggle="tooltip" data-placement="top" title="View chat"><i class="fa fa-file"></i>View</a>');

//				$json = array_keys(json_decode($role->permissions,true));
//
//				array_push($dd, str_replace(',', ', ', json_encode($json)));
//
//				$permissions = Permission::whereIn('name',['user.role.edit','admin'])->where('status','=',1)->lists('name');
//				if(Sentinel::hasAnyAccess($permissions)){
//					array_push($dd, '<a href="#" class="blue" onclick="window.location.href=\''.url('user/role/edit/'.$role->id).'\'" data-toggle="tooltip" data-placement="top" title="Edit Role"><i class="fa fa-pencil"></i></a>');
//				}else{
//					array_push($dd, '<a href="#" class="disabled" data-toggle="tooltip" data-placement="top" title="Edit Disabled"><i class="fa fa-pencil"></i></a>');
//				}
//
//				$permissions = Permission::whereIn('name',['user.role.delete','admin'])->where('status','=',1)->lists('name');
//				if(Sentinel::hasAnyAccess($permissions)){
//					array_push($dd, '<a href="#" class="red role-delete" data-id="'.$role->id.'" data-toggle="tooltip" data-placement="top" title="Delete Role"><i class="fa fa-trash-o"></i></a>');
//				}else{
//					array_push($dd, '<a href="#" class="disabled" data-toggle="tooltip" data-placement="top" title="Delete Disabled"><i class="fa fa-trash-o"></i></a>');
//				}

				array_push($jsonList, $dd);
				$i++;
			}
			return Response::json(array('data'=>$jsonList));
		}else{
			return Response::json(array('data'=>[]));
		}
	}
         public function endchat(Request $request)
	    {
	         $user=Sentinel::getUser();
	         
             $session=$request->input('session');
              DB::table('chat_sessions')
                ->where('id', $session)
                ->update(['status' =>1 ,'end_date' =>date('Y-m-d H:i:s')]);
                
                   $delee=DB::table('chat_new')->where('sessionid',$session)->delete();
              
                return 'success';
              
        }
        
        public function addchat(Request $request)
	{  
            $user=Sentinel::getUser();
            $message=$request->input('message');
            $subject=$request->input('subject');
            $toId=$request->input('touser');
            $session=$request->input('session');
            $sendSms=$request->input('sed_sms');
            $sendEmail=$request->input('sed_email');
          
            // Available alpha caracters           
            
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

            // generate a pin based on 2 * 7 digits + a random character
            $pin = mt_rand(1000000, 9999999)
                . mt_rand(1000000, 9999999)
                . $characters[rand(0, strlen($characters) - 1)];

            // shuffle the result
            $string = str_shuffle($pin);

            
            $data='';
            if($session ==""){
                if($subject!=""){
                $session=DB::table('chat_sessions')->insertGetId(
                    ['session_to' => $toId , 'session_from' => $user->id,'created_at'=>date('Y-m-d H:i:s'),'subject'=>$subject]
                ); 
                }else{
                    $session=DB::table('chat_sessions')->insertGetId(
                    ['session_to' => $toId , 'session_from' => $user->id,'created_at'=>date('Y-m-d H:i:s'),'subject'=>'gfhjgfhj']
                   ); 
                }
        
                               
                
            }
                $adminuser = DB::table('users')->where('users.id', $toId)->get();
                $to = $adminuser[0]->email;
                $adminusername = DB::table('users')->where('id', $user->id)->get();
                $username=$adminusername[0]->username;
                
                if( $sendEmail == 'true'){ 
            		$subject = 'New chat session started';
            		$msge = "Hi, I have sent a message through essayassia chat. Please reply to that. I need  an update as soon as possible.:".$username;
            		$headers = "From:essayasia.com <no-reply@essayasia.com>"."\r\n";
            		$headers .= 'Cc: auto.myassignment.lk@gmail.com' . "\r\n";
            		$headers.= "MIME-Version: 1.0"."\r\n";
            		$headers .= "Content-Type: text/html; charset=ISO-8859-1"."\r\n";				
            		mail($to,$subject,$msge,$headers);
                }
            
            if($sendSms == 'true'){           
            
                $adminusername = DB::table('users')->where('id', $user->id)->get();
                $username=$adminusername[0]->username;
                
                $adminuser = DB::table('users')->where('users.id', $toId)->get();
		        $msge = "Hi, I have sent a message through essayassia chat. Please reply to that. I need  an update as soon as possible. :  ".$username;//$adminuser[0]->mobileNo
		        $data = 'username=myassignment.lk&password=Mypassword123&src=Essayasia&dst='.$adminuser[0]->mobileNo.'&msg='. $msge .'&dr=1';

            }  
            $attachment=$request->file('file');
            if($attachment !=""){
                $destinationPath = 'chat/'.$session;
                $filename = $attachment->getClientOriginalName();
                $upload_success = $attachment->move($destinationPath, $user->id.'_'.$string.'_'.$filename);
                DB::table('chat_records')->insertGetId(
                                        ['add_by' => $user->id,'type' => 2 ,'content' =>  $user->id.'_'.$string.'_'.$filename ,'chat_sessions_id'=>$session,'created_at'=>date('Y-m-d H:i:s'),'chat_date'=>date('Y-m-d H:i:s')]
                );
            }
            
            if($message !=""){               
                DB::table('chat_records')->insertGetId(
                                        ['add_by' => $user->id,'type' =>1 ,'content' => $message ,'chat_sessions_id'=>$session,'created_at'=>date('Y-m-d H:i:s'),'chat_date'=>date('Y-m-d H:i:s')]
                );
            }
            
            
            $chatSession=DB::table('chat_sessions')->where('id',$session)->get();
           
            if($user->id != $chatSession[0]->session_to){
                $toid=$chatSession[0]->session_to;
                $count = DB::table('chat_new')->where('sessionid', $session)->where('user_id', $toid)->count();
                if($count==0){
              
                    DB::table('chat_new')->insertGetId(
                                            ['user_id' =>$toid,'sessionid'=>$session]
                    );
                }
                
                
            }
            
            if($user->id != $chatSession[0]->session_from){
                $fromchat=$chatSession[0]->session_from;
                $count = DB::table('chat_new')->where('sessionid', $session)->where('user_id', $fromchat)->count();
                if($count==0){
                    DB::table('chat_new')->insertGetId(
                                            ['user_id'=>$fromchat ,'sessionid'=>$session]
                    );
                }
            }
            return $data;
          
            
        }
        public function getlivechat(Request $request)
	{
                $fromId=$_GET['fromId'];
                $toId=$_GET['toId'];   
                $users=Sentinel::getUser();
                
                
		        $data = DB::table('chat_sessions')->join('chat_records', 'chat_sessions.id', '=', 'chat_records.chat_sessions_id')->where('chat_sessions.status','0')->where('chat_sessions.session_to',$toId)->where('chat_sessions.session_from',$fromId)->orderBy('chat_records.id', 'desc')->get();             
		
                if($data ==[]){
                   $data = DB::table('chat_sessions')->join('chat_records', 'chat_sessions.id', '=', 'chat_records.chat_sessions_id')->where('chat_sessions.status','0')->where('chat_sessions.session_to',$fromId)->where('chat_sessions.session_from',$toId)->orderBy('chat_records.id', 'desc')->get();  
                }
                
                $jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
                                $userId=$value->add_by;
                                $sessions=$value->chat_sessions_id;
                        
                              $delee=DB::table('chat_new')->where('sessionid',$sessions)->where('user_id','=',$users->id)->delete();
                              
                                $dataUser = DB::table('users')->where('id','=',$userId)->pluck('username');
				array_push($rowData, $i);
				array_push($rowData, $value->id);
                                array_push($rowData, $value->add_by);
                                array_push($rowData, $dataUser);
                                array_push($rowData, $value->type);
                                if($value->type==2){
                                    $ext =pathinfo($value->content, PATHINFO_EXTENSION);
                                   if($ext=='JPEG'|| $ext=='JPEG'|| $ext=='PNG' || $ext=='jpeg'|| $ext=='jpg'|| $ext=='png'){
                                       array_push($rowData, '<img src="'.url().'/chat/'.$value->chat_sessions_id.'/'.$value->content.'" class="blue"   target="_blank" data-toggle="tooltip" data-placement="top" title="Edit Menu" style="max-height: 300px;">');
                                   }
                                   else{
                                      array_push($rowData, '<a href="'.url().'/chat/'.$value->chat_sessions_id.'/'.$value->content.'" target="_blank"  style="color:blue;" ><i class="fa fa-file fa-3x"></i> Attachment</a>'); 
                                   }
                                    
                                }
                                else{
                                    $imagecontent=str_replace("<img ","<img height='300'",$value->content);
                                    array_push($rowData,$imagecontent);
                                }
                                array_push($rowData, $value->chat_date);
				array_push($rowData, DATE($value->chat_date));	
                                array_push($rowData, $value->chat_sessions_id);
                                array_push($rowData, $value->subject);
                                array_push($jsonList, $rowData);
                                $i++;
		}
		return Response::json($jsonList);
            

        }
        
        public function chathistory(Request $request)
	{
                $fromId=$_GET['fromId'];
                $toId=$_GET['toId'];   
                $users=Sentinel::getUser();                
                
		$data = DB::table('chat_sessions')->join('chat_records', 'chat_sessions.id', '=', 'chat_records.chat_sessions_id')->where('chat_sessions.status','0')->where('chat_sessions.session_to',$toId)->where('chat_sessions.session_from',$fromId)->orderBy('chat_records.id', 'desc')->get();             
		
                if($data ==[]){
                   $data = DB::table('chat_sessions')->join('chat_records', 'chat_sessions.id', '=', 'chat_records.chat_sessions_id')->where('chat_sessions.status','0')->where('chat_sessions.session_to',$fromId)->where('chat_sessions.session_from',$toId)->orderBy('chat_records.id', 'desc')->get();  
                }
                
                $jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
                                $userId=$value->add_by;
                                $sessions=$value->chat_sessions_id;                        
                                $delee=DB::table('chat_new')->where('sessionid',$sessions)->where('user_id',$users->id)->delete();
		}
		
            

        }
        
         public function ischat()
	{    
           $user=Sentinel::getUser(); 
           $data = DB::table('chat_new')->where('user_id',$user->id)->get();
            $jsonList = array();
            $i=1;
           foreach ($data as $value) {
                $rowData= array();
                
                $chat_sessions_id= $value->sessionid;
                $chatSession = DB::table('chat_sessions')->where('id','=',$chat_sessions_id)->get();                
                if($user->id != $chatSession[0]->session_to){             
                    $toid=$chatSession[0]->session_to;   
                    $dataUser = DB::table('users')->where('id','=',$toid)->get();
                    array_push($rowData, $dataUser[0]->username);
                    array_push($rowData, $dataUser[0]->id);
                }            
                if($user->id != $chatSession[0]->session_from){
                   $fromchat=$chatSession[0]->session_from;
                   $dataUser = DB::table('users')->where('id','=',$fromchat)->get();
                   array_push($rowData, $dataUser[0]->username);
                   array_push($rowData, $dataUser[0]->id);
                }
                
                array_push($rowData, $value->id);
                array_push($jsonList, $rowData);
                $i++;
               
           }
           return Response::json($jsonList);
           //return $data;
        }
         public function editView($id,$from,$to)
	    {    
            $data = DB::table('chat_records')->join('users', 'users.id', '=', 'chat_records.add_by')->join('chat_sessions', 'chat_sessions.id', '=','chat_records.chat_sessions_id')->where('chat_sessions_id','=',$id)->orderByRaw('chat_date DESC')->get();
            return view('Chat::edit')->with([
                'chathistory'=>$data,
                'from'=>$from,
                'to'=>$to
            ]);
        }
        
        
        
         public function jsonListsdate($from,$to)
	    {
		
			
			$user = Sentinel::getUser();
                       
                         if($user->roles[0]->id ==9 ){
                            $data = DB::table('chat_sessions')->where('chat_sessions.session_to',$user->id)->orwhere('chat_sessions.session_from',$user->id)->get();             
                         }
                         else{
                             $data = DB::table('chat_sessions')->get();    
                         }
			$jsonList = array();
			$i=1;
			foreach ($data as $key => $chatsession) {
				$dd = array();
				array_push($dd, $i);
                                $sessionId=$chatsession->id;
                                $data = DB::table('chat_records')->where('chat_sessions_id','=',$sessionId)->whereBetween('created_at', [$from.' 00:00:00', $to.' 23:59:59'])->count();
                               $touser= DB::table('users')->where('id',$chatsession->session_to)->get();
                                $foruser= DB::table('users')->where('id',$chatsession->session_from)->get();
                                
                                if($data !=0){
				array_push($dd, $foruser[0]->username);
                                array_push($dd, $touser[0]->username);
                                if( $chatsession->status ==1){
                                    array_push($dd,'<span style="color:red;">Ended</span>');
                                }
                                else{
                                    array_push($dd,'<span style="color:green;">Ongoing</span>');
                                }
                                
                                array_push($dd, '<a href="#" class="blue" onclick="window.location.href=\''.url('chat/edit/'.$chatsession->id).'/'.$from.'/'.$to.'\'" data-toggle="tooltip" data-placement="top" title="View chat"><i class="fa fa-file"></i>View</a>');


//				$json = array_keys(json_decode($role->permissions,true));
//
//				array_push($dd, str_replace(',', ', ', json_encode($json)));
//
//				$permissions = Permission::whereIn('name',['user.role.edit','admin'])->where('status','=',1)->lists('name');
//				if(Sentinel::hasAnyAccess($permissions)){
//					array_push($dd, '<a href="#" class="blue" onclick="window.location.href=\''.url('user/role/edit/'.$role->id).'\'" data-toggle="tooltip" data-placement="top" title="Edit Role"><i class="fa fa-pencil"></i></a>');
//				}else{
//					array_push($dd, '<a href="#" class="disabled" data-toggle="tooltip" data-placement="top" title="Edit Disabled"><i class="fa fa-pencil"></i></a>');
//				}
//
//				$permissions = Permission::whereIn('name',['user.role.delete','admin'])->where('status','=',1)->lists('name');
//				if(Sentinel::hasAnyAccess($permissions)){
//					array_push($dd, '<a href="#" class="red role-delete" data-id="'.$role->id.'" data-toggle="tooltip" data-placement="top" title="Delete Role"><i class="fa fa-trash-o"></i></a>');
//				}else{
//					array_push($dd, '<a href="#" class="disabled" data-toggle="tooltip" data-placement="top" title="Delete Disabled"><i class="fa fa-trash-o"></i></a>');
//				}

				array_push($jsonList, $dd);
                                }
				$i++;
			}
			return Response::json(array('data'=>$jsonList));
		
	}
        
        
        public function jsonHistoryListsdate($from,$to)
	    {

			
			$user = Sentinel::getUser();
                       
                                if($from !=0 && $to!=0){
                                    $data = DB::table('chat_records')->whereBetween('chat_date', [$from.' 00:00:00', $to.' 23:59:59'])->orderBy('chat_records.id', 'desc')->get();
                                }
                                else{
                                    $data = DB::table('chat_records')->whereBetween('chat_date', [date('Y-m-d').' 00:00:00', date('Y-m-d').' 23:59:59'])->orderBy('chat_records.id', 'desc')->get();
                                }
			$jsonList = array();
			$i=1;
			foreach ($data as $key => $chatsession) {
				$dd = array();
                                $sessionId=$chatsession->chat_sessions_id;
                                
                                $dataS = DB::table('chat_sessions')->where('id',$sessionId)->get();
                                
				array_push($dd, $i); 
                                
                                $touser= DB::table('users')->where('id',$dataS[0]->session_to)->get();
                                $foruser= DB::table('users')->where('id',$dataS[0]->session_from)->get();
                                
                                if($data !=0){
                                array_push($dd, $chatsession->chat_date); 
                                if($foruser[0]->id == $chatsession->add_by){
                                   array_push($dd, $foruser[0]->username); 
                                }
                                else{
                                    array_push($dd, $touser[0]->username);  
                                }
				if($foruser[0]->id != $chatsession->add_by){
                                   array_push($dd, $foruser[0]->username); 
                                }
                                else{
                                    array_push($dd, $touser[0]->username);  
                                }
                                                              
                                
                                if($chatsession->type==2){
                                    $ext =pathinfo($chatsession->content, PATHINFO_EXTENSION);
                                   if($ext=='JPEG'|| $ext=='JPEG'|| $ext=='PNG' || $ext=='jpeg'|| $ext=='jpg'|| $ext=='png'){
                                       array_push($dd, '<img src="'.url().'/chat/'.$chatsession->chat_sessions_id.'/'.$chatsession->content.'" class="blue"   target="_blank" data-toggle="tooltip" data-placement="top" title="Edit Menu" style="max-height: 300px;">');
                                   }
                                   else{
                                      array_push($dd, '<a href="'.url().'/chat/'.$chatsession->chat_sessions_id.'/'.$chatsession->content.'" target="_blank"  style="color:blue;" ><i class="fa fa-file fa-3x"></i> Attachment</a>'); 
                                   }
                                    
                                }
                                else{
                                    $imagecontent=str_replace("<img ","<img height='300'",$chatsession->content);
                                    array_push($dd,$imagecontent);
                                }
//				$json = array_keys(json_decode($role->permissions,true));
//
//				array_push($dd, str_replace(',', ', ', json_encode($json)));
//
//				$permissions = Permission::whereIn('name',['user.role.edit','admin'])->where('status','=',1)->lists('name');
//				if(Sentinel::hasAnyAccess($permissions)){
//					array_push($dd, '<a href="#" class="blue" onclick="window.location.href=\''.url('user/role/edit/'.$role->id).'\'" data-toggle="tooltip" data-placement="top" title="Edit Role"><i class="fa fa-pencil"></i></a>');
//				}else{
//					array_push($dd, '<a href="#" class="disabled" data-toggle="tooltip" data-placement="top" title="Edit Disabled"><i class="fa fa-pencil"></i></a>');
//				}
//
//				$permissions = Permission::whereIn('name',['user.role.delete','admin'])->where('status','=',1)->lists('name');
//				if(Sentinel::hasAnyAccess($permissions)){
//					array_push($dd, '<a href="#" class="red role-delete" data-id="'.$role->id.'" data-toggle="tooltip" data-placement="top" title="Delete Role"><i class="fa fa-trash-o"></i></a>');
//				}else{
//					array_push($dd, '<a href="#" class="disabled" data-toggle="tooltip" data-placement="top" title="Delete Disabled"><i class="fa fa-trash-o"></i></a>');
//				}

				array_push($jsonList, $dd);
                                }
				$i++;
			}
			return Response::json(array('data'=>$jsonList));
		
	}
        
               
        public function historylistView(Request $request)
	{        
            return view('Chat::chathistory');
        }
        

}