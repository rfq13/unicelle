@extends('sidebar-dr')

@section('sidebar')

<div class="card">
    <div class="card-header  bg-transparent mb-0">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-4 col-sm-4 col-6 p-3">
                <span class="head-card-akun__">Pesanan Saya</span>
            </div>
        </div>
    </div>
    <div class="card-body mt-3 px-3 pt-0 mb-2">


        <!-- ----- Start Belum Dibayar ----- -->
        <div class="card card-pesanan__ my-4 ">
            <div class="container card-header pb-2 pt-2">
                <span class="text-left p-0 mb-0">16 september 2020</span>
            </div>
            <div class="card-group">
                <div class="card col-md-4 mb-0 ">
                    <div class="card-body p-2">
                        <p class="mb-0 text-left">
                            <span class="title-id-pesanan__">#20200917-10304746</span>
                        </p>
                        <div class="d-flex mt-3">
                            <div class="img-produk-pesanan__ mr-3 p-1">
                                <img class="img-pesanan__" src="assets/images/produk.png" alt="">
                            </div>
                            <div class="deskripsi-pesanan__">
                                <div class="name-produk-pesanan__">
                                    <span class="judul-pesanan__"> ANTANGIN JRG CAIR 12
                                        SACHET.</span>
                                </div>
                                <div class="jumlah-produk-pesanan mt-2">
                                    <span class="jumlah-pesanan__">Jumlah Pesanan</span>
                                    <div class="jumlah-number-pesanan__">
                                        <span class="number-pesanan__">2</span>
                                    </div>
                                </div>
                                <div class="jumlah-produk-pesanan mt-2 mb-2">
                                    <span class="jumlah-pesanan__">Harga</span>
                                    <div class="jumlah-number-pesanan__">
                                        <span class="number-pesanan__">Rp 12.000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card col-md-4 mb-0">
                    <div class="card-body p-2">
                        <p class="mb-0 text-left">
                            <span class="title-id-pesanan__">Pembayaran</span>
                        </p>
                        <div class="jumlah-produk-pesanan mt-3">
                            <span class="virtual-pembayaran-pesanan__">BCA Virtual</span>
                            <div class="jumlah-number-pesanan__">
                                <span class="no-resi-pesanan__">No. 40905398604</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card col-md-4 mb-0s">
                    <div class="card-body p-2">
                        <p class="mb-0 text-left">
                            <span class="title-id-pesanan__">Status</span>
                        </p>
                        <div class="jumlah-produk-pesanan mt-3">
                            <div class="mb-2">
                                <span class="status-pesanan__">Belum Dibayar</span>
                            </div>
                            <button class="btn btn-primary1 mb-2 w-75">Lihat Detail</button>
                            <button class="btn btn-secondary mb-2 w-75">Batalkan </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container card-footer pb-2 pt-2 bg-white">
                <div class="text-left p-0 mb-0">

                </div>
            </div>
        </div>
         <!-- ----- End Belum Dibayar ----- -->


          <!-- ----- Start Terkirim ----- -->
        <div class="card card-pesanan__ my-4 ">
            <div class="container card-header pb-2 pt-2">
                <span class="text-left p-0 mb-0">16 september 2020</span>
            </div>
            <div class="card-group">
                <div class="card col-md-4 mb-0 ">
                    <div class="card-body p-2">
                        <p class="mb-0 text-left">
                            <span class="title-id-pesanan__">#20200917-10304746</span>
                        </p>
                        <div class="d-flex mt-3">
                            <div class="img-produk-pesanan__ mr-3 p-1">
                                <img class="img-pesanan__" src="assets/images/produk.png" alt="">
                            </div>
                            <div class="deskripsi-pesanan__">
                                <div class="name-produk-pesanan__">
                                    <span class="judul-pesanan__"> ANTANGIN JRG CAIR 12
                                        SACHET.</span>
                                </div>
                                <div class="jumlah-produk-pesanan mt-2">
                                    <span class="jumlah-pesanan__">Jumlah Pesanan</span>
                                    <div class="jumlah-number-pesanan__">
                                        <span class="number-pesanan__">2</span>
                                    </div>
                                </div>
                                <div class="jumlah-produk-pesanan mt-2 mb-2">
                                    <span class="jumlah-pesanan__">Harga</span>
                                    <div class="jumlah-number-pesanan__">
                                        <span class="number-pesanan__">Rp 12.000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card col-md-4 mb-0">
                    <div class="card-body p-2">
                        <p class="mb-0 text-left">
                            <span class="title-id-pesanan__">Pembayaran</span>
                        </p>
                        <div class="jumlah-produk-pesanan mt-3">
                            <span class="virtual-pembayaran-pesanan__">BCA Virtual</span>
                            <div class="jumlah-number-pesanan__">
                                <span class="no-resi-pesanan__">No. 40905398604</span>
                            </div>
                        </div>
                        <div class="jumlah-produk-pesanan mt-3">
                            <span class="virtual-pembayaran-pesanan__">No. Resi</span>
                            <div class="jumlah-number-pesanan__">
                                <span class="no-resi-pesanan__">0007531766480539</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card col-md-4 mb-0">
                    <div class="card-body p-2">
                        <p class="mb-0 text-left">
                            <span class="title-id-pesanan__">Status</span>
                        </p>
                        <div class="jumlah-produk-pesanan mt-3">
                            <div class="mb-2">
                                <span class="status-pesanan__">Terkirim</span>
                            </div>
                            <button class="btn btn-primary1 mb-2 w-75">Lihat Detail</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container card-footer pb-2 pt-2 bg-white">
                <div class="text-left p-0 mb-0 ">
                    <a href="" class="border-right pr-3" style="text-decoration: none;">Lacak Pesanan</a>
                    <a href="" class="border-right px-3"style="text-decoration: none;">Konfirmasi Diterima</a>
                    <a href="" class="pl-3" style="text-decoration: none;">Komplain</a>
                </div>
            </div>
        </div>
         <!-- ----- End Terkirim ----- -->


          <!-- ----- Start Dibatalkan ----- -->
        <div class="card card-pesanan__ my-4 ">
            <div class="container card-header pb-2 pt-2">
                <span class="text-left p-0 mb-0">16 september 2020</span>
            </div>
            <div class="card-group">
                <div class="card col-md-4 mb-0 ">
                    <div class="card-body p-2">
                        <p class="mb-0 text-left">
                            <span class="title-id-pesanan__">#20200917-10304746</span>
                        </p>
                        <div class="d-flex mt-3">
                            <div class="img-produk-pesanan__ mr-3 p-1">
                                <img class="img-pesanan__" src="assets/images/produk.png" alt="">
                            </div>
                            <div class="deskripsi-pesanan__">
                                <div class="name-produk-pesanan__">
                                    <span class="judul-pesanan__"> ANTANGIN JRG CAIR 12
                                        SACHET.</span>
                                </div>
                                <div class="jumlah-produk-pesanan mt-2">
                                    <span class="jumlah-pesanan__">Jumlah Pesanan</span>
                                    <div class="jumlah-number-pesanan__">
                                        <span class="number-pesanan__">2</span>
                                    </div>
                                </div>
                                <div class="jumlah-produk-pesanan mt-2 mb-2">
                                    <span class="jumlah-pesanan__">Harga</span>
                                    <div class="jumlah-number-pesanan__">
                                        <span class="number-pesanan__">Rp 12.000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card col-md-4 mb-0">
                    <div class="card-body p-2">
                        <p class="mb-0 text-left">
                            <span class="title-id-pesanan__">Pembayaran</span>
                        </p>
                        <div class="jumlah-produk-pesanan mt-3">
                            <span class="virtual-pembayaran-pesanan__">BCA Virtual</span>
                            <div class="jumlah-number-pesanan__">
                                <span class="no-resi-pesanan__">No. 40905398604</span>
                            </div>
                        </div>

                        <!-- No resi -->

                        <!-- <div class="jumlah-produk-pesanan mt-3">
                            <span class="virtual-pembayaran-pesanan__">No. Resi</span>
                            <div class="jumlah-number-pesanan__">
                                <span class="no-resi-pesanan__">0007531766480539</span>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="card col-md-4 mb-0">
                    <div class="card-body p-2">
                        <p class="mb-0 text-left">
                            <span class="title-id-pesanan__">Status</span>
                        </p>
                        <div class="jumlah-produk-pesanan mt-3">
                            <div class="mb-2">
                                <span class="status-pesanan__">Dibatalkan</span>
                            </div>
                            <button class="btn btn-primary1 mb-2 w-75">Lihat Detail</button>
                            <button class="btn btn-secondary1 mb-2 w-75">Beli Lagi</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container card-footer pb-2 pt-2 bg-white">
                <div class="text-left p-0 mb-0 ">
                   
                </div>
            </div>
        </div>
         <!-- ----- End Dibatalkan ----- -->


         <!-- ----- Start Dalam Pengiriman ----- -->
        <div class="card card-pesanan__ my-4 ">
            <div class="container card-header pb-2 pt-2">
                <span class="text-left p-0 mb-0">16 september 2020</span>
            </div>
            <div class="card-group">
                <div class="card col-md-4 mb-0 ">
                    <div class="card-body p-2">
                        <p class="mb-0 text-left">
                            <span class="title-id-pesanan__">#20200917-10304746</span>
                        </p>
                        <div class="d-flex mt-3">
                            <div class="img-produk-pesanan__ mr-3 p-1">
                                <img class="img-pesanan__" src="assets/images/produk.png" alt="">
                            </div>
                            <div class="deskripsi-pesanan__">
                                <div class="name-produk-pesanan__">
                                    <span class="judul-pesanan__"> ANTANGIN JRG CAIR 12
                                        SACHET.</span>
                                </div>
                                <div class="jumlah-produk-pesanan mt-2">
                                    <span class="jumlah-pesanan__">Jumlah Pesanan</span>
                                    <div class="jumlah-number-pesanan__">
                                        <span class="number-pesanan__">2</span>
                                    </div>
                                </div>
                                <div class="jumlah-produk-pesanan mt-2 mb-2">
                                    <span class="jumlah-pesanan__">Harga</span>
                                    <div class="jumlah-number-pesanan__">
                                        <span class="number-pesanan__">Rp 12.000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card col-md-4 mb-0">
                    <div class="card-body p-2">
                        <p class="mb-0 text-left">
                            <span class="title-id-pesanan__">Pembayaran</span>
                        </p>
                        <div class="jumlah-produk-pesanan mt-3">
                            <span class="virtual-pembayaran-pesanan__">BCA Virtual</span>
                            <div class="jumlah-number-pesanan__">
                                <span class="no-resi-pesanan__">No. 40905398604</span>
                            </div>
                        </div>

                        <!-- No resi -->

                        <div class="jumlah-produk-pesanan mt-3">
                            <span class="virtual-pembayaran-pesanan__">No. Resi</span>
                            <div class="jumlah-number-pesanan__">
                                <span class="no-resi-pesanan__">0007531766480539</span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card col-md-4 mb-0">
                    <div class="card-body p-2">
                        <p class="mb-0 text-left">
                            <span class="title-id-pesanan__">Status</span>
                        </p>
                        <div class="jumlah-produk-pesanan mt-3">
                            <div class="mb-2">
                                <span class="status-pesanan__">Dalam Pengiriman</span>
                            </div>
                            <button class="btn btn-primary1 mb-2 w-75">Lihat Detail</button>
                            <!-- <button class="btn btn-secondary1 mb-2 w-75">Beli Lagi</button> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="container card-footer pb-2 pt-2 bg-white">
                <div class="text-left p-0 mb-0 ">
                    <a href="" class="border-right pr-3" style="text-decoration: none;">Lacak Pesanan</a>
                    <!-- <a href="" class="border-right px-3">Konfirmasi Diterima</a>
                    <a href="" class="pl-3">Komplain</a> -->
                </div>
            </div>
        </div>
         <!-- ----- End Dalam Pengiriman ----- -->


            <!-- ----- Start SELESAI ----- -->
        <div class="card card-pesanan__ my-4 ">
            <div class="container card-header pb-2 pt-2">
                <span class="text-left p-0 mb-0">16 september 2020</span>
            </div>
            <div class="card-group">
                <div class="card col-md-4 mb-0 ">
                    <div class="card-body p-2">
                        <p class="mb-0 text-left">
                            <span class="title-id-pesanan__">#20200917-10304746</span>
                        </p>
                        <div class="d-flex mt-3">
                            <div class="img-produk-pesanan__ mr-3 p-1">
                                <img class="img-pesanan__" src="assets/images/produk.png" alt="">
                            </div>
                            <div class="deskripsi-pesanan__">
                                <div class="name-produk-pesanan__">
                                    <span class="judul-pesanan__"> ANTANGIN JRG CAIR 12
                                        SACHET.</span>
                                </div>
                                <div class="jumlah-produk-pesanan mt-2">
                                    <span class="jumlah-pesanan__">Jumlah Pesanan</span>
                                    <div class="jumlah-number-pesanan__">
                                        <span class="number-pesanan__">2</span>
                                    </div>
                                </div>
                                <div class="jumlah-produk-pesanan mt-2 mb-2">
                                    <span class="jumlah-pesanan__">Harga</span>
                                    <div class="jumlah-number-pesanan__">
                                        <span class="number-pesanan__">Rp 12.000</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card col-md-4 mb-0">
                    <div class="card-body p-2">
                        <p class="mb-0 text-left">
                            <span class="title-id-pesanan__">Pembayaran</span>
                        </p>
                        <div class="jumlah-produk-pesanan mt-3">
                            <span class="virtual-pembayaran-pesanan__">BCA Virtual</span>
                            <div class="jumlah-number-pesanan__">
                                <span class="no-resi-pesanan__">No. 40905398604</span>
                            </div>
                        </div>

                        <!-- No resi -->

                        <div class="jumlah-produk-pesanan mt-3">
                            <span class="virtual-pembayaran-pesanan__">No. Resi</span>
                            <div class="jumlah-number-pesanan__">
                                <span class="no-resi-pesanan__">0007531766480539</span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card col-md-4 mb-0">
                    <div class="card-body p-2">
                        <p class="mb-0 text-left">
                            <span class="title-id-pesanan__">Status</span>
                        </p>
                        <div class="jumlah-produk-pesanan mt-3">
                            <div class="mb-2">
                                <span class="status-pesanan__">SELESAI</span>
                                <div class="rating-pesanan-done">

                                    <!-- rating -->

                                </div>
                            </div>
                            <button class="btn btn-primary1 mb-2 w-75">Lihat Detail</button>
                            <!-- <button class="btn btn-secondary1 mb-2 w-75">Beli Lagi</button> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="container card-footer pb-2 pt-2 bg-white">
                <div class="text-left p-0 mb-0 ">
                    <!-- <a href="" class="border-right pr-3">Lacak Pesanan</a>
                    <a href="" class="border-right px-3">Konfirmasi Diterima</a>
                    <a href="" class="pl-3">Komplain</a> -->
                </div>
            </div>
        </div>
         <!-- ----- End SELESAI ----- -->



    </div>
</div>

@endsection