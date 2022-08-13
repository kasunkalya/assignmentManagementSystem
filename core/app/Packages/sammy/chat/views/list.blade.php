@extends('layouts.sammy_new.master') @section('title','Books List')
@section('css')
    <style type="text/css">
        .switch.switch-sm{
            width: 30px;
            height: 16px;
        }

        .switch.switch-sm span i::before{
            width: 16px;
            height: 16px;
        }

        .btn-success:hover, .btn-success:focus, .btn-success.focus, .btn-success:active, .btn-success.active, .open > .dropdown-toggle.btn-success {
            color: white;
            background-color: #D96557;
            border-color: #D96557;
        }
        .btn-success {
            color: white;
            background-color: #D96456;
            border-color: #D96456;
        }


        .btn-success::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
            width: 100%;
            height: 100%;
            background-color: #BB493C;
            -moz-opacity: 0;
            -khtml-opacity: 0;
            -webkit-opacity: 0;
            opacity: 0;
            -ms-filter: progid:DXImageTransform.Microsoft.Alpha(opacity=0 * 100);
            filter: alpha(opacity=0 * 100);
            -webkit-transform: scale3d(0.7, 1, 1);
            -moz-transform: scale3d(0.7, 1, 1);
            -o-transform: scale3d(0.7, 1, 1);
            -ms-transform: scale3d(0.7, 1, 1);
            transform: scale3d(0.7, 1, 1);
            -webkit-transition: transform 0.4s, opacity 0.4s;
            -moz-transition: transform 0.4s, opacity 0.4s;
            -o-transition: transform 0.4s, opacity 0.4s;
            transition: transform 0.4s, opacity 0.4s;
            -webkit-animation-timing-function: cubic-bezier(0.2, 1, 0.3, 1);
            -moz-animation-timing-function: cubic-bezier(0.2, 1, 0.3, 1);
            -o-animation-timing-function: cubic-bezier(0.2, 1, 0.3, 1);
            animation-timing-function: cubic-bezier(0.2, 1, 0.3, 1);
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
        }


        .switch :checked + span {
            border-color: #398C2F;
            -webkit-box-shadow: #398C2F 0px 0px 0px 21px inset;
            -moz-box-shadow: #2ecc71 0px 0px 0px 21px inset;
            box-shadow: #398C2F 0px 0px 0px 21px inset;
            -webkit-transition: border 300ms, box-shadow 300ms, background-color 1.2s;
            -moz-transition: border 300ms, box-shadow 300ms, background-color 1.2s;
            -o-transition: border 300ms, box-shadow 300ms, background-color 1.2s;
            transition: border 300ms, box-shadow 300ms, background-color 1.2s;
            background-color: #398C2F;
        }

        .datatable a.blue {
            color: #1975D1;
        }

        .datatable a.blue:hover {
            color: #003366;
        }

    </style>
