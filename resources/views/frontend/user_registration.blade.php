@extends('frontend.regis_dan_login.regis_dan_login')

@section('title')
    Registrasi
@endsection

@section('content')


    <section class="bg-img-login">
        <div style="display: flex; justify-content: center; align-content: center;padding:2%">
            <div class="row align-items-center w-100 text-center">
                @if ($physician == "physician")
                <div class="col-lg-12 my-auto">
                    <div class="card bg-form">
                        <div class="bg-reg-phy">
                            <form class="p-5 form-default" id="reg-form" role="form" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="d-flex mb-4 align-items-center">
                                    <div class="p-2"><img class="img-reg-phy" src="{{my_asset('images\logo.png')}}" alt=""></div>
                                    <div class="p-2">
                                        <span class="head-reg-phy">
                                            Pendaftaran Tenaga Medis</span>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="user_type"
                                                id="exampleRadios1" value="regular physician" checked>
                                            <label class="form-check-label font-weight-bold" for="exampleRadios1">
                                                {{-- Regular Physician --}}
                                                Tenaga Kesehatan (Reguler)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="user_type"
                                                id="exampleRadios2" value="partner physician">
                                            <label class="form-check-label font-weight-bold" for="exampleRadios2">
                                                {{-- Partner Physician --}}
                                                Tenaga Kesehatan (Partner)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!--  -->
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control {{ $errors->has('nama_depan') ? ' is-invalid' : '' }}" value="{{ old('nama_depan') }}" placeholder="{{  translate('Nama Depan') }}" name="nama_depan" required>
                                        @if ($errors->has('nama_depan'))
                                            <span style="display: flex;" class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nama_depan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control {{ $errors->has('nama_belakang') ? ' is-invalid' : '' }}" value="{{ old('nama_belakang') }}" placeholder="{{  translate('Nama Belakang') }}" name="nama_belakang" required>
                                        @if ($errors->has('nama_belakang'))
                                            <span style="display: flex;" class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nama_belakang') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!--  -->
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" class="form-control {{ $errors->has('nama_instansi') ? ' is-invalid' : '' }}" value="{{ old('nama_instansi') }}" placeholder="{{  translate('Nama Klinik / Rumah Sakit / Intitusi') }}" name="nama_instansi" required>
                                        @if ($errors->has('nama_instansi'))
                                            <span style="display: flex;" class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nama_instansi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control {{ $errors->has('alamat_instansi') ? ' is-invalid' : '' }}" value="{{ old('alamat_instansi') }}" placeholder="{{  translate('Alamat Klinik / Praktek Dokter') }}" name="alamat_instansi" required>
                                        @if ($errors->has('alamat_instansi'))
                                            <span style="display: flex;" class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('alamat_instansi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <!--  -->
                                <div class="row mb-4 align-items-center">
                                    <div class="col">
                                        <input type="text" class="form-control {{ $errors->has('izin') ? ' is-invalid' : '' }}" value="{{ old('izin') }}" placeholder="{{  translate('Nomor Klinik/Surat Izin Praktek Dokter') }}" name="izin" required>
                                        @if ($errors->has('izin'))
                                            <span style="display: flex;" class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('izin') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlFile1" class="font-weight-light">
                                            <div class="row">
                                                <div class="col" style="text-align: center">
                                                    Surat Izin Praktek Dokter<span style="color: red">*</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <span style="font-size: 12px;color:#555758">*Dokumen legalitas (SIP/ Ijazah tenaga medis / Surat Izin / Klinik / Surat Izin Apotek)</span>
                                            </div>
                                        </label>
                                        <input type="file" class="form-control-file" name="fhoto" id="exampleFormControlFile1" required>
                                    </div>
                                </div>
                                <!--  -->
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="text" id="telp" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" placeholder="{{  translate('Nomor Telepon') }}" name="phone" onkeypress="return hanyaAngka(event)"  maxlength="14" required>
                                    @if ($errors->has('phone'))
                                        <span style="display: flex;" class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                    <div class="col">
                                        <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email" required>
                                    @if ($errors->has('email'))
                                        <span style="display: flex;" class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                </div>
                                <!--  -->
                                <div class="row mb-4">
                                    <div class="col">
                                        <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{  translate('Kata Sandi') }}" name="password" required>
                                    @if ($errors->has('password'))
                                        <span style="display: flex;" class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="password" class="form-control" placeholder="{{  translate('Konfirmasi Kata Sandi') }}" name="password_confirmation" required>
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-group" style="text-align: left;display:flex">
                                    <input class="d-none" id="dropdate" name="birth" placeholder="Tanggal Lahir"/>
                                    @if ($errors->has('birth'))
                                        <span style="display: flex;" class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('birth') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="form-group" style="text-align:left;margin-bottom:20px">
                                        <label for="inputPassword3" class="col-sm-3 col-form-label pr-4">Jenis
                                            Kelamin</label>
                                            <div class="col-md-12">
                                        <div class="form-check form-check-inline col-sm-3">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="1" required>
                                            <label class="form-check-label" for="inlineRadio1">Laki-Laki</label>
                                        </div>
                                        <div class="form-check form-check-inline col-sm-4">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="2" required>
                                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                        </div>
                                        @if ($errors->has('gender'))
                                        <span style="display: flex;" class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                </div>
                                @php
                                    $rc = "";
                                    if (Request::get('referral_code')) {
                                        $rc = '<input type="hidden" name="referral_code" value="'. $_GET['referral_code'] .'">';
                                    }
                                @endphp
                                {!! $rc !!}
                                <div class="text-center">
                                    @if(\App\BusinessSetting::where('type', 'google_recaptcha')->first()->value == 1)
                                            <div class="form-group">
                                                <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                                            </div>
                                    @endif
                                    <div class="form-group">
                                        <div id="recaptcha-container"></div>
                                    </div>

                                    <button type="submit" class="btn btn-secondary1 my-2" style="width: 50%;"><a
                                            href="#"></a>Daftar</button>
                                    <a href="{{route('user.registration')}}" class="btn btn-secondary1 my-2" style="width: 50%;">Daftar Sebagai Pasien</a>
                                    <a type="submit" class="btn btn-primary1 my-2" style="width: 50%;background-color: #ec4646;"  href="{{ route('home') }}">
                                       Kembali Ke Halaman Utama
                                </a>
                                </div>
                            </form>
                            <div class="card-footer text-center mt-2 mb-0">
                                <span class="bpa">Sudah Punya Akun? <a href="{{route('user.login')}}" class="ba">Login </a></span>
                            </div>
                        </div>
                    </div>
                </div>

                @else

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
                        <div class="bg-register">
                            <form class="p-3 form-default" id="reg-form" role="form" action="{{ route('register') }}" method="POST">
                                @csrf
                                <h5 class="mb-4 mt-2">Register</h5>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="text" class="form-control {{ $errors->has('nama_depan') ? ' is-invalid' : '' }}" value="{{ old('nama_depan') }}" placeholder="{{  translate('Nama Depan') }}" name="nama_depan" required>
                                        @if ($errors->has('nama_depan'))
                                            <span style="display: flex;" class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nama_depan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control {{ $errors->has('nama_belakang') ? ' is-invalid' : '' }}" value="{{ old('nama_belakang') }}" placeholder="{{  translate('Nama Belakang') }}" name="nama_belakang" required>
                                        @if ($errors->has('nama_belakang'))
                                            <span style="display: flex;" class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nama_belakang') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email" required>
                                    @if ($errors->has('email'))
                                        <span style="display: flex;" class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" placeholder="{{  translate('Nomor Telepon') }}" name="phone" onkeypress="return hanyaAngka(event)"  maxlength="14" required>
                                    @if ($errors->has('phone'))
                                        <span style="display: flex;" class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group mt-1">
                                    <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{  translate('Kata Sandi') }}" name="password" required>
                                    @if ($errors->has('password'))
                                        <span style="display: flex;" class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="{{  translate('Konfirmasi Kata Sandi') }}" name="password_confirmation" required>
                                </div>
                                <div class="form-group" style="text-align: left;display:flex">
                                    <input class="d-none" id="dropdate" name="birth" placeholder="Tanggal Lahir"/>
                                    @if ($errors->has('birth'))
                                        <span style="display: flex;" class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('birth') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group" style="text-align:left">
                                        <label for="inputPassword3" class="col-sm-3 col-form-label pr-4">Jenis
                                            Kelamin</label>
                                            <div class="col-md-12">
                                        <div class="form-check form-check-inline col-sm-3">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="1" required>
                                            <label class="form-check-label" for="inlineRadio1">Laki-Laki</label>
                                        </div>
                                        <div class="form-check form-check-inline col-sm-4">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="2" required>
                                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                        </div>
                                        @if ($errors->has('gender'))
                                        <span style="display: flex;" class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                                
                                @if(\App\BusinessSetting::where('type', 'google_recaptcha')->first()->value == 1)
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_KEY') }}"></div>
                                    </div>
                                @endif 

                                <div class="form-group">
                                    <div id="recaptcha-container"></div>
                                </div>

                                <button type="submit" class="btn btn-secondary1 mb-2" style="width: 100%;">
                                    <a href="#"></a>Daftar
                                </button>

                                <hr>
                                <a type="button" class="btn btn-primary1 my-2" style="width: 100%;"  href="{{ route('user.registration-otp') }}">
                                       Daftar Via Nomor Telepon</a>
                                       
                                       @php
                                           $params = ['physician'=>'physician'];
                                           if (Request::get('referral_code')) {
                                               $params = array_merge($params,['referral_code'=>$_GET['referral_code']]);
                                           }
                                       @endphp
                                <a type="submit" class="btn btn-primary1 my-2" style="width: 100%;"  href="{{ route('user.registration',$params) }}">
                                       Daftar Sebagai Physician
                                </a>
                                <a type="submit" class="btn btn-primary1 my-2" style="width: 100%;background-color: #ec4646;"  href="{{ route('home') }}">
                                       Kembali Ke Halaman Utama
                                </a>
                                    
                                
                            </form>

                                
                            <div class="card-footer text-center mt-2 mb-0">
                                <span class="bpa">Sudah Punya Akun? <a href="{{ route('user.login') }}" class="ba">Login </a></span>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- <section class="gry-bg py-4">
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
                                        @endif -->

                                        <!-- <div class="checkbox text-left">
                                            <input class="magic-checkbox" type="checkbox" name="checkbox_example_1" id="checkboxExample_1a" required>
                                            <label for="checkboxExample_1a" class="text-sm">{{ translate('By signing up you agree to our terms and conditions.')}}</label>
                                        </div> -->

                                        <!-- <div class="text-right mt-3">
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
    </section> -->
