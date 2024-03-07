<?php

namespace App\Http\Controllers;

use App\Album;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'path.*' => 'required|mimes:jpeg,jpg,bmp,png,gif,svg',
            'judulfoto' => 'required',
            'deskripsifoto' => 'required',
            'album_id' => 'required|exists:albums,id',
        ]);
    
        if (Auth::check()) {
            foreach ($request->file('path') as $image) {
                $slug = str_slug($request->name);
                $currentDate = Carbon::now()->toDateString();
                $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                if (!file_exists('images/post')) {
                    mkdir('images/post', 0777, true);
                }
                $image->move('images/post', $imagename);
    
                DB::table('posts')->insert([
                    'judulfoto' => $request->judulfoto,
                    'deskripsifoto' => $request->deskripsifoto,
                    'path' => $imagename,
                    'likes_count' => 0,
                    'album_id' => $request->album_id,
                    'user_id' => Auth::user()->id,
                ]);
            }
        } else {

        }
    
        return redirect()->route('dashboard')->with('success', 'Post Added');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        // Perform a search based on the keyword
        $post = Post::where('judulfoto', 'like', '%' . $keyword . '%')
                     ->orWhere('deskripsifoto', 'like', '%' . $keyword . '%')
                     ->get();

        return view('post.search-results', compact('post', 'keyword'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'judulfoto' => 'required',
            'deskripsifoto' => 'required',
        ]);

        $post->update([
            'judulfoto' => $request->judulfoto,
            'deskripsifoto' => $request->deskripsifoto,
        ]);

        return redirect()->back()
            ->with('success', 'Post updated successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show_post($id)
    {
        $post = Post::find($id);
        $comments = DB::table('comments')->where('post_id', $id)->get();

        foreach ($post->comments as $comment) {
            $comment->created_at = $comment->created_at ?? Carbon::now();
        }
        
        return view('post.show-pin', compact('post', 'comments'));
    }

    public function show($id)
    {
        $post = Post::with('comments')->find($id);

        // Check if the post exists
        if ($post) {
            // Retrieve comments using Eloquent relationship
            $comments = $post->comments;
    
            // Loop through comments and set created_at if null
            foreach ($comments as $comment) {
                $comment->created_at = $comment->created_at ?? Carbon::now();
            }
    
            return view('post.show-user', compact('post', 'comments'));
        }
    }

    public function delete($id)
    {
        $post = Post::with('comments')->find($id);

        // Check if the post exists
        if ($post) {
            // Loop through comments and set created_at if null
            foreach ($post->comments as $comment) {
                $comment->created_at = $comment->created_at ?? Carbon::now();
            }

            // Delete the post and its comments
            $post->delete();

            return redirect()->route('dashboard')->with('alert', 'Post Deleted');
        }
    }
}
