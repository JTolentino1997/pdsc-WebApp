<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $fillable = [
        'name',
        'code',
        'uom_id',
        'hasSerial',
        'hasExpiry',
        'fixAsset',
        'pms',
        'calibration', 
        'desc',
        'category_id'
    ]; 

    public function uoms()
    {
        return $this->belongsTo(Uoms::class, 'uom_id' );
    }

    public function categories()
    {
        return $this->belongsTo(categories::class, 'category_id');
    }
}
