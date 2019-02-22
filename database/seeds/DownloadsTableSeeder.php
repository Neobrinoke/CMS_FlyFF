<?php

use App\Model\Web\Article;
use App\Model\Web\ArticleCategory;
use App\Model\Web\ArticleComment;
use App\Model\Web\Download;
use App\Model\Web\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DownloadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
            'https://cdn.worldvectorlogo.com/logos/mega-icon.svg',
            'https://cdn2.iconfinder.com/data/icons/metro-ui-icon-set/512/MediaFire.png',
            'https://pbs.twimg.com/profile_images/978281583517077505/ZOvgNaJC_400x400.jpg',
            'https://cdn0.iconfinder.com/data/icons/Puck_Icons_Pack_II_by_deleket/300/Megaupload.png',
            'http://www.ixotype.com/media/Ixotype-Blog-Mejoras-en-el-buscador-de-LinkedIn.png',
        ];

        for ($i = 0; $i < rand(5, 15); $i++) {
            $randImg = $images[rand(0, (count($images) - 1))];

            $randType = rand(1, 2) === 1 ? Download::TYPE_CLIENT : Download::TYPE_PATCHER;

            Download::query()->create([
                'size' => rand(1, 8) . ' Go',
                'image' => $randImg,
                'link' => $randImg,
                'type' => $randType,
            ]);
        }
    }
}
