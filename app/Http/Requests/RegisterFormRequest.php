<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name'              => 'required|string',
            'phone'             => 'required|numeric',
            'name_alias'        => 'required|string',
            'email'             => 'required|email|unique:users',
            'university_name'   => 'nullable|string',
            'university_year'   => 'nullable|string',
            'sex'               => 'nullable|string',
            'password'          => 'required|string|min:6',
        ];
    }
}
