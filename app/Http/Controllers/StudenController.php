<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudenController extends Controller
{
    public function create() {
        return view("students.create");
    }

    public function index(){
        $students = User::where('id', '!=', 1)->get(); 
        return view("students.list", compact('students'));
    }

    public function store(Request $request) {
        $validate = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
            'phone' => 'required',
            'role' => 'required'
        ]);

        try{
            $student  = new User();
            $student->name = $request->name;
            $student->email = $request->email;
            $student->password =Hash::make($request->password);
            $student->phone = $request->phone;
            $student->role = $request->role;
            $student->save();
            return redirect('students')->with("message", 'student  create success');
        }catch(Exception $e){
            return redirect('student.index')->with("message", 'student not create');
        }
        
    }

    public function edit($id){
        $student = User::where('id', $id)->first(); 
        return view("students.edit", compact('student'));
    }

    public function update(Request $request, $id) {
        $validate = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'role' => 'required'
        ]);

        try{
            $student  = User::find($id);
            $student->name = $request->name;
            $student->email = $request->email;
            $student->phone = $request->phone;
            $student->role = $request->role;
            $student->save();
            return redirect('students')->with("message", 'student  update success');
        }catch(Exception $e){
            return redirect('students')->with("message", 'student not create');
        }
        
    }

    public function delete($id){
        $student = User::where('id', $id)->first(); 
        $student->delete();
        return redirect('students')->with("message", 'delete  success');
    }
}
