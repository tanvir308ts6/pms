<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class JailType implements Rule
{
    private array $types = ['low', 'medium', 'high'];

    public function passes($attribute, $value): bool
    {
        foreach ($this->types as $type) {
            if ($type === $value) {
                return true;
            }
        }
        return false;
    }

    public function message(): string
    {
        return 'The :attribute must match the following options "low", "medium" and "high"';
    }
}
