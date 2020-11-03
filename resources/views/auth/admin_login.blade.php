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
        @foreach (session('flash_notification', collect())->toArray() as $message)
            showFrontendAlert('{{ $message['level'] }}', '{{ $message['message'] }}');
        @endforeach
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "{{ env('FIREBASE_API_KEY') }}",
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
    });

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
@endsection
