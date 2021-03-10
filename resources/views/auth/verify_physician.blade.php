{{-- @extends('layouts.blank')

@section('content')
    <div class="cls-content-sm panel">
        <div class="panel-body">
            <h1 class="h3">{{ translate('Verifikasi Email anda') }}</h1>
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ translate('Link verifikasi telah dikirim ke Email anda.') }}
                    </div>
                @endif

            {{ translate('Sebelum masuk pada akun, harap verifikasi Email anda.') }}
            {{ translate('Tidak menerima Email Verifikasi ?') }}, <a href="{{ route('verification.resend') }}" class="btn-link text-bold text-main">{{ translate('Klik di sini untuk mengirim ulang verifikasi.') }}</a>.
        </div>
    </div>
@endsection --}}

@extends('frontend.regis_dan_login.regis_dan_login')

@section('title')
    Verifikasi E-mail
@endsection

@section('content')
<section class="bg-img-login">
    <div class="container">
        <div class="row">


            <div class="col-lg-6 d-xl-block d-none" style="margin-top: 25%;">
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
            <div class="col-lg-6" style="margin-top: 23%;">
                <div class="card bg-form-verifikasi p-3">

                    <div style="margin-top:40px">
                    <h5 class="mb-2 mt-2">Akun anda sedang diverifikasi</h5>

                        <span class="text-verifikasi-email__">
                        Untuk informasi lebih lanjut silahkan hubungi admin Unicelle di {{\App\GeneralSetting::first()->email}}
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
</section>
@endsection