@stop
@section('content')
    <ol class="breadcrumb">
        <li>
            <a href="{{url('/')}}"><i class="fa fa-home mr5"></i>Home</a>
        </li>
        <li>
            <a href="javascript:;">Chat</a>
        </li>
        <li class="active">Previous Conversation</li>
    </ol>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-bordered">
                <div class="panel-heading border">
                    <div class="row"><div class="col-xs-6"><strong>Previous Conversation</strong></div>                      
                    </div>
                </div>
                <div class="panel-heading ">
                    <?php
                        
                        if(isset($_GET['fromd'])){
                            $fromdate=$_GET['fromd'];
                        }
                        else{
                            $fromdate=0;
                        }
                        if($fromdate !=0){
                            $fromdatenew=$_GET['fromd'];
                        }
                        else{
                            $fromdatenew='';
                        }
                        
                        if(isset($_GET['tod'])){
                            $todate=$_GET['tod'];
                        }
                        else{
                            $todate=0;
                        }
                        if($fromdate !=0){
                            $todnew=$_GET['tod'];
                        }
                        else{
                            $todnew='';
                        }
                        
                       
                    ?>
                    <form role="form" class="form-horizontal form-validation" method="post" enctype="multipart/form-data">
                        {!!Form::token()!!}
                        <div class="col-sm-12">
                            <div class="col-sm-12">  
                                <div class="form-group col-sm-3">
                                    <label class="col-sm-2 control-label">From</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @if($errors->has('fromdeadline')) error @endif" name="fromdeadline" id="fromdeadline" required placeholder="From" value="{{$fromdatenew}}">
                                        @if($errors->has('fromdeadline'))
                                            <label id="label-error" class="error" for="label">{{$errors->first('fromdeadline')}}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label class="col-sm-2 control-label">To </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @if($errors->has('todate')) error @endif" name="todate" id="todate" required placeholder="To" value="{{$todnew}}">
                                        @if($errors->has('todate'))
                                            <label id="label-error" class="error" for="label">{{$errors->first('todate')}}</label>
                                        @endif
                                    </div>
                                </div>


                                <div class="pull-left">                                    
                                    <button type="button"  id="search" class="btn btn-info"><i class="fa fa-thumbs-o-up"></i> Search</button> 
                                    <a href="{{URL('chat/list/')}}"><button type="button"  class="btn btn-primary"><i class="fa fa-refresh"></i> Cancel</button></a>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
                <div class="panel-body">
                    <table class="table table-bordered bordered table-striped table-condensed datatable">
                        <thead>
                        <tr>
                            <th class="text-center" width="4%">#</th>
                            <th class="text-center" width="%" style="font-weight:normal;">From User</th>
                            <th class="text-center" style="font-weight:normal;">To user</th>
                            <th class="text-center" style="font-weight:normal;">Status</th>                            
                            <th class="text-center" width="4%" style="font-weight:normal;">Action</th>
                        </tr>                       
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script src="{{asset('assets/sammy_new/vendor/jquery-validation/dist/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">

        var id = 0;
        var table = '';
        $(document).ready(function(){
            
            $( "#fromdeadline" ).datepicker({
                format: "yyyy-mm-dd",
                changeMonth: true,
                changeYear: true
            });

            $( "#todate" ).datepicker({
                format: "yyyy-mm-dd",
                changeMonth: true,
                changeYear: true
            });
            var from = document.getElementById("fromdeadline").value;
            
            if(from !=''){     
                
                //e.preventDefault();
                var from = document.getElementById("fromdeadline").value;
                var to = document.getElementById("todate").value;

                if(from == ''){
                    sweetAlert('Error Occured','Please select from date!',3);
                    return ;
                }
                if(to == ''){
                    sweetAlert('Error Occured','Please select to date!',3);
                    return ;
                }

                $(".datatable").dataTable().fnDestroy()
                table = generateTable('.datatable', '{{url('chat/json/list/date')}}/'+from +'/'+to , 'get');
            }
            else{
                 table = generateTable('.datatable', '{{url('chat/json/list')}}');   
            }

        });
        
        $('#search').click(function(e){
            e.preventDefault();

            var from = document.getElementById("fromdeadline").value;
            var to = document.getElementById("todate").value;

            if(from == ''){
                sweetAlert('Error Occured','Please select from date!',3);
                return ;
            }
            if(to == ''){
                sweetAlert('Error Occured','Please select to date!',3);
                return ;
            }

            $(".datatable").dataTable().fnDestroy()
            table = generateTable('.datatable', '{{url('chat/json/list/date')}}/'+from +'/'+to , 'get');
        });


        /**
         * Delete the menu
         * Call to the ajax request menu/delete.
         */

//        function deleteFunc(){
//            ajaxRequest( '{{url('Document/delete')}}' , { 'id' : id  }, 'post', handleData);
//        }
        /**
         * Delete the menu return function
         * Return to this function after sending ajax request to the menu/delete
         */
        function handleData(data){
            if(data.status=='success'){
                sweetAlert('Delete Success','Record Deleted Successfully!',0);
                table.ajax.reload();
            }else if(data.status=='invalid_id'){
                sweetAlert('Delete Error','Menu Id doesn\'t exists.',3);
            }else{
                sweetAlert('Error Occured','Please try again!',3);
            }
        }

        function successFunc(data){
            table.ajax.reload();
        }
    </script>
@stop
