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
    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-4 d-none d-lg-block">
                    <div class="card mr-2">
                        @if (Auth::user()->user_type == 'seller')
                            @include('frontend.inc.seller_side_nav')
                        @else
                            @include('frontend.inc.customer_side_nav')
                        @endif
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header  bg-transparent mb-0">
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-4 col-sm-4 col-6 p-3">
                                    <span class="head-card-akun__">Riwayat Poin</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mt-2 px-0 pt-0 mb-2">
                            <section class="bg-poin-now m-0 p-3 py-4">
                                <div class="row align-items-center p-0 m-0">
                                    <div class="col-6 col-lg-6">
                                        <span class="text-head-poin__">Poin Saat ini</span>
                                    </div>
                                    <div class="col-6 col-lg-6 d-flex align-items-center justify-content-end">
                                        <img class="ic-akunpoin__ mr-lg-4 mr-2"
                                            src="{{ my_asset('images/icon/coin.png') }} " alt="">
                                        <div>
                                            <span class="poin-now__">6.000</span>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <a href="" type="" class="card_hv" data-toggle="modal" data-target="#staticBackdrop">
                                <div class="card m-3">
                                    <div class="d-flex">
                                        <div class="py-1 px-3 flex-grow-1 bd-highlight border-right">
                                            <h4 class="font-weight-bold text1">Diskon Rp 15K</h4>
                                            <h6>Voucher potongan 15k untuk pengguna pertama</h6>
                                            <span class="text2">520 Poin</span>
                                        </div>
                                        <div class=" bg_get_voc p-3">
                                            <div class=" text-center ">
                                                <h4 class="text-white align-self-center">Dapatkan <br>Kode</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            {{-- modal_detail --}}
                            <div class="modal fade"id="staticBackdrop" data-backdrop="static" data-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="p-3">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row align-items-center justify-content-center">
                                                <div class="col-4 text-center">
                                                    <img src="{{ my_asset('images/icon/coin.png') }} " alt="" class="img-fluid" width="180" height="160">
                                                </div>
                                                <div class="col-8">
                                                    <h5>Dapatkan potongan diskon Rp200ribu untuk menikmati weekend!</h5>
                                                    <span>200 Poin</span>
                                                </div>
                                            </div>
                                            <hr>
                                            <h6>Syarat & Ketentuan </h6>
                                            <ul>
                                                <li class="py-1">
                                                    Promo eksklusif ini berlaku untuk pembelanjaan dengan minimum Rp 200.000! Promo berlaku untuk semua produk kecuali voucher, tagihan, tiket & top-up.
                                                </li>
                                                <li class="py-1">
                                                    Penawaran Diskon: Cashback 50% hingga Rp 30.000
                                                </li>
                                                <li class="py-1">
                                                    Minimum Belanja: Minimum belanja Rp 200.000
                                                </li>
                                                    
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary disable">Tukar</button>
                                            <button type="button" class="btn btn-secondary1">Tukar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- modal konfirm --}}
                            <div class="modal fade"id="staticBackdrop" data-backdrop="static" data-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="p-3">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <h4 class="font-weight-bold text1">Yakin Tukar Voucher</h4>
                                            <div class=" text-center d-flex align-items-center justify-content-center mt-4">
                                                <img class="ic-akunpoin__ mr-lg-4 mr-2"
                                                    src="{{ my_asset('images/icon/coin.png') }} " alt="">
                                                <div>
                                                    <span class="poin-now__">200 Poin</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-around border-0">
                                            <button type="button" class="btn btn-secondary1 w-25">Tukar</button>
                                            <button type="button" class="btn btn-secondary w-25">Batalkan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
