<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnersFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (isset(auth()->user()->id) ? true : false);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
             'image_type' => 'bail|required',
             'image'=>'bail|required'
        ];
    }
}
