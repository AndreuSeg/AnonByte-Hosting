<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'username' => 'max:50',
            'name' => 'string|max:30',
            'lastname' => 'string|max:30',
            'email' => 'email',
            'role_id' => 'numeric|between:1,3',
            'stack_created' => 'boolean',
        ];
    }
}
