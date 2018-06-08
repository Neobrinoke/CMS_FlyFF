<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		for ($i = 0; $i < 10; $i++) {
			\App\User::query()->create([
				'name' => 'john doe ' . $i,
				'email' => 'john' . $i . '@doe.fr',
				'password' => bcrypt('0000')
			]);
		}
	}
}
