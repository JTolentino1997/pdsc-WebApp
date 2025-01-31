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
use App\Http\Requests\UpdateSupplierRequest;
use App\Http\Requests\UserRequest;
use App\Models\Departments;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use App\Helpers\GlobalHelper;
use App\Http\Requests\StoreItemRequest;
use App\Models\Categories;
use App\Models\Items;
use App\Models\Uoms;
use PhpParser\Node\Stmt\TryCatch;

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

            try {
                
                $duplicateSupp = Suppliers::where('name',$validatedRequest['name'])
                                            ->exists();

                if($duplicateSupp)
                {
                    return redirect()->back()->with('warning', 'Supplier name already exist. Please choose another name');
                }
                
            // dd($validatedRequest);
                
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

        public function updateSupplier(UpdateSupplierRequest $request)
        {
            
            $validatedRequest = $request->validated();

            // dd($validatedRequest);

            $supplier = Suppliers::find($request->id);


            if(!$supplier)
            {
                return redirect()->back()->with("error", 'Not found');
            }


            $supplier->name = $validatedRequest['name'];
            $supplier->address = $validatedRequest['address'];
            $supplier->contactNumber = $validatedRequest['contactNumber'];
            $supplier->contactPerson = $validatedRequest['contactPerson'];
            $supplier->email = $validatedRequest['email'];
            $supplier->designation = $validatedRequest['designation'];

            $supplier->save();

            return redirect()->back()->with('success', 'You have successfully update!');

        }
    #endregion  ***************************************************************************

    #region Item
        public function itemIndex()
        {
            $items = Items::with('uoms')->get();
            $categories = GlobalHelper::getCategories();
            $Uoms = GlobalHelper::getUnitOfMeasure();

            return view('library.item', compact('items', 'categories' ,'Uoms'));
        }

        public function createItem(StoreItemRequest $request)
        {

            $validatedRequest = $request->validated();
            // dd($validatedRequest);

            $item = Items::create($validatedRequest);
 
            return redirect()->back()->with('success', 'You have add new item successfully!');
 
        }

        public function deleteItem($id)
        {
           
            $item = Items::find($id);
            
            if(!$item)
            {
                return redirect()->back()->with('error', 'Not Found!');
            }
            
            $item->delete();
            return redirect()->back()->with('success', 'You have deleted an item');
        }

    #endregion

    #region Category
    public function categoryIndex()
    {
        $categories = GlobalHelper::getCategories();

        return view('library.category', ['categories' => $categories ]);
    }

    public function storeCategory(Request $request)
    {

       $validatedRequest = $request->validate([
        'name' => ['required','string','max:255'],
        'desc' => ['required','string','max:255']
       ]);

        try {
         
            $isDuplicate = Categories::where('name', $validatedRequest['name'])->exists();

            if($isDuplicate)
            {
                return redirect()->back()->with('warning', 'The category name already exists. Please choose another name!');
            }

            $category = Categories::create([
                'name' => $validatedRequest['name'],
                'desc' => $validatedRequest['desc']
            ]);

            return redirect()->back()->with('success', 'You have successfully added new category!');
        } 
        catch (\Throwable $th) 
        {
            return redirect()->back()->with('error', $th);
        }
    }

    public function deleteCategory($id)
    {
        $isCategoryExist = Categories::find($id);
        
        if(!$isCategoryExist)
        {
            return redirect()->back()->with('error', 'Not found');
        }

        $isCategoryExist->delete();
        return redirect()->back()->with('success', 'Delete successfully!');
    }

    public function updateCategory(Request $request)
    {
        $validatedRequest = $request->validate([
            'id' => ['required','exists:categories,id'],
            'name' => ['string','max:255','required'],
            'desc' => ['string', 'max:255', 'required']
        ]);


        try {
            $isDuplicate = Categories::where('name', $validatedRequest['name'])
                                    ->where('id', '!=', $validatedRequest['id'])
                                    ->exists();

            if($isDuplicate)
            {
                return redirect()->back()->with('warning', 'The Category name already exists. Please choose another name');
            }

            $category = Categories::findOrFail($validatedRequest['id']);

            $category->name = $validatedRequest['name'];
            $category->desc = $validatedRequest['desc'];

            $category->save();

            return redirect()->back()->with('success', 'You have successfully update');
        } catch (\Throwable $th) {
            //throw $th;

            return redirect()->back()->with('error',' not found!');
        }
    }
    #endregion 

    #region UnitOfMeasure
    public function unitOfMeasureIndex()
    {
        $Uoms = GlobalHelper::getUnitOfMeasure();

        return view('library.unitOfMeasure', compact('Uoms'));
    }

    public function storeUnitOfMeasure(Request $request)
    {
        $validatedRequest = $request->validate([
            'name' => ['required','string','max:255'],
            'desc' => ['required', 'string', 'max:255']
        ]);

        try {
            $isDuplicate = Uoms::where('name', $validatedRequest['name'])->exists();

            if($isDuplicate)
            {
                return redirect()->back()->with('error','Unit name already exists. Please choose another name!');
            }

            $unitOfMeasure = Uoms::create([
                'name' => $validatedRequest['name'],
                'desc' =>$validatedRequest['desc']
            ]);

            return redirect()->back()->with('success',  'You have successfully added new UOM!');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function deleteUnitOfMeasure($id)
    {
        $isUomExist = Uoms::find($id);

        if(!$isUomExist)
        {
            return redirect()->back()->with('error', 'Not found!');
        }

        $isUomExist->delete();
        return redirect()->back()->with('success', 'Delete successfully!');
    }

    public function updateUnitOfMeasure(Request $request)
    {
        $validatedRequest = $request->validate([
            'id' => ['required','exists:Uoms,id'],
            'name' => ['required', 'max:255', 'string'],
            'desc' => ['required', 'max:255', 'string']
        ]);

        try {

            $isDuplicate = Uoms::where('name', $validatedRequest['name'])
                                ->where('id' ,'!=',  $validatedRequest['id'])
                                ->exists();

            if($isDuplicate)
            {
                return redirect()->back()->with('error', 'The name is already taken. Please choose another name!');
            }

            $measurement = Uoms::findOrFail($validatedRequest['id']);

            $measurement->name = $validatedRequest['name'];
            $measurement->desc = $validatedRequest['desc'];
            $measurement->save();

            return redirect()->back()->with('success', 'You have successfully update');
        } 
        catch (\Throwable $th) 
        {

            return redirect()->back()->with('error',' not found!');
        }
 
    }
    #endregion 
}
