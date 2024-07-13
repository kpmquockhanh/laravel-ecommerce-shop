<?php

namespace Database\Seeders;

use App\enums\PermissionEnum;
use App\enums\RoleEnum;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductCategory;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::destroy(Role::all()->pluck('id'));
        Permission::destroy(Permission::all()->pluck('id'));

        $roles = RoleEnum::cases();
//        $permissions = PermissionEnum::cases();


        foreach ($roles as $role) {
            Role::create(['guard_name' => 'admin', 'name' => $role->value]);
        }

        foreach (PermissionEnum::cases() as $permission) {
            Permission::create(['guard_name' => 'admin', 'name' => $permission->value]);
        }
        $userId = 1;
        $user = Admin::query()->find($userId);
        $user->assignRole(RoleEnum::ADMIN->value, 'admin');
    }
}
