<?php

namespace App\Http\Requests\Ward;

use App\Rules\Alpha;
use Illuminate\Foundation\Http\FormRequest;

class WardInformationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'=> ['required', 'string', new Alpha, 'min:3', 'max:45'],
            'location' => ['required', 'string', new Alpha, 'min:3', 'max:45'],
            'description' => ['nullable', 'string', new Alpha, 'min:5', 'max:255'],
        ];
    }
}
