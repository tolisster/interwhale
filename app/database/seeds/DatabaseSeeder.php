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
		DB::table('user_infos')->delete();

		DB::table('users')->delete();

		$user = User::create(array(
			'code' => 'test1',
			'email' => 'tolisster@gmail.com',
			'first_name' => 'Anatoli',
			'last_name' => 'Lazar',
			'country_code' => 'MD',
			'city' => 'Chisinau',
			'password' => Hash::make('123123'),
		));

		$userInfo = new UserInfo(array(
			'gender' => 'm',
			'birthdate' => '1982-11-06',
			'description' => 'Ищу попутчика для путешествия по Индии этим летом.',
			'relationship' => 'married',
			'languages' => 'ru,ro,en',
			'education' => 'UCCM',
			'activity' => 'Программист'
		));

		$user->userInfo()->save($userInfo);

	}

}