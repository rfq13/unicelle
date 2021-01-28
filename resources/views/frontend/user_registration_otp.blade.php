@extends('frontend.regis_dan_login.regis_dan_login')

@section('title')
    Registrasi Nomor Telepon
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
                    <div class="card">
                        <div class="bg-register_otp">
                            <form class="p-3">
                                @csrf
                                <h5 class="mb-4 mt-2">Register OTP</h5>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="text" id="first_name" class="form-control" placeholder="Nama Depan">
                                    </div>
                                    <div class="col">
                                        <input type="text" id="last_name" class="form-control" placeholder="Nama Belakang">
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">+62</span>
                                    </div>
                                    <input type="text" id="number" class="form-control" placeholder="No. Telepon" onkeypress="return hanyaAngka(event)"  maxlength="12">
                                </div>

                                <div class="form-group">
                                    <div id="recaptcha-container"></div>
                                </div>

                                <button type="button" class="btn btn-primary1 mb-3" style="width: 100%;" onclick="phoneAuth(1)">
                                    Daftar</button>
                            </form>
                            <div class="card-footer text-center mt-2 mb-0">
                                <span class="bpa">Sudah Punya Akun? <a href="{{ route('user.login') }}" class="ba">Login
                                    </a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('frontend.regis_dan_login.modalAuthOtp')

    </section>

    {{-- <section class="gry-bg py-4">
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8 mx-auto">
                        <div class="card">
                            <div class="text-center px-35 pt-5">
                                <h1 class="heading heading-4 strong-500">
                                    {{ translate('Buat Akun.')}}
                                </h1>
                            </div>
                            <div class="px-5 py-3 py-lg-4">
                                <div class="">
                                    <form id="reg-form" class="form-default" role="form" action="{{ route('register') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="h-auto form-control-lg form-control{{ $errors->has('nama_depan') ? ' is-invalid' : '' }}" value="{{ old('nama_depan') }}" placeholder="{{  translate('Nama Depan') }}" name="nama_depan">
                                            @if ($errors->has('nama_depan'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('nama_depan') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="h-auto form-control-lg form-control{{ $errors->has('nama_belakang') ? ' is-invalid' : '' }}" value="{{ old('nama_belakang') }}" placeholder="{{  translate('Nama Belakang') }}" name="nama_belakang">
                                            @if ($errors->has('nama_belakang'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('nama_belakang') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                            <div class="form-group phone-form-group mb-1">
                                                <input type="tel" id="phone-code" class=" h-auto w-100 form-control-lg form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" placeholder="{{  translate('Mobile Number') }}" name="phone">
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            </div>

                                            <input type="hidden" name="country_code" value="">

                                            <div class="form-group email-form-group mb-1 d-none">
                                                <input type="email" class="h-auto form-control-lg form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <button class="btn btn-link p-0" type="button" onclick="toggleEmailPhone(this)">{{ translate('Use Email Instead') }}</button>
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <input type="email" class="h-auto form-control-lg form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <input type="text" class="h-auto form-control-lg form-control{{ $errors->has('no_telepon') ? ' is-invalid' : '' }}" value="{{ old('no_telepon') }}" placeholder="{{  translate('Nomor Telepon') }}" name="no_telepon" onkeypress="return hanyaAngka(event)"  maxlength="14">
                                                @if ($errors->has('no_telepon'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('no_telepon') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <input type="password" class="h-auto form-control-lg form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{  translate('Kata Sandi') }}" name="password">
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="h-auto form-control-lg form-control" placeholder="{{  translate('Konfirmasi Kata Sandi') }}" name="password_confirmation">
                                        </div>

                                        @if(\App\BusinessSetting::where('type', 'google_recaptcha')->first()->value == 1)
                                            <div class="form-group">
                                                <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                                            </div>
                                        @endif

                                        <div class="checkbox text-left">
                                            <input class="magic-checkbox" type="checkbox" name="checkbox_example_1" id="checkboxExample_1a" required>
                                            <label for="checkboxExample_1a" class="text-sm">{{ translate('By signing up you agree to our terms and conditions.')}}</label>
                                        </div>

                                        <div class="text-right mt-3">
                                            <button type="submit" class="btn btn-styled btn-base-1 w-100 btn-md">{{  translate('Create Account') }}</button>
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
                                    {{ translate('Already have an account?')}}<a href="{{ route('user.login') }}" class="strong-600">{{ translate('Log In')}}</a>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section> --}}
@endsection


@section('script')
@section('script')
    <script>
        $(document).ready(function () {
            $("#btn").html(`
                <button type="button" class="btn btn-secondary1 mb-3" style="width: 100%;" onclick="codeverify('regis');">Register</button>
            `)
        })
    </script>
@endsection

    {{-- <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript">

        //making the CAPTCHA  a required field for form submission
        $(document).ready(function(){
            // alert('helloman');
            $("#reg-form").on("submit", function(evt)
            {
                var response = grecaptcha.getResponse();
                if(response.length == 0)
                {
                //reCaptcha not verified
                    alert("Mohon Lengkapi Captcha.");
                    evt.preventDefault();
                    return false;
                }
                //captcha verified
                //do the rest of your validations here
                $("#reg-form").submit();
            });
        });

        var isPhoneShown = true;

        var input = document.querySelector("#phone-code");
        var iti = intlTelInput(input, {
            separateDialCode: true,
            preferredCountries: @php echo json_encode(\App\Country::where('status', 1)->pluck('code')->toArray()) @endphp
        });

        var country = iti.getSelectedCountryData();
        $('input[name=country_code]').val(country.dialCode);

        input.addEventListener("countrychange", function() {
            var country = iti.getSelectedCountryData();
            $('input[name=country_code]').val(country.dialCode);
        });

        function autoFillSeller(){
            $('#email').val('seller@example.com');
            $('#password').val('123456');
        }
        function autoFillCustomer(){
            $('#email').val('customer@example.com');
            $('#password').val('123456');
        }

        function toggleEmailPhone(el){
            if(isPhoneShown){
                $('.phone-form-group').addClass('d-none');
                $('.email-form-group').removeClass('d-none');
                isPhoneShown = false;
                $(el).html('Use Phone Instead');
            }
            else{
                $('.phone-form-group').removeClass('d-none');
                $('.email-form-group').addClass('d-none');
                isPhoneShown = true;
                $(el).html('Use Email Instead');
            }
        }
    </script> --}}
@endsection
