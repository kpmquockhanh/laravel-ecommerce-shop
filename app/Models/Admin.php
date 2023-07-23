<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @property mixed $status
 * @property mixed $type
 */
class Admin extends User
{
    use HasApiTokens, HasFactory, Notifiable;
    const ADMIN_CODE = 3;
    const MOD_CODE = 2;
    const SALER_CODE = 1;

    const ACTIVE_STATUS = 1;
    protected array $name_types = [
        1 => 'Saler',
        2 => 'Deverloper',
        3 => 'Admin',
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

    public function nameType(): Attribute {
        return Attribute::make(
            get: fn () => Arr::get($this->name_types, $this->type),
        );
    }

    public function getNameStatusAttribute(): Attribute
    {
        return Attribute::make(
            get: fn () => Arr::get($this->status_name, $this->status),
        );
    }

    public function isOperator(): bool
    {
        return $this->status == self::ACTIVE_STATUS && $this->type >= self::MOD_CODE;
    }

    public function isAdmin(): bool
    {
        return $this->status == self::ACTIVE_STATUS && $this->type == self::ADMIN_CODE;
    }
}
