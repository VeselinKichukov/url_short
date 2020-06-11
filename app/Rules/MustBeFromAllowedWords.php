<?php

namespace App\Rules;

use App\Word;
use Illuminate\Contracts\Validation\Rule;

class MustBeFromAllowedWords implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (empty($value) || empty(Word::first())) {
            return true;
        }
        if (!empty(Word::whereWord($value)->first())) {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The word is not in the list of allowed words.';
    }
}
