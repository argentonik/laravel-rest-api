<?php

namespace App\Policies;

use App\Enums\RoleEnum;
use App\Models\Business;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BusinessPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function store(User $user) {
        return $this->isAdminOrUser($user);
    }

    public function update(User $user, Business $business)
    {
        return $this->canChange($user, $business);
    }

    public function delete(User $user, Business $business)
    {
        return $this->canChange($user, $business);
    }

    private function canChange(User $user, Business $business)
    {
        $optionalUser = optional($user);
        if ($optionalUser->hasRole(strtolower(RoleEnum::admin()))) {
            return true;
        }
        if ($optionalUser->hasRole(strtolower(RoleEnum::unverified()))) {
            return false;
        }
        return $optionalUser->hasRole(strtolower(RoleEnum::user())) && 
            ($business->owner_id == $optionalUser->id);
    }

    private function isAdminOrUser(User $user) 
    {
        return optional($user)->hasRole(strtolower(RoleEnum::admin())) ||
            optional($user)->hasRole(strtolower(RoleEnum::user()));
    }
}
