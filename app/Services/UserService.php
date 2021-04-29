<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getAll($request)
    {
        return User::paginate(10);
    }
}