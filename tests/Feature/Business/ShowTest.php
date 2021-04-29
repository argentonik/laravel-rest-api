<?php

namespace Tests\Feature\Business;

use App\Enums\RoleEnum;
use App\Models\Business;
use App\Models\Category;
use Laravel\Passport\Passport;
use Tests\TestCase;

class BusinessShowTest extends TestCase
{
    public function testGetBusinessByIdSuccessfully()
    {
        $user = $this->createUser(RoleEnum::user());
        Passport::actingAs($user);

        $business = factory(Business::class)->create();
        $business->update(['owner_id' => $user->id]);

        $this->json('GET', '/api/businesses/' . $business->id)
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'data' => [
                    'business' => $business->attributesToArray() + [
                        'category' => [
                            'id' => $business->category_id,
                            'name' => Category::find($business->category_id)->name
                        ]
                    ]
                ]
            ])
            ->assertJsonStructure([
                'message'
            ]);
    }

    public function testGetNotExistBusinessById()
    {
        $user = $this->createUser(RoleEnum::user());
        Passport::actingAs($user);

        $this->json('GET', '/api/businesses/-1')
            ->assertStatus(404)
            ->assertJson([
                'status' => 'failed'
            ])
            ->assertJsonStructure([
                'message'
            ]);
    }

    public function testGetBusinessByIdWhenUnauthorized()
    {
        $this->errorUnauthorizedHandling('GET', '/api/businesses/1');
    }
}