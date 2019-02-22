<?php

use App\Model\Web\Article;
use App\Model\Web\ArticleCategory;
use App\Model\Web\ArticleComment;
use App\Model\Web\User;
use Faker\Factory;
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
        /** @var User $user */
        $user = User::query()->find(1);
        if (is_null($user)) {
            return;
        }

        $faker = Factory::create();

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

        $categories[] = ArticleCategory::query()->create([
            'label' => 'Mise à jour',
            'color' => 'orange',
        ]);

        $categories[] = ArticleCategory::query()->create([
            'label' => 'Nouveauté',
            'color' => 'purple',
        ]);

        /** @var ArticleCategory $category */
        foreach ($categories as $category) {
            for ($i = 0; $i < 20; $i++) {

                $image = $images[array_rand($images)];
                $isCommentable = rand(0, 1);

                /** @var Article $article */
                $article = Article::query()->create([
                    'title' => $faker->realText(50),
                    'content' => $faker->realText(500),
                    'author_id' => $user->id,
                    'image_thumbnail' => $image,
                    'image_header' => ($i % 2) == 0 ? 'http://eu-uimg-wgp.webzen.com/1220129452/HtmlEdit/10112017_113105_fr-500x175_414659.jpg' : null,
                    'category_id' => $category->id,
                    'authorized_comment' => $isCommentable,
                ]);

                if ($isCommentable) {
                    for ($j = 0; $j < rand(0, 10); $j++) {
                        ArticleComment::query()->create([
                            'author_id' => $user->id,
                            'article_id' => $article->id,
                            'content' => $faker->text(50),
                        ]);
                    }
                }
            }
        }
    }
}
