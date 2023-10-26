<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\IncFileExtension;

class GuestBookUploadController extends Controller
{
    public function index() {
        return view('guestBookUpload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'max:2048', new IncFileExtension()]
        ]);

        $uploadedFile = $request->file('file');
        $filename = 'messages.inc';

        $destinationPath = storage_path('app');
        $uploadedFile->move($destinationPath, $filename);

        return back()->with('success', 'Your data have been submitted successfully.');
    }
}
