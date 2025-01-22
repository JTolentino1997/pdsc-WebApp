<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return false;
        return Auth::check();

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'assetName' => [
                'required',
                'string',
                'max:255',
            ],
            'code' => [
                'string',
                'max:255',
                'required'
            ],
            'hasExpiry' => [
                'boolean',
            ],
            'hasSerial' => [
                'boolean',
            ],
            'desc' => [
                'string',
                'max:255'
            ],
            'fixAsset' => [
                'boolean',
            ],
            'pms' => [
                'boolean',
            ],
            'calibration' => [
                'boolean'
            ],
            'uom_id' => [
                'required',
                'integer',
                'existing:uom,id'
            ]
        ];
    }
}
