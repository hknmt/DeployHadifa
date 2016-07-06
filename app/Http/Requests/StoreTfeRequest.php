<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreTfeRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::check())
            return true;
        else
            return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => 'required|string|max:255',
            'image'       => 'required|string|max:255',
            'description' => 'required',
            'start'       => 'date',
            'end'         => 'date',
            'information' => 'required',
            'content'     => 'required'
        ];
    }
}
