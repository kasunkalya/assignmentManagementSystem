<!--
##############################################################
#     Admin Panel - Laravel 5.1                              #
#                                                            #
#     Author - Kasun kalya <kasun.kalya@gmail.com>    #
#     Version 1.0                                            #
#     Copyright Sammy 2015                                   #
##############################################################
-->

<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>essayasia.com  | @yield('title')</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="{{asset('assets/sammy_new/images/icon.png')}}">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

  <!-- page level plugin styles -->
  <link rel="stylesheet" href="{{asset('assets/sammy_new/vendor/chosen_v1.4.0/chosen.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/sammy_new/vendor/checkbo/src/0.1.4/css/checkBo.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/sammy_new/vendor/sweetalert/lib/sweet-alert.css')}}">
  <link rel="stylesheet" href="{{asset('assets/sammy_new/vendor/datatables/media/css/jquery.dataTables.css')}}">
  <!-- /page level plugin styles -->

  <!-- build:css({.tmp,app}) styles/app.min.css -->
  <link rel="stylesheet" href="{{asset('assets/sammy_new/vendor/bootstrap/dist/css/bootstrap.css')}}">
  <link rel="stylesheet" href="{{asset('assets/sammy_new/vendor/perfect-scrollbar/css/perfect-scrollbar.css')}}">
  <link rel="stylesheet" href="{{asset('assets/sammy_new/styles/roboto.css')}}">
  <link rel="stylesheet" href="{{asset('assets/sammy_new/styles/font-awesome.css')}}">
  <link rel="stylesheet" href="{{asset('assets/sammy_new/styles/panel.css')}}">
  <link rel="stylesheet" href="{{asset('assets/sammy_new/styles/feather.css')}}">
  <link rel="stylesheet" href="{{asset('assets/sammy_new/styles/animate.css')}}">
  <link rel="stylesheet" href="{{asset('assets/sammy_new/styles/urban.css')}}">
  <link rel="stylesheet" href="{{asset('assets/sammy_new/styles/urban.skins.css')}}">
  <link rel="stylesheet" href="{{asset('assets/sammy_new/vendor/jquery.multiselect/css/multi-select.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
  <link rel="stylesheet" type="text/css" media="screen" href="http://cdnjs.cloudflare.com/ajax/libs/fancybox/1.3.4/jquery.fancybox-1.3.4.css"/>
  <!-- endbuild -->
  <style type="text/css">
    .vertical-align-middle{
      vertical-align:middle !important;
    }

    .datatable a{
      font-size: 16px;
    }

    .datatable a:hover{
      font-size: 16px;
      color: #3B3B3B;
      transition: all .3s;
      -webkit-transition: all .3s;
      -moz-transition: all .3s;
    }

    .datatable a.blue{
      color: #1E88E5;
    }

    .datatable a.blue:hover{
      color: #0D47A1;
    }

    .datatable a.red{
      color: #E53935;
    }

    .datatable a.red:hover{
      color: #B71C1C;
    }

    .datatable a.green{
      color: #00C853;
    }

    .datatable a.green:hover{
      color: #2E7D32;
    }

    .datatable a.disabled{
      color: #565656;
    }

    .table.table-condensed > thead > tr > th,
    .table.table-condensed > tbody > tr > th,
    .table.table-condensed > tfoot > tr > th,
    .table.table-condensed > thead > tr > td,
    .table.table-condensed > tbody > tr > td,
    .table.table-condensed > tfoot > tr > td {
      padding: 6px 10px;
    }

    .sweet-alert{
      border-radius: 0;
    }

    .sweet-alert button{
      border-radius: 0;
    }

    .sweet-alert button.cancel{
      background-color: #E05A5A;
      transition: all .4s;
      -webkit-transition: all .4s;
      -moz-transition: all .4s;
    }

    .sweet-alert button.cancel:hover{
      background-color: #CC4D4D;
    }

    .sidebar-panel {
      background-color:#37A7E4;
    }

    .sidebar-panel > .brand {
      background-color: #37A7E4;
    }

    .body{
      font-size: 16px;
    }

    .main-panel > .header {
      background-color: #37A7E4;
    }

    .main-panel > .header .navbar-text {
      color: #FFFFFF;
    }

    .main-panel > .header .nav > li > a {
      color: #FFFFFF;
    }

    .border-danger {
      border-color: #D96557;
    }

    .bg-danger {
      color: white;
      background-color: #D96557;
    }

    .breadcrumb > li{
      display: inline-block;
      color: #292929;
    }

    .breadcrumb > li:hover{
      color: #D96557;
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

    b, strong {
      font-weight: normal;
    }

    .breadcrumb > li + li:before{
      color: #4A4A4A;
    }

    .bootstrap-tagsinput{
      display: block;
      width: 100%;
      padding: 6px 12px;
      line-height: 1.42857143;
      color: #555;
      background-color: #fff;
      background-image: none;
      border: 1px solid #ccc;
      border-color: #e4e4e4;
      font-weight: 400;
      font-size: 13px;
      -webkit-font-smoothing: antialiased;
      -webkit-border-radius: 2px;
      -moz-border-radius: 2px;
      border-radius: 2px;
      -webkit-transition: border 300ms linear;
      -moz-transition: border 300ms linear;
      -o-transition: border 300ms linear;
      transition: border 300ms linear;
      -webkit-box-shadow: none;
      -moz-box-shadow: none;
      box-shadow: none;
    }

    .bootstrap-tagsinput .tag{
      padding: 3px 6px 4px;
      font-size: 14px;
      font-weight: 100;
      line-height: 2.2;
      border-radius: 2px;
    }

    .sidebar-panel > nav li ul li a{
   		padding: 10px 25px 10px 50px;
    }

    .sidebar-panel > nav > ul > li a{
    	padding: 13px 20px;
    }

    .sidebar-panel > nav ul > li > a .fa{
    	width: 25px;
    }
  </style>

  @yield('css')

</head>

<body>

  <div class="app layout-fixed-header">

    <!-- sidebar panel -->
    <div class="sidebar-panel offscreen-left">

      <div class="brand">

        <!-- logo -->
        <div class="brand-logo" style="margin-top: 0px;font-size: 35px;color: #fff;font-family: 'Source Sans Pro', sans-serif;
    margin-left: 0%;">
          <img src="{{asset('assets/sammy_new/images/logo-dark1.png')}}" style="width: 55%;
    height: 1%; margin: 5px;" />
        </div>
        <!-- /logo -->

        <!-- toggle small sidebar menu -->
        {{--<a href="javascript:;" class="toggle-sidebar hidden-xs hamburger-icon v3" data-toggle="layout-small-menu">--}}
          {{--<span></span>--}}
          {{--<span></span>--}}
          {{--<span></span>--}}
          {{--<span></span>--}}
        {{--</a>--}}
        <!-- /toggle small sidebar menu -->

      </div>

      <!-- main navigation -->
      <nav role="navigation">
        @include('includes.menu')
      </nav>
      <!-- /main navigation -->

    </div>
    <!-- /sidebar panel -->

    <!-- content panel -->
    <div class="main-panel">

      <!-- top header -->
      <header class="header navbar">

        <div class="brand visible-xs">
          <!-- toggle offscreen menu -->
          <div class="toggle-offscreen">
            <a href="#" class="hamburger-icon visible-xs" data-toggle="offscreen" data-move="ltr">
              <span></span>
              <span></span>
              <span></span>
            </a>
          </div>
          <!-- /toggle offscreen menu -->

          <!-- logo -->
          <div class="brand-logo">
            <img src="{{asset('assets/sammy_new/images/logo-dark1.png')}}" height="15" alt="" style="width: 50%;height:50%;margin-top: -5%;">
          </div>
          <!-- /logo -->
        </div>

        <ul class="nav navbar-nav hidden-xs">
          <li>
            <p class="navbar-text" style="font-weight: bold !important; font-weight: 900 !important;">
              @yield('current_title')
            </p>
          </li>
        </ul>

        <ul class="nav navbar-nav navbar-right hidden-xs">    
              @include('includes.user')
        </ul>
        <ul class="nav navbar-nav navbar-right hidden-xs"  id="demo2">          
        </ul>
          
        
      </header>
        
      <!-- /top header -->

      <!-- main area -->
      <div class="main-content">
          <div id="demo3"></div>
        
        @yield('content')
      </div>
      <!-- /main area -->
    </div>
    <!-- /content panel -->

    <!-- bottom footer -->
    <footer class="content-footer">

      <nav class="footer-right">
        <ul class="nav">
          <li>
            <a href="javascript:;" class="scroll-up">
              <i class="fa fa-angle-up"></i>
            </a>
          </li>
        </ul>
      </nav>

      <nav class="footer-left">
        <ul class="nav">
          <li>
            <p class="text-muted">© 2014-<?php echo date('Y'); ?> Dynamic Software Solutions | Design by <a href="http://www.dynamicsofts.com/" target="_blank">Dynamic Software Solutions</a> | Dynamic Software Solutions All Rights Reserved. </p>
          </li>
          <li>
            <a href="http://essayasia.com/Data Security Policy.pdf" target="_blank">
                Privacy Policy
            </a>
          </li>
        </ul>
      </nav>

    </footer>
    <!-- /bottom footer -->
  </div>
  <!-- build:js({.tmp,app}) {{asset('assets/sammy_new/scripts/app.min.js')}} -->
  <script src="{{asset('assets/sammy_new/scripts/extentions/modernizr.js')}}"></script>
  <script src="{{asset('assets/sammy_new/vendor/jquery/dist/jquery-2.0.1.js')}}"></script>
  <script src="{{asset('assets/sammy_new/vendor/bootstrap/dist/js/bootstrap.js')}}"></script>
  <script src="{{asset('assets/sammy_new/vendor/jquery.easing/jquery.easing.js')}}"></script>
  <script src="{{asset('assets/sammy_new/vendor/fastclick/lib/fastclick.js')}}"></script>
  <script src="{{asset('assets/sammy_new/vendor/onScreen/jquery.onscreen.js')}}"></script>
  <script src="{{asset('assets/sammy_new/vendor/jquery-countTo/jquery.countTo.js')}}"></script>
  <script src="{{asset('assets/sammy_new/vendor/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
  <script src="{{asset('assets/sammy_new/scripts/ui/accordion.js')}}"></script>
  <script src="{{asset('assets/sammy_new/scripts/ui/animate.js')}}"></script>
  <script src="{{asset('assets/sammy_new/scripts/ui/link-transition.js')}}"></script>
  <script src="{{asset('assets/sammy_new/scripts/ui/panel-controls.js')}}"></script>
  <script src="{{asset('assets/sammy_new/scripts/ui/preloader.js')}}"></script>
  <script src="{{asset('assets/sammy_new/scripts/ui/toggle.js')}}"></script>
  <script src="{{asset('assets/sammy_new/scripts/urban-constants.js')}}"></script>
  <script src="{{asset('assets/sammy_new/scripts/extentions/lib.js')}}"></script>
  <script src="{{asset('assets/sammy_new/vendor/jquery.multiselect/js/jquery.multi-select.js')}}"></script>
  <!-- endbuild -->
  <script src="{{asset('assets/sammy_new/vendor/chosen_v1.4.0/chosen.jquery.min.js')}}"></script>
  <script src="{{asset('assets/sammy_new/vendor/checkbo/src/0.1.4/js/checkBo.min.js')}}"></script>
  <script src="{{asset('assets/sammy_new/vendor/sweetalert/lib/sweet-alert.min.js')}}"></script>
  <script src="{{asset('assets/sammy_new/vendor/datatables/media/js/jquery.dataTables.js')}}"></script>
  <script src="{{asset('assets/sammy_new/scripts/extentions/bootstrap-datatables.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
  <script src="{{asset('assets/sammy_new/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>
  <script src="{{asset('assets/vendor/typehead/typehead.js')}}"></script>
  <script src="{{asset('assets/angular/vendor/angular/angular.min.js')}}"></script>
  <script src="{{asset('assets/angular/vendor/api-check-7.5.5/api-check.min.js')}}"></script>
  <script src="{{asset('assets/angular/vendor/angular-formly-7.3.3/formly.min.js')}}"></script>
  <script src="{{asset('assets/angular/vendor/angular-bootstrap/ui-bootstrap-0.14.3.min.js')}}"></script>
  <!-- Custom DataTable Generator -->
  <script src="{{asset('assets/sammy_new/scripts/custom/custom_functions.js')}}"></script>

  <script type="text/javascript">
    $(document).ready(function(){   
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
 
             var userlog= {{$user->id}}; 
            ajaxRequest( '{{url('chat/ischat')}}' , { 'userlog' : userlog}, 'get', chatcount);
            setInterval(function()
                {
                    var userlog= {{$user->id}}; 
                   
                    if(userlog ==''){          
                            window.location.href = "{{url('user/logout')}}";   
                      }
                    else{  
                    
                        //ajaxRequest( '{{url('chat/getlivechat')}}' , { 'toId' : id,'fromId':userlog}, 'get', handleDatareviewrefresh);                    
                        //ajaxRequest( '{{url('chat/ischat')}}' , { 'userlog' : userlog}, 'get', chatcount);
                    }
               
                    ajaxRequest( '{{url('chat/ischat')}}' , { 'userlog' : userlog}, 'get', chatcount);
                }, 10000); //10000 milliseconds = 10 seconds
//      
      
      
      $('form').checkBo();
      $('.chosen').chosen();
//      @if(session('success'))
//        sweetAlert('{{session('success.title')}}', '{{session('success.message')}}',0);
//                var xhttp = new XMLHttpRequest();
//                xhttp.open("POST", "https://sms.textware.lk:5001/sms/send_sms.php", true);
//                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//                xhttp.send('{{session('success.link')}}');


      @elseif(session('error'))
        sweetAlert('{{session('error.title')}}','{{session('error.message')}}',2);
      @elseif(session('warning'))
        sweetAlert('{{session('warning.title')}}','{{session('warning.message')}}',3);
      @elseif(session('info'))
        sweetAlert('{{session('info.title')}}','{{session('info.message')}}',1);
      @endif
      
      
 
    });
   
   
   
     function chatcount(data){
  //alert();
            //var userlog= document.getElementById("user").value;  
            //var oldCount=localStorage.getItem("userlog");
            
            if(data.length >0){
                var content2="";
                document.getElementById("demo3").innerHTML='';
                content2 +='<div class="alert alert-success alert-dismissible fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>You have new messages.</strong></div>';
                document.getElementById("demo3").innerHTML =content2 ;
            }
            else{
                document.getElementById("demo3").innerHTML='';
            }
            
            var content="";          
            if(data.length >0){
                   
            document.getElementById("demo2").innerHTML='';
             content +='<li><a href="" data-toggle="dropdown"><i class="fa fa-bell-o"></i><div class="status bg-danger border-danger animated bounce"></div></a><ul class="dropdown-menu notifications">';
            for (i = 0; i < data.length; i++) {                  
                var idsender=data[i][1];             
                content +='<li class="notifications-header"><p class="text-muted small"><a href="<?php echo url("chat/add/") ?>/'+idsender+'" >You have new messages from '+data[i][0]+' </a></p></li>';  
            }
             content +='</ul></li>';
             document.getElementById("demo2").innerHTML =content ;
           // alert(data+'//'+oldCount);
//            if(data !=0 && oldCount <= data){
//                   //alert(data);
//                document.getElementById("demo2").innerHTML='';        
//                   var content="";
//                    content +='<li><a href="{{{url("chat/add")}}}" data-toggle="dropdown"><i class="fa fa-bell-o"></i><div class="status bg-danger border-danger animated bounce"></div></a><ul class="dropdown-menu notifications"><li class="notifications-header"><p class="text-muted small"><a href="{{{url("chat/add")}}}" >You have '+data+' new messages</a></p></li></ul></li>';
//                    document.getElementById("demo2").innerHTML =content ;
//                    localStorage.setItem("userlog", data);
//                //alert(localStorage.getItem("lastname"));  
//            }
//            else{
//                document.getElementById("demo2").innerHTML ='';
//            }
            }
            else{
                document.getElementById("demo2").innerHTML ='';
            }
      
     }
              
        function handleDatareviewrefresh(data){
            document.getElementById("demo").innerHTML='';            
            var userlog= document.getElementById("user").value;
            var content="";
            var i;
            if(data.length >0){
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
//            var objDiv = document.getElementById("demo");
//            objDiv.scrollTop = objDiv.scrollHeight; 
 
        }
  </script>

  @yield('js')
</body>

</html>

