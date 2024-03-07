<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
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
        $post = DB::table('posts')->get();

        return view('home')->with('posts',$post);
    }

    public function dashboard()
    {
        $posts = DB::table('posts')
        ->where('user_id','=',\Auth::user()->id)
        ->get();  
        $albums = DB::table('albums')
        ->where('user_id','=',\Auth::user()->id)
        ->get();      
        return view('post.index', compact('posts', 'albums'));
    }
}
