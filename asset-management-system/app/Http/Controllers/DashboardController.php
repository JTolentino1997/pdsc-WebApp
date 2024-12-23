<?php

namespace App\Http\Controllers;

use App\Models\Employees;
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

        return view('mainDashboard', compact('employees'));
        // return "<h1>Black space</h1>";
    }

    public function blankSpace()
    {
        return "<h1>Black space</h1>";
    }
}
