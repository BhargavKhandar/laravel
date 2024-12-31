<?php

namespace Database\Seeders;

use App\Models\lecture;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class Lectureseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get('database/json/lecturers.json');
        $lecturers = collect(json_decode($json));

        $lecturers->each(function ($lecturers)
        {
            lecture::create([
                'name' => $lecturers->name,
                'email' => $lecturers->email,
                'age' => $lecturers->age,
                'city' => $lecturers->city,
            ]);
        });
    }
}
