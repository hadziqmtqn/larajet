<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LetterTemplateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'category' => ['required', 'exists:letters,category'],
            'name' => ['required'],
            'email' => ['required', 'email', 'max:254'],
            'date' => ['required', 'date'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
