@extends('frontend.layouts.app')

@section('title')
    List Voucher
@endsection

@section('content')
    <style>
        .text1 {
            color: #005662;
        }

        .text2 {
            color: #B71C1C;
        }

        .bg_get_voc {
            background: linear-gradient(249.42deg, #005662 0%, #4FB3BF 100%);
            border-radius: 0px 5px 5px 0px;
        }

        /* .card_hv:hover {
            background: #fafafa;
            border: 1px solid #C4C4C4;
            box-sizing: border-box;
            box-shadow: 0px 0px 8px 2px rgba(0, 0, 0, 0.25);
            border-radius: 5px;
        } */

    </style>
    <section class="section-sub-head"></section>
    <section class="section-akun-profil">
        <div class="container">
            <div class="col-md-12">
                <div class="card px-2 py-3">
                    <div class="col-md-6">
                        <section class="bg-profil-poin p-4">
                            <div class="d-flex flex-row bd-highlight mb-3">
                                <div class="img-profil-akun__ mr-4">
                                    <img class="big-img-akun-pasien__" src="assets/images/ic_user.jpg" alt="">
                                </div>
                                <div class="info-akun-role__">
                                    <span class="tag-username-akun__">Maclefi Abner</span>
                                    <div class="my-1">
                                        <span class="role-user">Pasien Regular</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 card px-3 py-2" style="background: rgba(255, 255, 255, 0.7);
                            backdrop-filter: blur(1000px);
                            border-radius: 5px;">
                                <div class="row align-items-center ">
                                    <div class="col-6 col-lg-6">
                                        <span class="text-head-poin-change">Poin Saat ini</span>
                                    </div>
                                    <div class="col-6 col-lg-6 d-flex align-items-center justify-content-end">
                                        <img class="ic-akunpoin-change mr-lg-4 mr-2" src="assets/images/coin.png"
                                            alt="">
                                        <div>
                                            <span class="text-head-poin-change font-weight-bold">6.000</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-6 col-sm-12">
                            <div style="position: relative;
                            display: -ms-flexbox;
                            display: flex;
                            align-items: stretch;
                            width: 100%;">
                                <input type="text" class="form-control d-inline-block" placeholder="Cari Voucher"
                                    name="srch-term" id="srch-term"
                                    style="max-width: 100%; width: 100%;border-radius: 3px 0px 0px 3px;">
                                <div class="input-group-btn d-inline-block">
                                    <button class="btn btn-light px-3" type="submit"
                                        style="border-radius: 0px 3px 3px 0px;"><i class="fas fa-search"
                                            style="color: #3B6CB6; "></i></button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="mb-2">
                        <h5>Voucher Saya</h5>
                    </div>
                    <div class="row ">
                        <div class="col-md-3 col-sm-6 my-2">
                            <div class="card">
                                <div class="p-1">
                                    <div class="d-flex flex-row bd-highlight mb-3">
                                        <div class="p-2 bd-highlight">
                                            <img src="assets/images/ic_user.jpg" alt="" style="width: 70px;
                                            height: 70px;
                                            border: 1px solid #C4C4C4;
                                            box-sizing: border-box; border-radius: 100px;">
                                        </div>
                                        <div class="p-2 bd-highlight">
                                            <span class="d-block pb-2">All u can eat Bulgrill</span>
                                            <span style="
                                            font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 14px;
                                            line-height: 27px;
                                            color: #FF6F00;">Rp </span><span style="    font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 20px;
                                            line-height: 27px;
                                            color: #FF6F00;">100.000</span>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary1 w-100" style="border-radius: 0px 0px 5px 5px;">Pakai
                                    Voucher</button>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 my-2">
                            <div class="card">
                                <div class="p-1">
                                    <div class="d-flex flex-row bd-highlight mb-3">
                                        <div class="p-2 bd-highlight">
                                            <img src="assets/images/ic_user.jpg" alt="" style="width: 70px;
                                            height: 70px;
                                            border: 1px solid #C4C4C4;
                                            box-sizing: border-box; border-radius: 100px;">
                                        </div>
                                        <div class="p-2 bd-highlight">
                                            <span class="d-block pb-2">All u can eat Bulgrill</span>
                                            <span style="font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 14px; 
                                            line-height: 28px;
                                            color: #B40000;">Expired </span>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-secondary w-100" disabled
                                    style="border-radius: 0px 0px 5px 5px;">Pakai Voucher</button>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 my-2">
                            <div class="card">
                                <div class="p-1">
                                    <div class="d-flex flex-row bd-highlight mb-3">
                                        <div class="p-2 bd-highlight">
                                            <img src="assets/images/ic_user.jpg" alt="" style="width: 70px;
                                            height: 70px;
                                            border: 1px solid #C4C4C4;
                                            box-sizing: border-box; border-radius: 100px;">
                                        </div>
                                        <div class="p-2 bd-highlight">
                                            <span class="d-block pb-2">All u can eat Bulgrill</span>
                                            <span style="
                                            font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 14px;
                                            line-height: 28px;
                                            color: #008F31;">Sudah Digunakan</span>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-secondary w-100" disabled
                                    style="border-radius: 0px 0px 5px 5px;">Pakai
                                    Voucher</button>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 my-2">
                            <div class="card">
                                <div class="p-1">
                                    <div class="d-flex flex-row bd-highlight mb-3">
                                        <div class="p-2 bd-highlight">
                                            <img src="assets/images/ic_user.jpg" alt="" style="width: 70px;
                                            height: 70px;
                                            border: 1px solid #C4C4C4;
                                            box-sizing: border-box; border-radius: 100px;">
                                        </div>
                                        <div class="p-2 bd-highlight">
                                            <span class="d-block pb-2">All u can eat Bulgrill</span>
                                            <span style="
                                            font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 14px;
                                            line-height: 27px;
                                            color: #FF6F00;">Rp </span><span style="    font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 20px;
                                            line-height: 27px;
                                            color: #FF6F00;">100.000</span>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary1 w-100" style="border-radius: 0px 0px 5px 5px;">Pakai
                                    Voucher</button>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 my-2">
                            <div class="card">
                                <div class="p-1">
                                    <div class="d-flex flex-row bd-highlight mb-3">
                                        <div class="p-2 bd-highlight">
                                            <img src="assets/images/ic_user.jpg" alt="" style="width: 70px;
                                            height: 70px;
                                            border: 1px solid #C4C4C4;
                                            box-sizing: border-box; border-radius: 100px;">
                                        </div>
                                        <div class="p-2 bd-highlight">
                                            <span class="d-block pb-2">All u can eat Bulgrill</span>
                                            <span style="font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 14px; 
                                            line-height: 28px;
                                            color: #B40000;">Expired </span>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-secondary w-100" disabled
                                    style="border-radius: 0px 0px 5px 5px;">Pakai Voucher</button>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 my-2">
                            <div class="card">
                                <div class="p-1">
                                    <div class="d-flex flex-row bd-highlight mb-3">
                                        <div class="p-2 bd-highlight">
                                            <img src="assets/images/ic_user.jpg" alt="" style="width: 70px;
                                            height: 70px;
                                            border: 1px solid #C4C4C4;
                                            box-sizing: border-box; border-radius: 100px;">
                                        </div>
                                        <div class="p-2 bd-highlight">
                                            <span class="d-block pb-2">All u can eat Bulgrill</span>
                                            <span style="
                                            font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 14px;
                                            line-height: 28px;
                                            color: #008F31;">Sudah Digunakan</span>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-secondary w-100" disabled
                                    style="border-radius: 0px 0px 5px 5px;">Pakai
                                    Voucher</button>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-md-3 mb-md-5 mb-3 mt-1">
                        <button class="btn btn-primary1 px-5">Lihat Lainnya</button>
                    </div>
                    <div class="mb-2 mt-md-5 mt-3">
                        <h5>Voucher Terbaru</h5>
                    </div>
                    <div class="row ">
                        <div class="col-md-4 col-12 my-2">
                            <div class="card">
                                <div class="p-1">
                                    <div class="d-flex flex-row bd-highlight mb-3">
                                        <div class="p-2 bd-highlight">
                                            <img src="assets/images/ic_user.jpg" alt="" style="width: 70px;
                                            height: 70px;
                                            border: 1px solid #C4C4C4;
                                            box-sizing: border-box; border-radius: 100px;">
                                        </div>
                                        <div class="p-2 bd-highlight">
                                            <h5>All u can eat Bulgrill</h5>
                                            <span style="
                                            font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 14px;
                                            line-height: 27px;
                                            color: #FF6F00;">Poin </span><span style="    font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 20px;
                                            line-height: 27px;
                                            color: #FF6F00;"> 10.000</span>
                                            <button class=" mt-3 btn btn-primary1 w-100">Tukar Poinku</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 my-2">
                            <div class="card">
                                <div class="p-1">
                                    <div class="d-flex flex-row bd-highlight mb-3">
                                        <div class="p-2 bd-highlight">
                                            <img src="assets/images/ic_user.jpg" alt="" style="width: 70px;
                                            height: 70px;
                                            border: 1px solid #C4C4C4;
                                            box-sizing: border-box; border-radius: 100px;">
                                        </div>
                                        <div class="p-2 bd-highlight">
                                            <h5>All u can eat Bulgrill</h5>
                                            <span style="
                                            font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 14px;
                                            line-height: 27px;
                                            color: #FF6F00;">Poin </span><span style="    font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 20px;
                                            line-height: 27px;
                                            color: #FF6F00;"> 10.000</span>
                                            <button class=" mt-3 btn btn-primary1 w-100">Tukar Poinku</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 my-2">
                            <div class="card">
                                <div class="p-1">
                                    <div class="d-flex flex-row bd-highlight mb-3">
                                        <div class="p-2 bd-highlight">
                                            <img src="assets/images/ic_user.jpg" alt="" style="width: 70px;
                                            height: 70px;
                                            border: 1px solid #C4C4C4;
                                            box-sizing: border-box; border-radius: 100px;">
                                        </div>
                                        <div class="p-2 bd-highlight">
                                            <h5>All u can eat Bulgrill</h5>
                                            <span style="
                                            font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 14px;
                                            line-height: 27px;
                                            color: #FF6F00;">Poin </span><span style="    font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 20px;
                                            line-height: 27px;
                                            color: #FF6F00;"> 10.000</span>
                                            <button class=" mt-3 btn btn-primary1 w-100">Tukar Poinku</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 my-2">
                            <div class="card">
                                <div class="p-1">
                                    <div class="d-flex flex-row bd-highlight mb-3">
                                        <div class="p-2 bd-highlight">
                                            <img src="assets/images/ic_user.jpg" alt="" style="width: 70px;
                                            height: 70px;
                                            border: 1px solid #C4C4C4;
                                            box-sizing: border-box; border-radius: 100px;">
                                        </div>
                                        <div class="p-2 bd-highlight">
                                            <h5>All u can eat Bulgrill</h5>
                                            <span style="
                                            font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 14px;
                                            line-height: 27px;
                                            color: #FF6F00;">Poin </span><span style="    font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 20px;
                                            line-height: 27px;
                                            color: #FF6F00;"> 10.000</span>
                                            <button class=" mt-3 btn btn-primary1 w-100">Tukar Poinku</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 my-2">
                            <div class="card">
                                <div class="p-1">
                                    <div class="d-flex flex-row bd-highlight mb-3">
                                        <div class="p-2 bd-highlight">
                                            <img src="assets/images/ic_user.jpg" alt="" style="width: 70px;
                                            height: 70px;
                                            border: 1px solid #C4C4C4;
                                            box-sizing: border-box; border-radius: 100px;">
                                        </div>
                                        <div class="p-2 bd-highlight">
                                            <h5>All u can eat Bulgrill</h5>
                                            <span style="
                                            font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 14px;
                                            line-height: 27px;
                                            color: #FF6F00;">Poin </span><span style="    font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 20px;
                                            line-height: 27px;
                                            color: #FF6F00;"> 10.000</span>
                                            <button class=" mt-3 btn btn-primary1 w-100">Tukar Poinku</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 my-2">
                            <div class="card">
                                <div class="p-1">
                                    <div class="d-flex flex-row bd-highlight mb-3">
                                        <div class="p-2 bd-highlight">
                                            <img src="assets/images/ic_user.jpg" alt="" style="width: 70px;
                                            height: 70px;
                                            border: 1px solid #C4C4C4;
                                            box-sizing: border-box; border-radius: 100px;">
                                        </div>
                                        <div class="p-2 bd-highlight">
                                            <h5>All u can eat Bulgrill</h5>
                                            <span style="
                                            font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 14px;
                                            line-height: 27px;
                                            color: #FF6F00;">Poin </span><span style="    font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 20px;
                                            line-height: 27px;
                                            color: #FF6F00;"> 10.000</span>
                                            <button class=" mt-3 btn btn-primary1 w-100">Tukar Poinku</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12 my-2">
                            <div class="card">
                                <div class="p-1">
                                    <div class="d-flex flex-row bd-highlight mb-3">
                                        <div class="p-2 bd-highlight">
                                            <img src="assets/images/ic_user.jpg" alt="" style="width: 70px;
                                            height: 70px;
                                            border: 1px solid #C4C4C4;
                                            box-sizing: border-box; border-radius: 100px;">
                                        </div>
                                        <div class="p-2 bd-highlight">
                                            <h5>All u can eat Bulgrill</h5>
                                            <span style="
                                            font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 14px;
                                            line-height: 27px;
                                            color: #FF6F00;">Poin </span><span style="    font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 20px;
                                            line-height: 27px;
                                            color: #FF6F00;"> 10.000</span>
                                            <button class=" mt-3 btn btn-primary1 w-100">Tukar Poinku</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-md-3 mb-md-5 mb-3 mt-1">
                        <button class="btn btn-primary1 px-5">Lihat Lainnya</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@foreach (session('flash_notification', collect())->toArray() as $message)
    <script>
        showFrontendAlert('{{ $message['level'] }}', '{{ $message['message'] }}');
    </script>
@endforeach