<?php

namespace Tests\Feature\Auth;

use App\Enums\RoleEnum;
use Illuminate\Support\Facades\Notification;
use Laravel\Passport\Passport;
use Tests\TestCase;

class SignupTest extends TestCase
{
    public function testSignupSuccessfully()
    {
        $payload = [
            'name' => 'testName',
            'email' => 'test@test.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $this->json('post', '/api/auth/signup', $payload)
            ->assertStatus(201)
            ->assertJson([
                'status' => 'success',
            ])
            ->assertJsonStructure([
                'message',
                'data' => [
                    'user' => [
                        'name',
                        'email',
                        'id',
                    ]
                ],
            ]);

        $this->assertDatabaseHas('users', [
            'name' => 'testName',
            'email' => 'test@test.com',
        ]);
    }

    public function testSignupActivationSuccessfully()
    {
        Notification::fake();

        $admin = $this->createUser(RoleEnum::admin());
        $userForActivate = $this->createUser(RoleEnum::unverified());

        Passport::actingAs($admin);

        $this->json('get', '/api/auth/signup/activate/' . $userForActivate->id)
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
            ])
            ->assertJsonStructure([
                'message',
                'data' => [
                    'user' => [
                        'name',
                        'email',
                        'id',
                    ]
                ],
            ]);

        $this->assertEquals($userForActivate->hasRole(strtolower(RoleEnum::user())), true);
    }

    public function testSignupActivationCannotDoNotAdmin()
    {
        Notification::fake();

        $user = $this->createUser(RoleEnum::user());
        $userForActivate = $this->createUser(RoleEnum::unverified());

        Passport::actingAs($user);

        // ToDo: change to 401
        $this->json('get', '/api/auth/signup/activate/' . $userForActivate->id)
            ->assertStatus(500);
    }

    public function testSignupActivationCannotDoWithAlreadyActivatedUser()
    {
        Notification::fake();

        $admin = $this->createUser(RoleEnum::admin());
        $userForActivate = $this->createUser(RoleEnum::user());

        Passport::actingAs($admin);

        $this->json('get', '/api/auth/signup/activate/' . $userForActivate->id)
            ->assertStatus(500)
            ->assertJson([
                'status' => 'failed',
            ])
            ->assertJsonStructure([
                'message',
            ]);
    }

    public function testSignupRequiresPasswordEmailAndName()
    {
        $this->json('post', '/api/auth/signup')
            ->assertStatus(422)
            ->assertJson([
                'status' => 'failed',
                'errors' => [
                    'name' => ['The name field is required.'],
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ]
            ])
            ->assertJsonStructure([
                'message'
            ]);
    }

    public function testSignupRequirePasswordConfirmation()
    {
        $payload = [
            'name' => 'testName',
            'email' => 'test@test.com',
            'password' => 'password',
        ];

        $this->json('post', '/api/auth/signup', $payload)
            ->assertStatus(422)
            ->assertJson([
                'status' => 'failed',
                'errors' => [
                    'password' => ['The password confirmation does not match.'],
                ]
            ])
            ->assertJsonStructure([
                'message'
            ]);
    }
}
