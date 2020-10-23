@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('public/css/main.css')}}">
</br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <center><div class="card-header"><h4 style="color:white;">Register</h4></center>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="api_key" class="col-md-4 col-form-label text-md-right">{{ __('Zoom Key') }}</label>

                            <div class="col-md-6">
                                <input id="api_key" type="text" class="form-control" name="api_key" value="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="secret" class="col-md-4 col-form-label text-md-right">{{ __('Zoom Secret') }}</label>

                            <div class="col-md-6">
                                <input id="secret" type="text" class="form-control" name="secret" value="" required>
                            </div>
                        </div>
                        <center><div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="contact100-form-btn">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div></center>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.card-header {
    padding: .75rem 1.25rem;
    margin-bottom: 0;
    background-color: #77c09e;
    border-bottom: 1px solid rgba(0,0,0,.125);
}
.shadow-sm {
    box-shadow: 1px 1px 1px #77c09e;
}

.bg-white {
    background-color: #77c09e!important;
}
</style>
@endsection
