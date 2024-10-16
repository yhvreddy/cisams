<?php

namespace App\Enums;

enum Roles: string
{
    // case NAMEINAPP = 'name-in-database';
    case SUPERADMIN = 'super-admin';
    case MANAGER = 'manager';
    case SPECIALBRANCH = 'special-branch';

    // extra helper to allow for greater customization of displayed values, without disclosing the name/value data directly
    public function label(): string
    {
        return match ($this) {
            static::SUPERADMIN => 'Super Admin',
            static::MANAGER => 'Manager',
            static::SPECIALBRANCH => 'Special Branch',
        };
    }
}
