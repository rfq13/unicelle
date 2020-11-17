@extends('frontend.regis_dan_login.regis_dan_login')

@section('title')
    Login Nomor Telepon
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
                        <form class="p-3">
                            
                            <h5 class="mb-4 mt-2">Login Via Nomor Telepon</h5>
                            <!-- <div class="form-group"> -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">+62</span>
                                </div>
                                <input type="text" id="number" class="form-control" placeholder="No. Telepon" onkeypress="return hanyaAngka(event)"  maxlength="12">
                            </div>

                            <div class="form-group">
                                {{-- @if(\App\BusinessSetting::where('type', 'google_recaptcha')->first()->value == 1)
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                                    </div>
                                @endif --}}
                                <div id="recaptcha-container"></div>
                            </div>

                            <button type="button" class="btn btn-primary1" style="width: 100%;" onclick="phoneAuth();"
                                >Berikutnya</button>
                        </form>
                        <div class="card-footer text-center mt-3 mb-0">
                            <span class="bpa">Belum Punya Akun? <a href="{{route('user.registration')}}" class="ba">Buat Akun</a></span>
                            @include('frontend.regis_dan_login.modalAuthOtp')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            

            .tombol-float{
                position:fixed;
                width:60px;
                height:60px;
                bottom:40px;
                right:40px;
                background-image: url('{{ my_asset("images/wa.png") }}');
                background-color:white;
                color:#FFF;
                border-radius:60px;
                text-align:center;
                /* box-shadow: 2px 2px 3px #999; */
                margin-bottom: 3%;
            }

            .my-float{
                margin-top:22px;
            }
        </style>
        @php
            $phone = \App\GeneralSetting::first()->phone;
            $phone =  $phone[0] == "+" ? substr($phone,1) : $phone[0] == '0' ?  "62"+substr($phone,1) : $phone;
            $text = \App\GeneralSetting::first()->text_whatsapp;
            $url = "https://api.whatsapp.com/send?phone=$phone&text=$text";
        @endphp
        <a href="{{ $url }}" target="_blank" class="tombol-float"><i class="my-float"></i></a>
    </section>


    {{--<!-- <section class="gry-bg py-5">
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8 mx-auto">
                        <div class="card">
                            <div class="text-center px-35 pt-5">
                                <h1 class="heading heading-4 strong-500">
                                    {{ translate('Login to your account.')}}
                                </h1>
                            </div>
                            
                            <div class="px-5 py-3 py-lg-4">
                                <div class="">
                                    <form class="form-default" role="form" action="{{ route('login') }}" method="POST">
                                        @csrf
                                        @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                            <span>{{  translate('Use country code before number') }}</span>
                                        @endif
                                        <div class="form-group">
                                            @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                                <input type="text" class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ translate('Email Or Phone')}}" name="email" id="email">
                                            @else
                                                <input type="email" class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control h-auto form-control-lg {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ translate('Password')}}" name="password" id="password">
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <div class="checkbox pad-btm text-left">
                                                        <input id="demo-form-checkbox" class="magic-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                        <label for="demo-form-checkbox" class="text-sm">
                                                            {{  translate('Remember Me') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 text-right">
                                                <a href="{{ route('password.request') }}" class="link link-xs link--style-3">{{ translate('Forgot password?')}}</a>
                                            </div>
                                        </div>


                                        <div class="text-center">
                                            <button type="submit" class="btn btn-styled btn-base-1 btn-md w-100">{{  translate('Login') }}</button>
                                        </div>
                                    </form>
                                    @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                                        <div class="or or--1 mt-3 text-center">
                                            <span>or</span>
                                        </div>
                                        <div>
                                        @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                                            <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="btn btn-styled btn-block btn-facebook btn-icon--2 btn-icon-left px-4 mb-3">
                                                <i class="icon fa fa-facebook"></i> {{ translate('Login with Facebook')}}
                                            </a>
                                        @endif
                                        @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                                            <a href="{{ route('social.login', ['provider' => 'google']) }}" class="btn btn-styled btn-block btn-google btn-icon--2 btn-icon-left px-4 mb-3">
                                                <i class="icon fa fa-google"></i> {{ translate('Login with Google')}}
                                            </a>
                                        @endif
                                        @if (\App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                                            <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="btn btn-styled btn-block btn-twitter btn-icon--2 btn-icon-left px-4">
                                                <i class="icon fa fa-twitter"></i> {{ translate('Login with Twitter')}}
                                            </a>
                                        @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="text-center px-35 pb-3">
                                <p class="text-md">
                                    {{ translate('Need an account?')}} <a href="{{ route('user.registration') }}" class="strong-600">{{ translate('Register Now')}}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    @if (env("DEMO_MODE") == "On")
                        <div class="bg-white p-4 mx-auto mt-4">
                            <div class="">
                                <table class="table table-responsive table-bordered mb-0">
                                    <tbody>
                                        <tr>
                                            <td>{{ translate('Seller Account')}}</td>
                                            <td><button class="btn btn-info" onclick="autoFillSeller()">{{ translate('Copy credentials') }}</button></td>
                                        </tr>
                                        <tr>
                                            <td>{{ translate('Customer Account')}}</td>
                                            <td><button class="btn btn-info" onclick="autoFillCustomer()">{{ translate('Copy credentials') }}</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section> -->--}}
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $("#btn").html(`
                <button type="button" class="btn btn-secondary1 mb-3" style="width: 100%;" onclick="codeverify();">Login</button>
            `)
        })
    </script>
@endsection
