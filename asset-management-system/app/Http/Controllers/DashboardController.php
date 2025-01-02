<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    
    public function index()
    {
        // if(Auth::user()->id == 1)
        // {
        //     return view('mainDashboard');
        // }
        
        $employees = Employees::all();
        $users = User::count();

        return view('mainDashboard', compact('employees','users'));
        // return "<h1>Black space</h1>";
    }

 
}
