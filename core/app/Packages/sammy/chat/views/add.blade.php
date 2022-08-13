@extends('layouts.sammy_new.master') @section('title','Add New Book')
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
        #textarea {
            -moz-appearance: textfield-multiline;
            -webkit-appearance: textarea;
            
            border: 1px solid gray;
            font: medium -moz-fixed;
            font: -webkit-small-control;
            height:200px;
            overflow: auto;
            padding: 2px;
            resize: both;
            width: 500px;
        }
        .loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid blue;
  border-right: 16px solid green;
  border-bottom: 16px solid red;
  width: 120px;
  height: 120px;
  margin-left:50%;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
    </style>
@stop
@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="{{{url('/')}}}"><i class="fa fa-home mr5"></i>Home</a>
        </li>
        <li>
            <a href="javascript:;">Chat</a>
        </li>
        <li class="active">Start Conversation</li>
    </ol>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-bordered">
                <div class="panel-heading border">
                    <strong>Start Conversation <span id="name_lable"></span></strong>
                    
                </div>
                <div class="panel-body">
                    <div id="subjectheader">
                    
                  </div>
                    <!--<div id="rte"  style="height: 100%; width: 100%; outline: 0; overflow: auto">
                        <label class="control-label ">  
                        You are strictly prohibited from sharing your contact details through this messaging/chatting platform. In case you get a request from a coordinator to do through this platform, please alert it immediately to academicwriters50@gmail.com <br>
If you found sharing your details overriding this notice, it may result in the termination of our contract with you.</label>
                    </div> -->
   
                    
                    <form role="form" class="form-horizontal form-validation" method="post" enctype="multipart/form-data">
                        {!!Form::token()!!}
                        <input type="hidden" id="writer" name="writer" value="">
                        <input type="hidden" id="user" name="user" value="{{$user->id}}">
                        <input type="hidden" id="session" name="session" value="">
                        <div class="col-sm-12">    
                            <div class="col-sm-9">
                                <p id="demo" style=" max-height: 350px; overflow:auto"></p>    
                                <div style="padding:10px; height: 200px" id="chatboximg" >  
                                    <center><h2>Please select receiver</h2>
                                    <img src="{{asset('assets/sammy_new/images/images.png')}}"></center>
                                </div>
                                
                        <div class="col-sm-12" style="padding:10px; height: 350px" id="chatboxs" >   
                      
                         
                           <div class="form-group">
                                                           
                                <div class="col-sm-12">
                                    <div class="loader" id="loder"></div>
                                </div>  
                                                        
                            </div>
                            
                            @if (true)
                            <div id="subjectarea">
                            <div class="form-group">
                                <label class="col-sm-2 control-label ">Subject</label>                              
                                <div class="col-sm-9">
                                    <div class="form-control @if($errors->has('checking_discription')) error @endif" name="subject"  contenteditable="true" id="subject" placeholder="subject" contenteditable ></div>                                
                                </div>                                   
                            </div> 
                            </div> 
                              @endif
                            <div class="form-group">
                                <label class="col-sm-2 control-label ">Message</label>                              
                                <div class="col-sm-8">
                                    <div class="form-control @if($errors->has('checking_discription')) error @endif" name="message"  contenteditable="true" id="textarea" placeholder="Message" contenteditable ></div>                                
                                </div>
                                                        
                            </div>          
                            <div class="form-group">
                                <label class="col-sm-2 control-label ">Attachment</label>                                
                                <div class="col-sm-8">                                  
                                    <input type="file" name="attachment" id="attachment" class="@if($errors->has('attachment')) error @endif">
                                    @if($errors->has('attachment'))
                                        <label id="label-error" class="error" for="label">{{$errors->first('attachment')}}</label>
                                    @endif
                                </div>                                                       
                            </div>  
                            <div class="form-group">
                                <label class="col-sm-2 control-label ">Send SMS</label>                                
                                <div class="col-sm-2">                                  
                                    <input type="checkbox" name="sed_sms" id="sed_sms" value="1">                                  
                                </div>                                                       
                         
                                <label class="col-sm-2 control-label ">Send Email</label>                                
                                <div class="col-sm-2">                                  
                                    <input type="checkbox" name="sed_email" id="sed_email" value="1">                                  
                                </div>                                                       
                            </div> 
                            <div class="pull-right">
                                     <button type='button' id='submit_btn' class="btn btn-primary">Submit</button>
                                     
                                     <button type='button' id='end_btn' class="btn btn-danger">End Session</button>
                                     
        <!--                            <button type="button" class="btn btn-primary" name="chatadd" onclick="myFunctionchat()" id="chatadd"><i class="fa fa-floppy-o"></i> Save</button>
                                -->
                                 </div>
                        </div>
                            </div>
                     
                            <div class="col-sm-3" >  
                                <div class="form-group">
                                    <center><h4>Receivers</h4></center> 
                                </div>
                               @foreach($first_name as $aKey => $aSport)  
                                <i name="chatico"  id="{{$aKey}}" class="fa fa-dot-circle-o" aria-hidden="true" style="color: transparent"></i>
                                <a onclick="myFunction({{$aKey}})">{{$aSport}} {{$last_name[$aKey]}}</a><br>                                
                                @endforeach
                            </div>
                            
                        </div>
                        
                    </form>
                
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')   

    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
    <script src="{{asset('assets/sammy_new/vendor/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
         
              $("#chatboxs").hide();
              $("#loder").hide();
              $("#chatboximg").show();
         if({{$chatfor}} !=0){
            
             myFunction({{$chatfor}});
         }             
            $('.form-validation').validate();
            $('#permissions').multiSelect();
            
