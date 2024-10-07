<?php

namespace App\Enums;

use App\Enums\Concerns\ExtendedEnum;

enum Roles: string
{
    use ExtendedEnum;

    case SUPER_ADMIN = 'super_admin';
    case ADMIN = 'admin';
    case USER = 'usuario';

    public static function mainTeamRoles(): array
    {
        return self::cases();
    }

    public static function teamRoles(): array
    {
        return [
            self::ADMIN,
            self::USER,
        ];
    }
}
