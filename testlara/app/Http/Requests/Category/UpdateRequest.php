<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        if ($this->expectsJson()) {
            $response = new Response($validator->errors(), 400 );
            throw new ValidationException($validator, $response);
        }
    }
    
    public function rules(): array
    {
        return [
            'title' => 'required|min:5|max:500',
            'slug' => 'required|min:3|max:500|unique:categories,slug,' . $this->route('category')->id 
        ];
    }
}
