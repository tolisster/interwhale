<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('token')->nullable();
			$table->decimal('amount')->nullable();
			$table->string('currency')->nullable();
			$table->decimal('fee')->nullable();
			$table->string('email')->nullable();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('country_code')->nullable();
			$table->string('country_name')->nullable();
			$table->string('state_code')->nullable();
			$table->string('city')->nullable();
			$table->string('note')->nullable();
			$table->boolean('canceled');
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
		Schema::drop('payments');
	}

}
