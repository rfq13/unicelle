@extends('frontend.regis_dan_login.regis_dan_login')
@section('content')
<section class="bg-img-login">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-xl-block d-none" style="margin-top: 25%;">
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
                            <div class="form-group">
                                <label for="lupapass">Masukkan Alamat Email Anda</label>
                                <input type="email" class="form-control" id="lupapass"
                                    placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="lupapass-baru">Masukkan Password Baru</label>
                                <input type="password" class="form-control" id="lupapass-baru"
                                    placeholder="Password Baru">
                            </div>
                            <div class="form-group">
                                <label for="lupapass-konfirmasi">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" id="lupapass-konfirmasi"
                                    placeholder="Konfirmasi Password">
                            </div>
                            <div class="mt-5">
                                <a href="" class="btn btn-primary1 " style="width: 100%;"> Submit </a>
                                <a href="{{ route('user.login') }}" class="btn btn-back-login mt-2 " style="width: 100%;"> Back To Login </a>
                            </div>



                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
<!-- <div class="cls-content-sm panel">
    <div class="panel-body">
        <h1 class="h3">{{ translate('Reset Password') }}</h1>
        <p class="pad-btm">{{translate('Enter your email address to recoverssss your password.')}} </p>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                    <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="{{ translate('Email or Phone') }}">
                @else
                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ translate('Email') }}" name="email">
                @endif

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group text-right">
                <button class="btn btn-danger btn-lg btn-block" type="submit">
                    {{ translate('Send Password Reset Link') }}
                </button>
            </div>
        </form>
        <div class="pad-top">
            <a href="{{route('user.login')}}" class="btn-link text-bold text-main">{{translate('Back to Login')}}</a>
        </div>
    </div>
</div> -->


@endsection
