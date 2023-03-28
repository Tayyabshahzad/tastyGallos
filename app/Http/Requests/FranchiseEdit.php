<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FranchiseEdit extends FormRequest
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
            'edit_id'=>'required|integer',
            'user_id'=>'required|integer',
            'workingHourId'=>'required',
            'opening_time' => 'required',
            'closing_time' => 'required',
            'day' => 'required',
            'code' => 'required',
            'time_status' => 'required|max:10',
            'franchise_name' => 'required|max:140',
            'franchise_phone' => 'required|max:20',
            'franchise_vat' => 'required',
            'contact_email' => 'required|email|max:30',
            'franchise_address' => 'required|max:200',
            'delivery_charge' => 'required|max:250|integer',
            'pickup' => 'required_without_all:delivery|string|max:3',
            'delivery' => 'string|max:3',
            'busy_time' => 'required|integer',
            'free_time' => 'required|integer',
            'admin_name' => 'required|max:100',
            'lat' => 'required',
            'estimated_time' => 'required',
            'lng' => 'required',
            'payment_method' => 'required'

        ];
    }
}
