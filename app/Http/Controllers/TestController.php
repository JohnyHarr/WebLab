<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TestRequest;

class TestController extends Controller
{
    public function index() {
        return view('test');
    }

    public function store(TestRequest $request)
    {
        return back()->with('success', 'Your test answers have been submitted successfully.');
    }
}
