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

        /*table, th, td {*/
        /*  border: 1px solid black;*/
        /*  border-collapse: collapse;*/
        /*}*/
        /*th, td {*/
        /*  padding: 5px;*/
        /*  text-align: left;    */
        /*}*/

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
                       
                        <div class="form-group">                  
                       
                        @if($assignment->domain =='AU')                        
                            <label class="col-sm-2 control-label">Price ($)</label>
                       @else
                       	<label class="col-sm-2 control-label">Price (Rs)</label>
                       @endif
                            
                            <div class="col-sm-8">
                                <input type="number" min="1" class="form-control @if($errors->has('price')) error @endif" name="price" placeholder="Price" value="{{$assignment->price}}" readonly >
                                @if($errors->has('price'))
                                    <label id="label-error" class="error" for="label">{{$errors->first('price')}}</label>
                                @endif
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                      @if($assignment->domain =='AU')                        
                            <label class="col-sm-2 control-label">Advance ($)</label>
                       @else
                       	<label class="col-sm-2 control-label">Advance (Rs)</label>
                       @endif
                           
                            <div class="col-sm-8">
                                <input type="number" min="0" class="form-control @if($errors->has('advance')) error @endif" name="advance" id='advance' placeholder="Advance"  value="{{$assignment->advance}}" readonly>
                                @if($errors->has('advance'))
                                    <label id="label-error" class="error" for="label">{{$errors->first('advance')}}</label>
                                @endif
                            </div>
                        </div>
                         <?php
                            if($assignment->advanceDate =='0000-00-00'){
                            $paydate="";
                            }else{
                                $paydate=$assignment->advanceDate;
                            }
                        ?>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Payment Date</label>
                                <div class="col-sm-8">
                                    @if($roll->roles[0]['id'] !=9)
                                        <input type="text" class="form-control @if($errors->has('paydate')) error @endif" name="paydate" id="paydate" placeholder="Payment Date" value="{{$paydate}}" readonly>
                                        @if($errors->has('paydate'))
                                            <label id="label-error" class="error" for="label">{{$errors->first('paydate')}}</label>
                                        @endif
                                    @else
                                        <input type="text" readonly class="form-control @if($errors->has('paydate')) error @endif" placeholder="Pay Date" readonly value="{{$paydate}}">
                                    @endif
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
                                                    <li><a href="#tab1defaultstudent" data-toggle="tab">Payment</a></li>                                                            
                                                </ul>
                                        </div>
                                     
                                        <div class="panel-body">
                                            <div class="tab-content">
                                                <div class="tab-pane fade" id="tab2default">
                                                
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Writer</label>
                                                             <div class="col-sm-8">                                  
                                                                     @if(sizeof($userList) != 0)    
                                                                         <?php 
                                                                         $username=$userList[0]->username;
                                                                         $userid=$userList[0]->id;                                                                         
                                                                         ?>
                                                                     @else
                                                                         <?php 
                                                                         $username=''; 
                                                                         $userid='';                                                                         
                                                                         ?>
                                                                     @endif    
                                                                 <input type="text" class="form-control @if($errors->has('paydate')) error @endif" value="{{$username}}" readonly>
                                                             </div>
                                                     </div>
													 <div class="form-group">
														<label class="col-sm-2 control-label">Payment Date</label>
														<div class="col-sm-8">														
																<input type="text" class="form-control @if($errors->has('writer_paydate')) error @endif" name="writer_paydate" id="writer_paydate" placeholder="Payment Date" value="">
																@if($errors->has('writer_paydate'))
																	<label id="label-error" class="error" for="label">{{$errors->first('writer_paydate')}}</label>
																@endif														
														</div>
													</div>   
                                                     <div class="form-group">
                                                        <label class="col-sm-2 control-label">Amount (Rs)</label>
                                                             <div class="col-sm-8">
                                                                 <input type="hidden" name="writer_id" id="writer_id" class="form-control @if($errors->has('writer_amount')) error @endif" value="{{$userid}}" >
                                                                 <input type="number" min="0" name="writer_amount" id="writer_amount" class="form-control @if($errors->has('writer_amount')) error @endif" value="" >
                                                             </div>
                                                     </div>
													
                                                      <div class="form-group">
                                                          <label class="col-sm-2 control-label"></label>
                                                          <button type="button" class="btn btn-primary"  id="writersave"><i class="fa fa-floppy-o"></i>  Add writer payment</button>
                                                     </div>
                                                    
                                                    
                                                      <table class="table table-bordered bordered table-striped table-condensed datatable">
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
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label required">Writer</label>
                                                            <div class="col-sm-8">                                    
                                                                        {!! Form::select('rewriter',array('' => 'Select Writer') + $reWriterList, Input::old('rewriter'),['class'=>'chosen error','style'=>'width:100%;','required','data-placeholder'=>'Set After','id'=>'rewriter']) !!}
                                                                        <label id="supervisor-error" class="error" for="writer">{{$errors->first('rewriter')}}</label>                                      
                                                            </div>
                                                    </div>                                                           
													<div class="form-group">
														<label class="col-sm-2 control-label">Payment Date</label>
														<div class="col-sm-8">															
																<input type="text" class="form-control @if($errors->has('rewriter_paydate')) error @endif" name="rewriter_paydate" id="rewriter_paydate" placeholder="Payment Date" value="" >
																@if($errors->has('rewriter_paydate'))
																	<label id="label-error" class="error" for="label">{{$errors->first('rewriter_paydate')}}</label>
																@endif														
														</div>
													</div>  
                                                     <div class="form-group">
                                                        <label class="col-sm-2 control-label">Amount (Rs)</label>
                                                             <div class="col-sm-8">                                                                 
                                                                 <input type="number" min="0" name="re_writer_amount" id="re_writer_amount" class="form-control @if($errors->has('re_writer_amount')) error @endif" value="" >
                                                             </div>
                                                     </div>
                                                      <div class="form-group">
                                                          <label class="col-sm-2 control-label"></label>
                                                          <button type="button" class="btn btn-primary"  id="rewritersave"><i class="fa fa-floppy-o"></i>  Add Review writer payment</button>
                                                     </div>
                                                    
                                                    
                                                      <table class="table table-bordered bordered table-striped table-condensed datatable1">
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
                                                
                                                
                                                <div class="tab-pane fade" id="tab1defaultstudent">     
