<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'domain' => [
                'required',
                'unique:stacks,domain',
                'regex:/^[a-z0-9]+$/i', // Solo permitir números y letras minúsculas
                'not_regex:/[A-Z]/', // Excluir mayusculas
            ],
            'db_user' => 'required',
            'db_pass' => 'required|min:8',
            'db_root_pass' => 'required|min:8',
        ];
    }
}
