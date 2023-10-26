<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'Name' => 'required|string|min:3|regex:/^[A-Za-z]+ [A-Za-z]+ [A-Za-z]+$/',
            'Gender' => 'required|in:Male,Female,Secret',
            'Age' => 'required|in:<14,14-17,18-29,30-49,50-59,>59',
            'BirthDate' => 'required|date_format:j.M.Y',
            'Message' => 'required|string|min:1|max:1000',
            'Mail' => 'required|email',
            'PhoneNumber' => ['required', 'regex:/^[\+][7|3][\d]{7,9}[\d]$/']
        ];
    }
}
