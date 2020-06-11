<?php

namespace App\Rules;

use App\Word;
use Illuminate\Contracts\Validation\Rule;

class WordsMustExist implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!empty(Word::first())){
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
        return 'Currently there are no words in our database.';
    }
}
