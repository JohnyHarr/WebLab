<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class GuestBookController extends Controller
{
    public function index()
    {
        $filePath = storage_path('app/messages.inc');
        $messages = [];

        if (file_exists($filePath)) {
            $fileContent = file_get_contents($filePath);
            $lines = explode("\n", $fileContent);

            foreach ($lines as $line) {
                if (trim($line) != '') {
                    $messageData = explode(";", $line);
                    $messages[] = [
                        'date' => $messageData[0],
                        'name' => $messageData[1],
                        'email' => $messageData[2],
                        'message' => $messageData[3]
                    ];
                }
            }
        }

        $messages = array_reverse($messages);

        $perPage = 5;
        $currentPage = request('page') ?? 1;
        $offset = ($currentPage - 1) * $perPage;

        $paginatedMessages = array_slice($messages, $offset, $perPage);
        $messages = new LengthAwarePaginator($paginatedMessages, count($messages), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);

        return view('guestbook', ['messages' => $messages]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'surname' => 'required',
            'name' => 'required',
            'patronymic' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $message = date('Y-m-d H:i:s') . ';'
            . $request->input('surname') . ' ' . $request->input('name') . ' ' . $request->input('patronymic') . ';'
            . $request->input('email') . ';'
            . $request->input('message');

        $filePath = storage_path('app/messages.inc');

        file_put_contents($filePath, $message . "\n", FILE_APPEND);

        return back()->with('success', 'Your data have been submitted successfully.');
    }

}
