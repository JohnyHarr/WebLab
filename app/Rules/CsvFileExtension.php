<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CsvFileExtension implements Rule
{
    public function passes($attribute, $value)
    {
        $fileExtension = $value->getClientOriginalExtension();
        return strtolower($fileExtension) === 'csv';
    }    

    public function message()
    {
        return 'File extension is not "csv".';
    }
}
