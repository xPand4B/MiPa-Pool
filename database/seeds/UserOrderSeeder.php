<?php

use Illuminate\Database\Seeder;

class UserOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // How many users you need, defaulting to 10
        $userCount = (int)$this->command->ask('How many users do you need ?', 25);

        // Ask how many orders per user needed
        $orderCount = (int)$this->command->ask('How many orders per user do you need ?', 4);

        $this->command->info("Creating {$userCount} users each having between {$orderCount} orders.");

        // Create the Users 
        $users = factory(App\User::class, $userCount)->create();

        // Create a range of orders for each users
        $users->each(function($user) use ($orderCount){
            factory(App\Order::class, $orderCount)
                    ->create([
                        'user_id'    => $user->id,
                        'max_orders' => rand(2, 10)
                    ]);
        });

        $this->command->info("Users and Orders Created! \n");
    }
}
