<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'address' => ['required', 'string', 'max:255'],
            'instagram' => ['nullable', 'regex:/^[A-Za-z0-9._]{1,30}$/'],
            'whatsapp' => ['nullable', 'regex:/^\+?[0-9]{8,20}$/'],
            'website' => ['nullable', 'url', 'max:255', 'regex:/^(https?:)\/\//i'],
        ];
    }
}
