@extends('layouts.app')

@section('content')
  <a href="{{route('home')}}" class="btn btn-light rounded-circle shadow-sm" role="button" style="margin-left:10px;margin-top:10px;">
    <i class="fa-solid fa-arrow-left" aria-hidden="true" style="font-size:18px;"></i>
  </a>

  <div class="container">
 
    <div class="row d-flex flex-wrap justify-content-center" >
      <div class="col-md-10">
        <div class="card mb-4 mx-auto mt-2 py-10 bg-white rounded-5 shadow-lg" style="min-height: 300px;padding-top:0px;padding-bottom:0px;">
          <div class="card-body">
            <div class="card-group">

              <div class="card">
                <img class="img-fluid rounded-4" src="{{asset('images/post/'.$post->path)}}">
              </div>

              <div class="card" style="min-height: 300px;">

                <div class="card-header">
                  <div class="d-flex justify-content-end">
                    <button class="btn btn-warning rounded-pill" type="button" style="font-size: 20px;">
                    <i class="fa-solid fa-download"></i>
                    </button>
    
                  </div>
                </div>

                <div class="card-body">
                  <div class="content">
                    <img class="w-full rounded-4">

                    <h3 class="card-title my-2" style="font-weight:bold;font-size:xx-large;">{{$post->judulfoto}}</h3>
                    <p class="text-muted" style="font-size:20px;">{{$post->deskripsifoto}}</p>
                  </div>
                  <div class="boxscroll" style="min-height: 300px;">
                    
                      <div class="content">
                      @foreach (App\Comment::all() as $comment)
                      @if ($comment->user_id == Auth::user()->id)
                        <div class="panel panel-default">
                          <div class="panel-heading">{{$comment->user->name}} said:</div>
                            <div class="panel-body">
                              <p>{{ $comment->isikomentar }}</p>
                              <small>Commented on: {{$comment->tglkomentar}}</small>
                            </div>
                        </div>
                        @endif
                      @endforeach

                      </div>
                      <div class="card mb-3">
                        <div class="card-body">
                          <h5 class="card-title"></h5>
                          <p class="card-text"></p>
                          <p class="card-text"><small class="text-muted"></small></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="card-footer" style="padding-top:1rem;padding-bottom:1rem;margin-right:-10px;">
                    <div class="d-flex justify-content-between">
                      <div class="p-2">What do you say?</div>
                      <div class="p-2">
                        <a class="float-right" href="{{ route('like',$post->id)}}">
                          <i class="fa-solid fa-heart fa-2xl" style="color: #f39f5a;"></i>{{$post->likes_count}}
                        </a>
                      </div>
                    </div>
                    

                    <form action="{{ route('comment.store', ['post_id' => $post->id]) }}" method="POST">
                      @csrf
                      <div class="input-group">
                        <textarea id="comment" name="isikomentar" rows="1" placeholder="Tulis komentar"></textarea>
                        <button id="submit"><i class="fa-solid fa-paper-plane"></i></button>
                      </div>
                    </form>
                
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  

@endsection