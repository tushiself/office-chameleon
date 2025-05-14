<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeaveTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Change if you have authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'leave_type'   => 'required|string|max:255',
            'description'  => 'nullable|string',
            'assign_days'  => 'nullable|integer|min:0',
            'apply_base'   => 'required|in:month,year',
            'paid_type'    => 'required|in:paid,unpaid',
            'early_leave'  => 'nullable|in:0,1',
            'status'       => 'required|in:1,2',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'dname.required' => 'Leave Type is required.',
            'assigned.required' => 'Available Days are required.',
            'apply_base.required' => 'Please select the Apply Base.',
            'paid_type.required' => 'Please select the Leave Type.',
            'status.required' => 'Please select the Status.',
        ];
    }
}
