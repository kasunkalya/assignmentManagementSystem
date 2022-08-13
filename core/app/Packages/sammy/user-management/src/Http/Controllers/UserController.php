<?php
namespace Sammy\UserManage\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Sammy\UserManage\Models\User;
use Sammy\UserRoles\Models\UserRole;
use Sammy\permissions\Models\Permission;
use Sammy\UserManage\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Response;
use Sentinel;
use Hash;
use Activation;


class UserController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| User Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('guest');
	}

	/**
	 * Show the User add screen to the user.
	 *
	 * @return Response
	 */
	public function addView()
	{
		$user = User::all()->lists('full_name' , 'id' );
		$roles = UserRole::all()->lists('name' , 'id' );		
		return view( 'userManage::user.add' )->with([ 'users' => $user,
			'roles' => $roles
		 ]);;
	}

	public function addwriterView()
	{
		$user = User::all()->lists('full_name' , 'id' );
		$userd = Sentinel::getUser();
		if($userd->roles[0]->id ==8) {
			$roles = UserRole::select()->where('id', 9)->orWhere('id', 10)->lists('name', 'id');
		}
		else{
			$roles = UserRole::select()->where('id', 9)->lists('name', 'id');
		}

		return view( 'userManage::user.addwriter' )->with([ 'users' => $user,
			'roles' => $roles
		]);;
	}
	/**
	 * Add new user data to database
	 *
	 * @return Redirect to menu add
	 */
	public function add(UserRequest $request)
	{
		
		$supervisor = User::find( $request->get('supervisor') );
		$credentials = [
		    'first_name'    => $request->get( 'first_name' ),
		    'last_name' => $request->get('last_name' ),
		    'email' => $request->get('email' ),
			'mobileNo' => $request->get('mobileNo' ),
		    'username' => $request->get('username' ),
		    'password' => $request->get('password' ),
		];

		$user = Sentinel::registerAndActivate($credentials);	
		
		$user->makeChildOf($supervisor);
		foreach ($request->get( 'roles' ) as $key => $value) {
			$role = Sentinel::findRoleById($value);
	   	    $role->users()->attach($user);
		}
		return redirect('user/add')->with([ 'success' => true,
			'success.message'=> 'User added successfully!',
			'success.title' => 'Well Done!']);
	}


	public function addwriter(UserRequest $request)
	{

		$supervisor = User::find( $request->get('supervisor') );
		$credentials = [
			'first_name'    => $request->get( 'first_name' ),
			'last_name' => $request->get('last_name' ),
			'email' => $request->get('email' ),
			'mobileNo' => $request->get('mobileNo' ),
			'username' => $request->get('username' ),
			'password' => $request->get('password' ),
		];

		$user = Sentinel::registerAndActivate($credentials);

		$user->makeChildOf($supervisor);
		foreach ($request->get( 'roles' ) as $key => $value) {
			$role = Sentinel::findRoleById($value);
			$role->users()->attach($user);
		}
		return redirect('user/addwriter')->with([ 'success' => true,
			'success.message'=> 'User added successfully!',
			'success.title' => 'Well Done!']);
	}

	/**
	 * Show the user add screen to the user.
	 *
	 * @return Response
	 */
	public function listView()
	{
		return view( 'userManage::user.list' );
	}

	public function listWriter()
	{
		return view( 'userManage::user.listWriter' );
	}


	/**
	 * Show the user add screen to the user.
	 *
	 * @return Response
	 */
	public function jsonList(Request $request)
	{
		if($request->ajax()){
			 $data= User::get();			
			$jsonList = array();
			$i=1;
			foreach ($data as $key => $user) {
				$dd = array();
				array_push($dd, $i);
				
				if($user->first_name != ""){
					array_push($dd, $user->first_name);
				}else{
					array_push($dd, "-");
				}
				if($user->last_name != ""){
					array_push($dd, $user->last_name);
				}else{
					array_push($dd, "-");
				}

				if($user->email != ""){
					array_push($dd, $user->email);
				}else{
					array_push($dd, "-");
				}
				if($user->mobileNo != ""){
					array_push($dd, $user->mobileNo);
				}else{
					array_push($dd, "-");
				}
				if($user->username != ""){
					array_push($dd, $user->username);
				}else{
					array_push($dd, "-");
				}
				if($user->supervisor_id != ""){
					array_push($dd, Sentinel::findById($user->supervisor_id)->first_name.' '.Sentinel::findById($user->supervisor_id)->last_name);
				}else{
					array_push($dd, "-");
				}

				if($user->status == 1){
					array_push($dd, '<label class="switch switch-sm" data-toggle="tooltip" data-placement="top" title="Deactivate"><input class="user-activate" type="checkbox" checked value="'.$user->id.'"><span style="position:inherit;"><i class="handle" style="position:inherit;"></i></span></label>');
				}else{
					array_push($dd, '<label class="switch switch-sm" data-toggle="tooltip" data-placement="top" title="Activate"><input class="user-activate" type="checkbox" value="'.$user->id.'"><span style="position:inherit;"><i class="handle" style="position:inherit;"></i></span></label>');
				}

				$permissions = Permission::whereIn('name',['user.edit','admin'])->where('status','=',1)->lists('name');
				if(Sentinel::hasAnyAccess($permissions)){
					array_push($dd, '<a href="#" class="blue" onclick="window.location.href=\''.url('user/edit/'.$user->id).'\'" data-toggle="tooltip" data-placement="top" title="Edit Menu"><i class="fa fa-pencil"></i></a>');
				}else{
					array_push($dd, '<a href="#" class="disabled" data-toggle="tooltip" data-placement="top" title="Edit Disabled"><i class="fa fa-pencil"></i></a>');
				}

				$permissions = Permission::whereIn('name',['user.delete','admin'])->where('status','=',1)->lists('name');
				if(Sentinel::hasAnyAccess($permissions)){
					array_push($dd, '<a href="#" class="red user-delete" data-id="'.$user->id.'" data-toggle="tooltip" data-placement="top" title="Delete User"><i class="fa fa-trash-o"></i></a>');
				}else{
					array_push($dd, '<a href="#" class="disabled" data-toggle="tooltip" data-placement="top" title="Delete Disabled"><i class="fa fa-trash-o"></i></a>');
				}

				array_push($jsonList, $dd);
				$i++;
			}
			return Response::json(array('data'=>$jsonList));
		}else{
			return Response::json(array('data'=>[]));
		}
	}


	/**
	 * Show the user add screen to the user.
	 *
	 * @return Response
	 */
	public function jsonListWriter(Request $request)
	{
		if($request->ajax()){
			$data=DB::table('users')->join('role_users', 'role_users.user_id', '=', 'users.id')->where('role_users.role_id','9')->orWhere('role_users.role_id','10')->get();
			$jsonList = array();
			$i=1;
			foreach ($data as $key => $user) {
				$dd = array();
				array_push($dd, $i);
				
				$assignment = DB::table('assignment_request')->where('assignto', $user->id)->count();
				
				$roll = DB::table('roles')->where('id', $user->role_id)->get();

				if($user->first_name != ""){
					array_push($dd, $user->first_name);
				}else{
					array_push($dd, "-");
				}
				if($user->last_name != ""){
					array_push($dd, $user->last_name);
				}else{
					array_push($dd, "-");
				}
				array_push($dd, $roll[0]->name);

				if($user->email != ""){
					array_push($dd, $user->email);
				}else{
					array_push($dd, "-");
				}
				if($user->mobileNo != ""){
					array_push($dd, $user->mobileNo);
				}else{
					array_push($dd, "-");
				}
				if($user->username != ""){
					array_push($dd, $user->username);
				}else{
					array_push($dd, "-");
				}
				if($user->status == 1){
					array_push($dd, '<label class="switch switch-sm" data-toggle="tooltip" data-placement="top" title="Deactivate"><input class="user-activate" type="checkbox" checked value="'.$user->id.'"><span style="position:inherit;"><i class="handle" style="position:inherit;"></i></span></label>');
				}else{
					array_push($dd, '<label class="switch switch-sm" data-toggle="tooltip" data-placement="top" title="Activate"><input class="user-activate" type="checkbox" value="'.$user->id.'"><span style="position:inherit;"><i class="handle" style="position:inherit;"></i></span></label>');
				}

				$permissions = Permission::whereIn('name',['writer.edit'])->where('status','=',1)->lists('name');
				if(Sentinel::hasAnyAccess($permissions)){
					array_push($dd, '<a href="#" class="blue" onclick="window.location.href=\''.url('user/editmin/'.$user->id).'\'" data-toggle="tooltip" data-placement="top" title="Edit Menu"><i class="fa fa-pencil"></i></a>');
				}else{
					array_push($dd, '<a href="#" class="disabled" data-toggle="tooltip" data-placement="top" title="Edit Disabled"><i class="fa fa-pencil"></i></a>');
				}

				$permissions = Permission::whereIn('name',['writer.delete','admin'])->where('status','=',1)->lists('name');
				if(Sentinel::hasAnyAccess($permissions) && $assignment ==0){
					array_push($dd, '<a href="#" class="red user-delete" data-id="'.$user->id.'" data-toggle="tooltip" data-placement="top" title="Delete User"><i class="fa fa-trash-o"></i></a>');
				}else{
					array_push($dd, '<a href="#" class="disabled" data-toggle="tooltip" data-placement="top" title="Delete Disabled"><i class="fa fa-trash-o"></i></a>');
				}

				array_push($jsonList, $dd);
				$i++;
			}
			return Response::json(array('data'=>$jsonList));
		}else{
			return Response::json(array('data'=>[]));
		}
	}


	/**
	 * Activate or Deactivate User
	 * @param  Request $request user id with status to change
	 * @return json object with status of success or failure
	 */
	public function status(Request $request)
	{
		if($request->ajax()){
			$id = $request->input('id');
			$status = $request->input('status');

			$user = User::find($id);
			if($user){
				$user->status = $status;
				$user->save();
				return response()->json(['status' => 'success']);
			}else{
				return response()->json(['status' => 'invalid_id']);
			}
		}else{
			return response()->json(['status' => 'not_ajax']);
		}
	}

	/**
	 * Delete a User
	 * @param  Request $request user id
	 * @return Json           	json object with status of success or failure
	 */
	public function delete(Request $request)
	{
		if($request->ajax()){
			$id = $request->input('id');

			$user = User::find($id);
			if($user){
				$user->delete();
				return response()->json(['status' => 'success']);
			}else{
				return response()->json(['status' => 'invalid_id']);
			}
		}else{
			return response()->json(['status' => 'not_ajax']);
		}
	}

	/**
	 * Show the user edit screen to the user.
	 *
	 * @return Response
	 */
	public function editView($id)
	{
		$user = User::all()->lists('full_name' , 'id' );
	    $curUserold = User::with(['roles'])->where('id',$id)->take(1)->get();;
	    $curUser=$curUserold[0];  
	    $srole = array();
	    foreach ($curUser->roles as $key => $value) {
	    	array_push($srole, $value->id);
	    }
	  

	    $roles = UserRole::all()->lists('name' , 'id' );
		if($curUser){
			return view( 'userManage::user.edit' )->with([ 
				'curUser' => $curUser,
				'users'=>$user,
				'roles'=>$roles,
				'srole'=>$srole

				 ]);
		}else{
			return view( 'errors.404' );
		}
	}

	public function editminView($id)
	{
		$user = User::all()->lists('full_name' , 'id' );
		$curUserold = User::with(['roles'])->where('id',$id)->take(1)->get();;
		$curUser=$curUserold[0];
		$srole = array();
		foreach ($curUser->roles as $key => $value) {
			array_push($srole, $value->id);
		}


		$userd = Sentinel::getUser();
		if($userd->roles[0]->id ==8) {
			$roles = UserRole::select()->where('id', 9)->orWhere('id', 10)->orWhere('id', 8)->lists('name', 'id');
		}
		else{
			$roles = UserRole::select()->where('id', 9)->lists('name', 'id');
		}

		if($curUser){
			return view( 'userManage::user.editmin' )->with([
				'curUser' => $curUser,
				'users'=>$user,
				'roles'=>$roles,
				'srole'=>$srole,
				'role'=>$userd->roles[0]->id

			]);
		}else{
			return view( 'errors.404' );
		}
	}
	/**
	 * Add new user data to database
	 *
	 * @return Redirect to menu add
	 */
	public function edit(UserRequest $request, $id)
	{
		//return $request->get('email' );
		$emailcount = User::where('id', '!=', $id)->where('email', '=', $request->get('email'))->count();
		$usercount = User::where('id', '!=', $id)->where('username', '=', $request->get('username'))->count();
		if ($emailcount == 0) {
			if ($usercount == 0) {
				$userOld = User::with(['roles'])->where('id', $id)->take(1)->get();
				$user = $userOld[0];
				$user->first_name = $request->get('first_name');
				$user->last_name = $request->get('last_name');
				$user->email = $request->get('email');
				$user->mobileNo = $request->get('mobileNo');
				$user->username = $request->get('username');
				$user->makeChildOf(Sentinel::findById($request->get('supervisor')));

				foreach ($user->roles as $key => $value) {
					$role = Sentinel::findRoleById($value->id);
					$role->users()->detach($user);
				}

				$user->save();
				//attach user for role
				foreach ($request->get('roles') as $key => $value) {
					$role = Sentinel::findRoleById($value);
					$role->users()->attach($user);
				}
				return redirect('user/list')->with(['success' => true,
					'success.message' => 'User updated successfully!',
					'success.title' => 'Good Job!']);
			} else {
				return redirect('user/edit/' . $id)->with(['error' => true,
					'error.message' => 'User Already Exsist!',
					'error.title' => 'Duplicate!']);
			}

		} else {
			return redirect('user/edit/' . $id)->with(['error' => true,
				'error.message' => 'Email Already Exsist!',
				'error.title' => 'Duplicate!']);
		}

	}
		public function editmin(UserRequest $request, $id)
	{
		//return $request->get('email' );
		$emailcount= User::where('id', '!=', $id)->where('email', '=',$request->get('email' ))->count();
		$usercount= User::where('id', '!=', $id)->where('username', '=',$request->get('username' ))->count();
		//return $usercount;
		if($emailcount==0){
				if($usercount==0){
				$credentials = [
					'first_name'    => $request->get( 'first_name' ),
					'last_name' => $request->get('last_name' ),
					'password' => $request->get('password' ),
					'email' => $request->get('email' ),
					'mobileNo' => $request->get('mobileNo'),
				];

					Sentinel::update($id, $credentials);
				//return $request->roles;
				if($request->roles !=null) {
					foreach ($request->roles as $key => $value) {
						DB::table('role_users')->where('user_id', $id)->update(['role_id' => $value]);
					}
				}

				return redirect('user/editmin/'.$id)->with([ 'success' => true,
					'success.message'=> 'User updated successfully!',
					'success.title' => 'Good Job!' ]);
			}else{
				return redirect('user/editmin/'.$id)->with([ 'error' => true,
					'error.message'=> 'User Already Exsist!',
					'error.title' => 'Duplicate!']);
			}

		}else{
			return redirect('user/editmin/'.$id)->with([ 'error' => true,
				'error.message'=> 'Email Already Exsist!',
				'error.title' => 'Duplicate!']);
		}


	}
		

}
