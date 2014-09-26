<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInfosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_infos', function(Blueprint $table)
		{
			$table->integer('user_id');
			$table->enum('gender', array_keys(UserInfo::$genders))->nullable();
			$table->date('birthdate')->nullable();
			$table->enum('relationship', array_keys(UserInfo::$relationships))->nullable();
			$table->string('languages')->nullable();
			$table->string('education')->nullable();
			$table->string('activity')->nullable();
			$table->text('description')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_infos');
	}

}
