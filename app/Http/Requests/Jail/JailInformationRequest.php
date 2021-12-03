<?php

namespace App\Http\Requests\Jail;

use App\Rules\Alpha;
use App\Rules\JailType;
use Illuminate\Foundation\Http\FormRequest;

class JailInformationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', new Alpha, 'min:3', 'max:45'],
            'code' => ['required', 'string', 'alpha_dash', 'min:5', 'max:45'],
            'type' => ['required', 'string', new JailType],
            'capacity' => ['required', 'string', 'numeric', 'digits:1', 'min:2', 'max:5'],
            'ward' => ['required', 'string', 'numeric', 'exists:wards,id'],
            'description' => ['nullable', 'string', new Alpha, 'min:5', 'max:255'],
        ];
    }
}
