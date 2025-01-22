<?php

namespace App\Helpers;

use App\Models\Employees;

class GlobalHelper
{
    /**
     * Create a new class instance.
     */
    // public function __construct()
    // {
        
    // }

    public static function getUserName($userId)
    {
        $user = Employees::find($userId);

        return $user ? $user->lastName : 'Unknown user';
    }
}
