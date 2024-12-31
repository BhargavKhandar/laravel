<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed data for permissions table
        DB::table('permissions')->insert([
            [
                'name' => 'Dashboard',
                'slug' => 'Dashboard',
                'groupby' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Users',
                'slug' => 'users',
                'groupby' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Create Users',
                'slug' => 'create-users',
                'groupby' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Edit Users',
                'slug' => 'edit-users',
                'groupby' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Delete Users',
                'slug' => 'delete-users',
                'groupby' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Roles',
                'slug' => 'roles',
                'groupby' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Create Roles',
                'slug' => 'create-roles',
                'groupby' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Edit Roles',
                'slug' => 'edit-roles',
                'groupby' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Delete Roles',
                'slug' => 'delete-roles',
                'groupby' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Categories',
                'slug' => 'categories',
                'groupby' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Create Categories',
                'slug' => 'create-categories',
                'groupby' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Edit Categories',
                'slug' => 'edit-categories',
                'groupby' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Delete Categories',
                'slug' => 'delete-categories',
                'groupby' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sub Categories',
                'slug' => 'sub-categories',
                'groupby' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Create Sub Categories',
                'slug' => 'create-sub-categories',
                'groupby' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Edit Sub Categories',
                'slug' => 'edit-sub-categories',
                'groupby' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Delete Sub Categories',
                'slug' => 'delete-sub-categories',
                'groupby' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Products',
                'slug' => 'products',
                'groupby' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Create Products',
                'slug' => 'create-products',
                'groupby' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Edit Products',
                'slug' => 'edit-products',
                'groupby' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Delete Products',
                'slug' => 'delete-products',
                'groupby' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Settigns',
                'slug' => 'settings',
                'groupby' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