//              
//                  document.getElementById("writer").value;
//              }
       
                setInterval(function()
                {
                     
                    var id=document.getElementById("writer").value;          
                    var userlog= document.getElementById("user").value;    
                    ajaxRequest( '{{url('chat/getlivechat')}}' , { 'toId' : id,'fromId':userlog}, 'get', handleDatareviewrefresh);
                }, 10000); //10000 milliseconds = 10 seconds
          
        });



        function myFunction(id) {
            
          $("#chatboxs").show();
          $("#chatboximg").hide();
         // document.getElementsByName("chatico").style.color = "green";
         //document.getElementByName("chatico").innerHTML=''; 
          //document.getElementById(id).style.color = "blue";
          document.getElementById("writer").value = id;
       
          var userlog= document.getElementById("user").value; 
          
          if(userlog ==''){          
          	window.location.href = "{{url('user/logout')}}";
              
          } else{  
          ajaxRequest( '{{url('chat/history')}}' , { 'toId' : id,'fromId':userlog}, 'get');
          ajaxRequest( '{{url('chat/getlivechat')}}' , { 'toId' : id,'fromId':userlog}, 'get', handleDatareview);
          }
        }
        
        
            
        function handleDatareviewrefresh(data){
         
            document.getElementById("demo").innerHTML='';            
            var userlog= document.getElementById("user").value;
            var content="";
            var i;
            if(data.length >0){           
             // link2.style.visibility = 'visible';
            document.getElementById("session").value = data[0][8];
             
            }
            else{
               
                 document.getElementById("session").value = "";
            }
            for (i = 0; i < data.length; i++) {
                content +='<section class="widget bg-white post-comments">';
                if(data[i][2]==userlog){
                    content +='<div class="media">\n\
                                    <div class="comment">\n\
                                        <div class="comment-author h6 no-margin">\n\
                                        <div class="comment-meta small">';
                    content +=data[i][6];
                    content +='</div>\n\
                    <strong>';
                    content +=data[i][3];
                    content +='</strong>\n\
                    </div>\n\
                    <p>';
                    content +=data[i][5];
                    content +='</p>\n\
                    </div>\n\
                    </div>';
                    
                }
                else{
                      content +='<div class="media alert-info" style="padding:10px">\n\
                                    <div class="comment">\n\
                                        <div class="comment-author h6 no-margin">\n\
                                        <div class="comment-meta small">';
                    content +=data[i][6];
                    content +='</div>\n\
                    <strong>';
                    content +=data[i][3];
                    content +='</strong>\n\
                    </div>\n\
                    <p>';
                    content +=data[i][5];
                    content +='</p>\n\
                    </div>\n\
                    </div>';
                }
                content +="</section><hr>";
            } 
            
            document.getElementById("demo").innerHTML =content ;
               $("#loder").hide();
//            var objDiv = document.getElementById("demo");
//            objDiv.scrollTop = objDiv.scrollHeight; 
 
        }
        
        
        function handleDatareview(data){           
      
            document.getElementById("demo").innerHTML='';            
            var userlog= document.getElementById("user").value;
            localStorage.setItem("userlog", 0);
            var content="";
            var i;
            if(data.length >0){
            var link = document.getElementById('subjectarea');
            //var link2 = document.getElementById('subjectheader');      
             link.style.visibility = 'hidden';
             //link2.style.visibility = 'visible';
            document.getElementById("subjectheader").innerHTML='<div class="panel-heading border"><strong><i><b>Subject -'+data[0][9]+'</span></b></i></strong></div>';
            document.getElementById("session").value = data[0][8];
            }
            else{ 
                var link = document.getElementById('subjectarea');
                link.style.visibility = 'visible';
                document.getElementById("subjectheader").innerHTML="";
               // link.style.display = 'none'; //or                              
                 document.getElementById("session").value = "";
            }
            for (i = 0; i < data.length; i++) {
                content +='<section class="widget bg-white post-comments">';
                if(data[i][2]==userlog){
                    content +='<div class="media">\n\
                                    <div class="comment">\n\
                                        <div class="comment-author h6 no-margin">\n\
                                        <div class="comment-meta small">';
                    content +=data[i][6];
                    content +='</div>\n\
                    <strong>';
                    content +=data[i][3];
                    content +='</strong>\n\
                    </div>\n\
                    <p>';
                    content +=data[i][5];
                    content +='</p>\n\
                    </div>\n\
                    </div>';
                    
                }
                else{
                      content +='<div class="media alert-info" style="float:left;padding:10px">\n\
                                    <div class="comment">\n\
                                        <div class="comment-author h6 no-margin">\n\
                                        <div class="comment-meta small">';
                    content +=data[i][6];
                    content +='</div>\n\
                    <strong>';
                    content +=data[i][3];
                    content +='</strong>\n\
                    </div>\n\
                    <p>';
                    content +=data[i][5];
                    content +='</p>\n\
                    </div>\n\
                    </div>';
                }
                content +="</section><hr>";
            } 
            
            document.getElementById("demo").innerHTML =content ;
               $("#loder").hide();
//            var objDiv = document.getElementById("demo");
//            objDiv.scrollTop = objDiv.scrollHeight; 
 
        }