@endsection


@section('script')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="{{ my_asset('js/dropdown-date-picker/dist/jquery-dropdown-datepicker.min.js') }}"></script>

  

    <script type="text/javascript">
   
        //making the CAPTCHA  a required field for form submission
        $(document).ready(function(){
            const x = document.querySelectorAll("#dropdate")
        x.forEach(el => {
            $(el).dropdownDatepicker({
                dropdownClass:"custom-select hai",
                required:true,
                dayLabel:'Tanggal',
                monthLabel:'Bulan',
                yearLabel:'Tahun',
                monthFormat:'short',
                sortYear:'asc',
                minAge:10,
                monthShortValues: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agust','Sep','Okt','Nov','Des'],
                daySuffixValues: ['','','','']
            })
        });
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
        // var iti = intlTelInput(input, {
        //     separateDialCode: true,
        //     preferredCountries: @php echo json_encode(\App\Country::where('status', 1)->pluck('code')->toArray()) @endphp
        // });

        // var country = iti.getSelectedCountryData();
        // $('input[name=country_code]').val(country.dialCode);

        // input.addEventListener("countrychange", function() {
        //     var country = iti.getSelectedCountryData();
        //     $('input[name=country_code]').val(country.dialCode);
        // });

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

        function hanyaAngka(evt){
            var charCode = (evt.which) ? evt.which : event.keyCode
            if(charCode > 31 && (charCode < 48 || charCode > 57))

                return false;
            return true;
        }
       
    </script>
@endsection
