<?php

namespace Tests\Feature;

use Tests\TestCase;

class SearchResourceTest extends TestCase
{
    /** @test */
    public function AuthRoutes()
    {
        // Show
        $this->get(route('search.show', $this->validUserParams()['username']))
            ->assertRedirect(route('login'));

        $this->assertModelCount(0, 0, 0);
    }
}
