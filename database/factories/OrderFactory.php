<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $deadline = new Carbon();

        return [
            'user_id'           => fn() => User::inRandomOrder()->first()->id,
            'name'              => $this->faker->text(20),
            'delivery_service'  => $this->faker->name,
            'site_link'         => $this->faker->url,
            'deadline'          => $deadline->addSeconds(rand(600, 86400)), // Between 10min and 24h
            'minimum_value'     => $this->faker->numberBetween(0, 10),
            'max_orders'        => $this->faker->numberBetween(2, 15),
        ];
    }
}
