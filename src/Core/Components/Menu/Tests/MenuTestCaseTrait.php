<?php

namespace MiPaPo\Core\Components\Menu\Tests;

use MiPaPo\Core\Components\Menu\Database\Menu;

/**
 * @group MenuCoreComponent
 */
trait MenuTestCaseTrait
{
    /**
     * Returns a new menu.
     *
     * @param int $count
     * @param array $overrides
     *
     * @return mixed
     */
    public function createMenu(int $count = 1, array $overrides = [])
    {
        return factory(Menu::class, $count)->create($overrides);
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
            //
        ], $overrides);
    }
}
