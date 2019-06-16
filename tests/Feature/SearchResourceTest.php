<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class SearchResourceTest extends TestCase
{
    /** @test */
    public function only_logged_in_users_can_perform_a_search_request()
    {
        $this->get(route('search.show', $this->validUserParams()['username']))
            ->assertRedirect(route('login'));
    }
}
