@extends('frontend.regis_dan_login.regis_dan_login')

@section('title')
    Registrasi
@endsection

@section('content')


    <section class="bg-img-login">
        <div class="container" style="display: flex; justify-content: center; align-content: center;padding:2%">
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
                        <div class="bg-register">
                            <form class="p-3 form-default" id="reg-form" role="form" action="{{ route('otp.register.otp') }}" method="POST">
                                @csrf
                                <h5 class="mb-4 mt-2">Register</h5>
                                <div class="row mb-3">
                                    <div class="col">
                                        <input type="text" class="form-control {{ $errors->has('nama_depan') ? ' is-invalid' : '' }}" value="{{ old('nama_depan') }}" placeholder="{{  translate('Nama Depan') }}" name="nama_depan">
                                        @if ($errors->has('nama_depan'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nama_depan') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col">
                                        <input type="text" class="form-control {{ $errors->has('nama_belakang') ? ' is-invalid' : '' }}" value="{{ old('nama_belakang') }}" placeholder="{{  translate('Nama Belakang') }}" name="nama_belakang">
                                        @if ($errors->has('nama_belakang'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('nama_belakang') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <input type="hidden" name="uid" value={{$uid}}>

                                <div class="form-group">
                                    <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input type="text" id="telp" class="form-control {{ $errors->has('no_telepon') ? ' is-invalid' : '' }}" value="{{ $nomor_hp }}" placeholder="{{  translate('Nomor Telepon') }}" name="no_telepon" onkeypress="return hanyaAngka(event)"  maxlength="14">
                                    @if ($errors->has('no_telepon'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('no_telepon') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group" style="text-align: left;">
                                <p>Please select your gender:</p>

                                <div class="row" style="margin-left: 20px;">
                                <label for="male" style="padding-right:20px">
                                <input type="radio" id="male" name="gender" value="L">
                                Laki-Laki</label><br>
                                <label for="female">
                                <input type="radio" id="female" name="gender" value="P">
                                Perempuan</label><br>
                                </div>
                                </div>
                                <div class="form-group" style="text-align: left;">
                                <input type="text" class="form-control datepicker" name="birth" id="datepicker" data-date-format="yyyy-mm-dd" placeholder="Tanggal Lahir">
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
                                       Daftar Via Nomer Telepon</a>
                                       
                                       @php
                                           $params = ['physician'=>'physician'];
                                           if (Request::get('referral_code')) {
                                               $params = array_merge($params,['referral_code'=>$_GET['referral_code']]);
                                           }
                                       @endphp
                                <a type="submit" class="btn btn-primary1 my-2" style="width: 100%;"  href="{{ route('user.registration',$params) }}">
                                       Daftar Sebagai Physician
                                </a>
                                    
                                
                            </form>

                                
                            <div class="card-footer text-center mt-2 mb-0">
                                <span class="bpa">Sudah Punya Akun? <a href="{{ route('user.login') }}" class="ba">Login </a></span>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    
@endsection


@section('script')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">

    $( "#datepicker" ).datepicker({
        changeMonth: true,
      changeYear: true,
      minYear:'1990',
dateFormat: "yy-mm-dd",
});
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
