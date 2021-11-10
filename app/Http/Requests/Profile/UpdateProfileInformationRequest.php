<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileInformationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'min:3', 'max:35'],
            'last_name' => ['required', 'string', 'min:3', 'max:35'],
            'username' => ['required', 'string', 'min:3', 'max:20'],
            'birthdate' => ['nullable', 'string', 'date_format:d/m/Y',
                'after_or_equal:' . date('Y-m-d', strtotime('-70 years')),
                'before_or_equal:' . date('Y-m-d', strtotime('-18 years'))],
            'personal_phone' => ['required', 'numeric', 'digits:10'],
            'home_phone' => ['required', 'numeric', 'digits:9'],
            'address' => ['required', 'string', 'min:5', 'max:50'],
        ];
    }
}
