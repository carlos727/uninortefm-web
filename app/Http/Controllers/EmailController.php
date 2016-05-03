<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class EmailController extends Controller
{
	public function show() {
		$emails = Email::orderBy('created_at', 'asc')->get();

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

	public function send(Email $email) {
		//Send Email
	}
}
