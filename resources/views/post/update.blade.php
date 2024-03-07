@foreach(App\Post::all() as $post)
<div class="modal fade" id="modalEdit{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h2 class="modal-title" id="exampleModalLabel">Edit Post</h2>
                
            </div>
            <div class="modal-body">
                <form class="p-10 mw-5xl mx-auto bg-light-light " method="post" action="{{ route('update', $post->id)}}">
                    <div class="row g-8">
                    {{csrf_field()}}

                    @method('PUT')

                    <div class="col-12 pb-3 ">
                        <div class="form-group text-start">
                            <label class="mb-1 fw-medium text-light-dark" for="modalInput2-7">Judul</label>
                            <input type="text" name="judulfoto" class="form-control" value="{{ old('judulfoto', $post->judulfoto) }}" required>
                        </div>
                    </div>
                    <div class="col-12 pb-3">
                        <div class="form-group text-start">
                            <label class="mb-1 fw-medium text-light-dark" for="modalInput2-8">Deskripsi</label>
                            <textarea name="deskripsifoto" class="form-control" required>{{ old('deskripsifoto', $post->deskripsifoto) }}</textarea>
                        </div>
                    </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn rounded-pill" style="font-size:18px;background-color: #F39F5A; color:white;">Simpan</button>
                    </div>
                    
                </form>
            </div>
            
        </div>
    </div>
</div>
@endforeach