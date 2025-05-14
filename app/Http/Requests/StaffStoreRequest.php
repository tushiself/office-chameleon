<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name'       => 'required|string|max:255',
            'middle_name'      => 'nullable|string|max:255',
            'last_name'        => 'required|string|max:255',
            'phone_number'     => 'required|numeric|digits:10',
            'designation'      => 'required|string|max:255',
            'dob'              => 'required|date',
            'joining_date'     => 'required|date',
            'gender'           => 'required|in:Male,Female',
            'department_id'       => 'required|exists:departments,id',
            'email'            => 'required|email|unique:users,email',
            'password'         => 'required|string|min:8',
            'monthly_salary'   => 'required|numeric',
            'is_supervisor'    => 'nullable|boolean',
            'role'             => 'required|in:Staff,Manager',
            'avatar'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'address'          => 'required',
            'city'             => 'required',
            'state'            => 'required',
            'pincode'          => 'required',

            // Additional fields based on your $fillable
            'staff_id'         => 'required|string|max:255|unique:users,staff_id',
            'password_reset'   => 'nullable|boolean',
            'lock_unlock'      => 'nullable|boolean',
            'date_created'     => 'nullable|date',
            'supervisor_id'    => 'nullable|exists:users,id',
            'can_be_assigned'  => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required'     => 'First name is required.',
            'last_name.required'      => 'Last name is required.',
            'phone_number.required'   => 'Phone number is required.',
            'designation.required'    => 'Designation is required.',
            'dob.required'            => 'Date of birth is required.',
            'joining_date.required'   => 'Joining Date is required.',
            'gender.required'         => 'Gender is required.',
            'email.required'          => 'Email is required.',
            'password.required'       => 'Password is required.',
            'monthly_salary.required' => 'Monthly salary is required.',
            'role.required'           => 'Role is required.',

            'address'          => 'address is required.',
            'city'             => 'city is required.',
            'state'            => 'state is required.',
            'pincode'          => 'pincode is required.',

            'email.unique'            => 'This email is already taken.',
            'staff_id.unique'         => 'Staff ID must be unique.',
            'supervisor_id.exists'    => 'Selected supervisor does not exist.',
            'department_id.exists'       => 'Selected department does not exist.',

            'avatar.image'            => 'Profile image must be an image file.',
            'avatar.mimes'            => 'Profile image must be of type jpeg, png, jpg, or gif.',
            'avatar.max'              => 'Profile image size cannot exceed 2MB.',
        ];
    }
}
