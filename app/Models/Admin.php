<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property mixed $status
 * @property mixed $type
 */
class Admin extends User
{
    use HasRoles;
    use HasApiTokens, HasFactory, Notifiable;

    protected function getDefaultGuardName(): string
    {
        return 'admin';
    }

    const ADMIN_CODE = 3;
    const MOD_CODE = 2;
    const SALE_CODE = 1;
    const ACTIVE_STATUS = 1;
    protected array $name_types = [
        self::SALE_CODE => 'Sale',
        self::MOD_CODE => 'Developer',
        self::ADMIN_CODE => 'Admin',
    ];

    protected array $status_name = [
        0 => 'Disabled',
        1 => 'Active',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function nameType(): Attribute
    {
        return Attribute::make(
            get: fn() => Arr::get($this->name_types, $this->type),
        );
    }

    public function getNameStatusAttribute(): Attribute
    {
        return Attribute::make(
            get: fn() => Arr::get($this->status_name, $this->status),
        );
    }

    public function isAdmin(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->status == self::ACTIVE_STATUS && $this->type == self::ADMIN_CODE,
        );
    }
}
