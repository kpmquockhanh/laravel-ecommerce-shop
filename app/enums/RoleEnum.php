<?php

namespace App\enums;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case EDITOR = 'editor';
    case STAFF = 'staff';

    public function label(): string
    {
        return match ($this) {
            static::ADMIN => 'Admin',
            static::EDITOR => 'Editor',
            static::STAFF => 'Staff',
        };
    }

}
