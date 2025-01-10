<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\User;
use App\Models\Brands;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BrandRequest;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UserRequest;
use App\Models\Departments;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    #region Department ***************************************************************
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
         * @param StoreDepartmentRequest $request
         * @return void
         */
        public function createDepartment(StoreDepartmentRequest $request)
        {
            $validatedRequest = $request->validated();

            try 
            {
                $duplicateDept = Departments::where ('desc', $validatedRequest['desc'])
                                            ->orWhere('code', $validatedRequest['code'])
                                            ->exists();
                
                if($duplicateDept)
                {
                    return redirect()->back()->with('warning', 'The Department name already exists. Please choose another name!');
                }
                

                $dept = Departments::create($validatedRequest);
    
                return redirect()->back()->with('success','You have successfully Added new Department');

            } catch (\Throwable $th) {
                return redirect()->back()->with('error' , $th);
            }
        }

        public function updateDepartment(UpdateDepartmentRequest $request)
        {
            $validatedRequest = $request->validated();

            try {
                $duplicateDept = Departments::where(function ($query) use ($validatedRequest) {
                                    $query->where('desc', $validatedRequest['desc'])
                                        ->orWhere('code', $validatedRequest['code']);
                                })
                            ->where('id', '!=', $validatedRequest['id'])
                            ->exists();


                if($duplicateDept)
                {
                    return redirect()->back()->with('warning', 'The Department name already exists. Please choose another name!');
                }
                
                $dept = Departments::findOrFail($validatedRequest['id']);

                $dept->desc = $validatedRequest['desc'];
                $dept->code = $validatedRequest['code'];

                $dept->save();
                
                return redirect()->back()->with('success', 'You have successfully update!');

            } 
            catch (\Throwable $th) 
            {

                return redirect()->back()->with('error','Not found!');

            }
        }
    
    #endregion
 
    #region Brand******************************************************************************
        
        /**
         * Create Brand
         *
         * @param BrandRequest $request
         * @return void
         */
        public function createBrand(Request $request)
        {
            $ValidatedRequest = $request->validate([
                'brandName' => 'required|string'
            ]);

            try {

                $duplicateBrand = Brands::where('brand', $ValidatedRequest['brandName'])
                                ->exists();

                // dd($duplicateBrand);
                if($duplicateBrand)
                {
                    return redirect()->back()->with('warning', 'The Brand name already exists. Please choose another name!');
                }

                $brand = Brands::create([
                    'brand' => $ValidatedRequest['brandName']
                ]);
                
                return redirect()->back()->with('success','You have successfully Added new Brand'); 
            }
            catch (\Throwable $e) {
                return redirect()->back()->with('error',$e); 
            }

        }
        
        public function brandIndex()
        {
            $brands = Brands::all();

            return view('library.brand', compact('brands'));
        } 
        
        /**
         * Delete Brand
         *
         * @param [type] $id
         * @return void
         */
        public function deleteBrand($id)
        {
            $brand  = Brands::find($id);

            if(!$brand)
            {
                return redirect()->back()->with('error','Not Found!');
            }

            $brand->delete();
            return redirect()->back()->with('success','Deleted successfully!');
        }

        /**
         * update brand
         * 
         * @param [type] $id
         */
        public function updateBrand(Request $request)
        {
            $validatedRequest = $request->validate([
                'id' => 'required|exists:brands,id', 
                'brandName' => [
                    'required',
                    'string',
                    'max:255',
                ],
            ]);
            
            try {
                $duplicateBrand = Brands::where('brand', $validatedRequest['brandName'])
                                        ->where('id', '!=', $validatedRequest['id'])
                                        ->exists();
    
                if($duplicateBrand)
                {
                    return redirect()->back()->with('warning', 'The brand name already exists. Please choose another name.');
                }


                $brand = Brands::findOrFail($validatedRequest['id']);
                
                $brand->brand = $validatedRequest['brandName'];
                $brand->save();

                return redirect()->back()->with('success', 'You have successfully update');

            } catch (\Exception $th) {
                //throw $th;
                return redirect()->back()->with('error','Not found!');
            }
        }
    
    #endregion**************************************************************************

    #region User ************************************************************************

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

    #endregion ********************************************************************************

    #region Supplier *********************************************************************
        public function supplierIndex()
        {
            $suppliers = Suppliers::all();

            return view('library.supplier', compact('suppliers'));
        }

        public function createSupplier(StoreSupplierRequest $request)
        {
            $validatedRequest = $request->validated();
            // dd($validatedRequest);
            try {
                
                $duplicateSupp = Suppliers::where('name',$validatedRequest['name'])
                                            ->exists();

                                            if($duplicateSupp)
                                            {
                                                return redirect()->back()->with('warning', 'Supplier name already exist. Please choose another name');
                                            }
                
                $supplier = Suppliers::create($validatedRequest);

                return redirect()->back()->with('success', 'You have successfully added new supplier');
            } catch (\Throwable $th) {

                return redirect()->back()->with('error' , $th);
            }
            
        }

        public function deleteSupplier($id)
        {
            // dd($id);
            $supplier = Suppliers::find($id);

            if($supplier)
            {
                $supplier->delete();
                return redirect()->back()->with('success', 'delete successfully!');
            }
            else
            {
                return redirect()->back()->with('error', 'not found!');
            }
        }
    #endregion  ***************************************************************************
}
