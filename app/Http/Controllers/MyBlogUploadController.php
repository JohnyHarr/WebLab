<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Rules\CsvFileExtension;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;

class MyBlogUploadController extends Controller
{
    public function index() {
        return view('myBlogUpload');

    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'max:2048', new CsvFileExtension()]
        ]);

        $filename = $request->file('file')->getClientOriginalName();
        $path = $request->file('file')->storeAs('csv', $filename, 'public');

        $file = fopen(storage_path("app/public/{$path}"), "r");

        $header = fgetcsv($file);
        while ($row = fgetcsv($file)) {
            $data = array_combine($header, $row);

            $post = new BlogPost([
                'title' => $data['title'],
                'content' => $data['content'],
            ]);

            if (!empty($data['image'])) {
                $post->image = preg_replace('#^data:image/\w+;base64,#i', '', $data['image']);
            }

            $post->created_at = \Carbon\Carbon::parse($data['created_at']);
            $post->save();
        }

        fclose($file);

        return back()->with('success', 'Your data have been submitted successfully.');
    }

    public function download()
    {
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=blog_posts.csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $posts = BlogPost::all();
        $columns = ['title', 'content', 'image', 'created_at'];

        $callback = function() use($posts, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($posts as $post) {
                fputcsv($file, [$post->title, $post->content, $post->image, $post->created_at]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
