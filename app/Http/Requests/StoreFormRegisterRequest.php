<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreFormRegisterRequest extends Request
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
            'category' => 'required|string|max:45'
            'post'     => 'required|string|max:255',
            'name'     => 'required|string|max:30',
            'phone'    => 'required|numeric|regex:/^[0-9]{0,20}$/',
            'email'    => 'required|email',
            'address'  => 'required|string|max:256',
            'company'  => 'string|max:50'
        ];
    }
}
