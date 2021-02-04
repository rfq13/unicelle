@extends('frontend.layouts.app')
@section('style')
<style>
    .img-pesanan__ {
        width: 59px;
        height: 70px;
    }
</style>
@endsection

@section('content')
    <section class="gry-bg py-4 profile">
    <div class="container">
    @if(Auth::user()->user_type == 'seller')
    @include('frontend.inc.seller_mobile_nav')
    @else
    @include('frontend.inc.customer_mobile_nav')
    @endif
    </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card"></div>
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
                                <div class="row align-items-center ">
                                    <div class="col-6 col-lg-6">
                                        <span class="text-head-poin__">Poin Saat ini</span>
                                    </div>
                                    <div class="col-6 col-lg-6 d-flex align-items-center justify-content-end">
                                        <img class="ic-akunpoin__ mr-lg-4 mr-2" src="{{my_asset('/images/icon/coin.png')}}" alt="">
                                        <div>
                                            <span class="poin-now__">6.000</span>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <table class="table text-center mb-0 my-3 " >
                                <thead class="table-menu-poin">
                                    <tr>
                                        <td><a class="aktif-poin__" href="">Semua Riwayat</a></td>
                                        <td><a class="non-poin__"  href="">Poin Ditukar</a></td>
                                        <td><a class="non-poin__" href="">Poin Didapat</a></td>
                                    </tr>
                                </thead>
                            </table>

                            <table class="table table-hover text-center mt-0">
                                <thead class="table-riwayat-poin__">
                                    <tr>
                                        <th style="color:#fff" width="40" scope="col">Nama Transaksi</th>
                                        <th style="color:#fff" width="20" scope="col">Poin</th>
                                        <th style="color:#fff" width="40" scope="col">Tanggal & Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row">Poin Pembelian</td>
                                        <th scope="row">120 poin</th>
                                        <td scope="row">2020-09-16 &nbsp; 11:59:34</td>
                                    </tr>
                                    <tr>
                                        <td scope="row">Poin Pembelian</td>
                                        <th scope="row">100 poin</th>
                                        <td scope="row">2020-09-16 &nbsp; 11:59:34</td>
                                    </tr>
                                    <tr>
                                        {{-- <td scope="row">Poin Pembelian</td> --}}
                                        <th scope="row">190 poin</th>
                                        <td scope="row">2020-09-16 &nbsp; 11:59:34</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        $('#order_details').on('hidden.bs.modal', function () {
            location.reload();
        })
    </script>

@endsection
