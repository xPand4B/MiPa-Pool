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
        $menuCount = $this->command->ask('How many menus per order do you need?', 4);

        $orders = App\Models\Order::all();

        $this->command->info("Creating {$menuCount} menus for {$orders->count()} orders.");
        $this->command->info("If your input is more than or equal 'max_order' will be the new value.\n");

        $i = 1;

        foreach($orders as $order){
            $count = $menuCount;

            if($menuCount > $order->max_orders){
                $count = $order->max_orders;
            }

            factory(App\Models\Menu::class, $count)
                ->create([
                    'order_id' => $i,
                    'user_id'  => App\Models\User::all()->random()->id            
                ]);
            $i++;
        }
    }
}
