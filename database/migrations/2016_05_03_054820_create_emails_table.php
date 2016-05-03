<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emails', function (Blueprint $table) {
			$table->increments('id');
			$table->string('receiver');
			$table->string('sender_name')->nullable();
			$table->string('subject');
			$table->string('message');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('emails');
	}
}
