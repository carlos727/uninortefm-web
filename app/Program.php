<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'start_at', 'end_at', 'day'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'created_at'
	];
}
