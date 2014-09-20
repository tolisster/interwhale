<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
		{
			$table->increments('id');
			$table->string('email')->unique();
			$table->string('first_name');
			$table->string('last_name');
			$table->string('country_code');
			$table->string('country_name');
			$table->string('state_code')->nullable();
			$table->string('city');
			$table->string('password', 64);
			$table->string('code');
			$table->string('remember_token', 100)->nullable();
			$table->boolean('active');
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
		Schema::drop('users');
	}

}
