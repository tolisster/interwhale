<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('UserTableSeeder');

		$this->command->info('User table seeded!');
	}

}

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();

		User::create(array(
			'email' => 'tolisster@gmail.com',
			'name' => 'Anatoli Lazar',
			'code' => 'test1'
		));
		User::create(array(
			'email' => 'tolis@inbox.ru',
			'name' => 'Лазар Анатолий',
			'code' => 'test2'
		));
	}

}