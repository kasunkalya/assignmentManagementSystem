@extends('layouts.sammy_new.master') @section('title','User List')
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
    	<a href="{{{url('/')}}}"><i class="fa fa-home mr5"></i>Home</a>
  	</li>
  	<li>
    	<a href="javascript:;">User Management</a>
  	</li>
  	<li class="active">User List</li>
</ol>
<div class="row">
	<div class="col-xs-12">
		<div class="panel panel-bordered">
      		<div class="panel-heading border">
      			<div class="row"><div class="col-xs-6"><strong>User List</strong></div>
      			<div class="col-xs-6 text-right"><button onclick="location.href = '{{url('user/add')}}';" class="btn btn-success"><i class="fa fa-plus" style="width: 28px;"></i>Add</button></div>
      			</div>
      		</div>
          	<div class="panel-body">
          		<table class="table table-bordered bordered table-striped table-condensed datatable">
	              	<thead>
		                <tr>
		                  	<th rowspan="2" class="text-center" width="4%">#</th>
		                  	<th rowspan="2" class="text-center" style="font-weight:normal;">First Name</th>
		                  	<th rowspan="2" class="text-center" style="font-weight:normal;">Last Name</th>
		                  	<th rowspan="2" class="text-center" width="5%" style="font-weight:normal;">E-mail</th>
							<th rowspan="2" class="text-center" width="5%" style="font-weight:normal;">Mobile No</th>
		                  	<th rowspan="2" class="text-center" style="font-weight:normal;">Username</th>
		                  	<th rowspan="2" class="text-center" style="font-weight:normal;">supervisor</th>		                  	
		                  	<th rowspan="2" class="text-center" width="6%" style="font-weight:normal;">Status</th>
		                  	<th colspan="2" class="text-center" width="4%" style="font-weight:normal;">Action</th>
		                </tr>
		                <tr style="display: none;">
		                	<th style="display: none;" width="2%"></th>
		                	<th style="display: none;" width="2%"></th>
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
		table = generateTable('.datatable', '{{url('user/json/list')}}',[0,6,7],[]);

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

	/**
	 * Delete the menu
	 * Call to the ajax request menu/delete.
	 */
	function deleteFunc(){
		ajaxRequest( '{{url('user/delete')}}' , { 'id' : id  }, 'post', handleData);
	}

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
