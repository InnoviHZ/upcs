<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PinSlipRequest extends Request
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
            'registration_number' => 'required|unique:clearance',
            'fullname' => 'required|min:3',
            'teller_number' => 'required|unique:clearance',
            'phone' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'registration_number.required' => 'Registration Number is required',
            'fullname.required' => 'Full Name is required',
            'teller_number.required' => 'Teller Number is required',
            'phone.required' => 'Phone Number is required',
            'phone.numeric' => 'Phone Number must be numeric',
        ];
    }
}
