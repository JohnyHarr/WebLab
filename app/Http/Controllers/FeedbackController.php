<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FeedbackRequest;

class FeedbackController extends Controller
{
    public function index() {
        return view('feedback');
    }

    public function store(FeedbackRequest $request)
    {
        return back()->with('success', 'Your feedback has been submitted successfully.');
    }
}
