<?php

use App\Model\Web\Ticket;
use App\Model\Web\TicketCategory;
use App\Model\Web\TicketResponse;
use App\Model\Web\TicketAttachment;
use App\Model\Web\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class TicketsTableSeeder extends Seeder
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

        $urls = [
            'https://www.youtube.com/watch?v=MfIpg2TGhjo',
            'https://www.youtube.com/watch?v=u5Ec5lKg7B8',
            'https://www.youtube.com/watch?v=JqRNzTQPJAE',
            'https://www.youtube.com/watch?v=pr4AeD27VZs',
            'https://www.youtube.com/watch?v=Zeqbq6PIsNA',
            'https://www.youtube.com/watch?v=lnFaRuWOLN0',
            'https://www.youtube.com/watch?v=Ex2F5di2lA4',
            'https://www.youtube.com/watch?v=sycEJ2N09VY',
            'https://www.youtube.com/watch?v=BsWs2k-ghFY',
        ];

        $ticketCategories = [];
        $ticketCategories[] = TicketCategory::query()->create([
            'name' => 'Boutique',
            'color' => 'black',
        ]);

        $ticketCategories[] = TicketCategory::query()->create([
            'name' => 'En jeu',
            'color' => 'orange',
        ]);

        $ticketCategories[] = TicketCategory::query()->create([
            'name' => 'Site',
            'color' => 'purple',
        ]);

        for ($i = 0; $i < rand(5, 10); $i++) {
            /** @var TicketCategory $ticketCategory */
            foreach ($ticketCategories as $ticketCategory) {
                $status = Ticket::STATUSES[array_rand(Ticket::STATUSES)];

                $closedAt = null;
                if ($status === Ticket::STATUS_CLOSED || $status === Ticket::STATUS_REJECTED) {
                    $closedAt = $faker->dateTime;
                }

                /** @var Ticket $ticket */
                $ticket = Ticket::query()->create([
                    'author_id' => $user->id,
                    'category_id' => $ticketCategory->id,
                    'title' => $faker->text(15),
                    'content' => $faker->text(255),
                    'status' => $status,
                    'closed_at' => $closedAt,
                ]);

                for ($j = 0; $j < rand(0, 5); $j++) {
                    $url = $urls[array_rand($urls)];

                    TicketAttachment::query()->create([
                        'ticket_id' => $ticket->id,
                        'name' => $faker->text(9),
                        'url' => $url,
                    ]);
                }

                for ($j = 0; $j < rand(2, 10); $j++) {
                    /** @var TicketResponse $ticketResponse */
                    $ticketResponse = TicketResponse::query()->create([
                        'ticket_id' => $ticket->id,
                        'author_id' => $user->id,
                        'content' => $faker->text(255),
                    ]);

                    for ($k = 0; $k < rand(0, 5); $k++) {
                        $url = $urls[array_rand($urls)];

                        TicketAttachment::query()->create([
                            'ticket_id' => $ticket->id,
                            'response_id' => $ticketResponse->id,
                            'name' => $faker->text(9),
                            'url' => $url,
                        ]);
                    }
                }
            }
        }
    }
}
