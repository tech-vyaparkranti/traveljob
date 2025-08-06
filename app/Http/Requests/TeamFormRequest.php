<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // This checks if a user is authenticated.
        // It's good practice to ensure the user is logged in before allowing form submission.
        return (isset(auth()->user()->id) ? true : false );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Define validation rules only for the fields present in your form and database.
        $rules = [
            'post' => 'required|string|max:255', // Designation
            'name' => 'required|string|max:255',
            // For 'image', if it's an 'insert' action, it should be required.
            // If it's an 'update' action, it's optional (nullable) if no new file is uploaded.
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Allow only image files, max 2MB
        ];

        // Conditionally make 'image' required for 'insert' action
        if ($this->input('action') === 'insert') {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        // 'id' is required only for 'update' and 'delete' actions
        if (in_array($this->input('action'), ['update', 'delete'])) {
            $rules['id'] = 'required|integer|exists:team,id'; // Ensure ID exists in the 'team' table
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'post.required' => 'The designation field is required.',
            'name.required' => 'The name field is required.',
            'image.required' => 'An image is required for new team members.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a JPEG, PNG, JPG, or GIF.',
            'image.max' => 'The image may not be greater than 2 megabytes.',
            'id.required_if' => 'The ID is required for update or delete operations.',
            'id.exists' => 'The selected team member does not exist.',
        ];
    }
}