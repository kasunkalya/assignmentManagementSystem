@extends('layouts.sammy_new.master') @section('title','Rejected Projects')
@section('current_title','Rejected Projects')
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
        <section class="widget bg-primary text-center" style="height: 99px;">

                <a href="{{ url('/reviewingview') }}">
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
                <a href="{{ url('/reviewedview') }}">
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
                    <div class="row"><div class="col-xs-6"><strong>Rejected Projects</strong></div>
                        {{--<div class="col-xs-6 text-right"><button onclick="location.href = '{{url('user/add')}}';" class="btn btn-success"><i class="fa fa-plus" style="width: 28px;"></i>Add</button></div>--}}
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered bordered table-striped table-condensed datatable">
                        <thead>
                        <tr>
                            <th class="text-center" width="2%">#</th>
		            <th class="text-center" width="2%">Ref.</th>
		            <th class="text-center" style="font-weight:normal;">Added Date</th>
		              @if($hasAcess == 1)
		                  <th class="text-center" style="font-weight:normal;">Student Name</th>
		                  <th class="text-center" style="font-weight:normal;">Writer</th>
		                  <th class="text-center" style="font-weight:normal;">Contact No</th>
		                  <th class="text-center" style="font-weight:normal;">Original Deadline</th>
		                  <th class="text-center" style="font-weight:normal;">Writer Deadline</th>
		              @else
		                  <th class="text-center" style="font-weight:normal;">Deadline</th>
		                  <th class="text-center" style="font-weight:normal;">Level</th>
                                  <th class="text-center" style="font-weight:normal;">Subject</th>
		              @endif
		            <th class="text-center" style="font-weight:normal;">Word Count</th>
		            <th class="text-center" style="font-weight:normal;">File</th>
		             @if($hasAcess == 1)
                            <th class="text-center" width="2%" style="font-weight:normal;">Price</th>
                            @else
                            <th class="text-center" width="2%" style="font-weight:normal;">Status</th>
                            @endif
                            <th class="text-center" width="2%" style="font-weight:normal;">Web Site</th>
		            <th class="text-center" width="2%" style="font-weight:normal;">Action</th>
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

    <!-- /page level scripts -->

    <!-- initialize page scripts -->
    <script src="{{asset('assets/sammy_new/scripts/pages/dashboard.js')}}"></script>
    <!-- /initialize page scripts -->
    <script type="text/javascript">
        var id = 0;
        var table = '';
        $(document).ready(function(){
            table = generateTable('.datatable', '{{url('json/rejectedprojects')}}',[0,0,0],[]);

            table.on('draw.dt',function(){
                $("[data-toggle=tooltip]").tooltip();

                $('.user-activate').change(function(){
                    if($(this).prop('checked')==true){
                        ajaxRequest( '{{url('user/status')}}' , { 'id' : $(this).val() , 'status' : 1 }, 'post', successFunc);
                    }else{
                        ajaxRequest( '{{url('user/status')}}' , { 'id' : $(this).val() , 'status' : 0 }, 'post', successFunc);
                    }
                });

                $('.user-delete').click(function(e){
                    e.preventDefault();
                    id = $(this).data('id');
                    sweetAlertConfirm('Delete Menu', 'Are you sure?',2, deleteFunc);
                });
            });

        });
    </script>
@stop
