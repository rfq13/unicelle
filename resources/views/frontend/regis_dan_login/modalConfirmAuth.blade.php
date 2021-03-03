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
                                
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">+62</span>
                                    </div>
                                    <input type="text" id="number" class="form-control" placeholder="No. Telepon" onkeypress="return hanyaAngka(event)"  maxlength="12">
                                </div>

                                

                                <button type="button" class="btn btn-primary1 mb-3" style="width: 100%;" onclick="phoneAuth(1)">
                                    Daftar</button>
                                    <a type="submit" class="btn btn-primary1 mb-3" style="width: 100%;background-color: #ec4646;"  href="{{ route('home') }}">
                                       Kembali Ke Halaman Utama
                                </a>
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

    <div class="modal fade" id="confirm" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog bg-verifikasi">
                                    <div class="modal-content bg-verifikasi">
                                    <div style="text-align: center;margin-top:20px">
                                    <img style="width:30%" src="{{ my_asset('img/regis_dan_login/logo.png') }}" alt="">
                                    </div>
                                        <div class="modal-body">

                                            <div>


                                                <div class="text-center">
<form class="p-3 form-default" id="reg-form" role="form" action="{{ route('otp.register.otp') }}" method="POST">
                                @csrf
                                                    <!-- -- -->
                                                    <!-- <form> -->
                                                   
                                                            <div class="row">
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
                                    <input type="hidden" name="uid" value={{$uid}}>

                                    <div class="form-group" style="margin-top:20px">
                                    <input type="text" id="number" class="form-control" name="no_telepon" placeholder="No. Telepon" @if(isset($nomor_hp))value="{{$nomor_hp}}"@endif  maxlength="12" required>
                                    @if ($errors->has('no_telepon'))
                                        <span style="display: flex;" class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('no_telepon') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email" required>
                                    @if ($errors->has('email'))
                                        <span style="display: flex;" class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
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
                                        <label for="inputPassword3" class="col-form-label pr-4">Jenis
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
                                                    <!-- </form> -->
                                                    </form>
                                                </div>
                                                                                      
                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
@endsection


@section('script')
@section('script')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="{{ my_asset('js/dropdown-date-picker/dist/jquery-dropdown-datepicker.min.js') }}"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script>
        $(document).ready(function () {
            $("#btn").html(`
                <button type="button" class="btn btn-secondary1 mb-3" style="width: 100%;" onclick="codeverify('regis');">Register</button>
            `);
            $('#confirm').modal('show');
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
