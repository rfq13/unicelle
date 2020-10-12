@php
    if(Auth::user()->referral_code == null){
        flash("verifikasi email anda terlebih dahulu untuk mendapatkan kode referal");
            echo '<script>window.location = "'.route('home').'";</script>';
    }
@endphp
@extends('frontend.layouts.app')
@section('content')
    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 d-none d-lg-block">
                    <div class="card mr-2">
                        @if(Auth::user()->user_type == 'seller')
                            @include('frontend.inc.seller_side_nav')
                        @elseif(Auth::user()->user_type == 'customer' || Auth::user()->user_type == 'pasien reg' || Auth::user()->user_type == 'regular physician' || Auth::user()->user_type == 'partner physician') 
                            @include('frontend.inc.customer_side_nav')
                        @endif

                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header  bg-transparent mb-0">
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-4 col-sm-4 col-6 p-3">
                                    <span class="head-card-akun__">Kode Referal</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mx-4 px-0 pt-0 mb-2">
                            <div class="mt-4">
                                <p class="referal-head">Dapatkan <span class="referal-on__">3.000 Poin</span> Unicelle
                                    dengan cara bagikan Kode Referalmu</p>
                            </div>

                            <input readonly class="form-control float-left" type="text"
                                value="{{ route('user.registration') }}?referral_code={{ urlencode(Auth::user()->referral_code) }}" id="myInput">
                            <button class="btn float-right" onclick="myFunction()"> 
                                <i class="fas fa-clipboard-list mr-2"></i>
                                <span class=" copy-text__">Copy</span>
                            </button>

                            <div class="share-sosmed d-inline-block mb-lg-5 mt-lg-5 mt-1 float-left">
                                <div class="d-flex align-items-center">
                                    <div class="mr-lg-3 mr-2">
                                        <span class="text-ic-share__ ">Share to : </span>
                                    </div>
                                    <a href="" style="text-decoration: none;">
                                        <img class="icon-referal-share__" src="{{my_asset('/images/icon/whatsapp.png')}}" alt="">
                                        <img class="icon-referal-share__" src="{{my_asset('/images/icon/facebook.png')}}" alt="">
                                        <img class="icon-referal-share__" src="{{my_asset('/images/icon/instagram.png')}}" alt="">
                                        <img class="icon-referal-share__" src="{{my_asset('/images/icon/line.png')}}" alt="">
                                        <img class="icon-referal-share__" src="{{my_asset('/images/icon/twitter.png')}}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')

    <script>
    function myFunction() {
        var copyText = document.getElementById("myInput");
        copyText.select();
        copyText.setSelectionRange(0, 99999)
        document.execCommand("copy");
        showFrontendAlert("success","Copied the text: \n" + copyText.value);
    }
    
</script>


<script>
    $('.add').click(function () {
        if ($(this).prev().val() < 12) {
            $(this).prev().val(+$(this).prev().val() + 1);
        }
    });
    $('.sub').click(function () {
        if ($(this).next().val() > 1) {
            if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
        }
    });
</script>
@endsection

