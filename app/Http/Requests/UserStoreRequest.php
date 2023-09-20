<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'email' => [
                'required',
                'email:filter',
                'max:255',
                'unique:users'
            ],
            'password' => [
                'required',
                'max:30'
            ],
            'role_id'=> 'required|exists:roles,id'
        ];
    }
}
