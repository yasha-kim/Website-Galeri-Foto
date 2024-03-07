<?php

namespace App\Http\Controllers;

use App\Album;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        return view('album.index');
        // $pins = DB::table('pins')->get();

        // return view('album.index')->with('pins',$pins);
    }


    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $album = Album::create([
            'nama_album' => $request->nama_album,
            'deskripsi' => $request->deskripsi,
            'user_id' => \Auth::user()->id,
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

        return view('album.show', ['album' => $album]);
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param int $id
	 * @return \Illuminate\Http\Response
     */
    
    public function edit($id)
    {
        $albums = Album::find($id);
        return view('albums.edit', compact('albums'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $validatedData  = $request->validate([
            'nama_album' => 'required',
            'deskripsi' => 'required',
        ]);

        Album::find($id)->update($validatedData);

        // $albums->nama_album = $validatedData['nama_album'];
        // $albums->deskripsi = $validatedData['deskripsi'];
        // Update other fields as needed

        return redirect()->route('albums.album-management');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(string $id)
    {
        $albums = Album::find($id);
        $albums->delete();

        return redirect()->route('albums.album-management')->with('success', 'Album berhasi dihapus!');
    }

}
