<?php

use Illuminate\Database\Seeder;
use App\Order;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear Table
        Order::truncate();

        // Call Factory to create 10 new Orders
        factory(Order::class, 10)->create();
    }
}
