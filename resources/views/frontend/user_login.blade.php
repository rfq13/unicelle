@extends('frontend.regis_dan_login.regis_dan_login')

@section('title')
    Login
@endsection

@section('content')
<section class="bg-img-login">
        <div class="container vh-100" style="display: flex; justify-content: center; align-content: center">
            <div class="row align-items-center w-100 text-center">
                <div class="col-lg-6 d-xl-block d-none">
                    <div class="justify-content-center text-center">
                        <img class="img-login" src="{{ my_asset('img/regis_dan_login/logo.png') }}" alt="">
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
                <div class="col-lg-6">
                    

                    <div class="card bg-form">
                        <form class="form-default p-3" id="reg-form" role="form" action="{{ route('login') }}" method="POST">
                            @csrf
                            <h5 class="mb-4 mt-2">Login</h5>

                            <div class="form-group">
                                @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                    <input type="text" class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ translate('Email Or Phone')}}" name="email" id="email">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <cite>{{ $errors->first('email') }}</cite>
                                        </span>
                                    @endif
                                @else
                                    <input type="email" class="form-control h-auto form-control-lg {{ $errors->has('email') ? 'is-invalid' : $type == "2" ? 'is-invalid' : "" }}" value="{{ old('email') }} {{ $email != "0" ? $email : "" }}" placeholder="{{  translate('Email') }}" name="email">
                                    @if ($errors->has('email') || $type == "2")
                                        <span class="invalid-feedback mb-1" style="text-align: left;font-size:72%" role="alert">
                                            <strong>{{ $errors->first('email') }}{{$msg}}</strong>
                                        </span>
                                    @endif
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control h-auto form-control-lg {{ $errors->has('password') ? ' is-invalid' : $type == "1" ? 'is-invalid' : "" }} }}" placeholder="{{ translate('Password')}}" name="password" id="password">
                                @if ($errors->has('password') || $type == "1")
                                    <span class="invalid-feedback mb-1" style="text-align: left;font-size:72%" role="alert">
                                        <strong>{{ $errors->first('password') }}{{ $msg != "0" ? $msg : "" }}</strong>
                                    </span>
                                @endif
                            </div>

                            @if(\App\BusinessSetting::where('type', 'google_recaptcha')->first()->value == 1)
                                <div class="form-group">
                                    <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                                </div>
                            @endif 
                            
                            <!-- <div class="capcha"> -->
                            <!-- <div class="form-group">
                                  
                            </div> -->
                            <!-- </div> -->

                            <div class="form-group mb-2">
                                <div id="recaptcha-container"></div>
                            </div>
                            <button type="submit" class="btn btn-secondary1" style="width: 100%;">Login</button>

                            <div class="text-center m-4">
                                <a href="{{ route('password.request') }}" class="lupa-pass" data-toggle="modal" data-target="#registerOTP">Lupa Kata
                                    Sandi ?</a>
                            </div>

                            <hr>

                            <a href="{{ route('user.login-otp') }}" class="btn btn-primary1" style="width: 100%;"> Login Via Nomer
                                Telepon</a>
                        </form>

                        <div class="card-footer text-center mt-3 mb-0">
                            <span class="bpa">Belum Punya Akun? <a href="{{ route('user.registration') }}" class="ba">Buat Akun </a></span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

