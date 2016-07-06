<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StorePostRequest extends Request
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
            'name'        => 'required|unique:posts,name,'.$this->get('id'),
            'image'       => 'required',
            'information' => 'required'
        ];

    }

    public function messenges()
    {

        return [
            'name.required'        => 'Bạn cần nhập tên tiêu đề.',
            'name.unique'          => 'Tên tiêu đề đã có sẵn.',
            'image.required'       => 'Bạn cần có ảnh đại diện.',
            'information.required' => 'Bạn cần nhập vào thông tin.'
        ];

    }

}
