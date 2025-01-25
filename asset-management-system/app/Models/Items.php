<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $fillable = [
        'assetName',
        'code',
        'uom_id',
        'hasSerial',
        'hasExpiry',
        'fixAsset',
        'pms',
        'calibration', 
        'desc',
    ]; 

    public function uoms()
    {
        return $this->belongsTo(Uoms::class, 'uom_id' );
    }
}
