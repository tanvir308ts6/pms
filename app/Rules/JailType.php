<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class JailType implements Rule
{
    private array $types = ['low', 'medium', 'high'];

    /* Determine if the validation rule passes */
    public function passes($attribute, $value): bool
    {
        foreach ($this->types as $type) {
            if ($type === $value) {
                return true;
            }
        }
        return false;
    }

    /* Get the validation error message */
    public function message(): string
    {
        return 'The :attribute must match the following options "low", "medium" and "high"';
    }
}
