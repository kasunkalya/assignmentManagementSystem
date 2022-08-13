@extends('layouts.sammy_new.master') @section('title','Writer Report')
@section('current_title','New Projects')
@section('content')
    <style type="text/css">
        .bg-black {
            color: #616161;
            background-color: #556B8D;
        }


        .bg-red {
            color: #616161;
            background-color: #EFA131;
        }

        .bg-blue {
            color: #616161;
            background-color: #55822A;
        }

        .widget .widget-title {
            display: block;
            font-size: 25px;
            line-height: 1;
            color: #fff;
            font-family:'Open Sans',sans-serif;
        }

        .widget .widget-subtitle {
            font-size: 12px;
            color: #fff;
        }

        .bg-white3 {
            color: #EFA131;
            background-color: #fff;
        }


        .bg-white1 {
            color: #556B8D;
            background-color: #fff;
        }

        .bg-white2 {
            color: #55822A;
            background-color: #fff;
        }

        .widget .widget-icon {
            display: inline-block;
            vertical-align: middle;
            width: 40px;
            height: 40px;
            border-radius: 20px;
            text-align: center;
            font-size: 25px;
            line-height: 40px;
        }

        small, .small {
            font-size: 12px;
        }
        dt,.bold {
            font-weight: 700;
        }

        .bg-white {
            color: #616161;
            background-color: white;
            border: 1px solid #ccc;
        }

        .bg-lightblue {
            color: white;
            background-color: #4CC3D9;
        }

        .bg-brown {
            color: white;
            background-color: #D96557;
        }

        .bg-success {
            color: white;
            background-color: #FFC65D;
        }

        .bg-primary {
            color: white;
            background-color: #34495e;
            height:99px;
        }

        .text-success {
            color: #556B8D;
        }

        .main-panel > .header .navbar-nav .dropdown-menu {
            margin-top: 2px;
            padding: 0;
            border-color: rgba(0, 0, 0, 0.1);
            border-top: 0;
            background-color: white;
            -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            -moz-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
            width: 100%;
        }
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

    <div class="row">
<!--        <div class="col-md-3">
            <section class="widget bg-primary">
                <div class="widget-details">
                    <a href="javascript:;" class="pull-left relative">
                        <img src="{{asset('assets/sammy_new/images/avatar.jpg')}}" class="avatar avatar-sm img-circle bordered" alt="">
                    </a>
                </div>
                <div class="widget-details">
                    <span class="h5 bold">@if(isset($user)) {{$user->full_name}} @endif</span>
                    <small class="block">@if(isset($user)) {{$user->email}} @endif</small>
                    <small class="block">{{date('Y-d-m')}}</small>

                </div>
            </section>

        </div>-->
        <div class="col-md-5">
            <section class="widget bg-primary text-center" style="height: 99px;">
                <a href="{{ url('/') }}">
                    <div class="widget-details ">
                        <h2 class="no-margin bold">
                            @if($hasAcess == 1)
                                {{$allpending}}
                            @else
                                {{$limitpending}}
                            @endif
                        </h2>

                        <small class="text-uppercase">New Projects</small>
                    </div>
                </a>
                @if($hasAcess == 1)
                    <div class="widget-details">
                        <div class="climacon hail sun fa-2x"></div>
                    </div>
                    <a href="{{ url('/assignedProjects') }}">
                        <div class="widget-details">
                            <h2 class="no-margin bold">
                                {{$allassigned}}
                            </h2>

                            <small class="text-uppercase">Assigned Projects</small>
                        </div>
                    </a>
                    <div class="widget-details">
                        <div class="climacon hail sun fa-2x"></div>
                    </div>
                    <a href="{{ url('/writercomplete') }}">
                        <div class="widget-details">
                            <h2 class="no-margin bold">
                                {{$writercomplete}}
                            </h2>

                            <small class="text-uppercase">Waiting for Complete</small>
                        </div>
                    </a>
                @else
                    <div class="widget-details">
                        <div class="climacon hail sun fa-2x"></div>
                    </div>
                    <a href="{{ url('/writercomplete') }}">
                        <div class="widget-details">
                            <h2 class="no-margin bold">
                                {{$writercompletelimit}}
                            </h2>

                            <small class="text-uppercase">Waiting for Complete</small>
                        </div>
                    </a>
                @endif

            </section>


        </div>

        <div class="col-md-4">
            <section class="widget bg-primary text-center" style="height: 99px;">

                <a href="{{ url('/runingprojects') }}">
                    <div class="widget-details col-xs-4">
                        <h2 class="no-margin">
                            @if($hasAcess == 1)
                                {{$allrun}}
                            @else
                                {{$limitrun}}
                            @endif
                        </h2>
                        <small class="text-uppercase">Running</small>
                    </div>
                </a>
                <a href="{{ url('/completeProjects') }}">
                    <div class="widget-details col-xs-4">
                        <h2 class="no-margin">
                            @if($hasAcess == 1)
                                {{$allcomplete}}
                            @else
                                {{$limitcomplete}}
                            @endif
                        </h2>
                        <small class="text-uppercase">Completed</small>
                    </div>
                </a>
                <a href="{{ url('/writerrejectview') }}">
                    <div class="widget-details col-xs-4">
                        <h2 class="no-margin">
                            @if($hasAcess == 1)
                                {{$allreject}}
                            @else
                                {{$limitreject}}
                            @endif
                        </h2>
                        <small class="text-uppercase">Rejected</small>
                    </div>
                </a>
            </section>
        </div>
