<?php

namespace App\Http\Requests\Movie;

use Illuminate\Foundation\Http\FormRequest;

class Save extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'year' => [
                'required',
                'integer',
                'digits:4',
                'min:1900',
                'max:2023',
            ],
            'country_id' => [
                'required',
                'integer',
                'exists:countries,id'
            ],
            'genre_ids' => [
                'required',
                'array',
            ],
            'genre_ids.*' => [
                'integer',
                'exists:genres,id'
            ],
        ];
    }
}
