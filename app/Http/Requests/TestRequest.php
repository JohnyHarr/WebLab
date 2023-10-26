<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\SumEqualsTen;

class TestRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:3|regex:/^[A-Za-z]+ [A-Za-z]+ [A-Za-z]+$/',
            'group' => 'required|string|regex:/^[A-Z]{2}\/[a-z]-\d{2}-\d-[a-z]$/',
            'question1' => 'required|string|in:E=mc^2',
            'question2a' => 'prohibited',
            'question2b' => 'required',
            'question3' => 'required|string|in:Бозон Хиггса'
        ];
    }
}
