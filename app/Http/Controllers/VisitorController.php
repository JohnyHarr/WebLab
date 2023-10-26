<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use Jenssegers\Agent\Agent;

class VisitorController extends Controller
{
    public function index()
    {
        $visitors = Visitor::orderBy('created_at', 'desc')->paginate(5);
        return view('visitors', compact('visitors'));
    }
}
