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
        <li class="active">Requests</li>
    </ol>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-bordered">
                <div class="panel-heading border">
                    <strong>Edit Requests</strong>
                      @if($roll->roles[0]['id'] !=9)
                            <a style=" float: right" href="{{{url('assignment/payment/'.$assignment->id)}}}"><button type="button"  class="btn btn-primary"> <i class="fa fa-money"></i> Payments</button></a>
                      @else
                            <a style=" float: right" href="{{{url('assignment/paymentWriter/'.$assignment->id)}}}"><button type="button"  class="btn btn-primary">  <i class="fa fa-money"></i> Payments</button></a>
                      @endif
                </div>
                <div class="panel-body">
                    <form role="form" class="form-horizontal form-validation" method="post" enctype="multipart/form-data">
                        {!!Form::token()!!}
                        @if($roll->roles[0]['id'] !=9)                       
                            @if($clientPayment !='' || $clientPayment !=0)
                                <div class="alert alert-success" role="alert">
                                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                  Client payed amount {{$clientPayment}}
                                </div>

                            @else
                                <div class="alert alert-danger" role="alert">
                                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                  Client didn't Payed 
                                </div>
                            @endif
                            
                            @if($writerPayment !='' || $writerPayment !=0)
                                <div class="alert alert-success" role="alert">
                                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                  Payed amount to writer {{$writerPayment}}
                                </div>

                            @else
                                <div class="alert alert-danger" role="alert">
                                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                  Not Payed to writer
                                </div>
                            @endif
                            
                               @if($rewriterPayment !='' || $rewriterPayment !=0)
                                <div class="alert alert-success" role="alert">
                                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                  Payed amount to review writer {{$writerPayment}}
                                </div>

                            @else
                                <div class="alert alert-danger" role="alert">
                                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                  Not Payed to review writer
                                </div>
                            @endif                   
                        @endif
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label required">Ref NO.</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control @if($errors->has('refno')) error @endif" name="refno" placeholder="refno" readonly value="{{$assignment->id}}">
                                @if($errors->has('studentname'))
                                    <label id="label-error" class="error" for="label">{{$errors->first('studentname')}}</label>
                                @endif
                            </div>
                        </div>
                        
                        @if($roll->roles[0]['id'] !=9)
                        <div class="form-group">
                            <label class="col-sm-2 control-label required">Student Name</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control @if($errors->has('studentname')) error @endif" name="studentname" placeholder="Student Name" readonly value="{{$assignment->studentName}}">
                                @if($errors->has('studentname'))
                                    <label id="label-error" class="error" for="label">{{$errors->first('studentname')}}</label>
                                @endif
                            </div>
                        </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label required">Email</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control @if($errors->has('email')) error @endif" name="email" placeholder="Email" required value="{{$assignment->email}}">
                                    @if($errors->has('email'))
                                        <label id="label-error" class="error" for="label">{{$errors->first('email')}}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label required">Phone No</label>
                                <div class="col-sm-8">
                                    <input type="text" readonly class="form-control @if($errors->has('phoneNo')) error @endif" name="phoneNo" placeholder="Phone No" required value="{{$assignment->phoneNo}}">
                                    @if($errors->has('phoneNo'))
                                        <label id="label-error" class="error" for="label">{{$errors->first('phoneNo')}}</label>
                                    @endif
                                </div>
                            </div>

                        <hr>
                        @endif
                        <div class="form-group">
                            <label class="col-sm-2 control-label required"> Assignment Topic</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control @if($errors->has('topic')) error @endif" name="topic" placeholder="Topic" readonly value="{{$assignment->topic}}">
                                @if($errors->has('topic'))
                                    <label id="label-error" class="error" for="label">{{$errors->first('topic')}}</label>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label required">Assignment Type</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control @if($errors->has('type')) error @endif" name="type" placeholder="Assgnement Type" readonly value="{{$assignment->type}}">
                                @if($errors->has('type'))
                                    <label id="label-error" class="error" for="label">{{$errors->first('type')}}</label>
                                @endif
                            </div>
                        </div>

                       <div class="form-group">
                            <label class="col-sm-2 control-label required">Word Count</label>
                            <div class="col-sm-8">
                           @if($assignment->assignto =='' || $assignment->assignto ==0)
                               <input type="text"  class="form-control @if($errors->has('wordcount')) error @endif" name="wordcount" placeholder="Student Name" value="{{$assignment->wordcount}}" >
                                @if($errors->has('wordcount'))
                                    <label id="label-error" class="error" for="label">{{$errors->first('wordcount')}}</label>
                                @endif
                               @else
                               <input readonly type="text"  class="form-control @if($errors->has('wordcount')) error @endif" name="wordcount" placeholder="Student Name" value="{{$assignment->wordcount}}" readonly>
                                @if($errors->has('wordcount'))
                                    <label id="label-error" class="error" for="label">{{$errors->first('wordcount')}}</label>
                                @endif
                               @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label required">Level</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control @if($errors->has('level')) error @endif" name="level" placeholder="Level " readonly value="{{$assignment->level}}">
                                @if($errors->has('level'))
                                    <label id="label-error" class="error" for="label">{{$errors->first('level')}}</label>
                                @endif
                            </div>
                        </div>

              		@if($roll->roles[0]['id'] !=9)
	                        <div class="form-group">
	                            <label class="col-sm-2 control-label required"> Student Deadline</label>
	                            <div class="col-sm-8">
	                                <input type="text" class="form-control @if($errors->has('sdeadline')) error @endif" name="sdeadline" id="sdeadline" placeholder="Deadline"  value="{{$assignment->deadline}}">
	                                @if($errors->has('sdeadline'))
	                                    <label id="label-error" class="error" for="label">{{$errors->first('sdeadline')}}</label>
	                                @endif
	                            </div>
	                        </div>
                        @endif
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label required">Reference</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control @if($errors->has('reference')) error @endif" name="reference" placeholder="Reference" readonly value="{{$assignment->reference}}">
                                @if($errors->has('reference'))
                                    <label id="label-error" class="error" for="label">{{$errors->first('reference')}}</label>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label required">Other Note</label>
                            <div class="col-sm-8">
                                    <textarea rows="15" class="form-control @if($errors->has('othernote')) error @endif" name="othernote" placeholder="Other Note" readonly>{{$assignment->othernote}}</textarea>
                                    @if($errors->has('othernote'))
                                        <label id="label-error" class="error" for="label">{{$errors->first('othernote')}}</label>
                                    @endif

                            </div>
                        </div>




                        <div class="form-group">
                            <label class="col-sm-2 control-label required">Student Attachment</label>
                            <div class="col-sm-8">
                                <?php $studentAttachment=explode(".",$assignment->studentAttachment); ?>
                                <a download="{{'studentAttachment_'.$assignment->id.'.'.$studentAttachment[1]}}" href="{{asset('attachments/'. $assignment->id .'/'.$assignment->studentAttachment)}}" class="btn btn-primary btn-outline btn-round ">Attachment</a>
                            </div>
                        </div>
                        <hr>     
                        
                        @if($assignment->domain !='LK') 
                        <div class="form-group">
                            <label class="col-sm-2 control-label required">Country</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control @if($errors->has('refno')) error @endif" name="refno" placeholder="Country" readonly value="{{$assignment->country}}">
                                @if($errors->has('studentname'))
                                    <label id="label-error" class="error" for="label">{{$errors->first('studentname')}}</label>
                                @endif
                            </div>
                        </div>
                        @else
                         <div class="form-group">
                            <label class="col-sm-2 control-label required">Country</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control @if($errors->has('refno')) error @endif" name="refno" placeholder="Country" readonly value="Sri Lanka">
                               
                            </div>
                        </div>
                        @endif
                       
                        <div class="form-group">
                         <label class="col-sm-2 control-label">Web Site</label>
                         <div class="col-sm-8">
                             <img style=" width:50px;" src="{{ asset('flags/'.$assignment->domain)}}.png" >                      
                        </div>     
                       </div>
                       @if($addprice ==1) 
                        <div class="form-group">                  
                       
                        @if($assignment->domain !='LK')                        
                            <label class="col-sm-2 control-label required">Price ($)</label>
                       @else
                       	<label class="col-sm-2 control-label required">Price (Rs)</label>
                       @endif
                            
                            <div class="col-sm-8">
                                <input type="number" min="1" class="form-control @if($errors->has('price')) error @endif" name="price" placeholder="Price" value="{{$assignment->price}}" required>
                                @if($errors->has('price'))
                                    <label id="label-error" class="error" for="label">{{$errors->first('price')}}</label>
                                @endif
                            </div>
                        </div>
                        @endif
                        @if($advanceadd ==1)
                        <div class="form-group">
                      @if($assignment->domain !='Sri Lanka')                        
                            <label class="col-sm-2 control-label required">Advance ($)</label>
                       @else
                       	<label class="col-sm-2 control-label required">Advance (Rs)</label>
                       @endif
                           
                            <div class="col-sm-8">
                                <input type="number" min="0"  readonly="" class="form-control @if($errors->has('advance')) error @endif" name="advance" placeholder="Advance"  value="{{$assignment->advance}}" readonly>
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
                                <label class="col-sm-2 control-label required">Payment Date</label>
                                <div class="col-sm-8">
                                    @if($roll->roles[0]['id'] !=9)
                                        <input type="text" class="form-control @if($errors->has('paydate')) error @endif" name="paydate"  placeholder="Payment Date" value="{{$paydate}}" readonly>
                                        @if($errors->has('paydate'))
                                            <label id="label-error" class="error" for="label">{{$errors->first('paydate')}}</label>
                                        @endif
                                    @else
                                        <input type="text" readonly class="form-control @if($errors->has('paydate')) error @endif" placeholder="Pay Date" readonly value="{{$paydate}}">
                                    @endif
                                </div>
                            </div>
                        @endif
                        @if($assigneWriter ==1 && $assignment->advance !=0)
                        <div class="form-group">
                           <label class="col-sm-2 control-label required">Writer</label>
                                <div class="col-sm-8">
                                    @if($assigneWriter ==1)
                                        @if($errors->has('writer'))
                                            {!! Form::select('writer',array('' => 'Select Writer') + $userList, Input::old('writer'),['class'=>'chosen error','style'=>'width:100%;','required','data-placeholder'=>'Set After','id'=>'writer']) !!}
                                            <label id="supervisor-error" class="error" for="writer">{{$errors->first('writer')}}</label>
                                        @else
                                            {!! Form::select('writer',array('' => 'Select Writer') + $userList, $assignment->assignto,['class'=>'chosen','style'=>'width:100%;','required','data-placeholder'=>'Set After','id'=>'writer']) !!}
                                        @endif
                                    @else
                                            {!! Form::select('writer',array('' => 'Select Writer') + $userList, $assignment->assignto,['class'=>'chosen','style'=>'width:100%;','required','data-placeholder'=>'Set After','disabled' => true,'id'=>'writer']) !!}
                                            <label id="supervisor-error" class="error" for="writer">{{$errors->first('writer')}}</label>
                                    @endif
                                </div>
                        </div>
                        @endif
                        
                                <?php
	                                if($assignment->writerDeadLine =='0000-00-00'){
	                                    $dateDeadline='';
	                                }else{
	                                    $dateDeadline=$assignment->writerDeadLine;
	                                }
	
                                ?>
                        
                            <div class="form-group">
                            <label class="col-sm-2 control-label required">Deadline</label>
                            <div class="col-sm-8">
                                 @if($roll->roles[0]['id'] !=9)
                                    <input type="text" class="form-control @if($errors->has('deadline')) error @endif" name="deadline" id="deadline" placeholder="Deadline" value="{{$dateDeadline}}">
                                    @if($errors->has('deadline'))
                                        <label id="label-error" class="error" for="label">{{$errors->first('deadline')}}</label>
                                    @endif
                                @else
                                    <input type="text" readonly class="form-control @if($errors->has('deadline')) error @endif" placeholder="Deadline" readonly value="{{$dateDeadline}}">
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label ">Description</label>
                            <div class="col-sm-8">
                                @if($adminDiscripton ==1)
                                    <textarea rows="15" class="form-control @if($errors->has('discription')) error @endif" name="discription" placeholder="Description">{{$assignment->adminDiscrption}}</textarea>
                                    @if($errors->has('discription'))
                                        <label id="label-error" class="error" for="label">{{$errors->first('discription')}}</label>
                                    @endif
                                @endif
                                @if($adminDiscripton ==0)
                                    <textarea rows="15" disabled class="form-control @if($errors->has('discription')) error @endif"  placeholder="Description">{{$assignment->adminDiscrption}}</textarea>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label ">Additional Materials</label>
                            @if($adminAttachment ==1)
                            <div class="col-sm-8">
                                <input type="file" name="adminAttachment" id="adminAttachment" class="@if($errors->has('adminAttachment')) error @endif">
                                @if($errors->has('adminAttachment'))
                                    <label id="label-error" class="error" for="label">{{$errors->first('adminAttachment')}}</label>
                                @endif
                            </div>
                            @endif
                            @if($assignment->adminAttachment !='')
                                    <div class="col-sm-8" style=" margin-top: 10px;">
                                        <a href="{{asset('attachments/'. $assignment->id .'/'.$assignment->adminAttachment)}}" class="btn btn-primary btn-outline btn-round " download>Attachment</a>
                                    </div>
                            @endif
                        </div>     
                        @if($assignment->assignto !='0' && $assignment->status >= 1)
                        <hr>

                        <div class="form-group">
                            <label class="col-sm-2 control-label required">Progress (%)</label>
                            <div class="col-sm-8">
                                    <input type="number" min="0" max="100" class="form-control @if($errors->has('progress')) error @endif" name="progress" placeholder="Progress" value="{{$assignment->progress}}">
                                    @if($errors->has('progress'))
                                        <label id="label-error" class="error" for="label">{{$errors->first('progress')}}</label>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label ">Writer Attachment</label>
                            @if($writerAttachment ==1 && $roll->id != $assignment->checking_writer)
                            <div class="col-sm-8">
                                <input type="file" name="writerAttachment" id="writerAttachment" class="@if($errors->has('writerAttachment')) error @endif" >
                                @if($errors->has('writerAttachment'))
                                    <label id="label-error" class="error" for="label">{{$errors->first('writerAttachment')}}</label>
                                @endif
                            </div>
                            @endif
                            @if($assignment->writerAttachment !='')
                                <div class="col-sm-8" style=" margin-top: 10px;">
                                     <?php $writerAttachment=explode(".",$assignment->writerAttachment); ?>
                                    <a download="{{'writerAttachment_'.$assignment->id.'.'.$writerAttachment[1]}}" href="{{asset('attachments/'. $assignment->id .'/'.$assignment->writerAttachment)}}" class="btn btn-primary btn-outline btn-round " download>Attachment</a>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label ">Writer Image</label>
                            @if($writerAttachment ==1 && $roll->id != $assignment->checking_writer)
                                <div class="col-sm-8">
                                    <input type="file" name="writerImage" id="writerImage" class="@if($errors->has('writerImage')) error @endif"  accept=".doc,.docx">
                                    @if($errors->has('writerImage'))
                                        <label id="label-error" class="error" for="label">{{$errors->first('writerImage')}}</label>
                                    @endif
                                </div>
                            @endif
                            @if($assignment->writerImages !='')
                                <div class="col-sm-8" style=" margin-top: 10px;">
                                    <div class="col-sm-12" style=" margin-top: 10px;">
                                        <?php $writerImage=explode(".",$assignment->writerImages); ?>
                                        <a download="{{'writerImage_'.$assignment->id.'.'.$writerImage[1]}}" href="{{asset('attachments/'. $assignment->id .'/'.$assignment->writerImages)}}"  class="btn btn-primary btn-outline btn-round " download>Attachment</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @endif
                                   
                        
                        @if($addreview ==1 && $assignment->status >= 4 && $roll->roles[0]['id'] !=9 || $roll->id == $assignment->checking_writer )
                        <hr>
                        <div class="form-group">
                           <label class="col-sm-2 control-label required">Reviewing Writer</label>
                                <div class="col-sm-8">
                                    @if($reviewWriter ==1)
                                        @if($errors->has('writer'))
                                            {!! Form::select('checking_writer',array('' => 'Select Writer') + $reWriter, Input::old('checking_writer'),['class'=>'chosen error','style'=>'width:100%;','required','data-placeholder'=>'Set After','id'=>'checking_writer']) !!}
                                            <label id="supervisor-error" class="error" for="checking_writer">{{$errors->first('checking_writer')}}</label>
                                        @else
                                            {!! Form::select('checking_writer',array('' => 'Select Writer') + $reWriter, $assignment->checking_writer,['class'=>'chosen','style'=>'width:100%;','required','data-placeholder'=>'Set After','id'=>'checking_writer']) !!}
                                        @endif
                                    @else
                                            {!! Form::select('checking_writer',array('' => 'Select Writer') + $reWriter, $assignment->checking_writer,['class'=>'chosen','style'=>'width:100%;','required','data-placeholder'=>'Set After','disabled' => true,'id'=>'checking_writer']) !!}
                                            <label id="supervisor-error" class="error" for="checking_writer">{{$errors->first('checking_writer')}}</label>
                                    @endif
                                </div>
                        </div>
                                 <?php
	                                if($assignment->chekingDeadLine  =='0000-00-00'){
	                                    $redateDeadline='No Deadline';
	                                }else{
	                                    $redateDeadline=$assignment->chekingDeadLine;
	                                }
	
                                ?>
                        
                           
                        @endif
                        @if($addreview ==1 && $assignment->status >= 4 && $roll->roles[0]['id'] !=9 || $roll->id == $assignment->checking_writer )
                        <div class="form-group">
                            <label class="col-sm-2 control-label required">Reviewing Deadline</label>
                            <div class="col-sm-8">
                                 @if($roll->roles[0]['id'] !=9)
                                    <input type="text" class="form-control @if($errors->has('redeadline')) error @endif" name="redeadline" id="redeadline" placeholder="Deadline" value="{{$redateDeadline}}">
                                    @if($errors->has('redeadline'))
                                        <label id="label-error" class="error" for="label">{{$errors->first('redeadline')}}</label>
                                    @endif
                                @else
                                    <input type="text" readonly class="form-control @if($errors->has('redeadline')) error @endif" placeholder="Deadline" readonly value="{{$redateDeadline}}">
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                                <label class="col-sm-2 control-label ">Description</label>
                                <div class="col-sm-8">
                                    @if($addreview ==1 || $roll->roles[0]['id'] !=9 )
                                        <textarea class="form-control @if($errors->has('checking_discription')) error @endif" id="checking_discription" name="checking_discription" placeholder="Description"></textarea>
                                        @if($errors->has('checking_discription'))
                                            <label id="label-error" class="error" for="label">{{$errors->first('checking_discription')}}</label>
                                        @endif
                                    @endif

                                </div> 
                            </div>     
                        @endif
                      
                        @if(count($comment) > 0)
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label ">Previous Reviews</label>      
                             <div class="col-sm-8">                              
                               
                                @foreach ($comment as $comment)  
                                 <?php if ($comment->comment !='<br>'){ ?>
                                    <div class="comment-author h6 no-margin">
                                                <div class="comment-meta small">
                                                     @if($roll->roles[0]['id'] !=9 )
                                                     Added by -{{ $comment->first_name }}
                                                     <br>
                                                      @endif 
                                                      Added date -{{ $comment->created_at }}
                                                </div>
                                               
                                    </div>
                                <br>
                                 <p>    
                                        <?php 
                                        $imagecontent=str_replace("<img ","<img height='300'",$comment->comment);
                                        
                                        echo $imagecontent; ?>
                                 </p>
                                           
                                             <hr>     
                                 <?php } ?>
                                @endforeach
                                
                            </div>                      
                        </div>
                        @endif
                         <div class="pull-right">
                        
                        @if($assignment->checking_status == 2)
                         <img src="{{asset('assets/sammy_new/images/reject.png')}}" style="width: 100px;
    height: 1%; margin: 5px;" />
                        @elseif($assignment->checking_status == 3 )
                         <img src="{{asset('assets/sammy_new/images/approved.png')}}" style="width: 100px;
    height: 1%; margin: 5px;" />
                         @else
                         
                        @endif
                         </div>
                        <div class="pull-right">
                           <a href="{{URL::previous()}}"><button type="button"  class="btn btn-primary"><i class="fa fa-angle-left"></i> Go Back</button></a>
                         
                            @if($assignment->status < 1 && $roll->roles[0]['id'] ==9)
                                <button type="button"   data-id="{{$assignment->id}}" id="accept" class="btn btn-info"><i class="fa fa-thumbs-o-up"></i> Accept</button>
                            @endif
                            @if($roll->roles[0]['id'] ==9 && $user->id != $assignment->checking_writer && $assignment->progress < 100 && $assignment->checking_status ==0)
                                <button type="button"   data-id="{{$assignment->id}}" id="writerreject" class="btn btn-danger"><i class="fa fa-thumbs-o-down"></i> Reject Assignment</button>
                            @endif
                      
                          
                            @if($user->id == $assignment->checking_writer && $assignment->checking_status ==4)
                                <button type="button"   data-id="{{$assignment->id}}" id="rewriterreject" class="btn btn-danger"><i class="fa fa-thumbs-o-down"></i> Reject Assignment</button>
                            @endif
                            
                            @if($addcomplete ==1 && $assignment->status >= 4 && $roll->roles[0]['id'] !=9 )
                            <button type="button" class="btn btn-primary"  data-id="{{$assignment->id}}" id="assignReview"><i class="fa fa-rev"></i> Assign to review</button>                               
                            @endif
                         
                            @if($addcomplete ==1 && $assignment->status >= 4 && $roll->roles[0]['id'] !=9 )
                                <button type="button"   data-id="{{$assignment->id}}" id="reject" class="btn btn-danger"><i class="fa fa-thumbs-o-down"></i> Reject</button>
                                <button type="button"   data-id="{{$assignment->id}}" id="complete" class="btn btn-success"><i class="fa fa-check"></i>  Complete</button>
                            @endif
                            
                            @if($user->id == $assignment->checking_writer && $assignment->checking_status ==4)
                           
                                <button type="submit" class="btn btn-success" data-id="{{$assignment->id}}" id="add_complete_review" name="add_complete_review"><i class="fa fa-check"></i> Complete Review</button>
                                <button type="submit" class="btn btn-danger" data-id="{{$assignment->id}}" id="add_reject_review" name="add_reject_review"><i class="fa fa-thumbs-o-down"></i> Reject Review</button>
                             
                            @endif
                            
                            @if($assignment->status >= 1 && $assignment->status != 3 && $roll->roles[0]['id'] ==9 && $roll->id != $assignment->checking_writer && $assignment->checking_status ==0 || $assignment->checking_status ==2 && $assignment->progress < 100 && $assignment->assignto== $roll->id)
                                <button type="submit" class="btn btn-primary"  id="writersave"><i class="fa fa-floppy-o"></i> Save</button>
                                
                            @elseif($assignment->status != 4 && $assignment->status != 3 && $assignment->status == 0  && $roll->roles[0]['id'] !=9 && $assignment->advance ==0 || $assignment->advanceDate =='0000-00-00')
                                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button>
                            @elseif($assignment->status != 4 && $assignment->status != 3 && $assignment->status == 0  && $roll->roles[0]['id'] !=9 && $assignment->advance !=0)
                                <button type="submit" class="btn btn-danger" name="assign" id="assign"><i class="fa fa-floppy-o"></i>  Assign</button>                              
                            @endif
                            
                            
                            @if($assignment->advance ==0 && $roll->roles[0]['id'] !=9)
                                <button type="button"   data-id="{{$assignment->id}}" id="delete" class="btn btn-primary"><i class="fa fa-trash"></i> Reject</button>  
                            @endif
                            
                            @if($roll->roles[0]['id'] !=9 && $assignment->price!=0)
                                <button type="button"   data-id="{{$assignment->id}}" id="sms" class="btn btn-info"><i class="fa fa-envelope"></i> Send SMS& Email</button>
                            @endif

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
            
            $( "#sdeadline" ).datepicker({
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

   	$('#assign').click(function(e){      
         
            var y = document.getElementById("writer");
            var re = y.options[y.selectedIndex].value;
            if(re ==''){
             sweetAlert(' Error','Please select writer.',3);
                  return false;
            }    
        });
        
        
        $('#writersave').click(function(e){      
            var fup = document.getElementById('writerImage');
            var fileName = fup.value;
            if(fileName ==''){
                sweetAlert(' Error','Please upload writer image.',3);
                return false;
            }
//            var y = document.getElementById("writer");
//            var re = y.options[y.selectedIndex].value;
//            if(re ==''){
//             sweetAlert(' Error','Please select writer.',3);
//                  
//            }    
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
            
            var date=document.getElementById("redeadline").value;           
            var y = document.getElementById("checking_writer");            
            var re = y.options[y.selectedIndex].value;
            var checking_discription = document.getElementById("checking_discription").value;
            var id = $(this).data('id');
            if(re ==''){
                sweetAlert(' Error','Please select writer.',3);
                return false;
            }
            
            
            else{  
                ajaxRequest( '{{url('assignment/reviewwriter')}}' , { 'id' : id,'writer':re,'date':date,'checking_discription':checking_discription }, 'post', handleDatareview);
            }    
        });
        
        
        function handleDatareview(data){
            // alert(data.status);
            if(data.status=='success'){
                sweetAlert('Success','Successfully Assigned !',0);                
                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "https://sms.textware.lk:5001/sms/send_sms.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send(data.link);               
               
             xhttp.onreadystatechange = processRequest;

		function processRequest(e) {
		  var response='0';
		   response=JSON.stringify(e);
                        if(response !='0'){
                       // window.location.href = "{{URL::previous()}}";
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
//                var xhttp = new XMLHttpRequest();
//                xhttp.open("POST", "https://sms.textware.lk:5001/sms/send_sms.php", true);
//                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//                xhttp.send(data.url);               
               
           //  xhttp.onreadystatechange = processRequest;

		//function processRequest(e) {
		//  var response='0';
		//   response=JSON.stringify(e);
		//if(response !='0'){
		window.location.href = "{{URL::previous()}}";
		//}
		   //
		//}
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
            sweetAlertConfirm('Reject Request', 'Are you sure?',1, deleteFun);
        });
        function deleteFun(){
            ajaxRequest( '{{url('assignment/delete')}}' , { 'id' : id  }, 'post', handleDatadelete);
        }
        function handleDatadelete(data){
            //alert(data.link);
            if(data.status=='success'){
                var xhttp_studeny = new XMLHttpRequest();
                var status= xhttp_studeny.open("POST", "https://sms.textware.lk:5001/sms/send_sms.php", true);
                xhttp_studeny.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp_studeny.send(data.link);
                sweetAlert('Success','Successfully Rejected !',0); 
                setTimeout(myFunctioan, 2000)
                //e.preventDefault();                           
                //;
                
            }else if(data.status=='invalid_id'){
                sweetAlert('Rejecting Error','Request Id doesn\'t exists.',3);
            }else{
                sweetAlert('Error Occured','Please try again!',3);
            }
        }
             
        function myFunctioan() {
            window.location.href = "{{URL::previous()}}";
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

              //var xhttp_studeny = new XMLHttpRequest();
                     // xhttp_studeny.open("POST", "https://sms.textware.lk:5001/sms/send_sms.php", true);
                     // xhttp_studeny.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                     // xhttp_studeny.send('{{session('success.studentlink')}}');
                //window.location.href = "{{URL::previous()}}";
          
        
      /* document.cookie = "mailsend=John Doe"; 
      var x = document.cookie; 
      alert(x.mailsend);
      
           var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "https://sms.textware.lk:5001/sms/send_sms.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send('{{session('success.link')}}');            
                sweetAlert('{{session('success.title')}}', '{{session('success.message')}}',0);*/
                 
          	
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
     <script type="text/javascript">
        document.getElementById("checking_discription").focus();
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
