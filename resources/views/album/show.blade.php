<!-- resources/views/albums/show.blade.php -->
@extends('layouts.app')

@section('content')
<a href="{{route('dashboard')}}" class="btn btn-light rounded-circle shadow-sm" role="button" style="margin-left:10px;margin-top:10px;">
    <i class="fa-solid fa-arrow-left" aria-hidden="true" style="font-size:18px;"></i>
  </a>

<div class="container">
  <div class="py-3 px-sm-5">     
      
      <div class="card-body pt-0">
          <div class="row mt-4" >
              <div class="col">
                  <div class="d-flex justify-content-center">
                      <div class="d-grid text-center">
                          <span class="text-lg" style="font-size:x-large;font-weight:bolder;">{{ $album->nama_album }}</span>
                      </div>
                      
                  </div>
              </div>
          </div>
          <div class="text-center mt-4">

              <div class="h6 font-weight-300">
                <p>{{ $album->deskripsi }}</p>
              </div>
          </div>
      </div>
  </div>

  <div class="columns-1 gap-2 space-y-4 p-4 sm:columns-2 md:columns-3 lg:columns-4">
        @foreach (App\Post::all() as $value)
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
            @endif
        @endforeach
        @include('post.update')
    </div>

  
  <div>
    <a class="btn rounded-pill" href="{{ route('form') }}" role="button"  style="position: fixed; left: 50%; bottom: 20px; transform: translateX(-50%); background-color: #F39F5A; color:black;font-weight:bolder;">
        <i class="fa-solid fa-plus"></i>&nbsp;New Pin
    </a>
    
</div>
        
</div>
@endsection