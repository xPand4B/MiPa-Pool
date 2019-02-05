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
        Eloquent::unguard();

        // Ask for db migration refresh, default is no
        if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data ?')) {

            // Call the php artisan migrate:fresh using Artisan
            $this->command->call('migrate:fresh');

            $this->command->line("Database cleared.");
        }

        $this->call([
            UserOrderSeeder::class,
            MenuTableSeeder::class
        ]);

        $this->command->info("Database seeded.");
        
        $users  = App\User::all();
        $orders = App\Order::all();
        $menus  = App\Menu::all();
        
        $this->command->info("\nTotal:");
        $this->command->info("=============");
        $this->command->info("Users : {$users->count()}");
        $this->command->info("Orders: {$orders->count()}");
        $this->command->info("Menus : {$menus->count()} \n");
        

        // Re Guard model
        Eloquent::reguard();
    }
}