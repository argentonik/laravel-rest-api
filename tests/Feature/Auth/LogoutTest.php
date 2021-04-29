<?php

namespace Tests\Feature\Auth;

use App\Enums\RoleEnum;
use App\Models\User;
use Laravel\Passport\Passport;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    public function testUserIsLoggedOutProperly()
    {
        $user = $this->createUser(RoleEnum::user());

        Passport::actingAs($user);

        $this->json('get', '/api/businesses')->assertStatus(200);
        $this->json('get', '/api/auth/logout')->assertStatus(200);

        $user = User::find($user->id);

        $this->assertEquals(null, $user->api_token);
    }

    public function testUserWithNullToken()
    {
        $this->json('get', '/api/businesses')->assertStatus(401);
    }
}
