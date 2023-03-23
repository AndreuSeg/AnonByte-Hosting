<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StackRequest extends FormRequest
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
            'app_name' => 'required|unique:stacks,stack_name',
            'db_name' => 'required',
            'db_user' => 'required',
            'db_pass' => 'required|min:8',
            'db_root_pass' => 'required|min:8',
            'file' => 'required|file|mimes:zip',
        ];
    }
}
