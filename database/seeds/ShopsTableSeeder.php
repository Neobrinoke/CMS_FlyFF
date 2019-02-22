<?php

use App\Model\Web\Shop;
use App\Model\Web\ShopCategory;
use App\Model\Web\ShopImage;
use App\Model\Web\ShopItem;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $shopImages = [
            'http://eu-uimg-wgp.webzen.com/1220129452/News/31052018_144440_fr-170x127_530808.jpg',
            'http://eu-uimg-wgp.webzen.com/1220129452/News/25052018_110852_fr-170x127_401321.jpg',
            'http://eu-uimg-wgp.webzen.com/1220129452/HtmlEdit/18052016_081352_project-1-maintenance_296322.jpg',
            'http://eu-uimg-wgp.webzen.com/1220129452/News/09032018_104050_turning-point-fr_384506.jpg',
            'http://eu-uimg-wgp.webzen.com/1220129452/News/06032018_115934_fr-170x127-2_431744.png',
            'http://eu-uimg-wgp.webzen.com/1220129452/News/06032018_094608_2d84b3831f3b3b960d4af15c5cb40c7ced99d89f702cab0c65-pimgpsh-fullsize-distr_351687.jpg',
            'http://eu-uimg-wgp.webzen.com/1220129452/News/10042017_153435_0c4f79e89df1096b94318520ebe7142f281da71c7e5dfa11bd-pimgpsh-fullsize-distr_560755.jpg',
        ];

        $itemImages = [
            'https://www.crystal-flyff.fr/img/boutique/bnaturelle.png',
            'https://www.crystal-flyff.fr/img/boutique/crystal-logo.gif',
            'https://www.crystal-flyff.fr/img/boutique/statsarmexp.png',
            'https://www.crystal-flyff.fr/img/boutique/groupexp.png',
            'https://www.crystal-flyff.fr/img/boutique/MPmax.png',
            'https://www.crystal-flyff.fr/img/boutique/npet23.png',
            'https://www.crystal-flyff.fr/img/boutique/vip.png',
            'https://www.crystal-flyff.fr/img/boutique/changementnom.png',
        ];

        $itemIds = [
            '35000',
            '35001',
            '35002',
            '35003',
            '35004',
            '35005',
            '35006',
            '35007',
            '35008',
            '35009',
            '35010',
            '35011',
            '35012',
            '35013',
            '35014',
            '35015',
            '35016',
            '35017',
            '35018',
        ];

        $shops = [];

        $shops[] = Shop::query()->create([
            'label' => 'Cash Shop',
            'image_thumbnail' => $shopImages[array_rand($shopImages)],
            'is_active' => true,
        ]);

        $shops[] = Shop::query()->create([
            'label' => 'Vote point',
            'image_thumbnail' => $shopImages[array_rand($shopImages)],
            'is_active' => true,
        ]);

        $shops[] = Shop::query()->create([
            'label' => 'Evenement',
            'image_thumbnail' => $shopImages[array_rand($shopImages)],
            'is_active' => true,
        ]);

        $shops[] = Shop::query()->create([
            'label' => 'Halloween',
            'image_thumbnail' => $shopImages[array_rand($shopImages)],
            'is_active' => true,
        ]);

        $categories = [];

        $categories[] = ShopCategory::query()->create([
            'label' => 'Armes',
            'color' => 'violet',
        ]);

        $categories[] = ShopCategory::query()->create([
            'label' => 'Bijoux',
            'color' => 'orange',
        ]);

        /** @var Shop $shop */
        foreach ($shops as $shop) {
            /** @var ShopCategory $category */
            foreach ($categories as $category) {
                for ($i = 0; $i < 20; $i++) {

                    $image = $itemImages[array_rand($itemImages)];
                    $shopType = rand(0, 1) === 1 ? Shop::SALE_CS_TYPE : Shop::SALE_VOTE_TYPE;

                    /** @var ShopItem $item */
                    $item = ShopItem::query()->create([
                        'category_id' => $category->id,
                        'shop_id' => $shop->id,
                        'item_id' => $itemIds[array_rand($itemIds)],
                        'sale_type' => $shopType,
                        'title' => $faker->text(15),
                        'description' => $faker->text(50),
                        'price' => $faker->numberBetween(50, 2500),
                        'image_thumbnail' => $image,
                    ]);

                    for ($j = 0; $j < rand(0, 5); $j++) {
                        ShopImage::query()->create([
                            'item_id' => $item->id,
                            'image' => $itemImages[array_rand($itemImages)],
                        ]);
                    }
                }
            }
        }
    }
}
