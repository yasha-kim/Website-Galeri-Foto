@foreach(App\Post::all() as $value)
<div class="modal fade" id="modalEdit{{$value->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h2 class="modal-title" id="exampleModalLabel">Edit Post</h2>
                
            </div>
            <div class="modal-body">
                <form class="p-10 mw-5xl mx-auto bg-light-light " method="post" action="{{ route('update')}}">
                    <div class="row g-8">
                    {{csrf_field()}}

                    @method('POST')

                    <div class="col-12 pb-3 ">
                        <div class="form-group text-start">
                            <label class="mb-1 fw-medium text-light-dark" for="modalInput2-7">Title</label>
                            <input type="text" class="form-control{{ $errors->has('judulfoto') ? ' is-invalid' : '' }}" name="judulfoto" placeholder="judulfoto" value="{{$value->judulfoto}}" />
                            @if ($errors->has('judulfoto'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('judulfoto') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-12 pb-3">
                        <div class="form-group text-start">
                            <label class="mb-1 fw-medium text-light-dark" for="modalInput2-8">Description</label>
                            <input type="text" class="form-control{{ $errors->has('deskripsifoto') ? ' is-invalid' : '' }}" name="deskripsifoto" placeholder="deskripsifoto" value="{{$value->deskripsifoto}}" />
                            @if ($errors->has('deskripsifoto'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('deskripsifoto') }}</strong>
                            </span>
                            @endif
                            <input type="hidden" class="form-control" name="post_id"  value="{{$value->id}}" />

                        </div>
                    </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn rounded-pill" style="font-size:18px;background-color: #F39F5A; color:white;">Save</button>
                    </div>
                    
                </form>
            </div>
            
        </div>
    </div>
</div>
@endforeach