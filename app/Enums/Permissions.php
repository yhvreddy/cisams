<?php

namespace App\Enums;

enum Permissions: string
{
    // case NAMEINAPP = 'name-in-database';
    case CREATE = 'Create';
    case READ = 'Read';
    case EDIT = 'Edit';
    case DELETE = 'Delete';

    // extra helper to allow for greater customization of displayed values, without disclosing the name/value data directly
    public function label(): string
    {
        return match ($this) {
            static::CREATE => 'Create',
            static::READ => 'Read',
            static::EDIT => 'Edit',
            static::DELETE => 'Delete',
        };
    }
}
