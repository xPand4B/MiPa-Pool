<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Menu;

class MenuTest extends TestCase
{   
    /** @test */
    public function a_menu_can_be_created()
    {
        factory(Menu::class)->create($this->validMenuParams());

        $this->assertCount(1, Menu::all());
    }

    /** @test */
    public function everything_is_required()
    {
        foreach($this->validMenuParams() as $param)
        {
            $this->expectException(\Exception::class);
    
            factory(Menu::class)->create($this->validMenuParams([$param => null]));
        }
    }
}
