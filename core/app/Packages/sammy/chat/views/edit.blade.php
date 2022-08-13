@extends('layouts.sammy_new.master') @section('title','Manage Requests')
@section('css')
    <style type="text/css">
        .panel.panel-bordered {
            border: 1px solid #ccc;
        }

        .btn-primary {
            color: white;
            background-color: #005C99;
            border-color: #005C99;
        }

        .chosen-container{
            font-family: 'FontAwesome', 'Open Sans',sans-serif;
        }
    </style>
@stop
@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="{{{url('/')}}}"><i class="fa fa-home mr5"></i>Home</a>
        </li>
        <li>
            <a href="{{{url('chat/list')}}}">Chat</a>
        </li>
        <li class="active">Chat History</li>
    </ol>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-bordered">
                <div class="panel-heading border">
                    <strong>Chat History</strong>
                     
                </div>
                <div class="col-sm-12" >
                        <i class="fa fa-print" style="font-size:20px;float:right" aria-hidden="true" value="Print Div" onclick="PrintElem('#myDiv')" /></i>
                 </div>
                <div class="panel-body">
                   <div id="subjectheader">
                       <div class="panel-heading border"><strong><i><b>Subject -  <?php if(count($chathistory)>0){echo $chathistory[0]->subject;} ?></b></i></strong></div>
                  </div>
                    <section class="widget bg-white post-comments">
                        <div id="myDiv">

                    @foreach ($chathistory as $chathistory)
                    
                    <?php $ext =pathinfo($chathistory->content, PATHINFO_EXTENSION)?>
 
                    
                        <section>
                            @if($user->id == $chathistory->add_by)
                            <div>
                                        <div>
                                            <div>
                                                <div class="comment-meta small">
                                                  <?php echo $chathistory->chat_date ?>
                                                </div>
                                                <strong>{{$chathistory->username}}</strong>
                                            </div>
                                        <p>
                                            @if($chathistory->type ==2)
                                               @if($ext=='JPEG'|| $ext=='JPEG'|| $ext=='PNG' || $ext=='jpeg'|| $ext=='jpg'|| $ext=='png')
                                                   <img src="../../chat/{{$chathistory->chat_sessions_id}}/{{$chathistory->content}}" class="blue"   target="_blank" data-toggle="tooltip" data-placement="top" title="Edit Menu" style="max-height: 500px;">

                                               @else
                                                  <a href="../../chat/{{$chathistory->chat_sessions_id}}/{{$chathistory->content}}" target="_blank"  style="color:blue;" ><i class="fa fa-file fa-3x"></i> Attachment</a>

                                               @endif
                                            @else
                                                <?php 
                                                 $imagecontent=str_replace("<img ","<img height='300'",$chathistory->content );
                                                 
                                                echo $imagecontent;
                                                
                                                ?>
                                            @endif
                                            
                                        </p>
                                        </div>
                            </div> 
                            @else
                            <div >
                                    <div class="comment">
                                        <div class="comment-author h6 no-margin">
                                            <div class="comment-meta small">
                                                       <?php echo $chathistory->chat_date ?>
                                            </div>
                                            <strong>{{$chathistory->username}}</strong>
                                        </div>
                                        <p>    
                                         @if($chathistory->type ==2)
                                               @if($ext=='JPEG'|| $ext=='JPEG'|| $ext=='PNG' || $ext=='jpeg'|| $ext=='jpg'|| $ext=='png')
                                                   <img src="../../chat/{{$chathistory->chat_sessions_id}}/{{$chathistory->content}}" class="blue"   target="_blank" data-toggle="tooltip" data-placement="top" title="Edit Menu" style="max-height: 500px;">

                                               @else
                                                  <a href="../../chat/{{$chathistory->chat_sessions_id}}/{{$chathistory->content}}" target="_blank"  style="color:blue;" ><i class="fa fa-file fa-3x"></i> Attachment</a>

                                               @endif
                                            @else
                                                  <?php 
                                                 $imagecontent=str_replace("<img ","<img height='300'",$chathistory->content );
                                                 
                                                echo $imagecontent;
                                                
                                                ?>
                                            @endif
                                        </p>
                                    </div>
                           </div>
                            
                            @endif
                        </section>
                    
                        <hr>
                        <br>
                    @endforeach
                    </div>
                    
                 <div class="pull-right">
                         
                     <a href="{{{url('chat/list/?fromd='.$from.'&tod='.$to)}}}"><button type='button' id='end_btn' class="btn btn-primary">Back</button></a>
                                     
        <!--                            <button type="button" class="btn btn-primary" name="chatadd" onclick="myFunctionchat()" id="chatadd"><i class="fa fa-floppy-o"></i> Save</button>
                                -->
                </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
    <script src="{{asset('assets/sammy_new/vendor/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">
        function PrintElem(elem) {
            Popup($(elem).html());
        }

        function Popup(data) {
            var myWindow = window.open('', 'my div', 'height=400,width=600');
            myWindow.document.write('<html><head><title>my div</title>');
            /*optional stylesheet*/ //myWindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
            myWindow.document.write('</head><body >');
            myWindow.document.write(data);
            myWindow.document.write('</body></html>');
            myWindow.document.close(); // necessary for IE >= 10

            myWindow.onload=function(){ // necessary if the div contain images

                myWindow.focus(); // necessary for IE >= 10
                myWindow.print();
               // myWindow.close();
            };
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.form-validation').validate();
            $('#permissions').multiSelect();           

            
              $( "#deadline" ).datepicker({
                format: "yyyy-mm-dd",     
           
            });
            
            $( "#paydate" ).datepicker({
                format: "yyyy-mm-dd",

            });
            
        });

   	$('#assign').click(function(e){      
         
            var y = document.getElementById("writer");
            var re = y.options[y.selectedIndex].value;
            if(re ==''){
             sweetAlert(' Error','Please select writer.',3);
                  return false;
            }    
        });
        
