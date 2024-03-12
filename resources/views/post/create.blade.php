@extends('layouts.app')

@section('content')

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
                            <label class="form-label">Judul</label>
                            <input type="text" class="form-control image-title" name="judulfoto" placeholder="Judul" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control image-description" name="deskripsifoto" placeholder="Deskripsi" required></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Album</label>
                            <select name="album_id" class="form-select" required>
                                <option value="">--Pilih Album--</option>
                                @foreach(App\Album::where('user_id', Auth::user()->id)->get() as $album)
                                    <option value="{{ $album->id }}">{{ $album->nama_album }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
                <div class="modal-footer" style="margin-top:10px;justify-content:flex-start;">
                    <button type="submit" class="btn rounded-pill" href="" style="font-size:18px;background-color: #F39F5A; color:white;">Upload</button>
                </div>
            </form>

        </div>
    </div>
  </div>
</div>
@endsection
