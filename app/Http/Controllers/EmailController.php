<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Email;

use DB;
use Response;

class EmailController extends Controller
{
	public function all() {
		$emails = DB::table('emails')
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
		if ($request->has('sender_name') && $request->has('email') && $request->has('message')) {
			$email = new Email;
			$email->sender_name = $request->input('sender_name');
			$email->email = $request->input('email');
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

		return redirect()->route('emails', [
					'emails' => $emails,
					'class' => $class
				]);
	}

	public function update($id) {
		$email = Email::find($id);

		$class = [
			'users'		=>	'activeli',
			'emails'	=>	'',
			'programs'	=>	' '
		];

		if ($email->isChecked == false) {
			$email->isChecked = true;
		} else {
			$email->isChecked = false;
		}
		$email->save();

		$emails = Email::orderBy('created_at', 'desc')->get();

		return redirect()->route('emails', [
					'emails' => $emails,
					'class' => $class
				]);
	}
}
