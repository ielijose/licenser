<?php

class UserTableSeeder extends Seeder {

	public function run()
	{

		User::create(array(
			'full_name' => 'Eli José Carrasquero',
			'picture' => '',
			'email' => 'ielijose@gmail.com',
			'password' => \Hash::make('1234'),
		));

	}

}