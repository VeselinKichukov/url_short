<?php

namespace App\Rules;

use App\Word;
use Illuminate\Contracts\Validation\Rule;

class MustNotBeInUse implements Rule
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
        if (!empty(Word::whereWord($value)->whereUsed(1)->first())){
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The short url word is in use.';
    }
}
