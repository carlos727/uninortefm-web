<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;

use DB;
use Response;
use Validator;

class UserController extends Controller
{
	public function all() {
		$users = DB::table('users')
					->groupBy('isActive')
					->get();

		return Response::json($users);
	}

	public function show() {
		$users = User::orderBy('username','asc')->get();

		$class = [
			'users'		=>	'activeli',
			'programs'	=>	'',
			'emails'	=>	''
		];

		return view('users',[
			'users' => $users,
			'class' => $class
			]);
	}

	public function store(Request $request) {
		$validator = Validator::make($request->all(), [
			'username'	=>	'required',
			'rol'		=>	'required'
		]);

		$validator->after(function($validator) {
			$users = User::orderBy('username', 'asc')->get();

			$username = array_get($validator->getData(), 'username', null);


			if ($users->contains('username',$username)) {
				$validator->errors()->add('username', 'Este usuario ya existe!');
			}
		});

		$class = [
			'users'		=>	'activeli',
			'emails'	=>	'',
			'programs'	=>	''
		];

		if ($validator->fails()) {
			$users = User::orderBy('username', 'asc')->get();

			return view('users', [
					'users' => $users,
					'class' => $class
				])
				->withErrors($validator->errors());
		}

		$user = new User;
		$user->username = $request->username;
		$user->rol = $request->rol;
		$user->isActive = true;
		$user->save();

		$users = User::orderBy('username', 'asc')->get();

		return Redirect::route('users', [
					'users' => $users,
					'class' => $class
				]);
	}

	public function delete($id){
		$class = [
			'users'		=>	'activeli',
			'emails'	=>	'',
			'programs'	=>	' '
		];

		User::findOrFail($id)->delete();

		$users = User::orderBy('username', 'asc')->get();

		return Redirect::route('users', [
					'users' => $users,
					'class' => $class
				]);
	}

	public function update($id, Request $request){
		$user = User::find($id);

		$class = [
			'users'		=>	'activeli',
			'emails'	=>	'',
			'programs'	=>	' '
		];

		$user->isActive = $request->isActive;
		$user->save();

		$users = User::orderBy('username', 'asc')->get();

		return Redirect::route('users', [
					'users' => $users,
					'class' => $class
				]);
	}

	public function login(){
		return view('login');
	}
}
