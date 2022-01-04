<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NickName implements Rule
{
    private string $regular_expression = "/^(?=.*[a-z])[a-z\.\-\_\d)]+$/";

    /* Determine if the validation rule passes */
    public function passes($attribute, $value): bool
    {
        return (bool)preg_match($this->regular_expression, $value);
    }

    /* Get the validation error message */
    public function message(): string
    {
        return 'The :attribute may only contain lowercase letters, numbers, points, underscores and hyphens.';
    }
}
