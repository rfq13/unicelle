@extends('layouts.blank')

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
@endsection
