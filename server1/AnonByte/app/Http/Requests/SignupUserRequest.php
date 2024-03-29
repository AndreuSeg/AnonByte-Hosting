<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => 'required|unique:users,username|max:50',
            'name' => 'required|string|max:30',
            'lastname' => 'required|string|max:30',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|string',
        ];
    }
}
