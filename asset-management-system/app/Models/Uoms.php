<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uoms extends Model
{
    protected $table = 'uoms'; // specify the correct table name

    protected $fillable = [
        'name',
        'desc'
    ];

        // public function items()
    // {
    //     return $this->hasMany(Items::class, 'uom_id');
    // }

    public function items()
    {
        return $this->hasMany(Items::class, 'uom_id');
    }
}
