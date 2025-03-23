<?php
// App/Rules/MoreThanOneWord.php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MoreThanOneWord implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed   $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Check if the name contains more than one word
        return str_word_count($value) > 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute must have more than one word.';
    }
}
