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

        table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
        }
        th, td {
          padding: 5px;
          text-align: left;    
        }

    </style>
@stop
@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="{{{url('/')}}}"><i class="fa fa-home mr5"></i>Home</a>
        </li>
        <li>
            <a href="javascript:;">Requests Management</a>
        </li>
        <li class="active">Payments</li>
    </ol>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-bordered">
                <div class="panel-heading border">
                    <strong>Payments</strong>
                </div>
                <div class="panel-body">
                    <form role="form" class="form-horizontal form-validation" method="post" enctype="multipart/form-data">
                        {!!Form::token()!!}
                          <div class="form-group">
                            <label class="col-sm-2 control-label required">Ref NO.</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control @if($errors->has('refno')) error @endif" name="refno" placeholder="refno" readonly value="{{$assignment->id}}">
                                @if($errors->has('studentname'))
                                    <label id="label-error" class="error" for="label">{{$errors->first('studentname')}}</label>
                                @endif
                            </div>
                        </div>    
                      
                        <div class="form-group">
                         <label class="col-sm-2 control-label">Domain</label>
                         <div class="col-sm-8">
                       @if($assignment->domain =='AU')  
                            <input type="text" min="1" class="form-control @if($errors->has('price')) error @endif" name="price" placeholder="Price" value="myassignment.com.au" readonly >
                       @else
                            <input type="text" min="1" class="form-control @if($errors->has('price')) error @endif" name="price" placeholder="Price" value="myassignment.lk" readonly >
                       @endif
                        </div>     
                       </div>
                       
                        <div class="form-group">
                         <label class="col-sm-2 control-label">Country</label>
                         <div class="col-sm-8">
                            <img style=" width:50px;" src="{{ asset('flags/'.$assignment->domain)}}.png" >
                        </div>     
                       </div>                       
                        
                        <hr>
                        <input type="hidden" name="assigmentid" id="assigmentid" class="form-control @if($errors->has('assigmentid')) error @endif" value="{{$assignment->id}}" >
                            <div class="form-group">
                                <label class="col-sm-2"></label>
                                <div class="col-sm-8">
                                    <div class="panel with-nav-tabs panel-info">
                                        <div class="panel-heading">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#tab1default" data-toggle="tab">Review Writer Payment</a></li>
                                                    <li><a href="#tab2default" data-toggle="tab">Writer Payment</a></li>                                                                              
                                                </ul>
                                        </div>
                                     
                                        <div class="panel-body">
                                            <div class="tab-content">
                                                <div class="tab-pane fade" id="tab2default">                                                
                                                
                                                    
                                                    <table class="table table-bordered bordered table-striped table-condensed datatable" id="datatable">
                                                        <thead>
                                                        <tr>
                                                            <th class="text-center" width="2%">#</th>
                                                            <th class="text-center" style="font-weight:normal;">Writer Name</th>
                                                            <th class="text-center" style="font-weight:normal;">Amount</th>
                                                            <th class="text-center" style="font-weight:normal;">Payment Date</th>
                                                            <th class="text-center" style="font-weight:normal;">Status</th>
                                                            <th class="text-center" style="font-weight:normal;"></th>
                                                        </tr>

                                                        </thead>
                                                    </table>
                                                    
                                                </div>                                                
                                               
                                               <div class="tab-pane fade in active" id="tab1default">    
                                                    
                                                    
                                                    
                                                   <table class="table table-bordered bordered table-striped table-condensed datatable" id="datatable1">
                                                        <thead>
                                                        <tr>
                                                            <th class="text-center" width="1%">#</th>
                                                            <th class="text-center" style="font-weight:normal;">Writer Name</th>
                                                            <th class="text-center" style="font-weight:normal;">Amount</th>
                                                            <th class="text-center" style="font-weight:normal;">Payment Date</th>
                                                            <th class="text-center" style="font-weight:normal;">Status</th>
                                                            <th class="text-center" style="font-weight:normal;"></th>
                                                        </tr>

                                                        </thead>
                                                    </table>
                                                    
                                                </div>
                                                               
                                            </div>
                                        </div>
                                    </div>
                                 </div>   
                         </div>
                        <div class="pull-right">
                           <a href="{{{url('assignment/edit/'.$assignment->id)}}}"><button type="button"  class="btn btn-primary"><i class="fa fa-angle-left"></i> Go Back</button></a>
                        </div>                       
                           
                    </form>
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
        $(document).ready(function(){
            $('.form-validation').validate();
            $('#permissions').multiSelect();           

            
              $( "#deadline" ).datepicker({
                format: "yyyy-mm-dd",     
           
            });
            
             $( "#redeadline" ).datepicker({
                format: "yyyy-mm-dd",     
           
            });
            
            $( "#paydate" ).datepicker({
                format: "yyyy-mm-dd",

            });
            
            $('#deadline').bind('cut copy paste', function (e) {
                e.preventDefault();
            });


            $('#redeadline').bind('cut copy paste', function (e) {
               e.preventDefault();
            });
    
        });
        
        $(document).ready(function(){
            table = generateTable('#datatable', '{{url('assignment/json/writerspay/2/'.$assignment->id)}}',[0,0,0],[]);
            table1 = generateTable('#datatable1', '{{url('assignment/json/writersrepay/1/'.$assignment->id)}}',[0,0,0],[]);   
          });
        
        
        function deletepayment(valueid){    
             id = valueid;
            sweetAlertConfirm('Payment Confirmation', 'Are you sure?',2, deleteFunc1);
	};
        /**
	 * Delete the menu
	 * Call to the ajax request menu/delete.
	 */
	function deleteFunc1(){    
           ajaxRequest( '{{url('assignment/confirmpay/')}}' , { 'id' : id  }, 'post', handleData1);
	}

	/**
	 * Delete the menu return function
	 * Return to this function after sending ajax request to the menu/delete
	 */
	function handleData1(data){
            
		if(data.status=='success'){                   

			sweetAlert('Confirmation','Payment Confirm Successfully!',0);                     
                         $("#datatable").dataTable().fnDestroy();       
                      table = generateTable('#datatable', '{{url('assignment/json/writerspay/2/'.$assignment->id)}}',[0,0,0],[]);
                          $("#datatable1").dataTable().fnDestroy();       
                                table1 = generateTable('#datatable1', '{{url('assignment/json/writersrepay/1/'.$assignment->id)}}',[0,0,0],[]);    
		}else if(data.status=='invalid_id'){
			sweetAlert('Delete Error','Role Id doesn\'t exists.',3);
		}else{
			sweetAlert('Error Occured','Please try again!',3);
		}
	}

        
       
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
        
        
        $('#writersave').click(function(e){    
             e.preventDefault();
            var writer_id=document.getElementById("writer_id").value;      
            var assigmentid=document.getElementById("assigmentid").value;   
            var writer_amount=document.getElementById("writer_amount").value;   
            
            
            if(writer_id ==''){
                sweetAlert(' Error','Please select writer.',3);
                return false;
            }
            if(writer_amount ==''){
                sweetAlert(' Error','Please enter writer payment amount.',3);
                return false;
            }
            
            
            else{  
                 
                sweetAlertConfirm('Writer Payment Add', 'Are you sure?',1, acceptFunc);                
            }    
        });
        
         function acceptFunc(){
            var writer_id=document.getElementById("writer_id").value;      
            var assigmentid=document.getElementById("assigmentid").value;   
            var writer_amount=document.getElementById("writer_amount").value;  
            
             ajaxRequest( '{{url('assignment/writerPayment')}}' , { 'id':writer_id,'assigmentid':assigmentid,'writeramount':writer_amount,'type':1 }, 'post', handleDatareview);
         }
        function handleDatareview(data){
            if(data.status=='success'){
                document.getElementById("writer_amount").value='';  
           
            $(".datatable").dataTable().fnDestroy();
            table = generateTable('.datatable', '{{url('assignment/json/writerpay/'.$assignment->id)}}',[0,0,0],[]);            
                sweetAlert('Success','Successfully Payed !',0);                  
                
            }else if(data.status=='invalid_id'){
                sweetAlert('Accepting Error','Menu Id doesn\'t exists.',3);
            }else{
                sweetAlert('Error Occured','Please try again!',3);
            }
        }
        
        
      //////////review//////////////////////////////
      
      
      
        $('#rewritersave').click(function(e){    
             e.preventDefault();
             
            var y = document.getElementById("rewriter");            
            var re = y.options[y.selectedIndex].value;             
            var assigmentid=document.getElementById("assigmentid").value;   
            var writer_amount=document.getElementById("re_writer_amount").value;   
            
            if(re ==''){
                sweetAlert(' Error','Please select writer.',3);
                return false;
            }
            if(writer_amount ==''){
                sweetAlert(' Error','Please enter writer payment amount.',3);
                return false;
            }
            
            
            else{  
                 
                sweetAlertConfirm('Writer Payment Add', 'Are you sure?',1, acceptFunc2);                
            }    
        });
        
         function acceptFunc2(){
             
            var y = document.getElementById("rewriter");            
            var writer_id = y.options[y.selectedIndex].value;             
            var assigmentid=document.getElementById("assigmentid").value;   
            var writer_amount=document.getElementById("re_writer_amount").value;     
            
             ajaxRequest( '{{url('assignment/writerPayment')}}' , { 'id':writer_id,'assigmentid':assigmentid,'writeramount':writer_amount,'type':2 }, 'post', handleDatareview2);
         }
        function handleDatareview2(data){
            // alert(data.status);
             
             
            if(data.status=='success'){
                document.getElementById("re_writer_amount").value='';  
           
            $(".datatable1").dataTable().fnDestroy();
//            table = generateTable('.datatable', '{{url('assignment/json/writerpay/'.$assignment->id)}}',[0,0,0],[]);    
            table1 = generateTable('.datatable1', '{{url('assignment/json/writerrepay/'.$assignment->id)}}',[0,0,0],[]);
            sweetAlert('Success','Successfully Payed !',0);   
               
                
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
//        function acceptFunc(){
//            ajaxRequest( '{{url('assignment/accept')}}' , { 'id' : id  }, 'post', handleData);
//        }



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
        
        
        
        ////new 2019-01-30//////////
        
          $('#rewriterreject').click(function(e){
            e.preventDefault();
            id = $(this).data('id');
            sweetAlertConfirm('Reject Request', 'Are you sure?',1, rejectreFunc);
        });
        function rejectreFunc(){
            ajaxRequest( '{{url('assignment/rewriterreject')}}' , { 'id' : id  }, 'post', handlerejectreData);
        }
        function handlerejectreData(data){
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
    
      @if(session('success_add'))   
        sweetAlert('{{session('success.title')}}','{{session('success.message')}}',0);
         var xhttp_studeny = new XMLHttpRequest();
                xhttp_studeny.open("POST", "https://sms.textware.lk:5001/sms/send_sms.php", true);
                xhttp_studeny.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp_studeny.send('{{session('success.link')}}');

          	
    @elseif(session('success'))   
        sweetAlert('{{session('success.title')}}','{{session('success.message')}}',0);
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
