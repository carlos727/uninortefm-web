<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Program;

use DB;
use Response;
use Validator;

class ProgramController extends Controller
{
	public function show() {
		$programs = Program::orderBy('start_at', 'asc')->get();

		$class = [
			'monday'		=>	'active',
			'tuesday'	=>	'',
			'wednesday'	=>	'',
			'thursday'	=>	'',
			'friday'	=>	'',
			'saturday'	=>	'',
			'sunday'	=>	'',
			'users'		=>	'',
			'programs'	=>	'activeli',
			'emails'	=>	'',
			'day'		=>	0
		];

		return view('programs', [
			'programs' => $programs,
			'class' => $class
		]);
	}

	public function store(Request $request) {
		$start_at = $request->start_at_h.":".$request->start_at_m;
		$end_at = $request->end_at_h.":".$request->end_at_m;

		$request ->merge(['start_at' => $start_at]);
		$request->merge(['end_at' => $end_at]);

		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'start_at' => ['required', 'regex:^(([0-1][0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?)$^', 'before:end_at'],
			'end_at' => ['required', 'regex:^(([0-1][0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?)$^'],
			'day' => 'required|integer|between:1,7'
		]);

		$validator->after(function($validator) {
			$day = array_get($validator->getData(), 'day', null);
			$start_at = strtotime(array_get($validator->getData(), 'start_at', null));
			$end_at = strtotime(array_get($validator->getData(), 'end_at', null));

			$programs = Program::where('day','=', $day)->orderBy('start_at', 'asc')->get();

			$conts = 0;
			$conte =  0;
			$contover = 0;
			foreach ($programs as $program) {
				$program_start = strtotime($program->start_at);
				$program_end = strtotime($program->end_at);

				if ($start_at <= $program_start && $end_at >= $program_end) {
					$contover++;
				} elseif ($start_at < $program_start && $end_at > $program_start) {
					$conte++;
				} elseif ($start_at < $program_end && $end_at > $program_end) {
					$conts++;
				}
			}

		    if ($contover > 0) {
				$validator->errors()->add('end_at', 'Existe otro programa en medio de este horario!');
			} elseif ($conte > 0) {
				$validator->errors()->add('end_at', 'La hora de finalización no puede ser en medio de otro programa!');
			} elseif ($conts > 0) {
				$validator->errors()->add('start_at', 'La hora de inicio no puede ser en medio de otro programa!');
			}
		});

		$class = [
			'monday'		=>	'',
			'tuesday'	=>	'',
			'wednesday'	=>	'',
			'thursday'	=>	'',
			'friday'	=>	'',
			'saturday'	=>	'',
			'sunday'	=>	'',
			'users'		=>	'',
			'programs'	=>	'activeli',
			'emails'	=>	'',
			'day'		=>	0
		];

		if ($request->day == 1) {
			$class['monday'] = 'active';
			$class['day'] = 1;
		} elseif ($request->day == 2) {
			$class['tuesday'] = 'active';
			$class['day'] = 2;
		} elseif ($request->day == 3) {
			$class['wednesday'] = 'active';
			$class['day'] = 3;
		} elseif ($request->day == 4) {
			$class['thursday'] = 'active';
			$class['day'] = 4;
		} elseif ($request->day == 5) {
			$class['friday'] = 'active';
			$class['day'] = 5;
		} elseif ($request->day == 6) {
			$class['saturday'] = 'active';
			$class['day'] = 6;
		} else {
			$class['sunday'] = 'active';
			$class['day'] = 7;
		}

		if ($validator->fails()) {
			$programs = Program::orderBy('start_at', 'asc')->get();

			return view('programs', [
					'programs' => $programs,
					'class' => $class
				])
				->withErrors($validator->errors());
		}

		$program = new Program;
		$program->name = $request->name;
		$program->start_at = $request->start_at;
		$program->end_at = $request->end_at;
		$program->day = $request->day;
		$program->save();

		$programs = Program::orderBy('start_at', 'asc')->get();

		return view('programs', [
			'programs' => $programs,
			'class' => $class
		]);
	}

	public function delete($id){
		$program = DB::table('programs')
					->select('day')
					->where('id','=', $id)
					->first();

		$class = [
			'monday'		=>	' ',
			'tuesday'	=>	' ',
			'wednesday'	=>	' ',
			'thursday'	=>	' ',
			'friday'	=>	' ',
			'saturday'	=>	' ',
			'sunday'	=>	' ',
			'users'		=>	' ',
			'programs'	=>	'activeli',
			'emails'	=>	'',
			'day'		=>	0
		];

		if ($program->day == 1) {
			$class['monday'] = 'active';
		} elseif ($program->day == 2) {
			$class['tuesday'] = 'active';
		} elseif ($program->day == 3) {
			$class['wednesday'] = 'active';
		} elseif ($program->day == 4) {
			$class['thursday'] = 'active';
		} elseif ($program->day == 5) {
			$class['friday'] = 'active';
		} elseif ($program->day == 6) {
			$class['saturday'] = 'active';
		} else {
			$class['sunday'] = 'active';
		}

		Program::findOrFail($id)->delete();

		$programs = Program::orderBy('start_at', 'asc')->get();

		return view('programs', [
					'programs' => $programs,
					'class' => $class
				]);
	}

	public function update($id, Request $request){
		$program = Program::find($id);

		$start_at = $request->start_at_h.":".$request->start_at_m;
		$end_at = $request->end_at_h.":".$request->end_at_m;

		$request ->merge(['start_at' => $start_at]);
		$request->merge(['end_at' => $end_at]);

		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'start_at' => ['required', 'regex:^(([0-1][0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?)$^', 'before:end_at'],
			'end_at' => ['required', 'regex:^(([0-1][0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?)$^'],
			'day' => 'required|integer|between:1,7'
		]);

		$validator->after(function($validator) {
			$day = array_get($validator->getData(), 'day', null);
			$id = array_get($validator->getData(), 'id', null);
			$start_at = strtotime(array_get($validator->getData(), 'start_at', null));
			$end_at = strtotime(array_get($validator->getData(), 'end_at', null));

			$programs = Program::where('day','=', $day)->orderBy('start_at', 'asc')->get();			

			$conts = 0;
			$conte =  0;
			$contover = 0;
			foreach ($programs as $program) {
				if ($program->id <> $id) {
					$program_start = strtotime($program->start_at);
					$program_end = strtotime($program->end_at);

					if ($start_at <= $program_start && $end_at >= $program_end) {
						$contover++;
					} elseif ($start_at < $program_start && $end_at > $program_start) {
						$conte++;
					} elseif ($start_at < $program_end && $end_at > $program_end) {
						$conts++;
					}
				}
			}

			if ($contover > 0) {
				$validator->errors()->add('end_at', 'Existe otro programa en medio de este horario!');
			} elseif ($conte > 0) {
				$validator->errors()->add('end_at', 'La hora de finalización no puede ser en medio de otro programa!');
			} elseif ($conts > 0) {
				$validator->errors()->add('start_at', 'La hora de inicio no puede ser en medio de otro programa!');
			}
		});

		$class = [
			'monday'		=>	' ',
			'tuesday'	=>	' ',
			'wednesday'	=>	' ',
			'thursday'	=>	' ',
			'friday'	=>	' ',
			'saturday'	=>	' ',
			'sunday'	=>	' ',
			'users'		=>	' ',
			'programs'	=>	'activeli',
			'emails'	=>	'',
			'day'		=>	0
		];

		if ($request->day == 1) {
			$class['monday'] = 'active';
			$class['day'] = 1;
		} elseif ($request->day == 2) {
			$class['tuesday'] = 'active';
			$class['day'] = 2;
		} elseif ($request->day == 3) {
			$class['wednesday'] = 'active';
			$class['day'] = 3;
		} elseif ($request->day == 4) {
			$class['thursday'] = 'active';
			$class['day'] = 4;
		} elseif ($request->day == 5) {
			$class['friday'] = 'active';
			$class['day'] = 5;
		} elseif ($request->day == 6) {
			$class['saturday'] = 'active';
			$class['day'] = 6;
		} else {
			$class['sunday'] = 'active';
			$class['day'] = 7;
		}

		if ($validator->fails()) {
			$programs = Program::orderBy('start_at', 'asc')->get();

			return view('programs', [
					'programs' => $programs,
					'class' => $class
				])
				->withErrors($validator->errors());
		}

		$program->name = $request->name;
		$program->start_at = $request->start_at;
		$program->end_at = $request->end_at;
		$program->day = $request->day;
		$program->save();

		$programs = Program::orderBy('start_at', 'asc')->get();

		return view('programs', [
			'programs' => $programs,
			'class' => $class
		]);
	}

	public function all() {
		$programs = DB::table('programs')
					->select('id', 'name', 'start_at', 'end_at', 'day')
					->groupBy('day','id', 'name', 'start_at', 'end_at')
					->get();

		return Response::json($programs);
	}

	public function sunday() {
		$programs = DB::table('programs')
					->select('id', 'name', 'start_at', 'end_at', 'day')
					->where('day','=',0)
					->orderBy('start_at', 'asc')
					->get();

		return Response::json($programs);
	}

	public function monday() {
		$programs = DB::table('programs')
					->select('id', 'name', 'start_at', 'end_at', 'day')
					->where('day','=',1)
					->orderBy('start_at', 'asc')
					->get();

		return Response::json($programs);
	}

	public function tuesday() {
		$programs = DB::table('programs')
					->select('id', 'name', 'start_at', 'end_at', 'day')
					->where('day','=',2)
					->orderBy('start_at', 'asc')
					->get();

		return Response::json($programs);
	}

	public function wednesday() {
		$programs = DB::table('programs')
					->select('id', 'name', 'start_at', 'end_at', 'day')
					->where('day','=',3)
					->orderBy('start_at', 'asc')
					->get();

		return Response::json($programs);
	}

	public function thursday() {
		$programs = DB::table('programs')
					->select('id', 'name', 'start_at', 'end_at', 'day')
					->where('day','=',4)
					->orderBy('start_at', 'asc')
					->get();

		return Response::json($programs);
	}

	public function friday() {
		$programs = DB::table('programs')
					->select('id', 'name', 'start_at', 'end_at', 'day')
					->where('day','=',5)
					->orderBy('start_at', 'asc')
					->get();

		return Response::json($programs);
	}

	public function saturday() {
		$programs = DB::table('programs')
					->select('id', 'name', 'start_at', 'end_at', 'day')
					->where('day','=',6)
					->orderBy('start_at', 'asc')
					->get();

		return Response::json($programs);
	}
}
