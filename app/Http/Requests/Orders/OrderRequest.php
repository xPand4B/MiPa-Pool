<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name'              => 'required|min:5|max:128',
            'deadline'          => '',
            'max_orders'        => 'required|integer|between:2,20',
            'minimum_value'     => 'required|integer|between:0,20',
            'delivery_service'  => 'required|string',
            'site_link'         => 'required|active_url'
        ];
    }
}
