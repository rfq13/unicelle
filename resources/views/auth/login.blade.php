@extends('layouts.login')

@section('content')

@php
    $generalsetting = \App\GeneralSetting::first();
@endphp

<div class="flex-row">
    <div class="flex-col-xl-6 blank-index d-flex align-items-center justify-content-center"
    @if ($generalsetting->admin_login_sidebar != null)
        style="background-image:url('{{ my_asset($generalsetting->admin_login_sidebar) }}');"
    @else
        style="background-image:url('{{ my_asset('img/bg-img/login-box.jpg') }}');"
    @endif>

    </div>
    <div class="flex-col-xl-6">
        <div class="pad-all">
        <div class="text-center">
            <br>
			@if($generalsetting->logo != null)
                <img loading="lazy"  src="{{ my_asset($generalsetting->logo) }}" class="" height="44">
            @else
                <img loading="lazy"  src="{{ my_asset('frontend/images/logo/logo.png') }}" class="" height="44">
            @endif

            <br>
            <br>
            <br>

        </div>
            <form id="admin-log-form" class="pad-hor" method="POST" role="form" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="{{ translate('Email') }}">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="{{ translate('Password') }}">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="checkbox pad-btm text-left">
                            <input id="demo-form-checkbox" class="magic-checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="demo-form-checkbox">
                                {{ translate('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    @if(env('MAIL_USERNAME') != null && env('MAIL_PASSWORD') != null)
                        <div class="col-sm-6">
                            <div class="checkbox pad-btm text-right">
                                <a href="{{ route('password.request') }}" class="btn-link">{{translate('Forgot password')}} ?</a>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="form-group mb-2">
                    <div id="recaptcha-container"></div>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    {{ translate('Login') }}
                </button>
            </form>
            @if (env("DEMO_MODE") == "On")
                <div class="col-sm-6">
                    <div class="cls-content-sm panel" style="width: 100% !important;">
                        <div class="pad-all">
                            <table class="table table-responsive table-bordered">
                                <tbody>
                                    <tr>
                                        <td>admin@example.com</td>
                                        <td>123456</td>
                                        <td><button class="btn btn-info btn-xs" onclick="autoFill()">copy</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>


@endsection

@section('script')
<script src="https://www.gstatic.com/firebasejs/7.15.5/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.15.5/firebase-auth.js"></script>
<!-- TODO: Add SDKs for Firebase products that you want to use
    https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.15.5/firebase-analytics.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.15.5/firebase.js"></script>
<script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyD6bOoOoU3ijmc3rAwIaTc7m45LMY_v2bc",
        authDomain: "unicelle-96810.firebaseapp.com",
        databaseURL: "https://unicelle-96810.firebaseio.com",
        projectId: "unicelle-96810",
        storageBucket: "unicelle-96810.appspot.com",
        messagingSenderId: "502908767642",
        appId: "1:502908767642:web:a6dbb6931fd23ed5767e23"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);


     /* ====== Render Captcha ===== */
     window.onload = function () {
        render();
    };

    function render() {
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
        recaptchaVerifier.render();
    }

    

    /* ========== Autentikasi OTP ========== */
    function phoneAuth(type = 0){

        var number = document.getElementById('number').value;
        var token = $("meta[name='csrf-token']").attr("content");

        // console.log(number);

        if(number.length == "") {

            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: 'Nomor Telepon Wajib Diisi !'
            });

        }else{

            $.ajax({

                url: "{{ route('user.proses-login-otp') }}",
                type: "POST",
                dataType: "JSON",
                cache: false,
                data: {
                    "nomor": "0" + number,
                    "_token": '{{csrf_token()}}'
                },

                success:function(response){
                    if (type == 1) {
                        let Username = document.getElementById("first_name").value+" "+document.getElementById("last_name").value
                        let regData = JSON.stringify({phone:"0"+number, name:Username})
                        if (response.success) {
                            Swal.fire({
                                type: 'error',
                                title: 'Maaf',
                                text: 'Nomor telepon sudah terdaftar pada sistem.',
                                timer: 3000
                            })
                            .then (function() {
                                // window.location.href = "{{ route('user.login-otp') }}";
                            });
                        } else {
                            firebase.auth().signInWithPhoneNumber("+62" + number, window.recaptchaVerifier).then(function(confirmationResult){
                                window.confirmationResult = confirmationResult;
                                coderesult = confirmationResult;
                                $("#verifikasi").prepend("<input type='hidden' id='verifiedTelp' value='"+regData+"'>")
                                $('#verifikasi').modal();

                            }).catch(function (error){
                                alert(error.message);
                            });
                        }
                    }else{
                        if (response.success) {
                            firebase.auth().signInWithPhoneNumber("+62" + number, window.recaptchaVerifier).then(function(confirmationResult){
                                window.confirmationResult = confirmationResult;
                                coderesult = confirmationResult;
                                $("#verifikasi").prepend("<input type='hidden' id='verifiedTelp' value='0"+number+"'>")

                                $('#verifikasi').modal();

                            }).catch(function (error){
                                alert(error.message);
                            });
                        }else{
                            Swal.fire({
                                type: 'error',
                                title: 'Maaf',
                                text: 'Nomor telepon tidak terdaftar pada sistem.',
                                timer: 3000
                            })
                            .then (function() {
                                window.location.href = "{{ route('user.registration-otp') }}";
                            });
                        }
                    }
                },

                error:function(response){
                    Swal.fire({
                        type: 'error',
                        title: 'Opps!',
                        text: 'server error!'
                    });
                }

            });
        }

    }

        $(document).ready(function(){
            // alert('helloman');
            $("#admin-log-form").on("submit", function(evt)
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
                $("#admin-log-form").submit();
            });

            $(".inline_input_").click(function (e) {
                e.preventDefault()
                if ($("#satu").val().length == 0) {
                    $("#satu").focus()
                    // if ( $this.val().length >= parseInt($this.attr("maxlength"),10) ){
                    //     $this.next("input").focus();
                    // }
                }

            })
                $(".inline_input_ input").focus(function () {
                    if ($(this).val().length > 0) {
                        $(this).next()
                    }
                })

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

        function hanyaAngka(evt){
            var charCode = (evt.which) ? evt.which : event.keyCode
            if(charCode > 31 && (charCode < 48 || charCode > 57))

                return false;
            return true;
        }

        function autoFillSeller(){
            $('#email').val('seller@example.com');
            $('#password').val('123456');
        }
        function autoFillCustomer(){
            $('#email').val('customer@example.com');
            $('#password').val('123456');
        }

        function codeverify(type = 'login'){

            var satu = document.getElementById('satu').value;
            var dua = document.getElementById('dua').value;
            var tiga = document.getElementById('tiga').value;
            var empat = document.getElementById('empat').value;
            var lima = document.getElementById('lima').value;
            var enam = document.getElementById('enam').value;

            var code = satu + dua + tiga + empat + lima + enam;
            coderesult.confirm(code).then(function (result){
                let verifiedTelp = $("#verifikasi").find("#verifiedTelp").val()
                let UrL = type == "regis" ? "{{route('regUser','register')}}".replace('register',verifiedTelp) : "{{route('bindUser','verified')}}".replace('verified',verifiedTelp);
                $.get(UrL, function (data) {
                    if (data == "sukses") {
                        window.location.href = "{{route('home')}}"
                    }else{
                        alert(data)
                    }
                })
                console.log("signed");
            }).catch(function (error){
                console.log(error);
                alert(error.message);
            })
            // alert(code);
        }

                function bindUser(params) {
                    
                }

</script> 
    <script type="text/javascript">
        function autoFill(){
            $('#email').val('admin@example.com');
            $('#password').val('123456');
        }
    </script>
@endsection
