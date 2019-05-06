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
        if ($this->command->confirm('Do you wish to refresh migration before seeding? It will clear all data.')) {

            // Call the php artisan migrate:fresh using Artisan
            $this->command->call('migrate:fresh');
        }

        $this->call([
            UserOrderSeeder::class,
            MenuTableSeeder::class
        ]);

        $this->command->info("\nDatabase seeded!\n");
        
        $usersCount  = App\User::all()->count();
        $ordersCount = App\Order::all()->count();
        $menusCount  = App\Menu::all()->count();
        
        $this->command->info("\nTotal:");
        $this->command->info("=============");
        $this->command->info("Users : {$usersCount}");
        $this->command->info("Orders: {$ordersCount}");
        $this->command->info("Menus : {$menusCount} \n");

        // Re Guard model
        Eloquent::reguard();
    }
}
