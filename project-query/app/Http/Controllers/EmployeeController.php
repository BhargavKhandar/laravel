<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function Show_employee()
    {
        // fetch all data
        $employees = DB::table('employees')
                        // ->get();
                        ->orderBy('id')
                        ->cursorPaginate(4);
                        // ->Paginate(4)
                        // ->fragment('employees');

        // this is return data in employee_view file
        return view('employee_view', ['data' => $employees]);

        // $employees = DB::table('employees')
        //                 // ->select('name', 'age')
        //                 ->select('city')
        //                 ->orderBy('city', 'desc')
        //                 ->get();
        // return $employees;

        // this is return json view
        // return $employees;
        // dd($employees);

        // data show in loop
        // foreach ($employees as $employee) {
        //     echo $employee->name . "<br>";
        // }

    }

    public function Single_employee($id)
    {
        $employee = DB::table('employees')->where('id', $id)->get();
        return view('employee', ['data' => $employee]);
        // return $employees;
    }

    public function Add_employee(Request $request)
    {
        $employee = DB::table('employees')
                        ->insert([
                            'name' => $request->name,
                            'email' => $request->email,
                            'age' => $request->age,
                            'city' => $request->city,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
        
        if ($employee)
        {
            return redirect()->route('home');
            // echo "<h2>Data Successfully added.</h2>";
        }
        else
        {
            echo "<h2>Data not addde!</h2>";
        }
    }

    function UpdatePage(string $id)
    {
        // $employee = DB::table('employees')->where('id', $id)->get();
        $employee = DB::table('employees')->find($id);
        // return $employee;
        return view('update', ['emp' => $employee]);
    }

    public function Update_employee(Request $request, $id)
    {
        // return $request;
        $employee = DB::table('employees')
                        ->where('id', $id)
                        ->update([
                            'name' => $request->name,
                            'email' => $request->email,
                            'age' => $request->age,
                            'city' => $request->city
                        ]);
        if ($employee)
        {
            return redirect()->route('home');
            // echo "<h2>Data updated successfully.</h2>";
        }
        else
        {
            echo "<h2>Data does not updated!</h2>";
        }
    }

    public function Delete_employee(string $id){
        $employee = DB::table('employees')
                        ->where('id', $id)
                        ->delete();
        if ($employee)
        {
            return redirect()->route('home');
        }
        else
        {
            echo "<h2>Data does not deleted!</h2>";
        }
    }

    public function Delete_all_employee()
    {
        $employee = DB::table('employees')
                        // ->truncate();
                        ->delete();
        if ($employee == "")
        {
            echo "<h2>Data does not delete!</h2>";
        }
        else
        {
            echo "<h2>All table data delete.</h2>";
        }
    }

}
