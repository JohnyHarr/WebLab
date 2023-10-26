<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;

class MyBlogEditorController extends Controller
{
    public function index()
    {
        $blogPosts = BlogPost::orderBy('created_at', 'desc')->paginate(5);
        return view('myBlogEditor', compact('blogPosts'));
    }

    public function editorMyBlogEditor()
    {
        $blogPosts = BlogPost::orderBy('created_at', 'desc')->paginate(5);
        return view('editorMyBlogEditor', compact('blogPosts'));
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
        $post->content = $request->content;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->path();
            $imageFile = file_get_contents($imagePath);
            $post->image = base64_encode($imageFile);
        }

        $post->save();

        return back()->with('success', 'Your data have been submitted successfully.');
    }

    public function storeXML(Request $request){
        $xmlString = $request->getContent();
        $xmlObject = simplexml_load_string($xmlString);
        $dataArray = json_decode(json_encode((array) $xmlObject), true);
        $post = new BlogPost();
        $post->title = $dataArray['title'];
        $post->content = $dataArray['content'];
        if($dataArray['image']!=null) {
            $post->useURL = $dataArray['useURL'] == 'true';
            $post->image = $dataArray['image'];
        }
        $post->save();
        $xml = new \SimpleXMLElement('<root/>');
        $xml->addChild('date', $post->created_at->format('d.m.Y H:i'));
        $xml->addChild('id', $post->id);
        return response($xml->asXML(), 200)->header('Content-Type', 'application/xml');
    }

    public function update(Request $request) {
        $xmlString = $request->getContent();
        $xmlObject = simplexml_load_string($xmlString);
        $dataArray = json_decode(json_encode((array) $xmlObject), true);
        if($dataArray['image']==null)
            $dataArray['image']='';
        BlogPost::updateOrCreate(
            ['id' => $dataArray['id']],
            [
                'title' => $dataArray['title'],
                'content' => $dataArray['content'],
                'image' => $dataArray['image'],
                'useURL' => $dataArray['useURL'] == 'true'
            ]
        );
    }

    public function delete($postId){
        $post = BlogPost::find($postId);

        if ($post) {
            $post->delete();

            $xml = new \SimpleXMLElement('<root/>');
            $xml->addChild('status', 'success');
            $xml->addChild('message', 'Post deleted successfully');
            return response($xml->asXML(), 200)->header('Content-Type', 'application/xml');
        } else {
            $xml = new \SimpleXMLElement('<root/>');
            $xml->addChild('status', 'error');
            $xml->addChild('message', 'Post not found');
            return response($xml->asXML(), 404)->header('Content-Type', 'application/xml');
        }
    }
}
