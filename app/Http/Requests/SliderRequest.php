<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (isset(auth()->user()->id) ? true : false );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'=>'bail|required_if:action,update,delete|nullable',
            'slider_title'=>'bail|required',
            'slider_image'=>'bail|file|required_if:action,insert|image',
            'sort_about'=>'bail|string',
            'button_link'=>'bail|string',
        ];
    }
}
