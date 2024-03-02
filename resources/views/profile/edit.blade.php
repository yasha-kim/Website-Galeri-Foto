<div class="modal fade" id="userEdit{{ Auth::user()->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h2 class="modal-title" id="exampleModalLabel">Edit Profile</h2>
                
            </div>
            <div class="modal-body">
                <form class="p-10 mw-5xl mx-auto bg-light-light " method="post" action="{{route('profile.update', Auth::user()->id)}}">
                    <div class="row g-8">
                    {{csrf_field()}}

                    @method('patch')

                    <div class="col-12 pb-3 ">
                        <div class="form-group text-start">
                        <label class="mb-1 fw-medium text-light-dark" for="modalInput2-7">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old ( 'name', Auth::user()->name ) }}"/>
                        </div>
                    </div>
                    <div class="col-12 pb-3 ">
                        <div class="form-group text-start">
                        <label class="mb-1 fw-medium text-light-dark" for="modalInput2-7">Fullname</label>
                        <input type="text" name="fullname" class="form-control" value="{{ old ( 'fullname', Auth::user()->fullname ) }}"/>
                        </div>
                    </div>
                    <div class="col-12 pb-3">
                        <div class="form-group text-start">
                        <label class="mb-1 fw-medium text-light-dark" for="modalInput2-8">Address</label>
                        <input type="text" name="address" class="form-control" value="{{ old ( 'address', Auth::user()->address ) }}"/>
                        </div>
                    </div>
                    <div class="col-12 pb-3">
                        <div class="form-group text-start">
                        <label class="mb-1 fw-medium text-light-dark" for="modalInput2-8">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old ( 'email', Auth::user()->email ) }}"/>
                        </div>
                    </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning rounded-pill" style="font-size:18px;">Save</button>
                    </div>
                    
                </form>
            </div>
        
        </div>
    </div>

</div>