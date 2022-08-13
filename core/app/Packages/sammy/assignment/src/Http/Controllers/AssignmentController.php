<?php

/**
 * Created by PhpStorm.
 * User: kalya
 * Date: 1/5/2016
 * Time: 10:24 AM
 */
namespace Sammy\Assignment\Http\Controllers;


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
use Mail;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//require 'mail_test.php';





class AssignmentController extends Controller
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
        
        public function jsonListwriterpay($id)
	{
                $users=Sentinel::getUser();          
               
                
                $assignement =  Assignment::find($id);
		$writer=$assignement->assignto;
                $assignementId=$assignement->id;
                
		$user = DB::table('users')->where('id','=', $writer)->get(); 
                    if(sizeof($user) > 0){
                        $user=$user;
                    }
                    else{
                        $user=array();
                    }
                
                $data = DB::table('payment_records')->join('users', 'users.id', '=', 'payment_records.pay_to')->where('payment_records.payment_type','=',1)->where('payment_records.assignment_id','=',$assignementId)->where('users.id','=',$writer)->get();
		$jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
			array_push($rowData,$i);
			array_push($rowData,$value->username);
			array_push($rowData,$value-> amount );
			array_push($rowData,DATE($value->payment_date));
                        if($value->confermstatus == 1){ 
                            array_push($rowData,'confirmed');
                        }
                        else{ 
                            array_push($rowData,'not confirmed');
                              
                        }
                 
                                                                     
			
                            if($value-> confermstatus ==0){
                                array_push($rowData, '<a onclick="deletepayment('.$value->payment_id.')"  data-id="'.$value->payment_id.'" class="role-delete" data-toggle="tooltip" data-placement="top" title="Delete Payment" style="color:red;"><i class="fa fa-trash-o"></i> Delete</a>');
                            }
                            else{
                                  array_push($rowData,'');
                            }
                        
                        array_push($jsonList, $rowData);
			$i++;

		}
		return Response::json(array('data' => $jsonList));

	}
        
        public function jsonListrewriterpay($id)
	{
                $users=Sentinel::getUser();   
                $assignement =  Assignment::find($id);
		$writer=$assignement->assignto;
                $assignementId=$assignement->id;
           
                
                $data = DB::table('payment_records')->join('users', 'users.id', '=', 'payment_records.pay_to')->where('payment_records.payment_type','=',2)->where('payment_records.assignment_id','=',$assignementId)->get();
		$jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
			array_push($rowData,$i);
			array_push($rowData,$value->username);
			array_push($rowData,$value-> amount );
			array_push($rowData,DATE($value->payment_date));
                        if($value->confermstatus == 1){ 
                            array_push($rowData,'confirmed');
                        }
                        else{ 
                            array_push($rowData,'not confirmed');
                              
                        }
                 
                       
                        if($value-> confermstatus ==0){
                               array_push($rowData, '<a onclick="deletepayment('.$value->payment_id.')"  data-id="'.$value->payment_id.'" class="role-delete" data-toggle="tooltip" data-placement="top" title="Delete Payment" style="color:red;"><i class="fa fa-trash-o"></i> Delete</a>');
                        }
                        else{
                            array_push($rowData,'');
                        }
                        
                                                                
				
                        array_push($jsonList, $rowData);
			$i++;

		}
		return Response::json(array('data' => $jsonList));

	}
        
         public function jsonListwriterspay($type,$id)
	{
                $users=Sentinel::getUser(); 
              
                $assignement =  Assignment::find($id);
		$writer=$assignement->assignto;
                $assignementId=$assignement->id;           
                
                $data = DB::table('payment_records')->join('users', 'users.id', '=', 'payment_records.pay_to')->where('payment_records.payment_type','=',$type)->where('payment_records.assignment_id','=',$assignementId)->where('payment_records.pay_to','=',$users->id)->get();
		$jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
			array_push($rowData,$i);
			array_push($rowData,$value->username);
			array_push($rowData,$value-> amount );
			array_push($rowData,DATE($value->payment_date));
                        if($value->confermstatus == 1){ 
                            array_push($rowData,'confirmed');
                        }
                        else{ 
                            array_push($rowData,'not confirmed');
                              
                        }
                 
                       
                        if($value-> confermstatus ==0){
                                array_push($rowData, '<a onclick="deletepayment('.$value->payment_id.')" class="role-delete" data-toggle="tooltip" data-placement="top" title="Confirm Payment" style="color:green;"><i class="fa fa-check"></i> Confirm</a>');
                        }
                        else{
                            array_push($rowData,'');
                        }
                        
                                                                
				
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
				

				$message = "
                        <html>
                        <head>
                        <title>HTML email</title>
                        </head>
                        <body>
                            ".$msge."
                        </body>
                        </html>";
				          $mail = new PHPMailer;
				    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
				    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Host = 'smtp.zoho.com';
                    $mail->Port = 465;         // Enable SMTP authentication
					$mail->Username = 'info@myassignment.lk';                 // SMTP username
					$mail->Password = 'Dumi@123#';
					$mail->setFrom('no-reply@essayasia.com', 'essayasia.com');
					$mail->addAddress($to, '');     // Add a recipient
					$mail->addCC('auto.myassignment.lk@gmail.com');
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = $subject;
					$mail->Body    = $message;
					$mail->send();
				


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
	public function writerreject(Request $request)
	{
		if($request->ajax()){
			$id = $request->input('id');
			$document = Assignment::find($id);
			if($document){
				$document->status = 0;
				$document->progress = 0;
                                $document->assignto = 0;
                                 $document->writer_reject = 1;
                                $document->assignDate = '0000-00-00 00:00:00';
				$document->save();


		   		$assignement = Assignment::find($id);
		                $adminuser = DB::table('users')->where('users.id', '52')->get();
		                $couser = DB::table('users')->join('role_users', 'role_users.user_id', '=', 'users.id')->where('role_users.role_id', '10')->get();           
		
		                $msge = 'Assignment Reject by writer Ref-'  . $id;
		                $data = 'username=myassignment.lk&password=Mypassword123&src=Essayasia&dst=' . $adminuser[0]->mobileNo . '&msg=' . $msge . '&dr=1';
		
		                $to = $adminuser[0]->email;
		                $toc = $couser[0]->email;
		                $subject = 'Assignment rejected by writer Ref- ' . $id;
		
		                //$headers = 'From:essayasia.com <no-reply@essayasia.com>" . "\r\n";
		                //$headers .= 'Cc: auto.myassignment.lk@gmail.com' . "\r\n";
		                //$headers.= "MIME-Version: 1.0" . "\r\n";
		                //$headers .= "Content-Type: text/html; charset=ISO-8859-1" . "\r\n";
		
		                //mail($to, $subject, $msge, $headers);
						$message = "
                        <html>
                        <head>
                        <title>HTML email</title>
                        </head>
                        <body>
                            ".$msge."
                        </body>
                        </html>";
						
					$mail = new PHPMailer;
				    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
				    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Host = 'smtp.zoho.com';
                    $mail->Port = 465;         // Enable SMTP authentication
					$mail->Username = 'info@myassignment.lk';                 // SMTP username
					$mail->Password = 'Dumi@123#';
					$mail->setFrom('no-reply@essayasia.com', 'essayasia.com');
					$mail->addAddress($to, '');     // Add a recipient
					//$mail->AddAddress('kasun.kalya@gmail.com');
					$mail->addCC('auto.myassignment.lk@gmail.com');
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = $subject;
					$mail->Body    = $message;
					$mail->send();
					
						
						
						
						
						
						
		                //mail($toc, $subject, $msge, $headers);

		                		$message = "
                                                <html>
                                                <head>
                                                <title>HTML email</title>
                                                </head>
                                                <body>
                                                    ".$msge."
                                                </body>
                                                </html>
                                        ";
										
					$mail = new PHPMailer;
				    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
				    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Host = 'smtp.zoho.com';
                    $mail->Port = 465;         // Enable SMTP authentication
					$mail->Username = 'info@myassignment.lk';                 // SMTP username
					$mail->Password = 'Dumi@123#';
					$mail->setFrom('no-reply@essayasia.com', 'essayasia.com');
					$mail->addAddress($toc, '');     // Add a recipient
					//$mail->AddAddress('kasun.kalya@gmail.com');
					$mail->addCC('auto.myassignment.lk@gmail.com');
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = $subject;
					$mail->Body    = $message;
					$mail->send();
						


				return response()->json(['status' => 'success','url' => $data]);
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
	public function rewriterreject(Request $request)
	{
		if($request->ajax()){
			$id = $request->input('id');
			$document = Assignment::find($id);
			if($document){	
                            
                                DB::table('review_writers')->where('assigmnet_id',$id)->where('writer_id',$document->checking_writer)->delete();                            
				
                                $document->checking_status = 0;
                                $document->checking_writer = 0;
                                $document->checking_allocated_date = '0000-00-00 00:00:00';
				$document->save();
                                
                                


		   		$assignement = Assignment::find($id);
		                $adminuser = DB::table('users')->where('users.id', '52')->get();
		                $couser = DB::table('users')->join('role_users', 'role_users.user_id', '=', 'users.id')->where('role_users.role_id', '10')->get();           
		
		                $msge = "Assignment reject by review writer Ref- " . $id;
		                $data = 'username=myassignment.lk&password=Mypassword123&src=Essayasia&dst=' . $adminuser[0]->mobileNo . '&msg=' . $msge . '&dr=1';
		
		                $to = $adminuser[0]->email;
		                $toc = $couser[0]->email;
		                $subject = 'Assignment rejected by review writer Ref- ' . $id;
		
		                $headers = "From:essayasia.com <no-reply@essayasia.com>" . "\r\n";
		                $headers .= 'Cc: auto.myassignment.lk@gmail.com' . "\r\n";
		                $headers.= "MIME-Version: 1.0" . "\r\n";
		                $headers .= "Content-Type: text/html; charset=ISO-8859-1" . "\r\n";
		
		               // mail($to, $subject, $msge, $headers);
						$message = "
                                                <html>
                                                <head>
                                                <title>HTML email</title>
                                                </head>
                                                <body>
                                                    ".$msge."
                                                </body>
                                                </html>
                                        ";
										
					$mail = new PHPMailer;
				    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
				    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Host = 'smtp.zoho.com';
                    $mail->Port = 465;         // Enable SMTP authentication
					$mail->Username = 'info@myassignment.lk';                 // SMTP username
					$mail->Password = 'Dumi@123#';
					$mail->setFrom('no-reply@essayasia.com', 'essayasia.com');
					$mail->addAddress($to, '');     // Add a recipient
					//$mail->AddAddress('kasun.kalya@gmail.com');
					$mail->addCC('auto.myassignment.lk@gmail.com');
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = $subject;
					$mail->Body    = $message;
					$mail->send();
			
						
						
		               // mail($toc, $subject, $msge, $headers);
						$message = "
                                                <html>
                                                <head>
                                                <title>HTML email</title>
                                                </head>
                                                <body>
                                                    ".$msge."
                                                </body>
                                                </html>
                                        ";


						          $mail = new PHPMailer;
				    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
				    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Host = 'smtp.zoho.com';
                    $mail->Port = 465;         // Enable SMTP authentication
					$mail->Username = 'info@myassignment.lk';                 // SMTP username
					$mail->Password = 'Dumi@123#';
					$mail->setFrom('no-reply@essayasia.com', 'essayasia.com');
					$mail->addAddress($toc, '');     // Add a recipient
					//$mail->AddAddress('kasun.kalya@gmail.com');
					$mail->addCC('auto.myassignment.lk@gmail.com');
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = $subject;
					$mail->Body    = $message;
					$mail->send();				
						
		                

				return response()->json(['status' => 'success','url' => $data]);
			}else{
				return response()->json(['status' => 'invalid_id']);
			}
		}else{
			return response()->json(['status' => 'not_ajax']);
		}
	}


	/**
	 * complete a Document
	 * @param  Request $request Document id
	 * @return Json           	json object with status of success or failure
	 */
	public function complete(Request $request)
	{
		if($request->ajax()){
			$id = $request->input('id');
			$document = Assignment::find($id);
			if($document){
				$document->status = 3;
                                $document->checking_status = 3;
				$document->completeDate = date('Y-m-d H:i:s');
				$document->save();


				$assignement =  Assignment::find($id);
				$writers=  User::find($assignement->assignto);
				
				$domain=$assignement->domain;
				
				if($domain !='LK'){
					$curency='USD';
					$url='myassignment.com.au';
				}
				else{
					$curency='LKR';
					$url='myassignment.lk';
				}

				$msge = "Assignment completed Ref- " . $id;
				$data = 'username=myassignment.lk&password=Mypassword123&src=Essayasia&dst='.$writers->mobileNo.'&msg='.$msge.'&dr=1';


				$to = $writers->email;
				$subject = 'Your order (Ref : '.$id.') is ready to collect '.$id;
				$headers = "From:essayasia.com <no-reply@essayasia.com>"."\r\n";
				$headers .= 'Cc: auto.myassignment.lk@gmail.com' . "\r\n";
				$headers.= "MIME-Version: 1.0"."\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1"."\r\n";
				
				//mail($to,$subject,$msge,$headers);
					$message = "
                                                <html>
                                                <head>
                                                <title>HTML email</title>
                                                </head>
                                                <body>
                                                    ".$msge."
                                                </body>
                                                </html>
                                        ";
				    $mail = new PHPMailer;
				    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
				    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Host = 'smtp.zoho.com';
                    $mail->Port = 465;         // Enable SMTP authentication
					$mail->Username = 'info@myassignment.lk';                 // SMTP username
					$mail->Password = 'Dumi@123#';
					$mail->setFrom('no-reply@essayasia.com', 'essayasia.com');
					$mail->addAddress($to, '');     // Add a recipient
					//$mail->AddAddress('kasun.kalya@gmail.com');
					$mail->addCC('auto.myassignment.lk@gmail.com');
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = $subject;
					$mail->Body    = $message;
					$mail->send();
				
				

				$balance=$assignement->price - $assignement->advance;
				$msgeStudent = 	"Dear ".$assignement->studentName." %0aYour order ".$id." is ready to collect. Already we have mailed  the screenshots and you could collect the papers after depositing the balance of ".$curency." ".$balance.".%0aThank you for choosing '.$url.'";

				$data_student = 'username=myassignment.lk&password=Mypassword123&src=MyAssign_LK&dst='.$assignement->phoneNo.'&msg='.$msgeStudent.'&dr=1';



				$msgeStudentemail='<html> 
  <body ><center style="min-width: 600px; width: 100%;">
<table class="m_8638116721254369886container m_8638116721254369886main-wrapper m_8638116721254369886float-center" style="margin: 0 auto; background: #fff; border: 4px solid #5f47a2; border-collapse: collapse; border-spacing: 0; float: none; padding: 0; text-align: center; vertical-align: top; width: 600px;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<td style="margin: 0; border-collapse: collapse!important; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0; text-align: left; vertical-align: top; word-wrap: break-word;">
<table class="m_8638116721254369886row m_8638116721254369886header" style="border-collapse: collapse; border-spacing: 0; display: table; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<th class="m_8638116721254369886no-padding m_8638116721254369886small-12 m_8638116721254369886large-12 m_8638116721254369886columns m_8638116721254369886first m_8638116721254369886last" style="margin: 0 auto; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0; padding-bottom: 0; padding-left: 0; padding-right: 0; text-align: left; width: 580px;">
<table style="border-collapse: collapse; border-spacing: 0; font-size: 14px; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="font-size: 14px; padding: 0; text-align: left; vertical-align: top;">
<th style="margin: 0; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 14px; font-weight: 400; line-height: 19px; padding: 0; text-align: left;">
<table class="m_8638116721254369886spacer" style="border-collapse: collapse; border-spacing: 0; font-size: 14px; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody style="font-size: 14px;">
<tr style="font-size: 14px; padding: 0; text-align: left; vertical-align: top;">
<td height="10px" style="margin: 0; border-collapse: collapse!important; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 10px; font-weight: 400; line-height: 10px; padding: 0; text-align: left; vertical-align: top; word-wrap: break-word;">&nbsp;</td>
</tr>
</tbody>
</table>
<table class="m_8638116721254369886row m_8638116721254369886inner" style="border-collapse: collapse; border-spacing: 0; display: table; font-size: 14px; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody style="font-size: 14px;">
<tr style="font-size: 14px; padding: 0; text-align: left; vertical-align: top;">
<th class="m_8638116721254369886logo m_8638116721254369886small-12 m_8638116721254369886large-3 m_8638116721254369886columns m_8638116721254369886first" style="margin: 0 auto; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 14px; font-weight: 400; line-height: 19px; padding: 0; padding-bottom: 0; padding-left: 20px; padding-right: 10px; text-align: left; width: 25%;">
<table style="border-collapse: collapse; border-spacing: 0; font-size: 14px; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="font-size: 14px; padding: 0; text-align: left; vertical-align: top;">
<th style="margin: 0; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 14px; font-weight: 400; line-height: 19px; padding: 0; text-align: left;">
<table class="m_8638116721254369886spacer" style="border-collapse: collapse; border-spacing: 0; font-size: 14px; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody style="font-size: 14px;">
<tr style="font-size: 14px; padding: 0; text-align: left; vertical-align: top;">
<td height="10px" style="margin: 0; border-collapse: collapse!important; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 10px; font-weight: 400; line-height: 10px; padding: 0; text-align: left; vertical-align: top; word-wrap: break-word;">&nbsp;</td>
</tr>
</tbody>
</table>
<a href="https://'.$url.'/"><img src="https://'.$url.'/resources/images/imgs/logo.png" alt="" width="300" height="41" /></a></th>
</tr>
</tbody>
</table>
</th>
<th class="m_8638116721254369886welcome m_8638116721254369886small-12 m_8638116721254369886large-4 m_8638116721254369886columns" style="margin: 0 auto; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 14px; font-weight: 400; line-height: 19px; padding: 0; padding-bottom: 0; padding-left: 10px; padding-right: 10px; text-align: left; width: 33.33333%;">
<table style="border-collapse: collapse; border-spacing: 0; font-size: 14px; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="font-size: 14px; padding: 0; text-align: left; vertical-align: top;">
<th style="margin: 0; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 14px; font-weight: 400; line-height: 19px; padding: 0; text-align: left;">
<table class="m_8638116721254369886spacer" style="border-collapse: collapse; border-spacing: 0; font-size: 14px; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody style="font-size: 14px;">
<tr style="font-size: 14px; padding: 0; text-align: left; vertical-align: top;">
<td height="10px" style="margin: 0; border-collapse: collapse!important; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 10px; font-weight: 400; line-height: 10px; padding: 0; text-align: left; vertical-align: top; word-wrap: break-word;">&nbsp;</td>
</tr>
</tbody>
</table>
Your paper is completed</th>
</tr>
</tbody>
</table>
</th>
</tr>
</tbody>
</table>
<table class="m_8638116721254369886spacer" style="border-collapse: collapse; border-spacing: 0; font-size: 14px; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody style="font-size: 14px;">
<tr style="font-size: 14px; padding: 0; text-align: left; vertical-align: top;">
<td height="20px" style="margin: 0; border-collapse: collapse!important; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 20px; font-weight: 400; line-height: 20px; padding: 0; text-align: left; vertical-align: top; word-wrap: break-word;">&nbsp;</td>
</tr>
</tbody>
</table>
</th>
</tr>
</tbody>
</table>
</th>
</tr>
</tbody>
</table>
<table class="m_8638116721254369886row m_8638116721254369886intro" style="background-color: #8d7bbc;  background-position: 100% 50%; background-repeat: no-repeat; background-size: cover; border-collapse: collapse; border-spacing: 0; display: table; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<th class="m_8638116721254369886small-12 m_8638116721254369886large-12 m_8638116721254369886columns m_8638116721254369886first m_8638116721254369886last" style="margin: 0 auto; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0; padding-bottom: 0; padding-left: 20px; padding-right: 20px; text-align: left; width: 580px;">
<table style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<th style="margin: 0; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; height: 252px; line-height: 19px; max-width: 232px; padding: 0; text-align: center; vertical-align: middle;"><span class="m_8638116721254369886simple-text" style="color: #ffffff; display: block; font-size: 35px; line-height: 40px; text-transform: uppercase;"> Hello, '.$assignement->studentName.'! </span>
<table class="m_8638116721254369886spacer" style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<td height="10px" style="margin: 0; border-collapse: collapse!important; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 10px; font-weight: 400; line-height: 10px; padding: 0; text-align: left; vertical-align: top; word-wrap: break-word;">&nbsp;</td>
</tr>
</tbody>
</table>
<p class="m_8638116721254369886text-center m_8638116721254369886yellow-text" style="margin: 0; margin-bottom: 0; color: #04af82; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0; text-align: center;"><strong><span class="m_8638116721254369886underlined" style="border-bottom: 2px solid #04af82; font-size: 22px; line-height: 32px; text-transform: none;">Order '.$assignement->id.' is ready to collect</span></strong></p>
</th>
<th class="m_8638116721254369886expander" style="margin: 0; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; height: 252px; line-height: 19px; max-width: 232px; padding: 0!important; text-align: center; vertical-align: middle; width: 0;"></th>
</tr>
</tbody>
</table>
</th>
</tr>
</tbody>
</table>
<table class="m_8638116721254369886row m_8638116721254369886main" style="border-collapse: collapse; border-spacing: 0; display: table; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<th class="m_8638116721254369886small-12 m_8638116721254369886large-12 m_8638116721254369886columns m_8638116721254369886first m_8638116721254369886last" style="margin: 0 auto; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0; padding-bottom: 0; padding-left: 20px; padding-right: 20px; text-align: left; width: 580px;">
<table style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<th style="margin: 0; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0; text-align: left;">
<table class="m_8638116721254369886spacer" style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<td height="20px" style="margin: 0; border-collapse: collapse!important; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 20px; font-weight: 400; line-height: 20px; padding: 0; text-align: left; vertical-align: top; word-wrap: break-word;">&nbsp;</td>
</tr>
</tbody>
</table>
<p class="m_8638116721254369886text-center m_8638116721254369886bold-text" style="margin: 0; margin-bottom: 0; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: bold; line-height: 1.3em; padding: 0; text-align: center;">ALREADY WE HAVE MAILED THE SCREENSHOTS</p>

<p class="m_8638116721254369886text-center m_8638116721254369886bold-text" style="margin: 0; margin-bottom: 0; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: bold; line-height: 1.3em; padding: 0; text-align: center;"><a href="
http://www.essayasia.com/dashboard/attachments/'.$assignement->id.'/'.$assignement->writerImages.'" download target="_self">DOWNLOAD SCREENSHOTS</a>

</p>

</p>
<table class="m_8638116721254369886spacer" style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<td height="20px" style="margin: 0px; color: #6a6a6a; font-family: Helvetica, Arial, sans-serif; font-size: 20px; font-weight: 400; line-height: 20px; padding: 0px; text-align: left; vertical-align: top; word-wrap: break-word; border-collapse: collapse !important; height: 21px;">&nbsp;</td>
</tr>
</tbody>
</table>
</th>
<th class="m_8638116721254369886expander" style="margin: 0; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0!important; text-align: left; width: 0;"></th>
</tr>
</tbody>
</table>
</th>
</tr>
</tbody>
</table>
<table class="m_8638116721254369886row m_8638116721254369886blue-stripe" style="background-color: #8d7bbc; border-collapse: collapse; border-spacing: 0; display: table; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<th class="m_8638116721254369886small-12 m_8638116721254369886large-12 m_8638116721254369886columns m_8638116721254369886first m_8638116721254369886last" style="margin: 0 auto; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0; padding-bottom: 0; padding-left: 20px; padding-right: 20px; text-align: left; width: 580px;">
<table style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<th style="margin: 0; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0; text-align: left;">
<table class="m_8638116721254369886spacer" style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<td height="25px" style="margin: 0px; color: #6a6a6a; font-family: Helvetica, Arial, sans-serif; font-size: 25px; font-weight: 400; line-height: 25px; padding: 0px; text-align: left; vertical-align: top; word-wrap: break-word; border-collapse: collapse !important; height: 27px;">&nbsp;</td>
</tr>
</tbody>
</table>
<p class="m_8638116721254369886text-center m_8638116721254369886upper" style="margin: 0; margin-bottom: 0; color: #fff; font-family: Helvetica,Arial,sans-serif; font-size: 18px; font-weight: 400; line-height: 24px; padding: 0; text-align: center; text-transform: uppercase; direction: ltr;">YOU COULD COLLECT THE PAPERS AFTER DEPOSITING THE BALANCE DUE OF '.$curency.' '.$balance.'<br /><span class="m_8638116721254369886yellow-text" style="color: #04af82;">If THERE ARE ANY CORRECTIONS OR ADJUSTMENTS THAT WOULD BE DONE FREE OF CHARGE SUBJECT TO THE ORIGINAL ORDER GIVEN</span></p>
<table class="m_8638116721254369886spacer" style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<td height="25px" style="margin: 0; border-collapse: collapse!important; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 25px; font-weight: 400; line-height: 25px; padding: 0; text-align: left; vertical-align: top; word-wrap: break-word;">&nbsp;</td>
</tr>
</tbody>
</table>
</th>
<th class="m_8638116721254369886expander" style="margin: 0; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0!important; text-align: left; width: 0;"></th>
</tr>
</tbody>
</table>
</th>
</tr>
</tbody>
</table>
<table class="m_8638116721254369886row m_8638116721254369886main" style="border-collapse: collapse; border-spacing: 0; display: table; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<th class="m_8638116721254369886small-12 m_8638116721254369886large-12 m_8638116721254369886columns m_8638116721254369886first m_8638116721254369886last" style="margin: 0 auto; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0; padding-bottom: 0; padding-left: 20px; padding-right: 20px; text-align: left; width: 580px;">
<table style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<th style="margin: 0; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0; text-align: left;">
<table class="m_8638116721254369886spacer" style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<td height="20px" style="margin: 0; border-collapse: collapse!important; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 20px; font-weight: 400; line-height: 20px; padding: 0; text-align: left; vertical-align: top; word-wrap: break-word;">&nbsp;</td>
</tr>
</tbody>
</table>
<table class="m_8638116721254369886spacer" style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<td height="20px" style="margin: 0px; color: #6a6a6a; font-family: Helvetica, Arial, sans-serif; font-size: 20px; font-weight: 400; line-height: 20px; padding: 0px; text-align: left; vertical-align: top; word-wrap: break-word; height: 38px; border-collapse: collapse !important;"><br />Order  :'.$assignement->id.'</td>
</tr>
<tr style="height: 21px;">
<td style="margin: 0px; color: #6a6a6a; font-family: Helvetica, Arial, sans-serif; font-size: 20px; font-weight: 400; line-height: 20px; padding: 0px; text-align: left; vertical-align: top; word-wrap: break-word; height: 24px; border-collapse: collapse !important;">Words  : '.$assignement->wordcount.'</td>
</tr>
<tr style="height: 21px;">
<td style="margin: 0px; color: #6a6a6a; font-family: Helvetica, Arial, sans-serif; font-size: 20px; font-weight: 400; line-height: 20px; padding: 0px; text-align: left; vertical-align: top; word-wrap: break-word; border-collapse: collapse !important; height: 21px;">Due amount : '.$balance.'</td>
</tr>
</tbody>
</table>
<center style="min-width: 540px; width: 100%;"><br />
<table class="m_8638116721254369886button m_8638116721254369886radius m_8638116721254369886float-center" style="margin: 0; border-collapse: collapse; border-spacing: 0; display: inline-block; float: none; padding: 0; text-align: center; vertical-align: top; width: auto!important;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<td style="margin: 0; border-collapse: collapse!important; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0; text-align: left; vertical-align: top; word-wrap: break-word;">
<table style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<td style="margin: 0; background: #5f47a2; border: none; border-collapse: collapse!important; border-radius: 7px; color: #fff; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0; text-align: left; vertical-align: top; word-wrap: break-word;"><a href="https://'.$url.'/payments/" style="margin: 0; border: 0 solid #5f47a2; border-radius: 5px; color: #fff; display: inline-block; font-family: Helvetica,Arial,sans-serif; font-size: 24px; font-weight: 400; line-height: 1.3em; padding: 10px 17px 10px 17px; text-align: center; text-decoration: none;" target="_blank" data-saferedirecturl="" rel="noopener">Bank Details</a></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</center></th>
<th class="m_8638116721254369886expander" style="margin: 0; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0!important; text-align: left; width: 0;"></th>
</tr>
</tbody>
</table>
</th>
</tr>
</tbody>
</table>
<table class="m_8638116721254369886row m_8638116721254369886thank-you" style="border-collapse: collapse; border-spacing: 0; display: table; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<th class="m_8638116721254369886small-12 m_8638116721254369886large-12 m_8638116721254369886columns m_8638116721254369886first m_8638116721254369886last" style="margin: 0 auto; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0; padding-bottom: 0; padding-left: 20px; padding-right: 20px; text-align: left; width: 580px;">
<table style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<th style="margin: 0; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0; text-align: left;">
<p class="m_8638116721254369886text-center" style="margin: 0; margin-bottom: 0; color: #6a6a6a; font-family: Georgia,serif; font-size: 20px; font-style: italic; font-weight: 400; line-height: 28px; padding: 0; text-align: center;"><span class="m_8638116721254369886line" style="color: #5f47a2; display: inline-block; font-size: 60px; font-style: normal; font-weight: bold; line-height: 45px; vertical-align: top;">&ndash;</span><span class="m_8638116721254369886main-text" style="display: inline-block; font-weight: bold; line-height: 50px; vertical-align: top;">Thank you!</span><span class="m_8638116721254369886line" style="color: #5f47a2; display: inline-block; font-size: 60px; font-style: normal; font-weight: bold; line-height: 45px; vertical-align: top;">&ndash;</span></p>
<p class="m_8638116721254369886text-center" style="margin: 0; margin-bottom: 0; color: #6a6a6a; font-family: Georgia,serif; font-size: 20px; font-style: italic; font-weight: 400; line-height: 28px; padding: 0; text-align: center;">for choosing <a href="https://'.$url.'/" class="m_8638116721254369886green-text" style="margin: 0; color: #5f47a2; font-family: Georgia,serif; font-weight: 400; line-height: 1.3em; padding: 0; text-align: left; text-decoration: none;" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://my.australianwritings.com.au&amp;source=gmail&amp;ust=1526716371421000&amp;usg=AFQjCNGAPTDUgHoEc8xpQ5xuL4AwJfs1fA" rel="noopener">'.$url.'</a> as your custom paper provider</p>
<table class="m_8638116721254369886spacer" style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<td height="15px" style="margin: 0; border-collapse: collapse!important; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 15px; font-weight: 400; line-height: 15px; padding: 0; text-align: left; vertical-align: top; word-wrap: break-word;">&nbsp;</td>
</tr>
</tbody>
</table>
</th>
<th class="m_8638116721254369886expander" style="margin: 0; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0!important; text-align: left; width: 0;"></th>
</tr>
</tbody>
</table>
</th>
</tr>
</tbody>
</table>
<table class="m_8638116721254369886container" style="margin: 0 auto; background: #fff; border-collapse: collapse; border-spacing: 0; padding: 0; text-align: inherit; vertical-align: top; width: 600px;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<td style="margin: 0; border-collapse: collapse!important; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0; text-align: left; vertical-align: top; word-wrap: break-word;"><img alt="" src="https://ci5.googleusercontent.com/proxy/mtfsaSdZmoMR02NUa_5HL_NJYgvJTKZdTWW93aXkiY26FCy42JYbezHWzUKE2EPXTz5hpHmhardtmaWwWhcZZbxIMb9LZ7a49DrLgwY1t_r03qZN6JDU6MMjpWfzb-IMZ-Qm3lprn6kyiR8Sy9PuFWF0jC4uQCiT7rkQ04PzL3PJBimkqYVzpLJjsB57spHaC-SXrnrVldHy6srtsXox9AGzq367a-4UgR9jQbYXP7hPyxs6f2SGB03BXBVh-Sza2EIgk6whVzfdOwTYK4wyn5MoauToeG4STWO-Y-8fTlRCOfOgQdmnPCcPQER23vXUTo6qBneN1KqIZh4tlLGrG4KIOg49UoU_fCNTmKSQGUmSwhnoXbeCZmHhPRNl3lRQg3ns3uBUS3rqD81GMUagXuOLJAztSWYIaZsfdrtgDgUhJIWQtbP_BmfZD3EpgoM1XrpArE872GW4Zg2DwWzg5Kcl5VOSjB29t_yvSvIsdnlis5UFVMwYsuPCDPV9Y7N1ahCgNRlYD9umgyXhwhpdDzYrzymeaswO8pxXxU7R6NjrMIClOjTWgMzHevKlyVHcifsD1aFvHLghhjrJY7gQVqs2SHsr4VU9sqkBZGQ8AUL7=s0-d-e1-ft#http://asset.australianwritings.com.au/track_d45sd841?aHR0cHM6Ly93d3cuZ29vZ2xlLWFuYWx5dGljcy5jb20vY29sbGVjdD92PTEmdGlkPVVBLTc3NzI5NTE0LTEmY2lkPTExNTM4MzkyMDkuMTUyMTg5ODY5MSZkaD1teS5hdXN0cmFsaWFud3JpdGluZ3MuY29tLmF1JnQ9ZXZlbnQmZWM9ZW1haWwmZWE9b3BlbiZjZDE9MTUwOTIxNCZjZDI9VmlzaXRvciZlbD0xZGF5X2RlYWRsaW5lXzE1MjY1NzI5ODQmZHA9JTJGZW1haWwlMkYxZGF5X2RlYWRsaW5lJmR0PVlvdXIrcGFwZXIraXMreWV0K3RvK2JlK2NvbXBsZXRlZCUzRiZjZDM9RW1haWxzK0luY2x1ZGVkJmNtMT0x" style="clear: both; display: block; height: 0; max-width: 100%; outline: 0; text-decoration: none; width: 0;" class="CToWUd" /></td>
</tr>
</tbody>
</table>
<table class="m_8638116721254369886row m_8638116721254369886footer" style="background-color: #f3f3f3; border-collapse: collapse; border-spacing: 0; border-top: 4px solid #5f47a2; display: table; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<th class="m_8638116721254369886small-12 m_8638116721254369886large-12 m_8638116721254369886columns m_8638116721254369886first m_8638116721254369886last" style="margin: 0 auto; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0; padding-bottom: 0; padding-left: 20px; padding-right: 20px; text-align: left; width: 580px;">
<table style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<th style="margin: 0; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0; text-align: left;">
<table class="m_8638116721254369886spacer" style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<td height="20px" style="margin: 0; border-collapse: collapse!important; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 20px; font-weight: 400; line-height: 20px; padding: 0; text-align: left; vertical-align: top; word-wrap: break-word;">&nbsp;</td>
</tr>
</tbody>
</table>
<table class="m_8638116721254369886row m_8638116721254369886big_button" style="display: table; background: #fff; border-collapse: collapse; border-radius: 5px; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<th class="m_8638116721254369886no-padding m_8638116721254369886small-1 m_8638116721254369886large-1 m_8638116721254369886columns m_8638116721254369886first" style="margin: 0 auto; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0; padding-bottom: 0; padding-left: 0; padding-right: 0; text-align: left; width: 4%;">
<table style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<th style="margin: 0; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0; text-align: left;"></th>
</tr>
</tbody>
</table>
</th>
<th class="m_8638116721254369886no-padding m_8638116721254369886small-10 m_8638116721254369886large-7 m_8638116721254369886columns" style="margin: 0 auto; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0; padding-bottom: 0; padding-left: 0; padding-right: 0; text-align: left; width: 58.33333%;">
<table style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<th style="margin: 0; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0; text-align: left;"><a href="https://'.$url.'/" class="m_8638116721254369886small-text-center111" style="margin: 0; color: #6a6a6a; display: block; font-family: Helvetica,Arial,sans-serif; font-size: 30px; font-weight: bold; line-height: 45px; padding: 0; text-align: left; text-decoration: none;" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://my.australianwritings.com.au&amp;source=gmail&amp;ust=1526716371421000&amp;usg=AFQjCNGAPTDUgHoEc8xpQ5xuL4AwJfs1fA" rel="noopener">HAVE A QUESTION?Click here to ask support</a></th>
</tr>
</tbody>
</table>
</th>
<th class="m_8638116721254369886no-padding m_8638116721254369886small-1 m_8638116721254369886large-4 m_8638116721254369886columns m_8638116721254369886last" style="margin: 0 auto; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0; padding-bottom: 0; padding-left: 0; padding-right: 0; text-align: left; width: 33.33333%;">
<table style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<th style="margin: 0; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0; text-align: left;"><a href="https://my.australianwritings.com.au" class="m_8638116721254369886show-for-large" style="margin: 0; color: #6a6a6a; display: block; font-family: Helvetica,Arial,sans-serif; font-size: 30px; font-weight: bold; line-height: 45px; padding: 0; text-align: left; text-decoration: none;" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://my.australianwritings.com.au&amp;source=gmail&amp;ust=1526716371421000&amp;usg=AFQjCNGAPTDUgHoEc8xpQ5xuL4AwJfs1fA" rel="noopener"><img src="?ui=2&amp;ik=da79e4bb40&amp;view=fimg&amp;th=1636ed7e121f17c4&amp;attid=0.1&amp;disp=emb&amp;attbid=ANGjdJ-f6m4OFLACuP0k5DAvS5q4rN0zCFMMbr54IQoBGK5ZkWEbREWi92d00qReJ5Buz8_euYJKzJnbNgqha_6QLhM_O4mVikOqa4X1iQDTQQyDE-G0o1KkSi0PYnM&amp;sz=s0-l75-ft&amp;ats=1526629971419&amp;rm=1636ed7e121f17c4&amp;zw&amp;atsh=1" alt="" style="border: none; clear: both; display: block; max-width: 100%; outline: 0; text-decoration: none; width: auto;" class="CToWUd" /></a></th>
</tr>
</tbody>
</table>
</th>
</tr>
</tbody>
</table>
<table class="m_8638116721254369886spacer" style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<td height="20px" style="margin: 0; border-collapse: collapse!important; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 20px; font-weight: 400; line-height: 20px; padding: 0; text-align: left; vertical-align: top; word-wrap: break-word;">&nbsp;</td>
</tr>
</tbody>
</table>
<table class="m_8638116721254369886row m_8638116721254369886copyright" style="border-collapse: collapse; border-spacing: 0; display: table; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<th class="m_8638116721254369886no-padding m_8638116721254369886small-12 m_8638116721254369886large-12 m_8638116721254369886columns m_8638116721254369886first m_8638116721254369886last" style="margin: 0 auto; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0; padding-bottom: 0; padding-left: 0; padding-right: 0; text-align: left; width: 100%;">
<table style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<th style="margin: 0; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0; text-align: left;">
<p style="margin: 0; margin-bottom: 5px; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 11px; font-weight: 400; line-height: 19px; padding: 0; text-align: left;">&copy; 2018,<a href="https://'.$url.'/"><em>'.$url.'</em></a></p>
<p style="margin: 0; margin-bottom: 5px; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 11px; font-weight: 400; line-height: 19px; padding: 0; text-align: left;">You have received this e-mail because you are subscribed as a registered user of our service <em>'.$url.'. </em></p>
</th>
<th class="m_8638116721254369886expander" style="margin: 0; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 16px; font-weight: 400; line-height: 19px; padding: 0!important; text-align: left; width: 0;"></th>
</tr>
</tbody>
</table>
</th>
</tr>
</tbody>
</table>
<table class="m_8638116721254369886spacer" style="border-collapse: collapse; border-spacing: 0; padding: 0; text-align: left; vertical-align: top; width: 100%;">
<tbody>
<tr style="padding: 0; text-align: left; vertical-align: top;">
<td height="15px" style="margin: 0; border-collapse: collapse!important; color: #6a6a6a; font-family: Helvetica,Arial,sans-serif; font-size: 15px; font-weight: 400; line-height: 15px; padding: 0; text-align: left; vertical-align: top; word-wrap: break-word;">&nbsp;</td>
</tr>
</tbody>
</table>
</th>
</tr>
</tbody>
</table>
</th>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</center>
 </body> 
</html>
';

    

				$to_student = $assignement->email;
				$subject_student = 'Payment Receipt Ref-'.$id;
				$headers_student = "From:".$url."<info@".$url.">"."\r\n";
				$headers_student  .= 'Cc: auto.myassignment.lk@gmail.com' . "\r\n";
				$headers_student .= "MIME-Version: 1.0\r\n";
				$headers_student .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				//mail($to_student,$subject_student,$msgeStudentemail,$headers_student);
					$message = "
                                                <html>
                                                <head>
                                                <title>HTML email</title>
                                                </head>
                                                <body>
                                                    ".$msgeStudentemail."
                                                </body>
                                                </html>
                                        ";
				
					$mail = new PHPMailer;
				    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
				    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Host = 'smtp.zoho.com';
                    $mail->Port = 465;         // Enable SMTP authentication
					$mail->Username = 'info@myassignment.lk';                 // SMTP username
					$mail->Password = 'Dumi@123#';
					$mail->setFrom('no-reply@myassignment.com', 'myassignment.lk');
					$mail->addAddress($to_student, '');     // Add a recipient
					//$mail->AddAddress('kasun.kalya@gmail.com');
					$mail->addCC('auto.myassignment.lk@gmail.com');
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = $subject_student;
					$mail->Body    = $message;
					$mail->send();


				return response()->json(['status' => 'success','studenturl' => $data_student ,'url' => $data ]);
			}else{
				return response()->json(['status' => 'invalid_id']);
			}
		}else{
			return response()->json(['status' => 'not_ajax']);
		}
	}

	/**
	 * Show the Document type edit screen to the user.
	 *
	 * @return Response
	 */
	public function editView($id)
	{
		$adminAttachment=0;
		$writerAttachment=0;
		$assigneWriter=0;
		$adminDiscripton=0;
		$addcomplete=0;
		$addprice=0;
		$advanceadd=0;
                $assigneReviewingWriter=0;
                $addcompleteReview=0;

		$assignement =  Assignment::find($id);
                $studentPayment = DB::table('student_payment_records')->where('assignment_id',$id)->sum('amount');
                $writerPayment = DB::table('payment_records')->where('payment_type',1)->where('assignment_id',$id)->sum('amount');
                $rewriterPayment = DB::table('payment_records')->where('payment_type',2)->where('assignment_id',$id)->sum('amount');
                //return $writerPayment;
		$writer=$assignement->assignto;
                
		$user = DB::table('users')->join('role_users', 'role_users.user_id', '=', 'users.id')->where('role_users.role_id','9')->where('status','1')->orderBy('username', 'ASC')->lists('users.username','users.id');		
		$user_re = DB::table('users')->join('role_users', 'role_users.user_id', '=', 'users.id')->where('role_users.role_id','9')->where('status','1')->where('users.id','!=',$writer)->orderBy('username', 'ASC')->lists('users.username','users.id');
			
		
                $permissionsadminAttachment = Permission::whereIn('name', ['assignment.admin.attachment'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissionsadminAttachment)) {
			$adminAttachment=1;
		}

		$permissionswriterAttachment = Permission::whereIn('name', ['writer.attachment'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissionswriterAttachment)) {
			$writerAttachment=1;
		}

		$permissionsassigneWriter = Permission::whereIn('name', ['writer.allocate'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissionsassigneWriter)) {
			$assigneWriter=1;
		}
                
                $permissionsReviewingWriterWriter = Permission::whereIn('name', ['review.writer.allocate'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissionsReviewingWriterWriter)) {
			$assigneReviewingWriter=1;
		}

                $permissionsReviewingAdd = Permission::whereIn('name', ['review.add'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissionsReviewingAdd)) {
			$addcompleteReview=1;
		}

                
		$permissionsadminDiscripton = Permission::whereIn('name', ['assignment.description'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissionsadminDiscripton)) {
			$adminDiscripton=1;
		}

		$permissionsaddcomplete = Permission::whereIn('name', ['add.complete'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissionsaddcomplete)) {
			$addcomplete=1;
		}

		$priceaddcomplete = Permission::whereIn('name', ['price.add'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($priceaddcomplete)) {
			$addprice=1;
		}

		$advanceaddcomplete = Permission::whereIn('name', ['advance.add'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($advanceaddcomplete)) {
			$advanceadd=1;
		}
                
                
                $comment = DB::table('review_history')->where('assignment','=', $id)->join('users', 'review_history.addedby', '=', 'users.id')->get();
                
               //return $assignement;
		if($assignement){
			return view('Assignment::edit')->with([
				'userList' => $user,
				'assignment'=> $assignement,
				'adminAttachment'=>$adminAttachment,
				'writerAttachment'=>$writerAttachment,
				'assigneWriter'=>$assigneWriter,
				'reWriter'=>$user_re,
				'adminDiscripton'=>$adminDiscripton,
				'addcomplete'=>$addcomplete,
				'addprice'=>$addprice,
				'advanceadd'=>$advanceadd,
                                'reviewWriter'=>$assigneReviewingWriter,
                                'addreview'=>$addcompleteReview,
                                'comment'=>$comment,
                                'clientPayment'=>$studentPayment,
                                'writerPayment'=>$writerPayment,
                                'rewriterPayment'=>$rewriterPayment,
				'roll'=>Sentinel::getUser()
			]);
		}else{
			return view('errors.404');
		}

	}
        
        
        /**
	 * Show the Document type edit screen to the user.
	 *
	 * @return Response
	 */
	public function paymnetView($id)
	{
		
		$assignement =  Assignment::find($id);
		$writer=$assignement->assignto;
                $assignementId=$assignement->id;
                
		$user = DB::table('users')->where('id','=', $writer)->get(); 
                    if(sizeof($user) > 0){
                        $user=$user;
                    }
                    else{
                        $user=array();
                    }
                
                $writer_payment = DB::table('payment_records')->join('users', 'users.id', '=', 'payment_records.pay_to')->where('payment_records.assignment_id','=',$assignementId)->where('users.id','=',$writer)->get();
                    if(sizeof($writer_payment) > 0){
                        $writer_payment=$writer_payment;
                    }
                    else{
                        $writer_payment=array();
                    }
                        
		$user_re = DB::table('users')->join('role_users', 'role_users.user_id', '=', 'users.id')->where('role_users.role_id','9')->where('status','1')->where('users.id','=',$writer)->orderBy('username', 'ASC')->lists('users.username','users.id');
		
                $user_review_writers = DB::table('users')->join('review_writers', 'review_writers.writer_id', '=', 'users.id')->join('role_users', 'role_users.user_id', '=', 'users.id')->where('review_writers.assigmnet_id','=',$assignementId)->lists('users.username','users.id');
                
		
                $comment = DB::table('review_history')->where('assignment','=', $id)->join('users', 'review_history.addedby', '=', 'users.id')->get();
                
               //return $assignement;
		if($assignement){
			return view('Assignment::payment')->with([
				'userList' => $user,
				'assignment'=> $assignement,
				'reWriter'=>$user_re,
                                'reWriterList'=>$user_review_writers,
                                'writerPayment'=>$writer_payment,
				'roll'=>Sentinel::getUser()
			]);
		}else{
			return view('errors.404');
		}

	}
        
        	public function paymnetWriterView($id)
	{
		
		$assignement =  Assignment::find($id);
		$writer=$assignement->assignto;
                $assignementId=$assignement->id;
                
		$user = DB::table('users')->where('id','=', $writer)->get(); 
                    if(sizeof($user) > 0){
                        $user=$user;
                    }
                    else{
                        $user=array();
                    }
                
                $writer_payment = DB::table('payment_records')->join('users', 'users.id', '=', 'payment_records.pay_to')->where('payment_records.assignment_id','=',$assignementId)->where('users.id','=',$writer)->get();
                    if(sizeof($writer_payment) > 0){
                        $writer_payment=$writer_payment;
                    }
                    else{
                        $writer_payment=array();
                    }
                        
		$user_re = DB::table('users')->join('role_users', 'role_users.user_id', '=', 'users.id')->where('role_users.role_id','9')->where('status','1')->where('users.id','=',$writer)->orderBy('username', 'ASC')->lists('users.username','users.id');
		
                $user_review_writers = DB::table('users')->join('review_writers', 'review_writers.writer_id', '=', 'users.id')->join('role_users', 'role_users.user_id', '=', 'users.id')->where('review_writers.assigmnet_id','=',$assignementId)->lists('users.username','users.id');
                
		
                $comment = DB::table('review_history')->where('assignment','=', $id)->join('users', 'review_history.addedby', '=', 'users.id')->get();
                
               //return $assignement;
		if($assignement){
			return view('Assignment::paymentWriter')->with([
				'userList' => $user,
				'assignment'=> $assignement,
				'reWriter'=>$user_re,
                                'reWriterList'=>$user_review_writers,
                                'writerPayment'=>$writer_payment,
				'roll'=>Sentinel::getUser()
			]);
		}else{
			return view('errors.404');
		}

	}
        
        public function reviewwriter(AssignmentRequest $request)
        {
                $user=Sentinel::getUser();
                $id=$request->id;
                $assignment = Assignment::find($id);
                if($assignment){
                
		$assignment->checking_writer = $request->writer;
		$assignment->checking_allocated_date = date('Y-m-d H:i:s');
                $assignment->chekingDeadLine  = $request->date;
                $assignment->checking_status  = 4;	
                $assignment->save();
                
                        $revieve = DB::table('review_writers')->where('writer_id', '=', $request->writer)->where('assigmnet_id', '=', $id)->get();  
                        if(sizeof($revieve) ==0){
                            DB::table('review_writers')->insert(
                                            ['assigmnet_id' => $id , 'writer_id' => $request->writer,'added_date'=> date('Y-m-d'),'created_at'=>date('Y-m-d H:i:s')]
                            );
                        }
                
//                
                if($request->checking_discription !='' && $request->checking_discription !=' <br>'){
                        $assignment->checking_comment= $request->checking_discription;
                        $assignment->checking_date = date('Y-m-d H:i:s');
                        $assignment->checking_status  = 4;                        
                        DB::table('review_history')->insert(
                                ['assignment' => $id , 'addedby' => $user->id,'add_date'=> date('Y-m-d'),'created_at'=>date('Y-m-d H:i:s'),'comment'=>$request->checking_discription ]
                        );
                        
		}
                
                
		
			$writers=User::find($request->writer);			
			$msge="Hi ,%0aYou have assigned for a new project for review %0aJob number : ". $id."%0aSubject : ". $assignment->topic."%0aDeadline : ". $assignment->writerDeadLine." %0aWords # : ".$assignment->wordcount;
			$msgemail="Hi ,<br> You have assigned for review a new project <br> Job number : ". $id."<br> Subject : ". $assignment->topic."<br> Deadline : ". $assignment->writerDeadLine." <br> Words # : ".$assignment->wordcount;
			$data = 'username=myassignment.lk&password=Mypassword123&src=Essayasia&dst='.$writers->mobileNo.'&msg='.$msge.'&dr=1';
			$to=$writers->email;
			$subject='New assignment allocated for review. Ref - '.$id;
			
			$headers = "From:essayasia.com <no-reply@essayasia.com>"."\r\n";
			$headers .= 'Cc: auto.myassignment.lk@gmail.com' . "\r\n";
			$headers.= "MIME-Version: 1.0"."\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1"."\r\n";
			//mail($to,$subject,$msgemail,$headers);
			
			$message = "
                        <html>
                        <head>
                        <title>HTML email</title>
                        </head>
                        <body>
                            ".$msgemail."
                        </body>
                        </html>
                ";
				
			          $mail = new PHPMailer;
				    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
				    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Host = 'smtp.zoho.com';
                    $mail->Port = 465;         // Enable SMTP authentication
					$mail->Username = 'info@myassignment.lk';                 // SMTP username
					$mail->Password = 'Dumi@123#';
					$mail->setFrom('no-reply@essayasia.com', 'essayasia.com');
					$mail->addAddress($to, '');     // Add a recipient
					//$mail->AddAddress('kasun.kalya@gmail.com');
					$mail->addCC('auto.myassignment.lk@gmail.com');
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = $subject;
					$mail->Body    = $message;
					$mail->send();	
			
                                                          
                    return response()->json(['status' => 'success','link'=>$data]);
                }
                else{
                    return response()->json(['status' => 'invalid_id']);
		}
                             
        }
        public function addReview(AssignmentRequest $request)
        {
                //return $request->writer;
                $user=Sentinel::getUser();
                $id=$request->id;
                $assignment = Assignment::find($id);
                if($assignment){       
                    if($request->checking_discription !=''){
                            $assignment->checking_comment= $request->checking_discription;
                            $assignment->checking_date = date('Y-m-d H:i:s');
                            $assignment->checking_status  = 4;  
                            $assignment->save();
                            

                    }
                        $data='';                                
                        return response()->json(['status' => 'success','success.link'=>$data]);
                    }
                    else{
                        return response()->json(['status' => 'invalid_id']);
                    }
                             
        }
	/**
	 * Edit Document type data to database
	 *
	 * @return Redirect to menu add
	 */
	public function edit(AssignmentRequest $request, $id)
	{
             $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

            // generate a pin based on 2 * 7 digits + a random character
            $pin = mt_rand(1000000, 9999999)
                . mt_rand(1000000, 9999999)
                . $characters[rand(0, strlen($characters) - 1)];

            // shuffle the result
            $string = str_shuffle($pin);
            
		$data=0;
                $user=Sentinel::getUser();
		$assignment = Assignment::find($id);
                if(isset($request->add_reject_review)){
                            $assignment->checking_comment= $request->get('checking_discription');
                            $assignment->checking_date = date('Y-m-d H:i:s');
                            $assignment->checking_status  = 2;  
                            $assignment->save();
                    
                            DB::table('review_history')->insert(
                                    ['assignment' => $id , 'addedby' => $user->id,'add_date'=> date('Y-m-d'),'created_at'=>date('Y-m-d H:i:s'),'comment'=>$request->get('checking_discription') ]
                            );
                            return redirect('assignment/edit/'.$id)->with(['success' => true,
				'success.message' => 'Review rejected successfully',
				'success.title' => 'Well Done!','success.link'=>'']);
                            
                            
                
                }
                elseif(isset($request->add_complete_review)){
                            $assignment->checking_comment= $request->get('checking_discription');
                            $assignment->checking_date = date('Y-m-d H:i:s');
                            $assignment->checking_status  = 3;  
                            $assignment->save();
                    
                            DB::table('review_history')->insert(
                                    ['assignment' => $id , 'addedby' => $user->id,'add_date'=> date('Y-m-d'),'created_at'=>date('Y-m-d H:i:s'),'comment'=>$request->get('checking_discription') ]
                            );
                            return redirect('assignment/edit/'.$id)->with(['success' => true,
				'success.message' => 'Review Added Sucessfully',
				'success.title' => 'Well Done!','success.link'=>'']);
                            
                
                }
                else{                    
               
                
                    $permissions = Permission::whereIn('name', ['writer.allocate'])->where('status', '=', 1)->lists('name');
                    if (Sentinel::hasAnyAccess($permissions)&& $request->get('writer') !='') {
                            $assignment->assignto = $request->get('writer');
                            $assignment->writer_reject = 0;
                            $assignment->assignDate = date('Y-m-d H:i:s');

                    }                
                    if($request->get('deadline') !=''){
                            $assignment->writerDeadLine= $request->get('deadline');
                    }

                    $permissionsdescription = Permission::whereIn('name', ['assignment.description'])->where('status', '=', 1)->lists('name');
                    if (Sentinel::hasAnyAccess($permissionsdescription)) {
                            $assignment->adminDiscrption = $request->get('discription');
                    }


                    $permissionsadminattachment = Permission::whereIn('name', ['assignment.admin.attachment'])->where('status', '=', 1)->lists('name');
                    if (Sentinel::hasAnyAccess($permissionsadminattachment)) {
                            $adminAttachment=$request->file('adminAttachment');
                            if($adminAttachment !=""){
                                    $destinationPath = 'attachments/'.$id;
                                    $filename = $adminAttachment->getClientOriginalName();
                                    $upload_success = $adminAttachment->move($destinationPath, 'admin_'.$string.'_'.$filename);
                                    $assignment->adminAttachment = 'admin_'.$string.'_'.$filename;
                            }

                    }
                    $permissionswriterattachment = Permission::whereIn('name', ['writer.attachment'])->where('status', '=', 1)->lists('name');
                    if (Sentinel::hasAnyAccess($permissionswriterattachment)) {
                            $writerAttachment=$request->file('writerAttachment');
                            if($writerAttachment !=""){
                                    $destinationPath = 'attachments/'.$id;
                                    $writerfilename = $writerAttachment->getClientOriginalName();
                                    $extension = $writerAttachment->getClientOriginalExtension();
                                    $writerfilename='writer_final_'.$id.'.'.$extension;
                                    $upload_success = $writerAttachment->move($destinationPath, 'atachmnet_'.$writerfilename);
                                    $assignment->writerAttachment = 'atachmnet_'.$writerfilename;
                            }
                            $writerImage=$request->file('writerImage');
                            if($writerImage !=""){
                                    $destinationPath = 'attachments/'.$id;
                                    $writerImagefilename = $writerImage->getClientOriginalName();
                                    $extension = $writerImage->getClientOriginalExtension();
                                    $writerImagefilename='writer_'.$id.'.'.$extension;
                                    $upload_success = $writerImage->move($destinationPath, 'image_'.$writerImagefilename);
                                    $assignment->writerImages = 'image_'.$writerImagefilename;
                            }
                    }

                    $priceaddcomplete = Permission::whereIn('name', ['price.add'])->where('status', '=', 1)->lists('name');
                    if (Sentinel::hasAnyAccess($priceaddcomplete)) {
                            $assignment->price = $request->get('price');
                    }

                    $advanceaddcomplete = Permission::whereIn('name', ['advance.add'])->where('status', '=', 1)->lists('name');
                    if (Sentinel::hasAnyAccess($advanceaddcomplete)) {
                            $assignment->advance = $request->get('advance');
                            $assignment->advanceDate = $request->get('paydate');
                    }

                    $assignment->progress = $request->get('progress');
                    if($request->get('progress')==100){
                            $assignment->status = 4;
                    }

                    $assignment->save();
                }
                
		$assignment = Assignment::find($id);
		$domain=$assignment ->domain;
		if($domain !='LK'){
					$curency='USD';
					$url='myassignment.com.au';
				}
				else{
					$curency='LKR';
					$url='myassignment.lk';
				}

		if($request->get('progress')==100){
			$adminuser=DB::table('users')->join('role_users', 'role_users.user_id', '=', 'users.id')->where('role_users.role_id','8')->get();
			//return $adminuser;
			foreach ($adminuser as $admin) {
				$writers=DB::table('assignment_request')->join('users', 'users.id', '=', 'assignment_request.assignto')->where('assignment_request.id',$id)->get();
				
				$msge = "Assignment completed by ".$writers[0]->first_name." ".$writers[0]->last_name."%0a Ref- " . $id;
				$data = 'username=myassignment.lk&password=Mypassword123&src=Essayasia&dst='. $admin->mobileNo.'&msg='.$msge.'&dr=1';
				$to = $admin->email;
				$subject = 'Assignment completed '.$id;
				
				$headers = "From:".$url."<".$url.">"."\r\n";
				$headers .= 'Cc: auto.myassignment.lk@gmail.com' . "\r\n";
				$headers.= "MIME-Version: 1.0"."\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1"."\r\n";
				
				//mail($to,$subject,$msge,$headers);
				$message = "
                        <html>
                        <head>
                        <title>HTML email</title>
                        </head>
                        <body>
                            ".$msge."
                        </body>
                        </html>
                ";
				
				          $mail = new PHPMailer;
				    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
				    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Host = 'smtp.zoho.com';
                    $mail->Port = 465;         // Enable SMTP authentication
					$mail->Username = 'info@myassignment.lk';                 // SMTP username
					$mail->Password = 'Dumi@123#';
					$mail->setFrom('no-reply@myassignment.com', 'myassignment.lk');
					$mail->addAddress($to, '');     // Add a recipient
					//$mail->AddAddress('kasun.kalya@gmail.com');
					$mail->addCC('auto.myassignment.lk@gmail.com');
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = $subject;
					$mail->Body    = $message;
					$mail->send();
				
				
			
				
				
				
			}


		}
		
		if($request->get('sdeadline') != $assignment->deadline ){                   
                    DB::table('assignment_request')->where('id',$assignment->id)->update(['deadline' => ($request->get('sdeadline'))]
                            );
                    DB::table('deadlines_history')->insert(
                                    ['assignment_id' => $id , 'add_by' => $user->id,'created_at'=> date('Y-m-d H:i:s'),'original_deadline'=>$assignment->deadline,'new_deadline'=>$request->get('sdeadline')]
                            );
                }
                
        if($request->get('wordcount') != $assignment->wordcount ){                 
                    DB::table('assignment_request')->where('id',$assignment->id)->update(['wordcount' => ($request->get('wordcount'))]
                            );
                    DB::table('deadlines_history')->insert(
                                    ['assignment_id' => $id , 'add_by' => $user->id,'created_at'=> date('Y-m-d H:i:s'),'original_word_count'=>$assignment->wordcount,'updated_word_count'=>$request->get('wordcount')]
                            );
                }
		
		
		$permissions = Permission::whereIn('name', ['writer.allocate'])->where('status', '=', 1)->lists('name');
		if (Sentinel::hasAnyAccess($permissions) && $request->get('writer') !='') {

			$writers=User::find($request->get('writer'));			
			$msge="Hi ,%0aYou have assigned for a new project %0aJob number : ". $id."%0aSubject : ". $assignment->topic."%0aDeadline : ". $assignment->writerDeadLine." %0aWords # : ".$assignment->wordcount;
			
                        $msgemail="Hi ,<br> You have assigned for a new project <br> Job number : ". $id."<br> Subject : ". $assignment->topic."<br> Deadline : ". $assignment->writerDeadLine." <br> Words # : ".$assignment->wordcount;
			
                        $data = 'username=myassignment.lk&password=Mypassword123&src=Essayasia&dst='.$writers->mobileNo.'&msg='.$msge.'&dr=1';
			$to=$writers->email;
			$subject='New assignment allocated for you. Ref - '.$id;
			
			$headers = "From:essayasia.com <no-reply@essayasia.com>"."\r\n";
			$headers .= 'Cc: auto.myassignment.lk@gmail.com' . "\r\n";
			$headers.= "MIME-Version: 1.0"."\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1"."\r\n";
			//mail($to,$subject,$msgemail,$headers);
			$message = "
                        <html>
                        <head>
                        <title>HTML email</title>
                        </head>
                        <body>
                            ".$msgemail."
                        </body>
                        </html>
                ";
			
			          $mail = new PHPMailer;
				    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
				    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Host = 'smtp.zoho.com';
                    $mail->Port = 465;         // Enable SMTP authentication
					$mail->Username = 'info@myassignment.lk';                 // SMTP username
					$mail->Password = 'Dumi@123#';
					$mail->setFrom('no-reply@essayasia.com', 'essayasia.com');
					$mail->addAddress($to, '');     // Add a recipient
					//$mail->AddAddress('kasun.kalya@gmail.com');
					$mail->addCC('auto.myassignment.lk@gmail.com');
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = $subject;
					$mail->Body    = $message;
					$mail->send();
			
			
//StudentSMS
                        $msgestudent='Your assignment assign to writer';
                        $msgstudentemail=  $msgestudent='Your assignment assign to writer';
                        if($assignment->domain !='Sri Lanka'){
                            $currency='USD';
                        }
                        else{
                            $currency='LKR';
                        } 
                        $currency='LKR';
                        $balance=$assignment->price - $assignment->advance;
                        $msgstudentemail='<div style="font-family: Open Sans,sans-serif; font-size: 13px; margin-top: 30px;"><img src="https://myassignment.lk/wp-content/uploads/2018/07/logo1_87f4a366c126e4ccd9cd52765812b09b.png" alt="myassignment.lk logo" width="300" height="41" /></div>
<div style="font-family: Open Sans,sans-serif; font-size: 13px; margin-top: 30px;"><span style="color: #000000;">Dear '.$assignment->studentName.' </span> <br /> <br />
<table>
<tbody>
<tr>
<td style="font-family: Open Sans,sans-serif; margin: 0px;" valign="top"><span style="font-size: 13px;"> Thanks for your payment of LKR '.$currency.' '.$assignment->advance.' to myassignment.lk&nbsp;Billing. </span></td>
</tr>
</tbody>
</table>
<div style="color: #333333!important; margin-top: 20px;"><hr style="color: #999a99;" size="1" /></div>
<table style="clear: both; color: #000000; font-size: 11px; margin-bottom: 20px; width: 100%;" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="font-family: Open Sans,sans-serif; margin: 0px; padding-top: 15px;" align="left" valign="top" width="280"><span style="font-size: 12px; line-height: 16px;"><span style="color: #000000; font-weight: bold;"> Billing Details</span><br /> '.$assignment->studentName.'&nbsp;<br />'.$assignment->level.'<br />'.$assignment->phoneNo.'<br /><br /> </span></td>
<td style="font-family: Open Sans,sans-serif; margin: 0px; padding-top: 15px;" valign="top" width="280"><span style="color: #000000; font-size: 12px; font-weight: bold; line-height: 16px;"> Order No</span><br /><span style="font-size: 12px;">'.$assignment->id.'<br /><strong>Requested Date&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;'.$assignment->deadline.'</strong></span></td>
</tr>
<tr>
<td style="font-family: arial,sans-serif; margin: 0px; padding-top: 15px;" align="left" valign="top" width="50%">&nbsp;</td>
<td style="font-family: arial,sans-serif; margin: 0px; padding-top: 15px;" valign="top" width="50%">&nbsp;</td>
</tr>
</tbody>
</table>
<table style="clear: both; color: #666666!important; font-size: 11px; width: 100%;" border="0" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="border-bottom-color: #cccccc; border-bottom-width: 1px; border-style: solid none; border-top-color: #cccccc; border-top-width: 1px; color: #333333!important; font-family: Open Sans,sans-serif; margin: 0px; padding: 5px 10px!important;" align="left" width="350">Description</td>
<td style="border-bottom-color: #cccccc; border-bottom-width: 1px; border-style: solid none; border-top-color: #cccccc; border-top-width: 1px; color: #333333!important; font-family: Open Sans,sans-serif; margin: 0px; padding: 5px 10px!important;" align="right" width="100">Words Count</td>
<td style="border-bottom-color: #cccccc; border-bottom-width: 1px; border-style: solid none; border-top-color: #cccccc; border-top-width: 1px; color: #333333!important; font-family:Open Sans,sans-serif; margin: 0px; padding: 5px 10px!important;" align="right" width="80">Amount</td>
</tr>
<tr>
<td style="font-family: Open San,sans-serif; margin: 0px; padding: 10px;" align="left">'.$assignment->topic.'</td>
<td style="font-family: Open Sans,sans-serif; margin: 0px; padding: 10px;" align="right">'.$assignment->wordcount.'</td>
<td style="font-family: Open Sans,sans-serif; margin: 0px; padding: 10px;" align="right">'.$currency.' '.$assignment->price.'</td>
</tr>
</tbody>
</table>
<table style="border-bottom-color: #cccccc; border-bottom-style: solid; border-bottom-width: 1px; border-top-color: #cccccc; border-top-style: solid; border-top-width: 1px; clear: both; color: #666666!important; font-size: 11px; width: 595px;" border="0" cellspacing="0" cellpadding="0" align="left">
<tbody>
<tr>
<td style="font-family: arial,sans-serif; margin: 0px;">
<table style="clear: both; font-family: arial,helvetica,sans-serif; margin-top: 20px; width: 595px;" border="0" cellspacing="0" cellpadding="0" align="right">
<tbody>
<tr>
<td style="font-family: Open Sans,sans-serif; margin: 0px; padding: 0px 10px 0px 0px; text-align: right; width: 390px;" height="20"><span style="font-size: 11px;">Subtotal</span></td>
<td style="font-family: Open Sans,sans-serif; margin: 0px; padding: 0px 5px 0px 0px; text-align: right; width: 90px;"><span style="color: #666666; font-size: 11px;">'.$currency.' '.$assignment->price.'</span></td>
</tr>
<tr>
<td style="margin: 0px; padding: 0px 10px 0px 0px; text-align: right; width: 390px;" height="20"><span style="font-size: 11px;">Advance Paid</span></td>
<td style="font-family: Open Sans,sans-serif; margin: 0px; padding: 0px 5px 0px 0px; text-align: right; width: 90px;"><span style="color: #666666; font-size: 11px;">'.$currency.' '.$assignment->advance.'</span></td>
</tr>
<tr>
<td style="font-family: Open Sans,sans-serif; margin: 0px; padding: 20px 10px 0px 0px; text-align: right; width: 390px;"><strong>Due Amount</strong></td>
<td style="font-family: Open Sans,sans-serif; margin: 0px; padding: 20px 5px 0px 0px; text-align: right; width: 90px;"><span style="color: #666666; font-size: 11px;">'.$currency.' '.$balance.'</span></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="color: #757575; font-family: Open Sans,sans-serif; margin: 0px; padding-bottom: 20px; padding-top: 5px; padding-left: 10px;"><span style="padding-left: 10px; color: #747474;"><br /> Charge will appear on your statement as Myassignment.lk</span></td>
</tr>
</tbody>
</table>
<br /> <br /> <br /> <br /> <br /> <br />
<div style="font-family: Open Sans,sans-serif; font-size: 12px; line-height: 16px; margin-top: 35px;">&nbsp;</div>
<br /><br /> <span style="font-weight: 600; color: #000000; font-size: 12px; font-family: Open Sans,sans-serif; line-height: 16px;">For inquiries related to your order &amp; delivery</span><br /> <br />myassignment.lk Billing<br /> <a style="color: #1155cc;" href="https://www.myassignment.lk" target="_blank" rel="noopener" data-saferedirecturl="https://www.google.com/url?q=https://www.payhere.lk&amp;source=gmail&amp;ust=1563171688018000&amp;usg=AFQjCNH850ohBnkpUIFIwfi8wF2rjz0t6w">https://www.myassignment.lk</a><br /> 0115 815 808</div>
';
			
			
                        $datastudent = 'username=myassignment.lk&password=Mypassword123&src=MyAssign_LK&dst='.$assignment->phoneNo.'&msg='.$msgestudent.'&dr=1';
                        
                                $to = $assignment->email;
				$subject = 'Assignment assign to writer  '.$id;
                                $domain=$assignment ->domain;
                                if($domain !='LK'){
					$curency='USD';
					$url='myassignment.com.au';
				}
				else{
					$curency='LKR';
					$url='myassignment.lk';
				}
				
	
				
				$headers = "From:".$url."<".$url.">"."\r\n";
				$headers .= 'Cc: auto.myassignment.lk@gmail.com' . "\r\n";
				$headers.= "MIME-Version: 1.0"."\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1"."\r\n";
				
                //  mail($to,$subject,$msgstudentemail,$headers);
				  
				  	$message = "
                        <html>
                        <head>
                        <title>HTML email</title>
                        </head>
                        <body>
                            ".$msgstudentemail."
                        </body>
                        </html>
                ";
				  
				           $mail = new PHPMailer;
				    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
				    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Host = 'smtp.zoho.com';
                    $mail->Port = 465;         // Enable SMTP authentication
					$mail->Username = 'info@myassignment.lk';                 // SMTP username
					$mail->Password = 'Dumi@123#';
					$mail->setFrom('no-reply@myassignment.com', 'myassignment.lk');
					$mail->addAddress($to, '');     // Add a recipient
					//$mail->AddAddress('kasun.kalya@gmail.com');
					$mail->addCC('auto.myassignment.lk@gmail.com');
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = $subject;
					$mail->Body    = $message;
					$mail->send();
				  	
	    
                        
                        
                        return redirect('assignment/edit/'.$id)->with(['success_add' => true,
				'success.message' => 'Did you received the advanced payment from the client?',
				'success.title' => 'Well Done!','success.link'=>$data,'success.studentlink'=>$datastudent]);
		}
		
		else {
			return redirect('assignment/edit/'.$id)->with(['success' => true,
				'success.message' => 'Request successfully Complete!',
				'success.title' => 'Well Done!','success.link'=>$data]);
		}


	}

	/**
	 * Delete a Document
	 * @param  Request $request Document id
	 * @return Json           	json object with status of success or failure
	 */
	public function delete(Request $request)
	{

		if($request->ajax()){
			$id = $request->input('id');

			$document = Assignment::find($id);
		
			
				
					if($document){
			
                                
                                $msge="Your assignment reject by admin ";
                                $data = 'username=myassignment.lk&password=Mypassword123&src=MyAssign_LK&dst='.$document->phoneNo.'&msg='.$msge.'&dr=1';
                                $msgemail="Hi ,<br> Your assignment reject by admin<br> Job number : ". $id."<br> Subject : ". $document->topic."<br> Deadline : ". $document->writerDeadLine." <br> Words # : ".$document->wordcount;
                                $to = $document->email;
				$subject = 'Assignment rejected '.$id;
                                $domain=$document ->domain;
                                if($domain !='LK'){
					$curency='USD';
					$url='myassignment.com.au';
				}
				else{
					$curency='LKR';
					$url='myassignment.lk';
				}
				
				$headers = "From:".$url."<".$url.">"."\r\n";
				$headers .= 'Cc: auto.myassignment.lk@gmail.com' . "\r\n";
				$headers.= "MIME-Version: 1.0"."\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1"."\r\n";
				
				mail($to,$subject,$msge,$headers);
				$message = "
                        <html>
                        <head>
                        <title>HTML email</title>
                        </head>
                        <body>
                            ".$msge."
                        </body>
                        </html>
                ";
				          $mail = new PHPMailer;
				    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
				    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Host = 'smtp.zoho.com';
                    $mail->Port = 465;         // Enable SMTP authentication
					$mail->Username = 'info@myassignment.lk';                 // SMTP username
					$mail->Password = 'Dumi@123#';
					$mail->setFrom('no-reply@myassignment.com', 'myassignment.lk');
					$mail->addAddress($to, '');     // Add a recipient
					//$mail->AddAddress('kasun.kalya@gmail.com');
					$mail->addCC('auto.myassignment.lk@gmail.com');
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = $subject;
					$mail->Body    = $message;
					$mail->send();
				
				
				
				
				$document->delete();
                                $document->deleted_at = date('Y-m-d H:i:s');
				$document->save();                
                                
                                
				return response()->json(['status' => 'success','link'=>$data]);
			}else{
				return response()->json(['status' => 'invalid_id']);
			}
		}else{
			return response()->json(['status' => 'not_ajax']);
		}

	}

	public function smsSend(Request $request)
	{
	    

		$id = $request->input('id');
		$userdata=Assignment::find($id);
		
		$domain=$userdata->domain;
				if($domain!='LK'){
					$curency='USD';
					$url='myassignment.com.au';
				}
				else{
					$curency='LKR';
					$url='myassignment.lk';
				}
		
		
	if($userdata->advance =='' || $userdata->advance =='0'){
		$payType='Not paid';
	}else{
		$payType='Advance Paid';
	}

		$msge="Invoice - ".$url."%0a Name: ".$userdata->studentName."%0a Order# :".$id."%0a Deadline: ".$userdata->deadline."%0a Words # : ".$userdata->wordcount."%0a Order total:".$curency." ".$userdata->price."%0a Advance : ".$curency." ".($userdata->price / 100)*50 ."%0a Bank details : http://".$url."/payments/";
		$data = 'username=myassignment.lk&password=Mypassword123&src=MyAssign_LK&dst='.$userdata->phoneNo.'&msg='.$msge.'&dr=1';
		$to=$userdata->email;
		
		
		
		$emailmsg='<html><body><div id=":23c" class="a3s aXjCH m16340a5f8e6a314c">
					<div class="adM"></div>
					<div>
					<div class="adM"></div>
					<table cellpadding="0" cellspacing="0" align="center" width="610" style="border-collapse: collapse;">
					<tbody>
					<tr style="height: 67px;">
					<td align="left" valign="top" colspan="2" style="height: 67px;">
					<table cellpadding="7" cellspacing="0" width="610" style="background: #ffffff;">
					<tbody>
					<tr>
					<td align="left" valign="middle" width="400">
					<table cellpadding="1" cellspacing="0" width="401">
					<tbody>
					<tr>
					<td width="400" align="left" valign="middle"><img src="https://'.$url.'/resources/images/imgs/logo.png" alt="" width="300" height="41" /></td>
					</tr>
					<tr>
					<td align="left" valign="middle"><span style="color: #000000; font-size: 11px; font-weight: normal; font-family: Arial,Helvetica,sans-serif;"> Professional Writing Service from Sri Lanka</span></td>
					</tr>
					</tbody>
					</table>
					</td>
					<td align="left" valign="top" width="210">
					<table cellpadding="0" cellspacing="0" width="210">
					<tbody>
					<tr>
					<td height="5" colspan="2">
					<div style="line-height: 0;"><span width="20" height="5" alt=""></span></div>
					</td>
					</tr>
					<tr>
					<td align="center" valign="bottom">
					<table cellpadding="0" cellspacing="0" width="210">
					<tbody>
					<tr>
					<td align="right" valign="middle"><span style="color: #000; font-size: 12px; font-weight: bold; font-family: Arial,Helvetica,sans-serif;"> </span></td>
					</tr>
					<tr>
<td align="right" valign="middle"><span style="color: #000; font-size: 14px; font-weight: bold; font-family: Arial,Helvetica,sans-serif;">W/CC/11400</span></td>
					</tr>
					<tr>
					<td height="10" colspan="2">
					<div style="line-height: 0;"><span width="20" height="10" alt=""></span></div>
					</td>
					</tr>
					<tr></tr>
					</tbody>
					</table>
					</td>
					</tr>
					</tbody>
					</table>
					</td>
					</tr>
					</tbody>
					</table>
					</td>
					<td style="height: 67px;"></td>
					<td style="height: 67px;"></td>
					</tr>
					<tr style="height: 10px;">
					<td height="10" colspan="2" style="height: 10px;">
					<div style="line-height: 0;"><span width="20" height="10" alt=""></span></div>
					</td>
					<td style="height: 10px;"></td>
					<td style="height: 10px;"></td>
					</tr>
					<tr style="height: 10px;">
					<td height="10" colspan="2" style="background: #4184c1; height: 10px;">
					<div style="line-height: 0;"><span width="20" height="10" alt=""></span></div>
					</td>
					<td style="height: 10px;"></td>
					<td style="height: 10px;"></td>
					</tr>
					<tr style="height: 35px;">
					<td align="center" colspan="2" style="background: #4184c1; height: 35px;"><span style="color: #fff; font-size: 24px; font-weight: normal; font-family: Arial,Helvetica,sans-serif;">Dear '.$userdata->studentName.'!</span></td>
					<td style="height: 35px;"></td>
					<td style="height: 35px;"></td>
					</tr>
					<tr style="height: 23px;">
					<td align="center" colspan="2" style="background: #4184c1; height: 23px;"><span style="color: #ffffff; font-size: 16px; font-weight: normal; font-family: Arial,Helvetica,sans-serif;">Thank you for your interest in our services. Please check the order details below:</span></td>
					<td style="height: 23px;"></td>
					<td style="height: 23px;"></td>
					</tr>
					<tr style="height: 10px;">
					<td height="10" colspan="2" style="background: #4184c1; height: 10px;">
					<div style="line-height: 0;"><span width="20" height="10" alt=""></span></div>
					</td>
					<td style="height: 10px;"></td>
					<td style="height: 10px;"></td>
					</tr>
					<tr style="height: 30px;">
					<td height="30" colspan="2" style="background: #f3f3f3; height: 30px;">
					<div style="line-height: 0;"><span width="30" height="30" alt=""></span></div>
					</td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					</tr>
					<tr style="height: 172px;">
					<td align="center" colspan="2" style="background: #f3f3f3; height: 172px;">
					<table cellpadding="3" cellspacing="5" width="455" style="height: 170px;">
					<tbody>
					<tr style="height: 23px;">
					<td align="right" valign="middle" width="109" style="width: 152px; height: 23px;"><span style="color: #333333; font-size: 14px; font-family: Arial,Helvetica,sans-serif;">Order #:</span></td>
					<td width="64" align="left" valign="middle" style="width: 102px; height: 23px;"><span style="color: #333333; font-weight: bold; font-size: 16px; font-family: Arial,Helvetica,sans-serif;">'.$userdata->id.'</span></td>
					<td width="142" align="left" valign="middle" style="width: 200px; height: 23px;"><span style="text-decoration: none; color: #32329e; font-size: 14px; border: 0;"></span></td>
					</tr>
					<tr style="height: 21px;">
					<td width="109" align="right" valign="middle" style="width: 152px; height: 21px;"><span style="color: #333333; font-size: 14px; font-family: Arial,Helvetica,sans-serif;">Type of document:</span></td>
					<td align="left" colspan="2" valign="middle" style="width: 302px; height: 21px;"><span style="color: #333333; font-size: 14px; font-family: Arial,Helvetica,sans-serif;">'.$userdata->type.'</span></td>
					</tr>
					<tr style="height: 21px;">
					<td width="109" align="right" valign="middle" style="width: 152px; height: 21px;"><span style="color: #333333; font-size: 14px; font-family: Arial,Helvetica,sans-serif;">Topic:</span></td>
					<td align="left" colspan="2" valign="middle" style="width: 302px; height: 21px;"><span style="color: #333333; font-size: 14px; font-family: Arial,Helvetica,sans-serif;">'.$userdata->topic.'</span></td>
					</tr>
					<tr style="height: 21px;">
					<td width="109" align="right" valign="middle" style="width: 152px; height: 21px;"><span style="color: #333333; font-size: 14px; font-family: Arial,Helvetica,sans-serif;">Deadline:</span></td>
					<td align="left" colspan="2" valign="middle" style="width: 302px; height: 21px;"><span style="color: #333333; font-size: 14px; font-family: Arial,Helvetica,sans-serif;"><span class="aBn" data-term="goog_1850746344" tabindex="0"><span class="aQJ">'.$userdata->deadline.'</span></span></span></td>
					</tr>
					<tr style="height: 21px;">
					<td width="109" align="right" valign="middle" style="width: 152px; height: 21px;"><span style="color: #333333; font-size: 14px; font-family: Arial,Helvetica,sans-serif;">Order total:</span></td>
					<td align="left" colspan="2" valign="middle" style="width: 302px; height: 21px;"><span style="color: #333333; font-size: 14px; font-family: Arial,Helvetica,sans-serif;">'.$curency.' '.$userdata->price.'</span></td>
					</tr>
					<tr style="height: 21px;">
					<td width="109" align="right" valign="middle" style="width: 152px; height: 21px;"><span style="color: #333333; font-size: 14px; font-family: Arial,Helvetica,sans-serif;">Order status:</span></td>
					<td align="left" valign="middle" style="width: 102px; height: 21px;"><span style="color: #333333; font-size: 14px; font-family: Arial,Helvetica,sans-serif;">'.$payType.'
					</span></td>
					</tr>
					<tr style="height: 21px;">
					<td width="109" align="right" valign="middle" style="width: 152px; height: 21px;"><span style="color: #333333; font-size: 14px; font-family: Arial,Helvetica,sans-serif;">Advance Payment:</span></td>
					<td align="left" valign="middle" style="width: 102px; height: 21px;"><span style="color: #333333; font-size: 14px; font-family: Arial,Helvetica,sans-serif;">'.$curency.' '.($userdata->price / 100)*50 .'</span></td>
					<td align="left" valign="middle" style="width: 200px; height: 21px;"></td>
					</tr>
                                        <tr style="height: 21px;">
					<td width="109" align="right" valign="middle" style="width: 152px; height: 21px;"><span style="color: #333333; font-size: 14px; font-family: Arial,Helvetica,sans-serif;">Office hours :</span></td>
					<td align="left" valign="middle" style="width: 102px; height: 21px;"><span style="color: #333333; font-size: 14px; font-family: Arial,Helvetica,sans-serif;">9am - 6pm ( Monday to Saturday)</span></td>
					<td align="left" valign="middle" style="width: 200px; height: 21px;"></td>
					</tr>
					<tr style="height: 21px;">
					<td width="109" align="right" valign="middle" style="width: 152px; height: 21px;"><span style="color: #333333; font-size: 14px; font-family: Arial,Helvetica,sans-serif;">Payment Method:</span><span style="color: #333333; font-size: 14px; font-family: Arial,Helvetica,sans-serif;"></span></td>
					<td align="left" valign="middle" style="width: 102px; height: 21px;">Bank Details</td>
					<td align="left" valign="middle" style="width: 200px; height: 21px;"><span style="background: #ee5b09; color: #ffffff; font-size: 12px; text-transform: uppercase; font-weight: bold; padding: 2px 10px; text-align: center; text-decoration: none; font-family: Arial,Helvetica,sans-serif;"><a href="https://'.$url.'/payments/" title="pay now" style="text-decoration: none; font-size: 12px; font-family: Arial,Helvetica,sans-serif; color: #ffffff; text-transform: uppercase; font-weight: bold;" target="_blank">Click Here</a></span></td>
					</tr>
					</tbody>
					</table>
					</td>
					<td style="height: 172px;"></td>
					<td style="height: 172px;"></td>
					</tr>
					<tr style="height: 30px;">
					<td height="30" colspan="2" style="background: #f3f3f3; height: 30px;">
					<div style="line-height: 0;"><span width="30" height="30" alt=""></span></div>
					</td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					</tr>
					<tr style="height: 26px;">
					<td colspan="2" align="center" style="height: 26px;"><span style="color:#FF9900; font-weight: bold; font-size: 15px; font-family: Arial,Helvetica,sans-serif;">Please email your payment slip to info@myassignment.lk</span></td>
					<td style="height: 26px;"></td>
					<td style="height: 26px;"></td>
					</tr>
					<tr style="height: 26px;">
					<td colspan="2" align="center" style="height: 26px;"><span style="color: #333333; font-weight: bold; font-size: 18px; font-family: Arial,Helvetica,sans-serif;">Additional Options</span></td>
					<td style="height: 26px;"></td>
					<td style="height: 26px;"></td>
					</tr>
					<tr style="height: 25px;">
					<td colspan="2" height="25" style="background: #ffffff; height: 25px;">
					<div style="line-height: 0;"><span width="30" height="25" alt=""></span></div>
					</td>
					<td style="height: 25px;"></td>
					<td style="height: 25px;"></td>
					</tr>
					<tr style="height: 94px;">
					<td align="center" colspan="2" style="height: 94px;">
					<table cellpadding="0" cellspacing="0" width="610">
					<tbody>
					<tr>
					<td align="left" valign="top" width="180" style="width: 187px;"><span style="color: #333333; font-size: 12px; font-weight: normal; font-family: Arial,Helvetica,sans-serif;">If the writer needs additional materials you can provide, you may email them to info@'.$url.'</span></td>
					<td width="20" style="width: 20px;">
					<div style="line-height: 0;"><span width="20" height="10" alt=""></span></div>
					</td>
					<td align="left" valign="top" width="180" style="width: 187px;"><span style="color: #333333; font-size: 12px; font-weight: normal; font-family: Arial,Helvetica,sans-serif;">If you need to change your order parameters, you may do the necessary changes, email them to info@'.$url.'</span></td>
					<td width="20" style="width: 20px;">
					<div style="line-height: 0;"><span width="20" height="10" alt=""></span></div>
					</td>
					<td align="left" valign="top" width="185" style="width: 195px;"><span style="color: #333333; font-size: 12px; font-weight: normal; font-family: Arial,Helvetica,sans-serif;">If you would like to check our sample assignments.</span></td>
					</tr>
					<tr>
					<td colspan="5" height="10" style="width: 609px;">
					<div style="line-height: 0;"><span width="20" height="10" alt=""></span></div>
					</td>
					</tr>
					<tr>
					<td align="left" valign="top" width="180" style="width: 187px;"><span style="background: #ee5b09; width: 180px; color: #ffffff; font-size: 14px; font-weight: bold; padding: 2px 40px; text-align: center; text-decoration: none; font-family: Arial,Helvetica,sans-serif;"><a href="mailto:info@'.$url.'" title="Upload files" style="text-decoration: none; font-size: 14px; font-family: Arial,Helvetica,sans-serif; color: #ffffff; font-weight: bold;" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://australianwritings.com/customer/order/82085624/instructions/?l%3D659b5bf1d3f8a3c4243806ed12a5b426dc43efa07f25419ac84730dbc27b1437%26utm_source%3Dnewsletter%26utm_medium%3Demail%26utm_campaign%3Dregemailfilesmain&amp;source=gmail&amp;ust=1526634811860000&amp;usg=AFQjCNE62MDinM0nNf_kTHopVljoFWNrbA" rel="noopener">Upload files</a></span></td>
					<td width="20" style="width: 20px;">
					<div style="line-height: 0;"><span width="20" height="10" alt=""></span></div>
					</td>
					<td align="left" valign="top" width="180" style="width: 187px;"><span style="background: #ee5b09; color: #ffffff; font-size: 14px; font-weight: bold; padding: 2px 14px; text-align: center; text-decoration: none; font-family: Arial,Helvetica,sans-serif;"><a href="mailto:info@'.$url.'" title="Change order details" style="text-decoration: none; font-size: 14px; font-family: Arial,Helvetica,sans-serif; color: #ffffff; font-weight: bold;" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://australianwritings.com/order/resubmit/82085624/?l%3Deccd81e048f7f7e8fec98e3afffd1d6df1efef73eadfb5bf5705f240bc0c8d79%26utm_source%3Dnewsletter%26utm_medium%3Demail%26utm_campaign%3Dregemailresubmitmain&amp;source=gmail&amp;ust=1526634811860000&amp;usg=AFQjCNG8aMBoyNEWRy-6HKCvUbcisESC9A" rel="noopener">Change order details</a></span></td>
					<td width="20" style="width: 20px;">
					<div style="line-height: 0;"><span width="20" height="10" alt=""></span></div>
					</td>
					<td align="left" valign="top" width="185" style="width: 195px;"><span style="background: #ee5b09; color: #ffffff; font-size: 14px; font-weight: bold; padding: 2px 14px; text-align: center; text-decoration: none; font-family: Arial,Helvetica,sans-serif;"><a href="https://'.$url.'/blog/" title="Message my writer" style="text-decoration: none; font-size: 14px; font-family: Arial,Helvetica,sans-serif; color: #ffffff; font-weight: bold;" target="_blank" usg=AFQjCNEQiwXfj23VonqIzDoA4-M0Khqw3g" rel="noopener">Liabrary</a></span></td>
					</tr>
					</tbody>
					</table>
					</td>
					<td style="height: 94px;"></td>
					<td style="height: 94px;"></td>
					</tr>
					<tr style="height: 20px;">
					<td colspan="2" height="20" style="border-bottom: 1px solid #eaeaea; height: 20px;">
					<div style="line-height: 0;"><span width="30" height="20" alt=""></span></div>
					</td>
					<td style="height: 20px;"></td>
					<td style="height: 20px;"></td>
					</tr>
					<tr style="height: 20px;">
					<td colspan="2" height="17" style="height: 20px;">
					<div style="line-height: 0;"><span width="30" height="17" alt=""></span></div>
					</td>
					<td colspan="2" height="20" style="background: #ffffff; height: 20px;">
					<div style="line-height: 0;"><span width="30" height="20" alt=""></span></div>
					</td>
					</tr>
					<tr style="height: 41px;">
					<td align="center" colspan="2" style="height: 41px;"><span style="color: #888888; font-size: 11px; font-family: Arial,Helvetica,sans-serif; font-style: italic;">You will receive important e-
					
					
					 notifications during different order stages. To ensure that status update e-mails go to your Inbox, please add our e-mail to contacts or <b>Mark as NOT SPAM</b></span></td>
					<td style="height: 41px;"></td>
					<td style="height: 41px;"></td>
					</tr>
					<tr style="height: 30px;">
					<td height="30" colspan="2" style="height: 30px;">
					<div style="line-height: 0;"><span width="30" height="30" alt=""></span></div>
					</td>
					<td style="height: 30px;"></td>
					<td style="height: 30px;"></td>
					</tr>
					<tr style="height: 1px;">
					<td colspan="2" align="left" valign="top" style="height: 1px;">
					<table cellpadding="0" cellspacing="0" width="610"></table>
					</td>
					<td style="height: 1px;"></td>
					<td style="height: 1px;"></td>
					</tr>
					<tr style="height: 20px;">
					<td height="20" colspan="2" style="height: 20px;">
					<div style="line-height: 0;"><span width="30" height="20" alt=""></span></div>
					</td>
					<td style="height: 20px;"></td>
					<td style="height: 20px;"></td>
					</tr>
					</tbody>
					</table>
					<div class="yj6qo"></div>
					<div class="adL"></div>
					</div>
					<div class="adL"></div>
					</div>
					</div>
					</body></html>
					 ';



	$subject=$url.' Billing Ref -'.$id;
	$headers="From:myassignment.lk <no-reply@info@myassignment.lk>"."\r\n";

		
		$headers = 'Cc: auto.myassignment.lk@gmail.com' . "\r\n";
			$headers = 'Cc: kasun.kalya@gmail.com' . "\r\n";
		$headers .= "MIME-Version: 1.0"."\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1"."\r\n";

		//mail($to,$subject,$emailmsg,$headers);
		
		
		
				$message = "
                        <html>
                        <head>
                        <title>HTML email</title>
                        </head>
                        <body>
                            ".$emailmsg."
                        </body>
                        </html>
                ";
	
 
                    $mail = new PHPMailer;
		//Server settings
				    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
				    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Host = 'smtp.zoho.com';
                    $mail->Port = 465;         // Enable SMTP authentication
					$mail->Username = 'info@myassignment.lk';                 // SMTP username
					$mail->Password = 'Dumi@123#';                           // SMTP password
				                                   // TCP port to connect to
				//Recipients
					$mail->setFrom('no-reply@myassignment.com', 'myassignment.lk');
					$mail->addAddress($to, '');     // Add a recipient
					//$mail->AddAddress('kasun.kalya@gmail.com');
					$mail->addCC('auto.myassignment.lk@gmail.com');
					$mail->isHTML(true);                                  // Set email format to HTML
					$mail->Subject = $subject;
					$mail->Body    = $message;
					$mail->send();






		//return ['status' => 'success','url' =>$data];
return response()->json(['status' => 'success','url' => $data ]);



	}
        
        
        public function writerPayment(AssignmentRequest $request)
        {
                $user=Sentinel::getUser();
                $id=$request->id;          
                    DB::table('payment_records')->insert(
                        ['pay_to' => $request->id , 'payment_type' => $request->type,'amount'=> $request->writeramount,'assignment_id'=> $request->assigmentid ,'added_by'=>$user->id,'created_at'=>date('Y-m-d H:i:s'),'payment_date'=> $request->writer_paydate]
                    );
                
                return response()->json(['status' => 'success']);
            
                             
        }
        
         public function paymentAdd(AssignmentRequest $request)
        {
                $user=Sentinel::getUser();
                
                    $writer_payment = DB::table('assignment_request')->where('id','=',$request->assigmentid)->get();
                    $advance=$writer_payment[0]->advance + $request->amount;
                    $assignment = Assignment::find($request->assigmentid);            
                    $assignment->advance= $advance;  
                    $assignment->advanceDate = $request->paymentdate;
                    $assignment->save();                           
                 
                      
                    DB::table('student_payment_records')->insert(
                        ['amount' => $request->amount,'assignment_id'=> $request->assigmentid,'added_by'=>$user->id,'created_at'=>date('Y-m-d H:i:s'),'payment_date'=>$request->paymentdate]
                    );
                
                return response()->json(['status' => 'success','data'=>$advance,'date'=>date('Y-m-d')]);
            
                             
        }
        
        public function paymentdelete(AssignmentRequest $request)
        {
         
            DB::table('payment_records')->where('payment_id',$request->id)->delete();
            return response()->json(['status' => 'success']);           
                             
        }
        
        public function paymentdeleteUser(AssignmentRequest $request)
        {
                    $payment = DB::table('student_payment_records')->where('payment_id','=',$request->id)->get();                     
                    $assignmentId=$payment[0]->assignment_id;
            
                    $writer_payment = DB::table('assignment_request')->where('id','=',$assignmentId)->get();
                    $advance=$writer_payment[0]->advance - $payment[0]->amount;
                    $assignment = Assignment::find($assignmentId);            
                    $assignment->advance= $advance;                      
                    $assignment->save();        
                    
            
            DB::table('student_payment_records')->where('payment_id',$request->id)->delete();
            return response()->json(['status' => 'success','data'=>$advance]);           
                             
        }
        
        public function confirm(AssignmentRequest $request)        {
       
            DB::table('payment_records')
            ->where('payment_id',$request->id)
            ->update(['confermstatus' => 1,'confermstatusDate'=>date('Y-m-d H:i:s')]);
            return response()->json(['status' => 'success']);           
                             
        }
        
        
        
         public function jsonListpayment($id)
	{
       
                $data = DB::table('student_payment_records')->where('assignment_id','=',$id)->get();
		$jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
                        $date1=date_create(DATE($value->payment_date));
                        $date2=date_create(date('Y-m-d'));
                        $diff=date_diff($date1,$date2);

			array_push($rowData,$i);			
			array_push($rowData,$value->amount);
			array_push($rowData,DATE($value->payment_date));
                        if($diff->format("%a") < 3){
                        array_push($rowData, '<a onclick="deletepaymentuser('.$value->payment_id.')"  data-id="'.$value->payment_id.'" class="role-delete" data-toggle="tooltip" data-placement="top" title="Delete Payment" style="color:red;"><i class="fa fa-trash-o"></i> Delete</a>');
                        }
                        else{
                            array_push($rowData,' ');
                        }
                        array_push($jsonList, $rowData);
			$i++;

		}
		return Response::json(array('data' => $jsonList));

	}
        
        
        
        public function jsonListwriterpayview($id)
	{
                $users=Sentinel::getUser();     
                $jsonList = array();
               if($id !=0){
                
                $assignement =  Assignment::find($id);
		$writer=$assignement->assignto;
                $assignementId=$assignement->id;
                $jsonList = array();
		$user = DB::table('users')->where('id','=', $writer)->get(); 
                    if(sizeof($user) > 0){
                        $user=$user;
                    }
                    else{
                        $user=array();
                    }
                
                $data = DB::table('payment_records')->join('users', 'users.id', '=', 'payment_records.pay_to')->where('payment_records.payment_type','=',1)->where('payment_records.assignment_id','=',$assignementId)->where('users.id','=',$writer)->get();
		
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
			array_push($rowData,$i);
			array_push($rowData,$value->username);
			array_push($rowData,$value-> amount );
			array_push($rowData,DATE($value->payment_date));
                        if($value->confermstatus == 1){ 
                            array_push($rowData,'<span style="color:green">confirmed</span>');
                        }
                        else{ 
                            array_push($rowData,'<span style="color:red">not confirmed</span>');
                              
                        }
                        array_push($rowData,DATE($value->confermstatusDate));
                        
                        array_push($jsonList, $rowData);
			$i++;

		}
                return Response::json(array('data' => $jsonList));
               }else{
		return Response::json(array('data' => $jsonList));
               }

	}

        
         public function jsonListpaymentview($id)
	{
       
                  $jsonList = array();
               if($id !=0){
                $data = DB::table('student_payment_records')->where('assignment_id','=',$id)->get();
		//$jsonList = array();
                $jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
			array_push($rowData,$i);			
			array_push($rowData,$value->amount);
			array_push($rowData,DATE($value->payment_date)); 			                         
                        array_push($jsonList, $rowData);
			$i++;

		}
                return Response::json(array('data' => $jsonList));
               }else{
		return Response::json(array('data' => $jsonList));
               }

	}
        
         public function jsonListrewriterpayview($id)
	{
                $users=Sentinel::getUser();   
                     $jsonList = array();
               if($id !=0){
                $assignement =  Assignment::find($id);
		$writer=$assignement->assignto;
                $assignementId=$assignement->id;
           
                
                $data = DB::table('payment_records')->join('users', 'users.id', '=', 'payment_records.pay_to')->where('payment_records.payment_type','=',2)->where('payment_records.assignment_id','=',$assignementId)->get();
		$jsonList = array();
		$i=1;
		foreach ($data as $value) {
			$rowData= array();
			array_push($rowData,$i);
			array_push($rowData,$value->username);
			array_push($rowData,$value-> amount );
			array_push($rowData,DATE($value->payment_date));
                        if($value->confermstatus == 1){ 
                            array_push($rowData,'<span style="color:green">confirmed</span>');
                        }
                        else{ 
                            array_push($rowData,'<span style="color:red">not confirmed</span>');
                              
                        }
                        array_push($rowData,DATE($value->confermstatusDate));
                                                                
				
                        array_push($jsonList, $rowData);
			$i++;

		}
                return Response::json(array('data' => $jsonList));
               }else{
		return Response::json(array('data' => $jsonList));
               }

	}
}