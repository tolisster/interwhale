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
			'status' => 'Ищу попутчика для путешествия по Индии этим летом.',
			'description' => 'Душа моя озарена неземной радостью, как эти чудесные весенние утра, '.
			'которыми я наслаждаюсь от всего сердца. Я совсем один и блаженствую в здешнем краю, '.
			'словно созданном для таких, как я. Я так счастлив, мой друг, так упоен ощущением покоя, '.
			'что искусство мое страдает от этого.',
			'relationship' => 'married',
			'languages' => array('ru', 'ro' , 'en'),
			'education' => 'UCCM',
			'activity' => 'Программист',
			'religion' => 'christianity',
			'interests' => 'спорт, путешествие',
			'hobby' => 'стрит арт',
			'dream' => 'полететь в космос'
		));

		$user->userInfo()->save($userInfo);

	}

}