<?php

namespace Database\Factories;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    protected $model = Menu::class;

    public function definition(): array
    {
        return [
            'name'      => $this->faker->name(),
            'number'    => $this->faker->numberBetween(1, 3),
            'comment'   => $this->faker->realText(rand(10, 50)),
            'price'     => $this->faker->numberBetween(100, 2000)
        ];
    }
}