<div class="col-md-3">
        <section class="widget bg-primary">

            <a href="{{ url('/runingprojects') }}">
              <div class="widget-details col-xs-6">
                <h2 class="no-margin">
                    @if($hasAcess == 1)
                        {{$reviewpending}}
                    @else
                        {{$limitreviewpending}}
                    @endif
                </h2>
                <small class="text-uppercase">Reviewing</small>
              </div>
           </a>

          <a href="{{ url('/completeProjects') }}">
              <div class="widget-details col-xs-6">
                <h2 class="no-margin">
                    @if($hasAcess == 1)
                        {{$reviewed}}
                    @else
                        {{$limitreviewed}}
                    @endif
                </h2>
                <small class="text-uppercase">Reviewed</small>
              </div>
          </a>
        </section>

      </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-bordered">
                <div class="panel-heading border">
                    <div class="row"><div class="col-xs-6"><strong>Writer Report</strong></div>
                        {{--<div class="col-xs-6 text-right"><button onclick="location.href = '{{url('user/add')}}';" class="btn btn-success"><i class="fa fa-plus" style="width: 28px;"></i>Add</button></div>--}}
                    </div>
                </div>

                <div class="panel-heading ">
                    <form role="form" class="form-horizontal form-validation" method="post" enctype="multipart/form-data">
                        {!!Form::token()!!}
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <div class="form-group col-sm-4">
                                    <label class="col-sm-2 control-label">Writer</label>
                                    <div class="col-sm-10">
                                        @if($errors->has('writer'))                                      
                                            {!! Form::select('writer', array('default' => 'All Writers') + $userList, Input::old('writer'),['class'=>'chosen error','style'=>'width:100%;','required','data-placeholder'=>'Set After','id'=>'writer']) !!}
                                            <label id="supervisor-error" class="error" for="writer">{{$errors->first('writer')}}</label>
                                        @else
                                            {!! Form::select('writer',array('default' => 'All Writers') + $userList ,Input::old('writer'),['class'=>'chosen','style'=>'width:100%;','required','data-placeholder'=>'Set After','id'=>'writer']) !!}
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group col-sm-3">
                                    <label class="col-sm-2 control-label">From</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @if($errors->has('fromdeadline')) error @endif" name="fromdeadline" id="fromdeadline" required placeholder="From" value="{{Input::old('fromdeadline')}}">
                                        @if($errors->has('fromdeadline'))
                                            <label id="label-error" class="error" for="label">{{$errors->first('fromdeadline')}}</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label class="col-sm-2 control-label">To </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @if($errors->has('todate')) error @endif" name="todate" id="todate" required placeholder="To" value="{{Input::old('todate')}}">
                                        @if($errors->has('todate'))
                                            <label id="label-error" class="error" for="label">{{$errors->first('todate')}}</label>
                                        @endif
                                    </div>
                                </div>


                                <div class="pull-left">
                                    {{--<a href="{{URL::previous()}}"><button type="button"  class="btn btn-primary"><i class="fa fa-angle-left"></i> Go Back</button></a>--}}
                                    <button type="button"  id="search" class="btn btn-info"><i class="fa fa-thumbs-o-up"></i> Search</button>
                                    <button type="button"  onclick="tableToExcel('testTable', '<?php echo date('Y-m-d'); ?>')" value="Export to Excel" class="btn btn-primary"><i class="fa fa-book"></i>  Export to Excel</button>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
                <div class="panel-body">
                    <table id="testTable" class="table table-bordered bordered table-striped table-condensed datatable">
                        <thead>
                        <tr>
                            <th class="text-center" width="4%">#</th>
                            <th class="text-center" width="4%">Ref.</th>
                            <th class="text-center" style="font-weight:normal;">Writer</th>
                            <th class="text-center" style="font-weight:normal;">Assigned Date</th>
                            <th class="text-center" style="font-weight:normal;">Review Add Date</th>  
                            <th class="text-center" style="font-weight:normal;">Level</th>
                            <th class="text-center" style="font-weight:normal;">Words Count</th>
                            <th class="text-center" width="4%" style="font-weight:normal;">Action</th>
                        </tr>
                        {{--<tr style="display: none;">--}}
                        {{--<th style="display: none;" width="2%"></th>--}}
                        {{--<th style="display: none;" width="2%"></th>--}}
                        {{--</tr>--}}
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @stop
    @section('js')
            <!-- page level scripts -->
    <script src="{{asset('assets/sammy_new/vendor/d3/d3.min.js')}}"></script>
    <script src="{{asset('assets/sammy_new/vendor/rickshaw/rickshaw.min.js')}}"></script>
    <script src="{{asset('assets/sammy_new/vendor/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('assets/sammy_new/vendor/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('assets/sammy_new/vendor/flot/jquery.flot.categories.js')}}"></script>
    <script src="{{asset('assets/sammy_new/vendor/flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('assets/sammy_new/vendor/excell/tableToExcel.js')}}"></script>
    <!-- /page level scripts -->

    <!-- initialize page scripts -->
    <script src="{{asset('assets/sammy_new/scripts/pages/dashboard.js')}}"></script>
    <!-- /initialize page scripts -->
    <script type="text/javascript">
        var id = 0;
        var table = '';
        $(document).ready(function(){
            table = generateTable('.datatable', '{{url('json/jsondateReview')}}/0/0000-00-00/0000-00-00' , 'get');
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

        });

        $('#search').click(function(e){
            e.preventDefault();
            var y = document.getElementById("writer");
            var re = y.options[y.selectedIndex].value;


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
            table = generateTable('.datatable', '{{url('json/jsondateReview')}}/'+ re +'/'+from +'/'+to , 'get');
        });




    </script>
@stop
