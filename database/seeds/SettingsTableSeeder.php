<?php

use App\Model\Web\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::query()->create([
            'exp_rate' => 'x150',
            'drop_rate' => 'x50',
            'penyas_rate' => 'x750'
        ]);
    }
}
