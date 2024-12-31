<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Call seeder file
        // $this->call([
        //     StudentSeeder::class
        // ]);

        // call factory method in one file
        // student::factory()->count(5)->create();

        // without using count enter data
        // student::factory(5)->create();

        // sencond file to call factory method
        // user::factory()->count(10)->create();

        $this->call([
            StudentSeeder::class
        ]);

    }
}
