<?php

namespace Tests;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations, RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();
        Artisan::call('db:seed');
        $this->artisan('passport:install');
    }

    protected function createUser(RoleEnum $role)
    {
        $user = factory(User::class)->create();
        $user->attachRole(User::getRole($role));
        return $user;
    }

    protected function errorUnauthorizedHandling($method, $url)
    {
        $this->json($method, $url)
            ->assertStatus(401)
            ->assertJson([
                'status' => 'failed'
            ])
            ->assertJsonStructure([
                'message'
            ]);
    }
}
