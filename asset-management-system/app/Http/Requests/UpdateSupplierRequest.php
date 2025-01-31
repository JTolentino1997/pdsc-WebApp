<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
                'string',
                'required',
                'max:255'
            ],
            'contactPerson' =>[
                'string',
                'max:255',
                'nullable'
            ],
            'email' => [
                'email',
                'required',
                'max:255',
                Rule::unique('suppliers','email')->ignore(Request::get('id')),
            ],
            'designation' => [
                'string',
                'nullable',
                'max:255'
            ]
        ];
    }
}
