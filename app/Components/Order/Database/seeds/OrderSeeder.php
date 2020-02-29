<?php

namespace App\Components\Order\Database\Seeds;

use App\Components\Order\Database\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, Order::$seed_count)->create();
    }
}
