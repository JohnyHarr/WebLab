<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IncFileExtension implements Rule
{
    public function passes($attribute, $value)
    {
        $fileExtension = $value->getClientOriginalExtension();
        return strtolower($fileExtension) === 'inc';
    }    

    public function message()
    {
        return 'File extension is not "inc".';
    }
}
