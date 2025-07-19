<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    // Handle blog post form submission
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'featured_image' => 'required|image|mimes:jpg,jpeg,png',
            'content' => 'required|json',
        ]);

        // Store the image
        $path = $request->file('featured_image')->store('featured_images', 'public');

        // Get raw JSON content
        $content = $request->input('content');

        if (!$content) {
            return back()->withErrors(['content' => 'Editor content is missing or invalid.']);
        }

        // ✅ Save content as a JSON string
        $post = Post::create([
            'title' => $request->title,
            'featured_image' => $path,
            'content' => $content,
        ]);

        Log::info('Post created', ['id' => $post->id]);

        return redirect()->route('posts.show', $post->id)->with('success', 'Post created!');
    }

    // Handle Editor.js image upload
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('editor_images', 'public');
            return response()->json([
                'success' => 1,
                'file' => ['url' => asset("storage/$path")]
            ]);
        }

        return response()->json([
            'success' => 0,
            'message' => 'Upload failed.'
        ]);
    }

    public function show($id)
    {

        $post = Post::findOrFail($id);

        // If $post->content is a JSON string, decode it
        $content = is_string($post->content) ? json_decode($post->content, true) : $post->content;
//dd($content);
        return view('posts.show', compact('post', 'content'));
    }
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->featured_image) {
            Storage::delete($post->featured_image);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
