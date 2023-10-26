<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\BlogPost;

class MyBlogController extends Controller
{
    public function index()
    {
        $blogPosts = BlogPost::orderBy('created_at', 'desc')->paginate(5);
        foreach ($blogPosts as $post) {
            $post->randomComment = $post->comments()->inRandomOrder()->first();
        }
        return view('myBlog', compact('blogPosts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpg|max:2048',
            'content' => 'required',
        ]);
        $post = new BlogPost();
        $post->title = $request->title;
        $post->content = $request->getContent();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->path();
            $imageFile = file_get_contents($imagePath);
            $post->image = base64_encode($imageFile);
        }

        $post->save();

        return back()->with('success', 'Your data have been submitted successfully.');
    }

    public function storeComment(Request $request) {
        $comment = new Comment;
        $comment->user_id = auth()->id();
        $comment->post_id = $request->postId;
        $comment->comment = $request->comment;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->path();
            $imageFile = file_get_contents($imagePath);
            $comment->image = base64_encode($imageFile);
        }

        $comment->save();

        return response()->json([
            'username' => $comment->user->name,
            'comment' => $comment->comment,
            'created_at' => $comment->created_at->toDateTimeString(),
            'image' => $comment->image,
        ]);
    }
}
