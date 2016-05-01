<?php

return [

	'custom' => [
		'name' => [
			'required'		=> 'El nombre es un campo requerido',
		],
		'start_at' => [
			'required'		=> 'La hora de inicio es un campo requerido',
			'before'		=> 'La hora de inicio debe ser menor que la hora de finalizacion',
			'date_format'	=> 'La hora de inicio debe seguir el formato de hh:mm',
		],
		'end_at' => [
			'required'		=> 'La hora de finalizacion es un campo requerido',
			'date_format'	=> 'La hora de finalizacion debe seguir el formato de hh:mm',
		],
		'username' => [
			'required'		=> 'El nombre de usuario es un campo requerido',
		],
		'rol' => [
			'required'		=> 'El rol del usuario es un campo requerido',
		],
	],

];