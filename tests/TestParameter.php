<?php

namespace Tests;

use Carbon\Carbon;

trait TestParameter
{
    /**
     * Provides an array with valid user data.
     *
     * @param array $overrides
     *
     * @return array
     */
    protected function validUserParams(array $overrides = []): array
    {
        return array_merge([
            'firstname' => 'Eric',
            'surname'   => 'Heinzl',
            'username'  => 'xPand',
            'about_me'  => "Hey, my name is Eric, I'm from germany and an enthusiastic developer/programmer.",
            // 'email'     => 'xpand.4beatz@gmail.com',
            'avatar'    => config('filesystems.avatar.default')
        ], $overrides);
    }

    /**
     * Provides an array with valid order data.
     *
     * @param array $overrides
     *
     * @return array
     */
    protected function validOrderParams(array $overrides = []): array
    {
        return array_merge([
            'user_id'           => 1,
            'name'              => 'Test Order',
            'delivery_service'  => 'Delivery Service',
            'site_link'         => 'https://lieferheld.de',
            'deadline'          => Carbon::now()->format('Y-m-d H:i'),
            'minimum_value'     => rand(0, 20),
            'max_orders'        => rand(2, 20),
            'closed'            => 0,
        ], $overrides);
    }

    /**
     * Provides an array with valid menu data.
     *
     * @param array $overrides
     *
     * @return array
     */
    protected function validMenuParams(array $overrides = []): array
    {
        return array_merge([
            'user_id'   => 1,
            'order_id'  => 1,
            'name'      => 'Test Menu',
            'number'    => '1',
            'comment'   => 'Without Onions',
            'price'     => 14.98,
        ], $overrides);
    }
}
