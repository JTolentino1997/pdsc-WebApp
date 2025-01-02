<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // return false;
        return Auth::check(); //return true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [ 
                'id' => [
                    'numeric',
                    'nullable'
                ],
                'lastName' => [
                    'required',
                    'string',
                    'max:255'
                ],
                'firstName' => [
                    'required',
                    'string',
                    'max:255'
                ],
                'middleName' => [
                    'required',
                    'string',
                    'max:255'
                ],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255'
                ]

            ];
    }
}