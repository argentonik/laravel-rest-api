<?php

namespace Tests\Feature\Business;

use App\Enums\RoleEnum;
use App\Models\Category;
use Laravel\Passport\Passport;
use Tests\TestCase;

class BusinessCreateTest extends TestCase
{
    public function testBusinessCreateSuccessfully()
    {
        $user = $this->createUser(RoleEnum::user());
        Passport::actingAs($user);

        $payload = [
            'name' => 'testName',
            'description' => 'testDescription',
            'category_id' => 1,
            'raiting' => 50,
            'phone' => '+1 (080) 337-4056',
            'email' => 'test@test.com',
            'website' => 'www.test-site.com'
        ];

        $serverResponse = [
            'status' => 'success',
            'data' => [
                'business' => [
                    'owner_id' => $user->id,
                    'category' => [
                        'id' => $payload['category_id'],
                        'name' => Category::find($payload['category_id'])->name
                        ] 
                    ] + $payload
                ]
            ];
        unset($serverResponse['data']['business']['category_id']);

        $this->json('POST', '/api/businesses', $payload)
            ->assertStatus(201)
            ->assertJson($serverResponse)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'business' => [
                        'id',
                        'updated_at',
                        'created_at',
                    ]
                ]
            ]);

        $this->assertDatabaseHas('businesses', $payload);
    }

    public function testBusinessCreateWithValidationErrors()
    {
        $user = $this->createUser(RoleEnum::user());
        Passport::actingAs($user);

        $this->json('POST', '/api/businesses')
            ->assertStatus(422)
            ->assertJson([
                'status' => 'failed'
            ])
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'name',
                    'description',
                    'category_id',
                    'raiting',
                    'phone',
                    'email',
                    'website',
                ]
            ]);
    }

    public function testBusinessCreateWhenUnauthorized()
    {
        $this->errorUnauthorizedHandling('POST', '/api/businesses');
    }
}