//        $('#add_review').click(function(e){
//  
//            var y = document.getElementById("checking_writer");            
//            var re = y.options[y.selectedIndex].value;
//            
//            var checking_discription = document.getElementsByName("checking_discription")[0].value;
//            alert(checking_discription);
//           
//            var id = $(this).data('id');           
////            if(checking_discription ==''){
////                sweetAlert(' Error','Please add reviews.',3);
////                return false;
////            }    
////            else{  
////                alert(checking_discription);
//               ajaxRequest( '{{url('assignment/addReview')}}' , { 'id' : id,'checking_discription':checking_discription}, 'post', handleDatareview);
//           // }    
//        
//        });
        
        
        $('#assignReview').click(function(e){    
            
            var y = document.getElementById("checking_writer");            
            var re = y.options[y.selectedIndex].value;
            var checking_discription = document.getElementById("checking_discription").value;
            var id = $(this).data('id');
            if(re ==''){
                sweetAlert(' Error','Please select writer.',3);
                return false;
            }    
            else{  
                ajaxRequest( '{{url('assignment/reviewwriter')}}' , { 'id' : id,'writer':re,'checking_discription':checking_discription }, 'post', handleDatareview);
            }    
        });
        
        
        function handleDatareview(data){
            if(data.status=='success'){
                sweetAlert('Success','Successfully Assigned !',0);                
//                var xhttp = new XMLHttpRequest();
//                xhttp.open("POST", "https://sms.textware.lk:5001/sms/send_sms.php", true);
//                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//                xhttp.send(data.url);               
//               
//             xhttp.onreadystatechange = processRequest;

		function processRequest(e) {
		  var response='0';
		   response=JSON.stringify(e);
                        if(response !='0'){
                        window.location.href = "{{URL::previous()}}";
                        }
		   //
		}
               // window.location.href = "{{URL::previous()}}";
            }else if(data.status=='invalid_id'){
                sweetAlert('Accepting Error','Menu Id doesn\'t exists.',3);
            }else{
                sweetAlert('Error Occured','Please try again!',3);
            }
        }
        
        
         
        $('#accept').click(function(e){
            e.preventDefault();
            id = $(this).data('id');
            sweetAlertConfirm('Accept Request', 'Are you sure?',1, acceptFunc);
        });
        function acceptFunc(){
            ajaxRequest( '{{url('assignment/accept')}}' , { 'id' : id  }, 'post', handleData);
        }
        function handleData(data){
            if(data.status=='success'){
                sweetAlert('Success','Successfully Accepted !',0);
                window.location.href = "{{URL::previous()}}";
            }else if(data.status=='invalid_id'){
                sweetAlert('Accepting Error','Menu Id doesn\'t exists.',3);
            }else{
                sweetAlert('Error Occured','Please try again!',3);
            }
        }


        $('#rejectwriter').click(function(e){
            e.preventDefault();
            id = $(this).data('id');
            sweetAlertConfirm('Reject Request', 'Are you sure?',1,Funcreject);
        });
        function Funcreject(){
            ajaxRequest( '{{url('assignment/rejectwriter')}}' , { 'id' : id  }, 'post', handleDatareject);
        }
        function handleDatareject(data){
            if(data.status=='success'){
                sweetAlert('Success','Successfully Rejected !',0);
                window.location.href = "{{URL::previous()}}";
            }else if(data.status=='invalid_id'){
                sweetAlert('Rejecting Error','Request Id doesn\'t exists.',3);
            }else{
                sweetAlert('Error Occured','Please try again!',3);
            }
        }

        $('#sms').click(function(e){
            e.preventDefault();
            id = $(this).data('id');
            sweetAlertConfirm('Sms & Email Request ', 'Are you sure?',1, smsFunc);
        });
        function smsFunc(){
            ajaxRequest( '{{url('assignment/smsSend')}}' , { 'id' : id  }, 'post', handleDatasms);
        }
        function handleDatasms(data){
            if(data.status=='success'){
                sweetAlert('Success','Successfully Send !',0);
                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "https://sms.textware.lk:5001/sms/send_sms.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send(data.url);
              // window.location.href = "{{URL::previous()}}";
            
            }else if(data.status=='invalid_id'){
                sweetAlert('Sending Error','Request Id doesn\'t exists.',3);
            }else{
                sweetAlert('Error Occured','Please try again!',3);
            }
        }
        
        
          $('#writerreject').click(function(e){
            e.preventDefault();
            id = $(this).data('id');
            sweetAlertConfirm('Reject Request', 'Are you sure?',1, rejectFunc);
        });
        function rejectFunc(){
            ajaxRequest( '{{url('assignment/writerreject')}}' , { 'id' : id  }, 'post', handlerejectData);
        }
        function handlerejectData(data){
            if(data.status=='success'){
                sweetAlert('Success','Successfully Rejected !',0);                
                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "https://sms.textware.lk:5001/sms/send_sms.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send(data.url);               
               
             xhttp.onreadystatechange = processRequest;

		function processRequest(e) {
		  var response='0';
		   response=JSON.stringify(e);
		if(response !='0'){
		window.location.href = "{{URL::previous()}}";
		}
		   //
		}
               // window.location.href = "{{URL::previous()}}";
            }else if(data.status=='invalid_id'){
                sweetAlert('Accepting Error','Menu Id doesn\'t exists.',3);
            }else{
                sweetAlert('Error Occured','Please try again!',3);
            }
        }

        $('#complete').click(function(e){
            e.preventDefault();
            id = $(this).data('id');
            sweetAlertConfirm('Complete Request', 'Are you sure?',1,Funccomplete);
        });
        function Funccomplete(){
            ajaxRequest( '{{url('assignment/complete')}}' , { 'id' : id  }, 'post', handleDatacomplete);
        }
        function handleDatacomplete(data){
            if(data.status=='success'){
                sweetAlert('Success','Successfully Completed !',0);

                var xhttp_studeny = new XMLHttpRequest();
                xhttp_studeny.open("POST", "https://sms.textware.lk:5001/sms/send_sms.php", true);
                xhttp_studeny.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp_studeny.send(data.studenturl);
                
                

            }else if(data.status=='invalid_id'){
                sweetAlert('Completing Error','Request Id doesn\'t exists.',3);
            }else{
                sweetAlert('Error Occured','Please try again!',3);
            }
        }

        $('#reject').click(function(e){
            e.preventDefault();
            id = $(this).data('id');
            sweetAlertConfirm('Reject Request', 'Are you sure?',1, deleteFuncreject);
        });
        function deleteFuncreject(){
            ajaxRequest( '{{url('assignment/reject')}}' , { 'id' : id  }, 'post', handleDatareject);
        }
        function handleDatareject(data){
            if(data.status=='success'){
                sweetAlert('Success','Successfully Rejected !',0);
                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "https://sms.textware.lk:5001/sms/send_sms.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send(data.url);
                //window.location.href = "{{URL::previous()}}";
          
            }else if(data.status=='invalid_id'){
                sweetAlert('Rejecting Error','Request Id doesn\'t exists.',3);
            }else{
                sweetAlert('Error Occured','Please try again!',3);
            }
        }

        $('#delete').click(function(e){
            e.preventDefault();
            id = $(this).data('id');
            sweetAlertConfirm('Delete Request', 'Are you sure?',1, deleteFun);
        });
        function deleteFun(){
            ajaxRequest( '{{url('assignment/delete')}}' , { 'id' : id  }, 'post', handleDatadelete);
        }
        function handleDatadelete(data){
            if(data.status=='success'){
                sweetAlert('Success','Successfully Deleted !',0);
                window.location.href = "{{URL::previous()}}";
            }else if(data.status=='invalid_id'){
                sweetAlert('Deleteing Error','Request Id doesn\'t exists.',3);
            }else{
                sweetAlert('Error Occured','Please try again!',3);
            }
        }
        
         $(document).ready(function(){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $('form').checkBo();
      $('.chosen').chosen();
      @if(session('success'))   
      
      /* document.cookie = "mailsend=John Doe"; 
      var x = document.cookie; 
      alert(x.mailsend);
      
           var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "https://sms.textware.lk:5001/sms/send_sms.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send('{{session('success.link')}}');            
                sweetAlert('{{session('success.title')}}', '{{session('success.message')}}',0);*/
                 



      @elseif(session('error'))
        sweetAlert('{{session('error.title')}}','{{session('error.message')}}',2);
      @elseif(session('warning'))
        sweetAlert('{{session('warning.title')}}','{{session('warning.message')}}',3);
      @elseif(session('info'))
        sweetAlert('{{session('info.title')}}','{{session('info.message')}}',1);
      @endif
    });

    </script>
@stop
