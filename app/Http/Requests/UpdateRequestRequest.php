<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'status' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:100'],
        ];

        // Conditionally add image validation rule if 'image' is present in the request
        if ($this->hasFile('image')) {
            $rules['image'] = ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'];
        }

        return $rules;
    }
}
