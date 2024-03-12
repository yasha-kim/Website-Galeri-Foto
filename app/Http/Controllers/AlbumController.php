<?php

namespace App\Http\Controllers;

use App\Album;
use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AlbumController extends Controller
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
        $albums = Album::all();
        return view('album.show', compact('albums'));
    }


    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate([
            'nama_album' => 'required',
            'deskripsi' => 'required',
            // Add any other validation rules as needed
        ]);

        $album = Album::create([
            'nama_album' => $request->input('nama_album'),
            'deskripsi' => $request->input('deskripsi'),
            'user_id' => Auth::user()->id,
            // Add any other fields you want to save
        ]);

        // Generate a unique slug for the album name
        $albumSlug = Str::slug($album->nama_album);

        $album->nama_album = $albumSlug;
        $album->save();

        // Redirect to the show route with the generated slug
        return redirect()->route('album.show', ['albumSlug' => $albumSlug]);

    }

    public function show($albumSlug)
    {
        $album = Album::where('nama_album', $albumSlug)->first();

        return view('album.show', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param int $id
	 * @return \Illuminate\Http\Response
     */
    
     public function edit($id)
     {
         $album = Album::findOrFail($id);
         return view('album.edit', compact('album'));
     }

    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, $id)
     {
         $request->validate([
             'nama_album' => 'required',
             'deskripsi' => 'required',
         ]);
 
         $album = Album::findOrFail($id);
         $album->update([
             'nama_album' => $request->input('nama_album'),
             'deskripsi' => $request->input('deskripsi'),
         ]);
 
         return redirect()->back()->with('success', 'Album berhasil diupdate!');
     }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(string $id)
    {
        $album = Album::findOrFail($id);
        $album->delete();

        return redirect()->back()->with('success', 'Album berhasil dihapus!');
    }

}
