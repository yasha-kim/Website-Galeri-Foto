<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        $post = DB::table('posts')->get();

        return view('home')->with('posts',$post);
    }

    public function download($id)
    {
        $post = Post::find($id);

        // Check if the post exists
        if (!$post) {
            return redirect()->back()->with('alert', 'Post not found');
        }

        // Get the image path from the post
        $path = $post->path;

        // Check if the file exists
        if (Storage::exists('images/post/' . $path)) {
            // Return the file as a downloadable response
            return response()->download(storage_path('app/images/post/' . $path));
        } else {
            // Handle the case where the file does not exist
            return redirect()->back()->with('alert', 'File not found');
        }
    }
}
