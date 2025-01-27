<?php

namespace App\Helpers;

use App\Models\Categories;
use App\Models\Employees;

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
}
