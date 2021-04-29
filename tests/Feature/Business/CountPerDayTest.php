<?php

namespace Tests\Feature\Business;

use App\Enums\RoleEnum;
use App\Models\Business;
use Laravel\Passport\Passport;
use Tests\TestCase;

class BusinessCountPerDayTest extends TestCase
{
    public function testGetCountBusinessPerDayWhenUnauthorized()
    {
        $this->errorUnauthorizedHandling('GET', '/api/businesses/statistics');
    }

    public function testGetCountOfBusinessesPerDayByAdmin()
    {
        $admin = $this->createUser(RoleEnum::admin());
        Passport::actingAs($admin);

        $yesterdayDate = date('Y-m-d', strtotime("-1 days"));
        $nowDate = date('Y-m-d');

        $response = $this->json('GET', '/api/businesses/statistics?from=' . $yesterdayDate
            . '&to=' . $nowDate)
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'data' => [
                    'businessesToDay' => [
                        $yesterdayDate => 0,
                        $nowDate => Business::count()
                    ]
                ]
            ])
            ->assertJsonStructure([
                'message'
            ]);
    }

    public function testGetCountOfBusinessesPerDayWhenGettingByUser()
    {
        $user = $this->createUser(RoleEnum::user());
        Passport::actingAs($user);

        $business = factory(Business::class)->create();
        $business->update(['owner_id' => $user->id]);

        $yesterdayDate = date('Y-m-d', strtotime("-1 days"));
        $nowDate = date('Y-m-d');

        $response = $this->json('GET', '/api/businesses/statistics?from=' . $yesterdayDate
            . '&to=' . $nowDate)
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'data' => [
                    'businessesToDay' => [
                        $yesterdayDate => 0,
                        $nowDate => 1
                    ]
                ]
            ])
            ->assertJsonStructure([
                'message'
            ]);
    }

    public function testGetCountOfBusinessesPerDayWhenGettingByAdminAndFilteredByOwner()
    {
        $admin = $this->createUser(RoleEnum::admin());
        Passport::actingAs($admin);

        $user = $this->createUser(RoleEnum::user());

        $business = factory(Business::class)->create();
        $business->update(['owner_id' => $user->id]);

        $yesterdayDate = date('Y-m-d', strtotime("-1 days"));
        $nowDate = date('Y-m-d');

        $response = $this->json('GET', '/api/businesses/statistics?from=' . $yesterdayDate
            . '&to=' . $nowDate . '&owner_id=' . $user->id)
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'data' => [
                    'businessesToDay' => [
                        $yesterdayDate => 0,
                        $nowDate => 1
                    ]
                ]
            ])
            ->assertJsonStructure([
                'message'
            ]);
    }
}