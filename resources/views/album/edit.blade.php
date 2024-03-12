<div class="modal fade" id="editModal{{ $album->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h2 class="modal-title" id="exampleModalLabel">Edit Album</h2>
                
            </div>
            <div class="modal-body">
                <form class="p-10 mw-5xl mx-auto bg-light-light" method="post" action="{{route('album.update', ['id' => $album->id])}}">
                    <div class="row g-8">
                    {{csrf_field()}}

                    @method('PUT')

                    <div class="col-12 pb-3 ">
                        <div class="form-group text-start">
                        <label class="mb-1 fw-medium text-light-dark" for="modalInput2-7">Nama Album</label>
                        <input type="text" name="nama_album" class="form-control" value="{{ old ( 'nama_album', $album->nama_album ) }}"/>
                        </div>
                    </div>
                    <div class="col-12 pb-3 ">
                        <div class="form-group text-start">
                        <label class="mb-1 fw-medium text-light-dark" for="modalInput2-7">Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control" value="{{ old ( 'deskripsi', $album->deskripsi ) }}"/>
                        </div>
                    </div>
                    
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning rounded-pill" style="font-size:18px;">Update</button>
                    </div>
                    
                </form>
            </div>
        
        </div>
    </div>

</div>