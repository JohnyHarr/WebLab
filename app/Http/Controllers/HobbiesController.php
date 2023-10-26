<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interests;

class HobbiesController extends Controller
{
    public function index() {
        $interests = new Interests();
        return view('hobbies', compact('interests'));
    }
}
