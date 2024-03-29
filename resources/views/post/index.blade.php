@extends('layouts.app')

@section('content')

<div class="py-3 px-sm-5">      
    <div class="card-body pt-0">     
        <div class="text-center mt-4">   
            <h5>
            {{ Auth::user()->name }}
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#userEdit" data-id="{{ Auth::user()->id }}" style="font-size:18px;">
                <i class="fa-solid fa-pen-to-square" aria-hidden="true" style="color:#F39F5A;"></i>
            </button>    

            </h5>
            
            <div class="h6 font-weight-300">
            {{ Auth::user()->fullname }}<span class="font-weight-light">, {{ Auth::user()->address }}</span>
            </div>
        </div>
    </div>
</div>
@include('profile.edit')

<div class="d-flex justify-content-center">
    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
        <label class="btn btn-outline-warning" for="btnradio1">Post&nbsp;<span class="badge rounded-pill text-bg-warning">{{ $posts->count() }}</span></label>

        <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
        <label class="btn btn-outline-warning" for="btnradio2">Album&nbsp;<span class="badge rounded-pill text-bg-warning">{{ $albums->count() }}</span></label>

    </div>
</div>

<div class="content1">
    <div class="card-header text-center border-0 pt-4 pt-lg-3 pb-4 pb-lg-3 px-4">
        <div class="d-flex justify-content-end">

            <div class="dropdown dropleft">
                <button class="btn btn-warning rounded-circle shadow-sm" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding:4px 13px;">
                    <i class="fa-solid fa-plus"></i>
                </button>
                <div class="dropdown-menu mt-1 shadow-lg">
                    <h6 class="dropdown-header">Tambah</h6>
                    <hr>
                    <a class="dropdown-item" role="button" data-bs-toggle="modal" data-bs-target="#albumModal">Album</a>
                    <a class="dropdown-item" role="button" href="{{route('form')}}">Post</a>
                </div>
            </div>

            <!-- Modal Tambah Album-->
            <div class="modal fade" id="albumModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header ">
                            <h2 class="modal-title" id="exampleModalLabel">Buat Album Baru</h2>   
                        </div>
                        <div class="modal-body">
                            <form class="p-10 mw-5xl mx-auto bg-light-light " method="post" action="{{route('album.store')}}">
                                <div class="row g-8">
                                {{csrf_field()}}

                                @method('POST')

                                <div class="col-12 pb-3 ">
                                    <div class="form-group text-start">
                                        <label class="mb-1 fw-medium text-light-dark" for="modalInput2-7">Judul</label>
                                        <input class="form-control" name="nama_album" type="text" placeholder="Seperti 'Tempat yang Harus Dikunjungi'">
                                    </div>
                                </div>
                                <div class="col-12 pb-3">
                                    <div class="form-group text-start">
                                        <label class="mb-1 fw-medium text-light-dark" for="modalInput2-8">Deskripsi</label>
                                        <textarea class="form-control" name="deskripsi" placeholder="Deskripsi"></textarea>
                                    </div>
                                </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-warning rounded-pill" style="font-size:18px;">Tambah</button>
                                </div>
                                
                            </form>
                        </div>
                    
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="columns-1 gap-2 space-y-4 p-4 sm:columns-3 md:columns-3 lg:columns-4">
        @foreach ($posts->sortByDesc('tglunggah') as $value) 
            @if ($value->user_id == Auth::user()->id)
            <div class="relative mb-1 before:content-[''] before:rounded-md before:absolute before:inset-0 before:bg-black before:bg-opacity-20 ">
            
            <img class="w-full rounded-4 img-edit" src="images/post/{{$value->path}}">
                
                <div class="test__body absolute inset-0 p-3 text-white flex flex-col">
                    <div class="relative">
                        <a class="test__link absolute inset-0" href="{{route('pin-user.show', ['id' => $value->id])}}"></a>
                        <h1 class="test__title text-md font-bold mb-2">{{$value->judulfoto}}</h1>
                    </div>    
                </div>
            </div>
                @else
                <center><h1 class="text-center">You Have No Post</h1></center>
            @endif
        @endforeach
        @include('post.update')

    </div>
</div>

<div id="content2" style="display:none;">
    <div class="row " style="padding:1.5rem;margin-top:1rem;border-radius:1.5rem;">
        @php
            $albums = App\Album::where('user_id', Auth::user()->id)->orderBy('nama_album')->get();
        @endphp
        
        @foreach($albums as $album)
            <div class="col-md-2 mb-4">
                <div class="card shadow-sm rounded-3">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-warning edit-button hidden rounded-pill shadow-md" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 20px;">
                                    <i class="fa-solid fa-ellipsis"></i>
                                </button>
                                <ul class="dropdown-menu shadow-lg">
                                <li>
                                    <form action="{{ route('album.destroy', $album->id) }}" method="post" >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this album?')"><i class="fa-solid fa-trash"></i>&nbsp;Hapus</button>
                                    </form>
                                </li>
                                </ul>
                
                            </div>
                        </div>
                        <h5 class="card-title">{{ $album->nama_album }}</h5>
                        <a href="{{ route('album.show', $album->nama_album) }}" class="btn btn-primary">Lihat Album</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


@endsection