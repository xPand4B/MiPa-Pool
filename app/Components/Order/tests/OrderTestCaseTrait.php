<?php

namespace App\Components\Order\tests;

use App\Components\Order\Database\Order;

/**
 * @group Order
 */
trait OrderTestCaseTrait
{
    /**
     * Returns a new order.
     *
     * @param int $count
     * @param array $overrides
     *
     * @return mixed
     */
    public function createOrder(int $count = 1, array $overrides = [])
    {
        return factory(Order::class, $count)->create($overrides);
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
            //
        ], $overrides);
    }
}
