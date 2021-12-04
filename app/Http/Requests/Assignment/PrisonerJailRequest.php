<?php

namespace App\Http\Requests\Assignment;

use Illuminate\Foundation\Http\FormRequest;

class PrisonerJailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'jail' => ['required', 'string', 'numeric', 'exists:jails,id']
        ];
    }
}
