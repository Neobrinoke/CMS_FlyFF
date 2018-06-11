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
		$user = \App\Model\Web\User::query()->where('name', '=', 'Neobrinoke')->get()->first();
		$images = [
			'http://eu-uimg-wgp.webzen.com/1220129452/News/31052018_144440_fr-170x127_530808.jpg',
			'http://eu-uimg-wgp.webzen.com/1220129452/News/25052018_110852_fr-170x127_401321.jpg',
			'http://eu-uimg-wgp.webzen.com/1220129452/HtmlEdit/18052016_081352_project-1-maintenance_296322.jpg',
			'http://eu-uimg-wgp.webzen.com/1220129452/News/09032018_104050_turning-point-fr_384506.jpg',
			'http://eu-uimg-wgp.webzen.com/1220129452/News/06032018_115934_fr-170x127-2_431744.png',
			'http://eu-uimg-wgp.webzen.com/1220129452/News/06032018_094608_2d84b3831f3b3b960d4af15c5cb40c7ced99d89f702cab0c65-pimgpsh-fullsize-distr_351687.jpg',
			'http://eu-uimg-wgp.webzen.com/1220129452/News/10042017_153435_0c4f79e89df1096b94318520ebe7142f281da71c7e5dfa11bd-pimgpsh-fullsize-distr_560755.jpg',
		];

		$categories = [];

		$categories[] = \App\Model\Web\ArticleCategory::query()->create([
			'label' => 'Mise à jour',
			'color' => 'orange'
		]);

		$categories[] = \App\Model\Web\ArticleCategory::query()->create([
			'label' => 'Nouveauté',
			'color' => 'purple'
		]);

		foreach ($categories as $category) {
			for ($i = 0; $i < 20; $i++) {

				$rand = rand(0, (count($images) - 1));

				\App\Model\Web\Article::query()->create([
					'title' => $faker->realText(50),
					'content' => $faker->realText(500),
					'author_id' => $user->id,
					'image_thumbnail' => $images[$rand],
					'image_header' => ($i % 2) == 0 ? 'http://eu-uimg-wgp.webzen.com/1220129452/HtmlEdit/10112017_113105_fr-500x175_414659.jpg' : null,
					'category_id' => $category->id
				]);
			}
		}
	}
}
