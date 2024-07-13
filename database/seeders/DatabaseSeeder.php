<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Product::destroy(Product::all()->pluck('id'));
        Category::destroy(Category::all()->pluck('id'));
        Admin::destroy(Admin::all()->pluck('id'));
        Role::destroy(Role::all()->pluck('id'));
        Permission::destroy(Permission::all()->pluck('id'));
        $this->call([
            AdminSeeder::class,
            ProductSeeder::class,
            CategorySeeder::class,
            PermissionSeeder::class,
        ]);
    }
}
