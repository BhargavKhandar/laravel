<?php

namespace App\Http\Controllers;

use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    // public function Show_students()
    // {
    //     // show data with join
    //     $students = DB::table('students')
    //                 ->join('cities', 'students.city', '=', 'cities.id')
    //                 ->select('students.*', 'cities.city_name')
    //                 ->get();

    //     // $students = DB::table('students')
    //     //                 ->leftjoin('cities', function (JoinClause $joinClause)
    //     //                 {
    //     //                     $joinClause->on('students.city', '=', 'cities.id')
    //     //                                 ->where('cities.city_name', 'like', 'r%');
    //     //                 })
    //     //                 ->select('students.*', 'cities.city_name')
    //     //                 ->get();

    //     // return $students;
    //     return view('student', compact('students'));
    // }

    // public function Union_data()
    // {
    //     $lecturers = DB::table('lecturers')
    //                  ->select('name', 'email', 'city_name')
    //                  ->join('cities', 'lecturers.city', '=', 'cities.id');
    //                 // using where condition with join
    //                 //  ->where('city_name', '=', 'Rajkot');

    //     $students = DB::table('students')
    //                 ->union($lecturers)
    //                 ->select('name', 'email', 'city_name')
    //                 ->join('cities', 'students.city', '=', 'cities.id')
    //                 // using where condition with join and union
    //                 // ->where('city_name', '=', 'Jamnagar')
    //                 ->get();
    //                 // show the sql query use toSql()
    //                 // ->toSql();

    //     return $students;
    // }

    // public function When_data()
    // {
    //     $test = true;
    //     // using when method similar if condition
    //     $students = DB::table('students')
    //                 ->when($test, function ($query)
    //                 {
    //                     $query->where('age', '>', 18);
    //                 },
    //                 function ($query)
    //                 {
    //                     $query->where('age', '<=', 18);
    //                 })
    //                 ->get();
                    
    //     return $students;
    // }

    // public function Chunk_data()
    // {
    //     $students = DB::table('students')
    //                 ->orderBy('id')
    //                 // data show by chunk (chunk work with orderby)
    //                 ->chunk(2, function ($students)
    //                 {
    //                     echo "<div style='border: 1px solid red; margin-bottom: 10px;'>";
    //                     foreach ($students as $student)
    //                     {
    //                         echo $student->name . "<br>";
    //                     }
    //                     echo "</div>";
    //                 });
    // }

    public function Raw_queries()
    {
        // use raw sql queries

        // show querie
        // $students = DB::select("select * from students"); // show all data
        // $students = DB::select("select * from students where name = ?", ['bhargav']); // show data with where condition using '?'
        // $students = DB::select("select * from students where name = :name", ['bhargav']);

        // insert querie
        // $students = DB::insert("insert into students (name, email, age, city) values (?, ?, ?, ?)", 
        //                         ['khavdu', 'khavdu12@gmail.com', 26, 2]);
                        
        // update querie
        // $students = DB::update("update lecturers set city = 1 where id = ?", [2]);

        // delete student
        // $students = DB::delete("delete from students where id = ?", [1]);
        
        // use statement method this method does not return any content
        // this querie also drop the table without return
        // $students = DB::statement("drop table students");

        // use unprepared method is used in delete or update the data but this is not secure
        // $students = DB::unprepared("delete from students where id = 1");

        $students = DB::table('students')
                    // ->selectRaw('count(*) as student_count, age')
                    ->select(DB::raw('count(*) as student_count'), 'age')
                    ->whereRaw('age > ?', [18])
                    ->groupByRaw('age')
                    // ->havingRaw('age < ?', [25])
                    ->get();

        return $students;
    }
}
