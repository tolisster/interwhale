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
			$table->integer('user_id')->primary();
			$table->date('birthdate')->nullable();
			$table->boolean('show_date_birth')->default(true);
			$table->boolean('show_age')->default(true);
			$table->enum('gender', array_keys(UserInfo::$genders))->nullable()->index();
			$table->enum('relationship', array_keys(UserInfo::$relationships))->nullable()->index();
			$table->enum('religion', array_keys(UserInfo::$religions))->nullable();
			$table->string('languages');
			$table->string('education');
			$table->string('activity');
			$table->string('status');
			$table->text('description');
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
