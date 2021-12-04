<?php

namespace App\Http\Requests\Assignment;

use Illuminate\Foundation\Http\FormRequest;

class GuardWardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'ward' => ['required', 'string', 'numeric', 'exists:wards,id']
        ];
    }
}
