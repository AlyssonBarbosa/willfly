<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UfValidator implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $uf = strtoupper($value); 
        $state = array("AC", "AL", "AM", "AP", "BA", "CE", "DF", "ES", "GO", "MA", "MT", " MS "," MG "," PA "," PB "," PR "," PE "," PI "," RJ "," RN "," RO "," RS "," RR "," SC " , "SE", "SP", "TO");
        return in_array($uf, $state);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'UF inválido.';
    }
}
