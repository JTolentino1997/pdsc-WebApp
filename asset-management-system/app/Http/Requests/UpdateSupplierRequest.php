<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateSupplierRequest extends FormRequest
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
            'name' => [
                'string',
                'required',
                'max:255',
            ],
            'address' => [
                'string',
                'max:255',
                'nullable'
            ],
            'contactNumber' => [
                'numeric',
                'regex:/^\+?[0-9]{1,15}$/', // Allows an optional '+' followed by up to 15 digits.
                'max:255'
            ],
            'email' => [
                'email',
                'required',
                'max:255',
                'unique:suppliers,email' . Request::get('id')
            ],
            'designation' => [
                'string',
                'nullable',
                'max:255'
            ]
        ];
    }
}
