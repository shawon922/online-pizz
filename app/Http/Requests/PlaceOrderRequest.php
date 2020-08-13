<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseFormRequest as FormRequest;

class PlaceOrderRequest extends FormRequest
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
            'billing_name' => 'required',
            'billing_phone' => 'required',
            // 'billing_email' => 'required',
            'billing_address' => 'required',
            'billing_city' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'billing_name.required' => trans('messages.billing_name.required'),
            'billing_phone.required' => trans('messages.billing_phone.required'),
            // 'billing_email.required' => trans('messages.billing_email.required'),
            'billing_address.required' => trans('messages.billing_address.required'),
            'billing_city.required' => trans('messages.billing_city.required'),
        ];
    }
}
