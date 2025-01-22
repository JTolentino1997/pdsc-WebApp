<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $fillable = [
        'assetName',
        'code',
        'hasExpiry',
        'hasSerial',
        'desc',
        'uom_id',
        'fixAsset',
        'pms',
        'calibration',
    ]; 

    public function uom()
    {
        return $this->belongsTo(Uom::class, 'uom_id');
    }
}
