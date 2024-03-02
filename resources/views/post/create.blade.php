@extends('layouts.app')

@section('content')
@if($message = Session::get('success'))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif
<div class="container-fluid">

  <div class="row">
    <div class="col-6">
        <div class="panel-body">
            <div class="image-preview"></div>
        </div>
    </div>
    
    
    <div class="col-6">
        <div class="panel-body">
        
            <form method="post" action="{{ route('store') }}" enctype="multipart/form-data"> 
                {{csrf_field()}}
                @method('POST')
                <div class="row">
                    <div class="col-md-8">
                        <label class="form-label">Upload</label>
                        {!! Form::file('path[]', ['class' => 'form-control image-upload', 'multiple' => true]) !!}                
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control image-title" name="judulfoto" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Description</label>
                            <textarea class="form-control image-description" name="deskripsifoto" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Album</label>
                            <select name="album_id" class="form-select">
                                <option value="">--Pilih Album--</option>
                                @foreach(App\Album::all() as $album)
                                @if ($album->user_id == Auth::user()->id)

                                    <option value="{{ $album->id }}">{{ $album->nama_album }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="margin-top:10px;justify-content:flex-start;">
                    <button type="submit" class="btn rounded-pill" href="" style="font-size:18px;background-color: #F39F5A; color:white;">Create</button>
                </div>
            </form>

        </div>
    </div>
  </div>
</div>
@endsection
