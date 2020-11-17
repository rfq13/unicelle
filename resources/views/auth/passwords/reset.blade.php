@extends('frontend.regis_dan_login.regis_dan_login')
@section('title')
    Lupa Password
@endsection
@section('content')
<section class="bg-img-login">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-xl-block d-none" style="margin-top: 10%;">
                <div class="justify-content-center text-center">
                    <img class="img-login" src="{{my_asset('\images\logo.png')}}" alt="">
                    <div class="text-center ">
                        <span class="together">
                            Together
                        </span>
                        <div class="text-banner">
                            <span class="text">
                                We Strive for a better wound care
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" style="margin-top: 15%;">

                <div class="card bg-form">
                    <div class="p-3">
                        <h5 class="mb-4 mt-2">Lupa Password</h5>
                    <form method="POST" action="{{ route('password.update') }}" id="pw-update-form">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="{{ translate('Email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ translate('New Password') }}" required>

                            @if ($errors->has('password'))
                                @foreach ($errors->get("password") as $item)
                                @php
                                    $item = $item == "validation.confirmed" ? "konfirmasi password salah" : $item;
                                    $item = $item == "validation.min.string" ? "password setidaknya 8 karakter" : $item;
                                @endphp
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $item }}</strong>
                                    </span>
                                @endforeach
                            @endif
                        </div>

                        <div class="form-group">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ translate('Confirm Password') }}" required>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" id="btn-submit-reset" class=" btn btn-primary btn-lg btn-block">
                                {{ translate('Reset Password') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
    
@endsection
