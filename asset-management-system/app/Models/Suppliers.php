<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    protected $fillable = [
        'name',
        'address',
        'contactNumber',
        'contactPerson',
        'email',
        'designation'
    ];
}
