<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photos;

class GalleryController extends Controller
{
    public function index() {
        $photos = new Photos();
        return view('gallery', compact('photos'));
    }
}
