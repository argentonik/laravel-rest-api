<?php

namespace Tests\Feature\Business;

use App\Enums\RoleEnum;
use App\Models\Business;
use Laravel\Passport\Passport;
use Tests\TestCase;

class BusinessDeleteTest extends TestCase
{
    public function testBusinessDeleteSuccessfully()
    {
        $user = $this->createUser(RoleEnum::user());
        Passport::actingAs($user);

        $business = factory(Business::class)->create();
        $business->update(['owner_id' => $user->id]);

        $this->json('DELETE', '/api/businesses/' . $business->id)
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success'
            ])
            ->assertJsonStructure([
                'message'
            ]);

        $this->assertDatabaseMissing('businesses', $business->attributesToArray());
    }

    public function testNotExsistBusinessDelete()
    {
        $user = $this->createUser(RoleEnum::user());
        Passport::actingAs($user);

        $this->json('DELETE', '/api/businesses/-1')
            ->assertStatus(404)
            ->assertJson([
                'status' => 'failed'
            ])
            ->assertJsonStructure([
                'message'
            ]);
    }

    public function testBusinessWithoudIdParamDelete()
    {
        $user = $this->createUser(RoleEnum::user());
        Passport::actingAs($user);

        $this->json('DELETE', '/api/businesses')
            ->assertStatus(405)
            ->assertJson([
                'status' => 'failed'
            ])
            ->assertJsonStructure([
                'message'
            ]);
    }

    public function testBusinessDeleteWhenUnauthorized()
    {
        $this->errorUnauthorizedHandling('DELETE', '/api/businesses/1');
    }
}