<!--                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label required">Payment Type</label>
                                                            <div class="col-sm-8">                                    
                                                                <select class="form-control" name="payType" id="payType" required>
                                                                    <option value="0" >Select Type</option>
                                                                    <option value="1" >Advance</option>
                                                                    <option value="2" >Normal</option>                                                              
                                                                </select>
                                                                <label id="supervisor-error" class="error" for="payType">{{$errors->first('payType')}}</label>                                      
                                                            </div>
                                                    </div>                                                           -->
                                                 

                                                     <div class="form-group">
                                                        <label class="col-sm-2 control-label">Amount (Rs)</label>
                                                             <div class="col-sm-8">                                                                 
                                                                 <input type="number" min="0" name="pay_amount" id="pay_amount" class="form-control @if($errors->has('pay_amount')) error @endif" value="" >
                                                             </div>
                                                     </div>
													<div class="form-group">
														<label class="col-sm-2 control-label">Payment Date</label>
														<div class="col-sm-8">													
																<input type="text" class="form-control @if($errors->has('paymentdate')) error @endif" name="paymentdate" id="paymentdate" placeholder="Payment Date" value="" >
																@if($errors->has('paymentdate'))
																	<label id="label-error" class="error" for="label">{{$errors->first('paymentdate')}}</label>
																@endif														
														</div>
													</div>   
                                                     <div class="form-group">
                                                          <label class="col-sm-2 control-label"></label>
                                                          <button type="button" class="btn btn-primary"  id="pay_amount_add"><i class="fa fa-floppy-o"></i>  Add payment</button>
                                                     </div>
                                                    
                                                    
                                                      <table class="table table-bordered bordered table-striped table-condensed datatable2">
                                                        <thead>
                                                        <tr>
                                                            <th class="text-center" width="2%">#</th>                                                           
                                                            <th class="text-center" style="font-weight:normal;">Amount</th>
                                                            <th class="text-center" style="font-weight:normal;">Payment Date</th>                                                          
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
			
			 $( "#writer_paydate" ).datepicker({
                format: "yyyy-mm-dd",     
           
            });
			 $( "#rewriter_paydate" ).datepicker({
                format: "yyyy-mm-dd",     
           
            });
             $( "#paymentdate" ).datepicker({
                format: "yyyy-mm-dd",     
           
            });
			
             $( "#redeadline" ).datepicker({
                format: "yyyy-mm-dd",     
           
            });
            
            // $( "#paydate" ).datepicker({
            //     format: "yyyy-mm-dd",

            // });
            
            $('#deadline').bind('cut copy paste', function (e) {
                e.preventDefault();
            });


            $('#redeadline').bind('cut copy paste', function (e) {
               e.preventDefault();
            });
    
        });
        
        $(document).ready(function(){
            table = generateTable('.datatable', '{{url('assignment/json/writerpay/'.$assignment->id)}}',[0,0,0],[]);
            table1 = generateTable('.datatable1', '{{url('assignment/json/writerrepay/'.$assignment->id)}}',[0,0,0],[]);  
            table2 = generateTable('.datatable2', '{{url('assignment/json/payment/'.$assignment->id)}}',[0,0,0],[]);  
            
          });
        
        
        
        
        function deletepayment(valueid){ 
            id = valueid;
            sweetAlertConfirm('Delete Payment', 'Are you sure?',2, deleteFunc1);
            
	};
        
        /**
	 * Delete the menu
	 * Call to the ajax request menu/delete.
	 */
	function deleteFunc1(){    
          ajaxRequest( '{{url('assignment/paymentdelete/')}}' , { 'id' : id  }, 'post', handleData1);
	}

	/**
	 * Delete the menu return function
	 * Return to this function after sending ajax request to the menu/delete
	 */
	function handleData1(data){
            
		if(data.status=='success'){
                    
			sweetAlert('Delete Success','Payment Deleted Successfully!',0);                     
                         $(".datatable").dataTable().fnDestroy();       
                        table = generateTable('.datatable', '{{url('assignment/json/writerpay/'.$assignment->id)}}',[0,0,0],[]);
                          $(".datatable1").dataTable().fnDestroy();       
                        table1 = generateTable('.datatable1', '{{url('assignment/json/writerrepay/'.$assignment->id)}}',[0,0,0],[]);   
		}else if(data.status=='invalid_id'){
			sweetAlert('Delete Error','Role Id doesn\'t exists.',3);
		}else{
			sweetAlert('Error Occured','Please try again!',3);
		}
	}
        
        
        
         function deletepaymentuser(valueid){ 
            id = valueid;
            sweetAlertConfirm('Delete Payment', 'Are you sure?',2, deleteFuncuser);
            
	};
        
        /**
	 * Delete the menu
	 * Call to the ajax request menu/delete.
	 */
	function deleteFuncuser(){    
          ajaxRequest( '{{url('assignment/paymentdeleteUser/')}}' , { 'id' : id  }, 'post', handleDatauser);
	}

	/**
	 * Delete the menu return function
	 * Return to this function after sending ajax request to the menu/delete
	 */
	function handleDatauser(data){
            
		if(data.status=='success'){
                     document.getElementById("advance").value=data.data;
			sweetAlert('Delete Success','Payment Deleted Successfully!',0);                     
                          $(".datatable2").dataTable().fnDestroy();     
                          table2 = generateTable('.datatable2', '{{url('assignment/json/payment/'.$assignment->id)}}',[0,0,0],[]);  
                          
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
			var writer_paydate=document.getElementById("writer_paydate").value;   
            
            
            if(writer_id ==''){
                sweetAlert(' Error','Please select writer.',3);
                return false;
            }
			if(writer_paydate ==''){
                sweetAlert(' Error','Please enter date.',3);
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
			var writer_paydate=document.getElementById("writer_paydate").value;   
            
             ajaxRequest( '{{url('assignment/writerPayment')}}' , { 'id':writer_id,'assigmentid':assigmentid,'writeramount':writer_amount,'type':1,'writer_paydate':writer_paydate }, 'post', handleDatareview);
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
			var rewriter_paydate=document.getElementById("rewriter_paydate").value;
            
            if(re ==''){
                sweetAlert(' Error','Please select writer.',3);
                return false;
            }
			if(rewriter_paydate ==''){
                sweetAlert(' Error','Please enter date.',3);
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
			var rewriter_paydate=document.getElementById("rewriter_paydate").value;			
            
             ajaxRequest( '{{url('assignment/writerPayment')}}' , { 'id':writer_id,'assigmentid':assigmentid,'writeramount':writer_amount,'type':2,'writer_paydate':rewriter_paydate }, 'post', handleDatareview2);
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
        
        /////////////////////////////////////////////////////////////////20190303
           $('#pay_amount_add').click(function(e){    
             e.preventDefault();                       
            var assigmentid=document.getElementById("assigmentid").value;   
            var amount=document.getElementById("pay_amount").value;   
            var paymentdate=document.getElementById("paymentdate").value; 
           
            if(amount ==''){
                sweetAlert(' Error','Please enter payment amount.',3);
                return false;
            }
			if(paymentdate ==''){
                sweetAlert(' Error','Please enter date.',3);
                return false;
            }
            
            
            else{  
                 
                sweetAlertConfirm('Payment Add', 'Are you sure?',1, acceptFuncpay);                
            }    
        });
        
         function acceptFuncpay(){
                        
            var assigmentid=document.getElementById("assigmentid").value;   
            var amount=document.getElementById("pay_amount").value;    
			var paymentdate=document.getElementById("paymentdate").value; 
            
             ajaxRequest( '{{url('assignment/payment')}}' , {'assigmentid':assigmentid,'amount':amount,'paymentdate':paymentdate}, 'post', handleDatareviewpay);
         }
        function handleDatareviewpay(data){
            if(data.status=='success'){
                var val=data.data; 
                document.getElementById("pay_amount").value='';  
                document.getElementById("writer_amount").value=val;
                document.getElementById("advance").value=data.data;
                document.getElementById("paydate").value=data.date;
           
            $(".datatable2").dataTable().fnDestroy();
            table2 = generateTable('.datatable2', '{{url('assignment/json/payment/'.$assignment->id)}}',[0,0,0],[]);                       
            sweetAlert('Success','Successfully Payed !',0);                  
                
            }else if(data.status=='invalid_id'){
                sweetAlert('Accepting Error','Menu Id doesn\'t exists.',3);
            }else{
                sweetAlert('Error Occured','Please try again!',3);
            }
        }
        
        
        //////////////////////////////////////////////////////////////////
        

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
