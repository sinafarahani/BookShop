<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookUpdateRequest extends FormRequest
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
        return [
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'language' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'publisher' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'integer'],
            'available' => ['required', 'integer'],
            'Publication' => ['nullable', 'integer'],
            'description' => ['nullable', 'string', 'max:65535'],
        ];
    }
}
