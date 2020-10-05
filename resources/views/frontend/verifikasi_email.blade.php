@extends('frontend.regis_dan_login.regis_dan_login')
@section('content')
<section class="bg-img-login">
        <div class="container">
            <div class="row">


                <div class="col-lg-6 d-xl-block d-none" style="margin-top: 25%;">
                    <div class="justify-content-center text-center">
                        <img class="img-login" src="{{my_asset('\images\logo.png')}}" alt="">
                        <div class="text-center">
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

                    <div class="card bg-form-verifikasi p-3" style="background-color:#EFFFFE">

                        <h5 class="mb-4 mt-2">Verifikasi Email</h5>
                        <div class="m-auto">
                            <span class="text-verifikasi-email__">
                                Sebelum masuk pada akun, harap verifikasi Email anda. Jika tidak menerima Email
                                Verifikasi.
                                <a href="" class="link-verifikasi-email__"> Klik untuk mengirm ulang verifikasi </a>
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
