<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('photos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->index()->unsigned();
			$table->softDeletes();
			$table->string('filename');
			$table->string('description');
			$table->timestamps();
		});

		File::makeDirectory(app_path('uploads/photos'));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		File::deleteDirectory(app_path('uploads/photos'));

		Schema::drop('photos');
	}

}