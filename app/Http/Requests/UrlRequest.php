<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UrlRequest extends FormRequest
{
    protected $redirect = '/';

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
        return [
            'original_url' => 'required|url'
        ];
    }

    public function messages(): array

    {
        return [
            'original_url.required' => 'The URL is required.',
            'original_url.url' => 'The URL is invalid.',
        ];

    }
}
