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
			$table->softDeletes();
			$table->string('code', 8)->index();
			$table->string('email')->unique();
			$table->string('first_name', 100);
			$table->string('last_name', 100);
			$table->string('country_code', 2)->index();
			$table->string('state_code', 2)->nullable()->index();
			$table->string('city');
			$table->string('password', 64);
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
		});

		File::makeDirectory(storage_path('uploads/avatars'));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		File::deleteDirectory(storage_path('uploads/avatars'));

		Schema::drop('users');
	}

}
