<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreFormPostRequest extends Request
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
            'name'    => 'required|min:3|max:25',
            'email'   => 'required|email',
            'phone'   => 'max:20',
            'company' => 'max:30',
            'address' => 'max:50',
            'title'   => 'required|min:4|max:50',
            'content' => 'required|min:10|max:200',
        ];
    }
}
