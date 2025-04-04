<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function fetchStudents()
    {
        return response()->json(Student::all());
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:students,email',
            'gender' => 'required|in:male,female,other',
            'mobile' => 'required|digits:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:8192'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
        }

        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->gender = $request->gender;
        $student->mobile = $request->mobile;
        $student->image = $imagePath;
        $student->save();

        return response()->json(['status' => '1', 'message' => 'Student added successfully']);
    }

    public function update(Request $request, $id)
    {
        dd($request->all(), $id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:students,email,' . $id,
            'gender' => 'required|in:male,female,other',
            'mobile' => 'required|digits:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $student = Student::findOrFail($id);
        $imagePath = $student->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
        }
        $student->name = $request->name;
        $student->email = $request->email;
        $student->gender = $request->gender;
        $student->mobile = $request->mobile;
        $student->image = $imagePath;
        $student->save();

        return response()->json(['status' => '1', 'message' => 'Student updated successfully']);
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return response()->json($student);
    }

    public function destroy($id)
    {
        Student::findOrFail($id)->delete();
        return response()->json(['message' => 'Student deleted successfully']);
    }
}
