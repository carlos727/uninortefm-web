<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Email;

use DB;
use Response;

class EmailController extends Controller
{
	public function all() {
		$emails = DB::table('emails')
					->groupBy('isChecked')
					->orderBy('created_at', 'desc')
					->get();

		return Response::json($emails);
	}

	public function show() {
		$emails = Email::orderBy('created_at', 'desc')->get();

		$class = [
			'users'		=>	'',
			'programs'	=>	'',
			'emails'	=>	'activeli'
		];

		return view('emails', [
			'emails' => $emails,
			'class' => $class
		]);
	}
	public function store(Request $request) {
		if ($request->has('receiver') && $request->has('subject') && $request->has('message')) {
			$email = new Email;
			$email->receiver = $request->input('receiver');
			$email->sender_name = $request->input('sender_name');
			$email->subject = $request->input('subject');
			$email->message = $request->input('message');
			$email->save();
			return response($email, 201);
		}
	}

	public function delete($id) {
		$class = [
			'users'		=>	'',
			'programs'	=>	'',
			'emails'	=>	'activeli'
		];

		Email::findOrFail($id)->delete();

		$emails = Email::orderBy('created_at', 'desc')->get();

		return Redirect::route('emails', [
					'emails' => $emails,
					'class' => $class
				]);
	}

	public function update($id, Request $request) {
		$email = User::find($id);

		$class = [
			'users'		=>	'activeli',
			'emails'	=>	'',
			'programs'	=>	' '
		];

		$email->isChecked = $request->isChecked;
		$email->save();

		$emails = Email::orderBy('created_at', 'desc')->get();

		return Redirect::route('emails', [
					'emails' => $emails,
					'class' => $class
				]);
	}
}
