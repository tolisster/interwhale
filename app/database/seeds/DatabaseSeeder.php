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
			'first_name' => 'Anatoli',
			'last_name' => 'Lazar',
			'country_code' => 'MD',
			'country_name' => 'Moldova',
			'city' => 'Chisinau',
			'password' => Hash::make('123123'),
			'code' => 'test1',
			'active' => 1,
		));
	}

}