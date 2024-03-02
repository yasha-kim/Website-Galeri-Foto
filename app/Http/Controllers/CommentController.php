<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
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
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'isikomentar' => 'required',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->post_id =  $request->input('post_id');
        $comment->isikomentar = $request->input('isikomentar');
        $comment->tglkomentar = now();
        $comment->save();

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function replay(Request $request, $id)
    {
        $request->validate([
            'replay' => 'required|string',
        ]);

        $parentComment = Comment::findOrFail($id);

        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->post_id =  $parentComment->post_id;
        $comment->isikomentar = $request->input('replay');
        $comment->parent_id = $parentComment->id;
        $comment->tglkomentar = now();
        $comment->save();

        return redirect()->back()->with('success', 'Replay added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return view('post.show-pin', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