$('#submit_btn').on('click', function() {    
       $("#loder").show();
    
    var file_data = $('#attachment').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
    
    var touser = document.getElementById("writer").value;  
    var session = document.getElementById("session").value;
    var message = document.getElementById("textarea").innerHTML; 
    var subject = document.getElementById("subject").innerHTML;  
    var sed_sms = document.getElementById("sed_sms").checked; 
    var sed_email = document.getElementById("sed_email").checked;

    if(subject=="" && session=="" ){
      
        swal("Enter Subject!", "Please enter subject to continue", "warning");
        //sweetAlertConfirm('Enter Subject', 'Please enter subject to continue',1,false_return);
    }else{
    
    
    form_data.append('touser', touser);
    form_data.append('message', message);
    form_data.append('subject', subject);
    form_data.append('session', session);    
    form_data.append('sed_sms', sed_sms);    
    form_data.append('sed_email', sed_email);    
     
    $.ajax({
        url: "{{url('chat/addchat')}}", // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(php_script_response){
           
          
            if(php_script_response !=''){
                var xhttp = new XMLHttpRequest();
                    xhttp.open("POST", "https://sms.textware.lk:5001/sms/send_sms.php", true);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.send(php_script_response);
            }
           
          var id=document.getElementById("writer").value;          
          var userlog= document.getElementById("user").value;    
          ajaxRequest( '{{url('chat/getlivechat')}}' , { 'toId' : id,'fromId':userlog}, 'get', handleDatareview);
          
          document.getElementById("textarea").innerHTML='';     
          document.getElementById("attachment").value = "";
          document.getElementById("sed_sms").checked = false;
          
           //$("#loder").hide();
//         var objDiv = document.getElementById("demo");
//            objDiv.scrollTop = objDiv.scrollHeight;   
            
        }
     });
 }
});

$('#end_btn').on('click', function() {    

sweetAlertConfirm('End chat', 'Are you sure?',2, endchatFunc);
   
});



function endchatFunc(){
     var session = document.getElementById("session").value;
    var form_data = new FormData();  
    form_data.append('session', session);
                             
    $.ajax({
        url: "{{url('chat/endchat')}}", // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(php_script_response){
           
            if(php_script_response=='success'){
                sweetAlert('Success','Chat Successfully End  !',0);
                document.getElementById("demo").innerHTML='';            
            } 
        document.getElementById("textarea").innerHTML='';     
        document.getElementById("attachment").value = "";
        
            
        }
     });
}



    </script>
     <script type="text/javascript">
        document.getElementById("textarea").focus();
        document.body.addEventListener("paste", function(e) {
            for (var i = 0; i < e.clipboardData.items.length; i++) {
                if (e.clipboardData.items[i].kind == "file" && e.clipboardData.items[i].type == "image/png") {
                    // get the blob
                    var imageFile = e.clipboardData.items[i].getAsFile();

                    // read the blob as a data URL
                    var fileReader = new FileReader();
                    fileReader.onloadend = function(e) {
                        // create an image
                        var image = document.createElement("IMG");
                        image.src = this.result;

                        // insert the image
                        var range = window.getSelection().getRangeAt(0);
                        range.insertNode(image);
                        range.collapse(false);

                        // set the selection to after the image
                        var selection = window.getSelection();
                        selection.removeAllRanges();
                        selection.addRange(range);
                    };

                    // TODO: Error Handling!
                    // fileReader.onerror = ...

                    fileReader.readAsDataURL(imageFile);

                    // prevent the default paste action
                    e.preventDefault();

                    // only paste 1 image at a time
                    break;
                }
            }
        });         
    </script>
@stop
