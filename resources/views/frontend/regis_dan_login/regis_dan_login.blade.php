<!DOCTYPE html>
@if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
<html dir="rtl" lang="en">
@else
<html lang="en">
@endif
<head>
    @php
        $seosetting = \App\SeoSetting::first();
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ config('app.name', 'Laravel') }}">
    <meta itemprop="description" content="{{ $seosetting->description }}">
    <meta itemprop="image" content="{{ my_asset(\App\GeneralSetting::first()->logo) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ config('app.name', 'Laravel') }}">
    <meta name="twitter:description" content="{{ $seosetting->description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ my_asset(\App\GeneralSetting::first()->logo) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ config('app.name', 'Laravel') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('home') }}" />
    <meta property="og:image" content="{{ my_asset(\App\GeneralSetting::first()->logo) }}" />
    <meta property="og:description" content="{{ $seosetting->description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">

    <link type="image/x-icon" href="{{ my_asset(\App\GeneralSetting::first()->favicon) }}" rel="shortcut icon" />

    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="{{ my_asset('frontend/css/bootstrap.min.css') }}" type="text/css" media="all"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ my_asset('vendor/fontawesome-free-5.14.0-web/fontawesome-free-5.14.0-web/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ my_asset('vendor/fontawesome-free-5.14.0-web/fontawesome-free-5.14.0-web/css/fontawesome.min.css') }}">
    
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ my_asset('css/regis_dan_login.css') }}">

    @if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
     <!-- RTL -->
        <link type="text/css" href="{{ my_asset('frontend/css/active.rtl.css') }}" rel="stylesheet" media="all">
    @endif
    <!-- sweetalert -->
    <link type="text/css" href="{{ my_asset('frontend/css/sweetalert2.min.css') }}" rel="stylesheet" media="none" onload="if(media!='all')media='all'">

    
</head>
<body>
    <style>
    .bg-form-lupapass{
        background-image: url('{{my_asset('/images/img/bg-form.png')}}');
    }
    .btn-back-login{
        background-color: #3BB6B1;
        color: #FFFFFF;
    }
    .together {
        font-family: "Open Sans";
        font-style: normal;
        font-weight: bold;
        font-size: 50px;
        text-align: center;
        color: #FFFFFF;
    }
    .bg-form-verifikasi {
    background-image: url('{{my_asset('/images/img/bg-form.png')}}');
    width: 100%;
    height: 300px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    }
    .text-verifikasi-email__ {
    font-family: "Open Sans";
    font-style: normal;
    font-weight: normal;
    font-size: 18px;
    color: #000000;
    }
    .link-verifikasi-email__ {
    font-family: "Open Sans";
    font-style: normal;
    font-weight: 600;
    color: #0D47A1;
    }
    </style>
    @yield('content')

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script> -->
    <script src="{{ my_asset('frontend/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ my_asset('frontend/js/vendor/popper.min.js') }}"></script>
    <script src="{{ my_asset('frontend/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ my_asset('frontend/js/sweetalert2.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script> --}}

    <script src="https://www.gstatic.com/firebasejs/7.15.5/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.15.5/firebase-auth.js"></script>
    <!-- TODO: Add SDKs for Firebase products that you want to use
        https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/7.15.5/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.15.5/firebase.js"></script>

    <script src="{{ my_asset('vendor/fontawesome-free-5.14.0-web/fontawesome-free-5.14.0-web/js/fontawesome.min.js') }}"></script>
    <script src="{{ my_asset('vendor/fontawesome-free-5.14.0-web/fontawesome-free-5.14.0-web/js/all.min.js') }}"></script>
