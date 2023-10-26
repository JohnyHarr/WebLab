<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SumEqualsTen implements Rule
{
    public function passes($attribute, $value)
    {
        return array_sum($value) === 10;
    }

    public function message()
    {
        return 'Sum is not equal to 10.';
    }
}
