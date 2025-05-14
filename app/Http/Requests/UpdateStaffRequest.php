<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStaffRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // You can add any additional authorization logic if needed
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => 'required|exists:users,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => '',
            'phone_number' => 'nullable|string|max:20',
            'gender' => 'nullable|in:male,female,other',
            'dob' => 'nullable|date',
            'department_id' => 'nullable|exists:departments,id',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'address'          => 'required',
            'city'             => 'required',
            'state'            => 'required',
            'pincode'          => 'required',

            // aur jo bhi fields update karni ho unke rules
        ];
    }
}
