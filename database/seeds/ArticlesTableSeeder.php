<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = \Faker\Factory::create();

		foreach (\App\Model\Web\User::all() as $user) {
			for ($i = 0; $i < 2; $i++) {
				\App\Model\Web\Article::query()->create([
					'title' => $faker->text,
					'content' => $faker->realText(500),
					'author_id' => $user->id,
					'category_id' => 0
				]);
			}
		}
	}
}
