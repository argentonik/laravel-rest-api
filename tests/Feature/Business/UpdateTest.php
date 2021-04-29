<?php

namespace Tests\Feature\Business;

use App\Enums\RoleEnum;
use App\Models\Business;
use App\Models\Category;
use Laravel\Passport\Passport;
use Tests\TestCase;

class BusinessUpdateCreateTest extends TestCase
{
    public function testBusinessUpdateSuccessfully()
    {
        $user = $this->createUser(RoleEnum::user());
        Passport::actingAs($user);

        $business = factory(Business::class)->create();
        $business->update(['owner_id' => $user->id]);

        $payload = [
            'id' => $business->id,
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
                    'owner_id' => $business->owner_id,
                    'category' => [
                        'id' => $payload['category_id'],
                        'name' => Category::find($payload['category_id'])->name
                    ] 
                ] + $payload
            ]
        ];
        unset($serverResponse['data']['business']['category_id']);

        $this->json('PUT', '/api/businesses/' . $business->id, $payload)
            ->assertStatus(200)
            ->assertJson($serverResponse)
            ->assertJsonStructure([
                'message',
                'data' => [
                    'business' => [
                        'updated_at',
                        'created_at',
                    ]
                ]
            ]);
        
        $this->assertDatabaseHas('businesses', $payload);
    }

    public function testBusinessUpdateWithFaledIdParam()
    {
        $user = $this->createUser(RoleEnum::user());
        Passport::actingAs($user);

        $this->json('PUT', '/api/businesses/-1')
            ->assertStatus(404)
            ->assertJson([
                'status' => 'failed'
            ])
            ->assertJsonStructure([
                'message'
            ]);
    }

    public function testBusinessUpdateWithValidationErrors()
    {
        $user = $this->createUser(RoleEnum::user());
        Passport::actingAs($user);

        $business = factory(Business::class)->create();
        $business->update(['owner_id' => $user->id]);

        $this->json('PUT', '/api/businesses/' . $business->id)
            ->assertStatus(422)
            ->assertJson([
                'status' => 'failed'
            ])
            ->assertJsonStructure([
                'message',
                'errors' => [
                    'id',
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

    public function testBusinessUpdateWhenUnauthorized()
    {
        $this->errorUnauthorizedHandling('PUT', '/api/businesses/1');
    }
}