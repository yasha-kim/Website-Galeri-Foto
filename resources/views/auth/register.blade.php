@extends('layouts.app')

@section('content')
<a href="{{route('index')}}" class="btn btn-light rounded-circle shadow-sm" role="button" style="margin-left:10px;margin-top:10px;">
    <i class="fa-solid fa-arrow-left" aria-hidden="true" style="font-size:18px;"></i>
</a>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card flex-row my-5 border-0 shadow-lg rounded-4 overflow-hidden">
          
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-bold fs-5">Register</h5>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-8">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="fullname" class="col-md-4 col-form-label text-md-right">{{ __('Fullname') }}</label>

                    <div class="col-md-8">
                        <input id="fullname" type="text" class="form-control{{ $errors->has('fullname') ? ' is-invalid' : '' }}" name="fullname" value="{{ old('fullname') }}" required autofocus>

                        @if ($errors->has('fullname'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('fullname') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                    <div class="col-md-8">
                        <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required autofocus>

                        @if ($errors->has('address'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row  mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-8">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-8">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-8">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>
          </div>
        </div>
            </div>
        </div>
    </div>
</div>
@endsection
