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
			\App\Model\Web\User::query()->create([
				'name' => 'john doe ' . $i,
				'email' => 'john' . $i . '@doe.fr',
				'password' => bcrypt('0000')
			]);
		}

		\App\Model\Web\User::query()->create([
			'name' => 'Neobrinoke',
			'email' => 'neobrinoke@gmail.com',
			'password' => bcrypt('neobrinoke')
		]);
	}
}
