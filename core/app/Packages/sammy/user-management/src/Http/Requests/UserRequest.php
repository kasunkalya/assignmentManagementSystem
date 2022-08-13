<?php
namespace Sammy\UserManage\Http\Requests;

use App\Http\Requests\Request;
use Input;

class UserRequest extends Request {

	public function authorize(){
		return true;
	}

	public function rules(){    

	if(Input::get('password') != NULL ){
		$rules = [
			'password' => 'required|confirmed|min:6'
		];
	}
	else if(Input::get('roles') != NULL){
		$rules = [
			'email' => 'email',
			'mobileNo' => 'required',

		];
	}
	else if(Input::get('email') != NULL){
			$rules = [


			];
		}

		else{
		$rules = [
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email|unique:users',
			'mobileNo' => 'required',
//			'mobileNo' => 'required|unique:users',
			
		];
	}
		
		return $rules;
	}

}
