<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function testRequiresEmailAndLogin()
    {
        $this->json('POST', 'api/auth/login')
            ->assertStatus(422)
            ->assertJson([
                'status' => 'failed',
                'errors' => [
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ]
            ])
            ->assertJsonStructure([
                'message'
            ]);
    }

    public function testUserLoginsSuccessfully()
    {
        $user = factory(User::class)->create([
            'name' => 'testUser',
            'email' => 'testlogin@user.com',
            'password' => bcrypt('testPassword'),
        ]);

        $payload = [
            'name' => 'testUser',
            'email' => 'testlogin@user.com', 
            'password' => 'testPassword'
        ];

        $this->json('POST', 'api/auth/login', $payload)
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
            ])
            ->assertJsonStructure([
                'message',
                'data' => [
                    'loginData' => [
                        'access_token',
                        'token_type',
                        'expires_at'
                    ]
                ],
            ]);
    }
}
