<!DOCTYPE html>
@if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
<html dir="rtl" lang="en">
@else
<html lang="en">
@endif
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

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
    <!-- <script src="{{ my_asset('frontend/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ my_asset('frontend/js/vendor/popper.min.js') }}"></script>
    <script src="{{ my_asset('frontend/js/vendor/bootstrap.min.js') }}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>


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
        function phoneAuth(){

            var number = document.getElementById('number').value;
            var token = $("meta[name='csrf-token']").attr("content");

            console.log(number);

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
                        if (response.success) {

                            firebase.auth().signInWithPhoneNumber("+62" + number, window.recaptchaVerifier).then(function(confirmationResult){
                                window.confirmationResult = confirmationResult;
                                coderesult = confirmationResult;
                                $("#verifikasi").prepend("<input type='hidden' id='verifiedTelp' value='0"+number+"'>")
                                // console.log(coderesult);

                                $('#verifikasi').modal();

                            }).catch(function (error){
                                alert(error.message);
                            });
                            

                        } else {

                            console.log(response);

                            Swal.fire({
                                type: 'error',
                                title: 'Maaf',
                                text: 'Nomor telepon tidak terdaftar pada sistem.',
                                timer: 3000
                            })
                            .then (function() {
                                    window.location.href = "{{ route('user.registration') }}";
                                });

                        }

                        console.log(response);

                    },

                    error:function(response){

                        Swal.fire({
                            type: 'error',
                            title: 'Opps!',
                            text: 'server error!'
                        });

                        console.log(response);

                    }

                });
            }

        }

        function codeverify(){

            var satu = document.getElementById('satu').value;
            var dua = document.getElementById('dua').value;
            var tiga = document.getElementById('tiga').value;
            var empat = document.getElementById('empat').value;
            var lima = document.getElementById('lima').value;
            var enam = document.getElementById('enam').value;

            var code = satu + dua + tiga + empat + lima + enam;
            coderesult.confirm(code).then(function (result){
                let verifiedTelp = $("#verifikasi").find("#verifiedTelp").val()
                $.get("{{route('bindUser','verified')}}".replace('verified',verifiedTelp), function (data) {
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
     
    <!-- <script src="{{ my_asset('vendor\bootstrap-4.5.2-dist\bootstrap-4.5.2-dist\js\bootstrap.min.js') }}"></script> -->
    <script src="{{ my_asset('vendor/fontawesome-free-5.14.0-web/fontawesome-free-5.14.0-web/js/fontawesome.min.js') }}"></script>
    <script src="{{ my_asset('vendor/fontawesome-free-5.14.0-web/fontawesome-free-5.14.0-web/js/all.min.js') }}"></script>

    @yield('script')

</body>
</html>