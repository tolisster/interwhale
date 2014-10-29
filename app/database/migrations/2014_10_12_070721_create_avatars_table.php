<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvatarsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('avatars', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->index()->unsigned();
			$table->string('filename');
			$table->timestamps();
		});

		File::makeDirectory(Config::get('app.data_dir') . 'avatars');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		File::deleteDirectory(Config::get('app.data_dir') . 'avatars');

		Schema::drop('avatars');
	}

}
