<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Employees;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // public function dashboard()
    // {
    //     return view('mainDashboard');
    // }
    public function createUser()
    {
        $employees = Employees::all();
        $users =  User::count();
        // dd($employees);

        return view('mainDashboard', compact('employees','users'));

     
        // return view('registerTest');
        // return "<h1>sample test</h1>";
    }

    public function saveUser(UserRequest $request)
    {
        $validatedRequest = $request->validated();

        $employee = Employees::create($validatedRequest);
        
        if(!$employee)
        {
            return redirect()->route('library.createUser')->with('error','Failed to create user!');
        }

        return redirect()->route('library.createUser')->with('success', 'You have successfully added new user!');
        // dd($validatedRequest);
    }

    public function deleteUser($id)
    {
        // dd($id);
        $employee = Employees::find($id);

        if($employee)
        {
            $employee->delete();
            return redirect()->back()->with('success','Deleted successfully!');
        }
         else 
        {
            return redirect()->back()->with('error','Not Found!');
        }
    }

    public function updateUser(UserRequest $request)
    {
        $validatedRequest = $request->validated();
        
        // dd($validatedRequest);
        // $id = Auth::user()->id;
        
        $employee = Employees::find($request->id);

        if(!$employee)
        {
            return redirect()->back()->with('error','Not found!');
        }
        $employee->lastName = $validatedRequest['lastName'];
        $employee->firstName = $validatedRequest['firstName'];
        $employee->middleName = $validatedRequest['middleName'];
        $employee->email = $validatedRequest['email'];

        $employee->save();

        return redirect()->back()->with('success',"You have successfully Update!");
    }
 
    public function mainDashboard()
    {
        return view('mainDashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

 
}
