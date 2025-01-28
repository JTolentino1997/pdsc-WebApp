<?php

namespace App\Helpers;

use App\Models\Categories;
use App\Models\Employees;
use App\Models\Uoms;

class GlobalHelper
{

    public static function getUserName($userId)
    {
        $user = Employees::find($userId);

        return $user ? $user->lastName : 'Unknown user';
    }

    public static function getCategories()
    {
       return Categories::all();
    }

    public static function getUnitOfMeasure()
    {
        return Uoms::all();
    }

  
}
