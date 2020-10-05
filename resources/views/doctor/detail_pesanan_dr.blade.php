@extends('sidebar-dr')

@section('sidebar')

<div class="card">
    <div class="card-header bg-transparent ">
        <div class="p-3">
            <span class="head-card-akun__">Detail Pesanan</span>
        </div>
    </div>
    <div class="card-body mx-4 px-0">
        <div class="card">
            <div class="card-header">
                <div class="text-left">
                    <span class="font-weight-bold">Order ID : #20200917-10304746</span>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-8 pl-3 pr-0">
                        <table class="w-100">
                            <tr>
                                <td>Status</td>
                                <th>Pembayaran Diterima</th>
                            </tr>
                            <tr>
                                <td>Metode Pembayaran</td>
                                <th>Bank BNI
                                    No. 8806 0821441</th>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <th>29/09/2020 - <span>14:53</span></th>
                            </tr>
                            <tr>
                                <td>Metode Pengiriman</td>
                                <th>J&T Express</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>No Resi: 000753176648</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-4">
                        <div class="text-right">
                            <a href="" class="btn btn-primary1"><i class="far fa-file-alt mr-3"></i>Lacak Pengiriman</a>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-4">
                        <p>Produk</p>
                      
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
                    <div class="col-lg-4 pl-lg-5 pl-3 mb-lg-0 mt-lg-0 mt-5 mb-5">
                        <p>Pembayaran</p>
                        
                        <div class="subtotal">
                            <span
                                class="text-head-detail-modal__">Subtotal</span>
                            <div class="">
                                <span class="text-content-detail-modal__">Rp 24.000</span>
                            </div>
                        </div>
                        <div class="poin mt-2">
                            <span class="text-head-detail-modal__">Poin
                                Ditukar</span>
                            <div class="">
                                <span class="text-content-detail-modal__">Rp 0</span>
                            </div>
                        </div>
                        <div class="ongkir mt-2">
                            <span class="text-head-detail-modal__">Ongkos
                                Kirim</span>
                            <div class="">
                                <span class="text-content-detail-modal__">Rp18.000</span>
                            </div>
                            <div class="mt-3">
                                <span class="text-head-detail-modal__total">Total</span>
                            </div>
                            <div class="">
                                <span class="text-content-detail-modal__total">Rp 42.000</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <p>Alamat Pengiriman</p>
                       
                        <div class="address-ship mt-3">
                            <div class="user-name__">
                                <span class="text-content-detail-modal__">Maclefi Abner</span>
                            </div>    
                            <div class="telp">
                                <span class="text-head-detail-modal__">+62087878787878</span>
                            </div>
                            <div class="alamat mt-2">
                                <span class="jumlah-pesanan__">
                                    Jalan mulyorejo utara 177
                                    Mulyorejo, Surabaya, Jawa Timur (600111)
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           




        </div>
    </div>
</div>


@endsection