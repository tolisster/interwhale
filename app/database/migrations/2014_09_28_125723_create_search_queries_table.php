<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSearchQueriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('search_queries', function(Blueprint $table)
		{
			$table->integer('user_id')->primary()->unsigned();
			$table->string('country_code', 2)->nullable();
			$table->string('state_code', 2)->nullable();
			$table->tinyInteger('from_age')->nullable()->unsigned();
			$table->tinyInteger('to_age')->nullable()->unsigned();
			$table->enum('gender', array_keys(UserInfo::$genders))->nullable();
			$table->enum('relationship', array_keys(UserInfo::$relationships))->nullable();
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
		Schema::drop('search_queries');
	}

}
