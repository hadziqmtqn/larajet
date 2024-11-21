<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TexteditorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'description' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
