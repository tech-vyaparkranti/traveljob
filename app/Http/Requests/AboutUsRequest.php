<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutUsRequest extends FormRequest
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
            'about_desc'=>'bail|required',
            'sort_about_us'=>'bail|required',
        ];
    }
}
