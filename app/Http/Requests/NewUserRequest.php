<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NewUserRequest extends Request
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
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|unique:users',
            'password' => 'required|min:5',
            'firstname' => 'required|min:3',
            'lastname' => 'required|min:3',
            'email' => 'required|email'
        ];
    }
}
