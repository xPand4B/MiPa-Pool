<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Clear tables
        App\User::truncate();
        App\Order::truncate();


        // Create 4 orders per every user
        factory(App\User::class, 25)->create()->each(function ($user) {
            for ($i = 0; $i < 4; $i++) {
                $user->orders()->save(factory(App\Order::class)->make());
            }
        });

        $this->call([
            // 
        ]);
    }
}