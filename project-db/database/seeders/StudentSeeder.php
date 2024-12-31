<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\student;
use Illuminate\Support\Facades\File;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // many fake record add in database
        // for ($i=1; $i <= 10; $i++) { 
        //     student::create([
        //         'name' => fake()->name,
        //         'email' => fake()->unique()->email
        //     ]);          
        // }

        // add real data using json file
        $json = File::get(path: 'database/json/student.json');
        $students = collect(json_decode($json));

        $students->each(function ($student)
        {
            student::create([
                'name' => $student->name,
                'email' => $student->email
            ]); 
        });
        
        // student::factory(5)->create();

    }
}
