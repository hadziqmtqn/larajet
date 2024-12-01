<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LetterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'category' => ['required'],
            'file' => ['required', 'file', 'mimes:docx', 'max:500']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
