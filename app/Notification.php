<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'deviceToken',
		'program',
		'start_at',
		'day'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [];
}
