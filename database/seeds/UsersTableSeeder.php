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
        $avatars = [
            'https://semantic-ui.com/images/avatar2/large/kristy.png',
            'https://semantic-ui.com/images/avatar/large/elliot.jpg',
            'https://semantic-ui.com/images/avatar/large/jenny.jpg',
            'https://semantic-ui.com/images/avatar2/large/matthew.png',
            'https://semantic-ui.com/images/avatar2/large/molly.png',
            'https://semantic-ui.com/images/avatar2/large/elyse.png',
            'https://semantic-ui.com/images/avatar/large/steve.jpg'
        ];

        for ($i = 0; $i < 10; $i++) {
            $avatar_url = $avatars[array_rand($avatars)];

            User::query()->create([
                'name' => 'john doe ' . $i,
                'email' => 'john' . $i . '@doe.fr',
                'password' => bcrypt('0000'),
                'cash_point' => 65498,
                'vote_point' => 9871,
                'avatar_url' => $avatar_url
            ]);
        }

        User::query()->create([
            'name' => 'admin',
            'email' => 'admin@email.fr',
            'password' => bcrypt('admin'),
            'cash_point' => 987654321,
            'vote_point' => 987654321,
            'avatar_url' => $avatars[array_rand($avatars)]
        ]);
    }
}
