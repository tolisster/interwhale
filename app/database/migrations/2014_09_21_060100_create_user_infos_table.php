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
			$table->enum('gender', array('m', 'f'))->nullable();
			$table->date('birthdate')->nullable();
			$table->text('description')->nullable();
			$table->enum('relationship', array(
				'married',
				'single',
				'divorced',
				'widowed',
				'cohabiting',
				'civil union',
				'domestic partnership',
				'unmarried partners'
			))->nullable();
			$table->string('languages')->nullable();
			$table->string('education')->nullable();
			$table->string('activity')->nullable();
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
