<?php

use App\Model\Web\User;
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
			User::query()->create([
				'name' => 'john doe ' . $i,
				'email' => 'john' . $i . '@doe.fr',
				'password' => bcrypt('0000'),
				'cash_point' => 65498,
				'vote_point' => 9871
			]);
		}

		User::query()->create([
			'name' => 'Neobrinoke',
			'email' => 'neobrinoke@gmail.com',
			'password' => bcrypt('neobrinoke'),
			'cash_point' => 987654321,
			'vote_point' => 987654321
		]);
	}
}
