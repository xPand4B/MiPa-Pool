<?php

namespace App\Http\Requests\Menus;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'name'      => 'required|min:5|max:128',
            'number'    => 'required|between:1,10',
            'price'     => 'required|min:0|max:6',
            'comment'   => 'max:255'
        ];
    }
}
