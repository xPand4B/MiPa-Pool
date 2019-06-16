<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /** @test */
    public function a_user_can_be_created()
    {
        factory(User::class)->create($this->validUserParams());

        $this->assertCount(1, User::all());
    }

    /** @test */
    public function check_all_required_fields()
    {
        foreach($this->validUserParams() as $field)
        {
            if(! in_array($field, $this->requiredFields()))
            {
                $this->expectException(\Exception::class);
                
                factory(User::class)->create($this->validUserParams([$field => null]));
            }
        }
    }

    /** @test */
    public function check_all_not_required_fields()
    {
        foreach($this->validUserParams() as $field => $value)
        {
            if(! in_array($field, $this->requiredFields())){
                factory(User::class)->create([$field => null]);
                
            }else{
                factory(User::class)->create();
            }
        }

        $this->assertCount(sizeof($this->validUserParams()), User::all());
    }

    /** @test */
    public function a_fullname_attribute_can_be_get()
    {
        factory(User::class)->create($this->validUserParams());

        $this->assertCount(1, User::all());

        $fullname = $this->validUserParams()['firstname'].' '.$this->validUserParams()['surname'];

        $this->assertEquals($fullname, User::first()->fullname);
    }

    /**
     * Return all fields that are not required.
     *
     * @return array
     */
    private function requiredFields(): array
    {
        return [
            'username',
            'firstname',
            'surname',
            'avatar',
            'locale',
            'password'
        ];
    }
}
