<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\User;
use App\Models\Brands;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BrandRequest;
use App\Http\Requests\DepartmentRequest;
use App\Http\Requests\UserRequest;
use App\Models\Departments;
use Illuminate\Http\Request;

class Library extends Controller
{
    
 
    public function brandIndex()
    {
        return view('library.brand');
    } 


    #region Department
    /**
     * Department Index
     *
     * @return void
     */
    public function departmentIndex()
    {
        $departments = Departments::all();

        return view('library.department', compact('departments'));
    }

    /**
     * Delete Department
     *
     * @param [type] $id
     * @return void
     */
    public function deleteDepartment($id)
    {
        $department = Departments::find($id);

        if($department)
        {
            $department->delete();
            return redirect()->back()->with('success','Deleted successfully!');
        } else {
            return redirect()->back()->with('error','Not Found!');
        }
    }

    /**
     * Create Department
     *
     * @param DepartmentRequest $request
     * @return void
     */
    public function createDepartment(DepartmentRequest $request)
    {
        $validatedRequest = $request->validated();

        try {
            $dept = Departments::create($validatedRequest);
 
            return redirect()->back()->with('success','You have successfully Added new Department');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error' , $th);
        }
    }
    #endregion
 
    /**
     * Create Brand
     *
     * @param BrandRequest $request
     * @return void
     */
    public function createBrand(Request $request)
    {
        $validateRequest = $request->validate([
            'brandName' => 'required|string'
        ]);
        
        try {
            $brand = Brands::create([
                'brand' => $validateRequest['brandName']
            ]);
            
            return redirect()->back()->with('success','You have successfully Added new Brand'); 
        }
         catch (\Throwable $e) {
            return redirect()->back()->with('error',$e); 
        }

    }

    /**
     * Create User
     *
     * @return void
     */
    public function createUser()
    {
        $employees = Employees::all();
        $users =  User::count();

        return view('mainDashboard', compact('employees','users'));
    }

    /**
     * Save User
     *
     * @param UserRequest $request
     * @return void
     */
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

    /**
     * Delete User
     *
     * @param [type] $id
     * @return void
     */
    public function deleteUser($id)
    {
        // dd($id);
        $employee = Employees::find($id);

        if($employee){
            $employee->delete();
            return redirect()->back()->with('success','Deleted successfully!');
        } else {
            return redirect()->back()->with('error','Not Found!');
        }
    }

    /**
     * Update User
     *
     * @param UserRequest $request
     * @return void
     */
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
