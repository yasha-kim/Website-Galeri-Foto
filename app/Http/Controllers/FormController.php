<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Album;
use App\Post;
use Illuminate\Support\Facades\Auth;

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
            // Handle case where user is not authenticated
        }
    
        return redirect()->back()->with('success', 'Post Added');
    }

    public function update_form($id)
    {
        $post_id = $id;
        $update = DB::table('posts')
        ->where('posts.id','=',$id)
        ->first();
        return view('post.update')->with('update',$update)->with('id',$id);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'judulfoto' => 'required',
            'deskripsifoto' => 'required',
        ]);

        if (Auth::check()) {
            // Periksa apakah ada file yang diunggah
            if ($request->hasFile('path')) {
                foreach ($request->file('path') as $image) {
                    $slug = str_slug($request->name);
                    $currentDate = Carbon::now()->toDateString();
                    $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                    if (!file_exists('images/post')) {
                        mkdir('images/post', 0777, true);
                    }
                    $image->move('images/post', $imagename);

                    DB::table('posts')
                        ->where('id', $request->post_id)
                        ->update([
                            'judulfoto' => $request->judulfoto,
                            'deskripsifoto' => $request->deskripsifoto,
                            'user_id' => Auth::user()->id,
                        ]);
                }
            } else {
                // Lakukan sesuatu jika tidak ada file yang diunggah
            }

            return redirect()->back()->with('success', 'Post Updated');
        } else {
            $imagename = "default.png";
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();
        $comments = DB::table('comments')->where('post_id', $id)->get();
        return view('post.show-pin', compact('post', 'comments'));
    }

    public function delete($id)
    {
        DB::table('posts')->where('id', '=', $id)->delete();
        return redirect()->back()->with('alert', 'Post Deleted');
    }
}
