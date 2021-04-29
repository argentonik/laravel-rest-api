<?php

namespace Tests\Feature\Business;

use App\Enums\RoleEnum;
use App\Models\Business;
use App\Models\Category;
use Laravel\Passport\Passport;
use Tests\TestCase;

class BusinessGetListTest extends TestCase
{
    public function testGetBusinessesListSuccessfully()
    {
        $this->withoutExceptionHandling();
        $user = $this->createUser(RoleEnum::user());
        Passport::actingAs($user);

        $response = $this->json('GET', '/api/businesses')
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success'
            ])
            ->assertJsonStructure([
                'message',
                'data' => [
                    'list' => [
                        'current_page',
                        'total',
                        'data' => [
                            '*' => [
                                'id', 
                                'name', 
                                'description', 
                                'raiting', 
                                'category' => [
                                    'id',
                                    'name'
                                ]
                            ]
                        ]
                    ]
                ]
            ]);
    }

    public function testGetBusinessListWhenUnauthorized()
    {
        $this->errorUnauthorizedHandling('GET', '/api/businesses');
    }

    public function testGetBusinessListWithSearch()
    {
        $this->withoutExceptionHandling();
        $user = $this->createUser(RoleEnum::user());
        Passport::actingAs($user);

        $business = factory(Business::class)->create();
        $business->update(['owner_id' => $user->id]);

        $businessResult = [
            'id' => $business->id,
            'name' => $business->name,
            'description' => $business->description,
            'raiting' => $business->raiting,
            'category' => [
                'id' => $business->category_id,
                'name' => Category::find($business->category_id)->name
            ]
            ];

        $response = $this->json('GET', '/api/businesses?q=' . $business->description)
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'data' => [
                    'list' => [
                        'data' => [$businessResult]
                    ]
                ]
            ])
            ->assertJsonStructure([
                'message',
                'data' => [
                    'list' => [
                        'current_page',
                        'total',
                    ]
                ]
            ]);
    }
}