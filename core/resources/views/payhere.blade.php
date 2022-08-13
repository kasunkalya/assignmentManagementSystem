<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>essayasia.com - User Login</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">
  <link rel="shortcut icon" href="{{asset('assets/sammy_new/images/icon.png')}}">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

  <!-- page level plugin styles -->
  <!-- /page level plugin styles -->

  <!-- build:css({.tmp,app}) styles/app.min.css -->
  <link rel="stylesheet" href="{{asset('assets/sammy_new/vendor/bootstrap/dist/css/bootstrap.css')}}">
  <link rel="stylesheet" href="{{asset('assets/sammy_new/vendor/perfect-scrollbar/css/perfect-scrollbar.css')}}">
  <link rel="stylesheet" href="{{asset('assets/sammy_new/vendor/checkbo/src/0.1.4/css/checkBo.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/sammy_new/vendor/sweetalert/lib/sweet-alert.css')}}">
  <link rel="stylesheet" href="{{asset('assets/sammy_new/styles/roboto.css')}}">
  <link rel="stylesheet" href="{{asset('assets/sammy_new/styles/font-awesome.css')}}">
  <link rel="stylesheet" href="{{asset('assets/sammy_new/styles/panel.css')}}">
  <link rel="stylesheet" href="{{asset('assets/sammy_new/styles/feather.css')}}">
  <link rel="stylesheet" href="{{asset('assets/sammy_new/styles/animate.css')}}">
  <link rel="stylesheet" href="{{asset('assets/sammy_new/styles/urban.css')}}">
  <link rel="stylesheet" href="{{asset('assets/sammy_new/styles/urban.skins.css')}}">

<style type="text/css">
  
  .form-layout {
      margin: 0 auto;
      padding: 15px;
      border: 1px solid rgb(99, 98, 98);
      background: rgba(0, 0, 0, 0.39);
  }

  p {
    color: rgba(255, 255, 255, 0.5);
    font-family:'Raleway' sans-serif;
    font-size: 14px;
}

.bg-white {
    color: #fff;
    font-family:'Raleway'sans-serif;
    font-size: 14px;
    
}

.center-wrapper {
  display: table;
  width: 100%;
  height: 100%;
  position: relative;
  background:url("../../../images/home_banner_new.jpg")  no-repeat center center fixed;
}

</style>
</head>

<body>

  <div class="app center-logwrapper layout-fixed-header bg-white usersession">
    <div class="full-height">
      <div class="center-wrapper">
        <div class="center-content">
          <div class="row no-margin">
            <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                <form method="post" class="form-layout">
                    <div class="form-inputs">
                        <input type="text" name="requestId" id="requestId" class="form-control input-lg" placeholder="RequestId" autocomplete="off" value="{{{Input::old('requestId')}}}">
                    </div>
                    <button class="btn btn-success btn-block btn-lg mb15" type="button" id="search">
                      <span>SEARCH</span>
                    </button>
                </form>
                <div id="myDIV">
                    <form method="post" class="form-layout checkbo" action="https://sandbox.payhere.lk/pay/checkout">   
                        <input type="hidden" name="merchant_id" value="121XXXX">    <!-- Replace your Merchant ID -->
                        <input type="hidden" name="return_url" value="http://sample.com/return">
                        <input type="hidden" name="cancel_url" value="http://sample.com/cancel">
                        <input type="hidden" name="notify_url" value="http://sample.com/notify">  
                        <br><br>Customer Details<br>
                        <input type="text" class="form-control input-lg" id="first_name" name="first_name" value="">    
                        <input type="hidden" name="last_name" value="">            
                        <input type="text" class="form-control input-lg" id="email" name="email" value="">
                        <input type="text" class="form-control input-lg" id="phone" name="phone" value="">  
                        <input type="hidden" name="address" value="">
    			<input type="hidden" name="city" value="">
    			<input type="hidden" name="country" value=""><br><br>             
                        <br><br>Payment Details<br>
                        <input type="hidden" class="form-control input-lg" id="order_id" name="order_id" value="">
                        <input type="text" class="form-control input-lg" id="items" name="items" value="">
                        <input type="text" class="form-control input-lg"  name="currency" value="LKR">
                        <input type="text" class="form-control input-lg" id="amount" name="amount" value="">  

                        <input type="submit" class="btn btn-success btn-block btn-lg mb15"  value="Buy Now">  
                        <button class="btn btn-success btn-block btn-lg mb15" type="button" id="search">
	                      <span>SEARCH</span>
	               	</button> 
                    </form> 
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- build:js({.tmp,app}) scripts/app.min.js -->
  <script src="{{asset('assets/sammy_new/scripts/extentions/modernizr.js')}}"></script>
  <script src="{{asset('assets/sammy_new/vendor/jquery/dist/jquery.js')}}"></script>
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
  <script src="{{asset('assets/sammy_new/vendor/sweetalert/lib/sweet-alert.min.js')}}"></script>
  <script src="{{asset('assets/sammy_new/vendor/chosen_v1.4.0/chosen.jquery.min.js')}}"></script>
  <script src="{{asset('assets/sammy_new/vendor/checkbo/src/0.1.4/js/checkBo.min.js')}}"></script>

  <script type="text/javascript"> 
    
        $(document).ready(function(){
          var x = document.getElementById("myDIV");
            x.style.display = "none";
        });
      
        $('#search').click(function(e){           
            var requestId = document.getElementById("requestId").value;         
            
            if(requestId == ''){
                sweetAlert('Error Occured','Please enter request id !');
                return ;
            }                
                swal({
                    title: 'Are you sure?',
                    text: 'You want to pay ?',
                    type: 'warning',
                    showConfirmButton : true,
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: true,
                    showCancelButton: true,
                    showSpinner: true
                }, acceptFunc);
        });
        
        function acceptFunc(){   
            var requestId = document.getElementById("requestId").value;           
           $.ajax({
                url: "{{url('pay/oder')}}",                
                 type: "GET",
                 data: ({id:requestId}),                   
                success: function(data){  
                    var len = data.length;                  
                     if(len ==0){
                         sweetAlert('Error Occured','Please enter correct request id !');              
                         var x = document.getElementById("myDIV");
                         x.style.display = "none";
                         
                     }else{
                        var x = document.getElementById("myDIV");
                        x.style.display = "block";                          
                        document.getElementById("order_id").value = data[0][1];
                        document.getElementById("items").value = data[0][7];
                        document.getElementById("amount").value = data[0][8];
                        document.getElementById("first_name").value = data[0][3];
                        document.getElementById("email").value = data[0][4];
                        document.getElementById("phone").value = data[0][5];    
                    }
                }
                    
                  //$(this).addClass("done");
                
            });
      
        }
        
        
  </script>
  <!-- endbuild -->
</body>

</html>
