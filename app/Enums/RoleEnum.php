<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self admin()
 * @method static self user()
 * @method static self unverified()
 */
class RoleEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'admin' => 'Admin',
            'user' => 'User',
            'archived' => 'Unverified',
        ];
    }
}