<script>
    @foreach (session('flash_notification', collect())->toArray() as $message)
        showFrontendAlert('{{ $message['level'] }}', '{{ $message['message'] }}');
    @endforeach
        // Your web app's Firebase configuration
        var firebaseConfig = {
            apiKey: "{{ env('FIREBASE_API_KEY') }}",
            authDomain: "gifted-airport-291804.firebaseapp.com",
            databaseURL: "https://unicelle-96810.firebaseio.com",
            projectId: "gifted-airport-291804",
            storageBucket: "gifted-airport-291804.appspot.com",
            messagingSenderId: "157501410450",
            appId: "1:157501410450:web:889b4a0eb9737e69142a4b"
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

        function render_resend() {
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container-resend');
            recaptchaVerifier.render();
        }

        

        /* ========== Autentikasi OTP ========== */
        function phoneAuth(type = 0){

            var response = grecaptcha.getResponse();
                    if(response.length == 0)
                    {
                    //reCaptcha not verified
                        alert("Mohon Lengkapi Captcha.");
                        return false;
                    }

            var number = document.getElementById('number').value;
            var token = $("meta[name='csrf-token']").attr("content");
            document.getElementById("p2").innerHTML = document.getElementById('number').value;

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
                        "nomor": number,
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
                                    window.location.href = "{{ route('user.login-otp') }}";
                                });
                            } else {
                                sendOtp(number,"modal")
                            }
                        }else{
                            if (response.success) {
                                sendOtp(number,"modal")
                            }else{
                                Swal.fire({
                                    type: 'error',
                                    title: 'Maaf',
                                    text: 'Nomor telepon tidak terdaftar pada sistem.',
                                    timer: 3000
                                })
                                .then (function() {
                                    // window.location.href = "{{ route('user.registration-otp') }}";
                                });
                            }
                        }
                    },

                    error:function(response){
                        showFrontendAlert('danger','error')
                    }

                });
            }

        }
       
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

            function hanyaAngka(evt){
                var charCode = (evt.which) ? evt.which : event.keyCode
                if(charCode > 31 && (charCode < 48 || charCode > 57))

                    return false;
                return true;
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
                    // alert(UrL);
                    $.get(UrL, function (data) {
                        if (data == "sukses") {
                            window.location.href = "{{route('home')}}"
                        }else{
                            alert(data)
                        }
                    })
                    console.log("signed");
                    var user = result.user;
                    var uid = user.uid;
                    var phoneNumber = user.phoneNumber;

                    $("input[name='uid']").val(uid);
                    $("input[name='nomor_hp']").val(phoneNumber);
                    $('form#form_lanjutan').submit();

                    }).catch(function (error){
                    console.log(error);
                    showFrontendAlert('danger','kode otp yang anda masukkan tidak valid')
                })
                // alert(code);
            }

            function sendOtp(number,modal="no",kirimUlang) {
                var res = number.charAt(0)
                
                if (res == "0") {
                    number = number.substring(1,number.length);
                }

                // console.log(number);
                firebase.auth().signInWithPhoneNumber("+62" + number, window.recaptchaVerifier).then(function(confirmationResult){
                    window.confirmationResult = confirmationResult;
                    coderesult = confirmationResult;
                    if (modal == "modal") {
                        $("#verifikasi").prepend("<input type='hidden' id='verifiedTelp' value='0"+number+"'>");
                        $('#verifikasi').modal();
                    }
                    countDown(20)
                }).catch(function (error){
                    showFrontendAlert("error",error.message);
                });
            }

            function countDown(detik) {
                document.getElementById("resend").style.color = "#c2edeb";
                // Set the date we're counting down to
                    var countDownDate = new Date();
                        countDownDate.setSeconds(countDownDate.getSeconds() + detik);

                // Update the count down every 1 second
                var x = setInterval(function() {

                    // Get today's date and time
                        var now = new Date().getTime();
                        
                    // Find the distance between now and the count down date
                        var distance = countDownDate - now;
                        
                    // Time calculations for days, hours, minutes and seconds
                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                        
                    // Output the result in an element with id="demo"
                        document.getElementById("detik").innerHTML = seconds;
                        
                    // If the count down is over, write some text 
                        if (distance < 1) {
                            render_resend();

                            clearInterval(x);
                            document.getElementById("resend").style.color = "#3BB5B0";
                            document.getElementById("detik").innerHTML = "0";
                            let resend = document.getElementById("resend")
                                resend.addEventListener("click", function (e) {
                                    var number = document.getElementById('verifiedTelp').value;
                                    sendOtp(number,'no',true)
                                })
                        }
                }, 1000);
            }

</script>   

    @yield('script')
<script>
    function showFrontendAlert(type, message){
            if(type == 'danger'){
                type = 'error';
            }
            swal({
                position: 'top-end',
                type: type,
                title: message,
                showConfirmButton: false,
                timer: 3000
            });
        }
</script>
</body>
</html>