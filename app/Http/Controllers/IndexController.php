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
        $post = DB::table('post')
        ->where('id','=',$id)
        ->first();

        $image = Image::make($post->content);
        //dd($post->path);
        return response()->download('images/post/',$post->path);
    }
}
