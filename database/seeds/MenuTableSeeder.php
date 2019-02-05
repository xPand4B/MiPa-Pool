<?php

use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menuCount = $this->command->ask('How many menus per order do you need ?', 4);

        $orders = App\Order::all();

        $this->command->info("Creating {$menuCount} menus for {$orders->count()} orders.");

        $orders->each(function($order) use ($menuCount){
            factory(App\Menu::class, $menuCount)
                ->create([
                       'order_id' => $order->id,
                       'user_id'  => App\User::all()->random()->id
                    ]);
        });

        $this->command->info('Menus Created!');
    }
}
