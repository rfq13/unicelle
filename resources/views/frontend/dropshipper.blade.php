@php
if ($bank_setting == null) {
flash("mohon maaf mengganggu kenyamanan anda, pengaturan bank belum dilakukan oleh admin");
echo "<script>
    window.location = '".route("home")."'

</script>";
return;
}
@endphp
@extends('frontend.layouts.app')
@section('stylesheet')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/themes/fontawesome-stars.css">
@endsection
@section('title', 'Dropshipper')
@section('content')
    <section class="gry-bg py-4 profile">
    <div class="container">
    @include('frontend.inc.customer_mobile_nav')

    </div>
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-4 d-none d-lg-block">
                    <div class="card mr-2">

                        @if (Auth::user()->user_type == 'seller')
                            @include('frontend.inc.seller_side_nav')
                        @elseif(Auth::user()->user_type != 'admin')
                            @include('frontend.inc.customer_side_nav')
                        @endif
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header  bg-transparent mb-0">
                            <div class="row align-items-center">
                                <div class="col-lg-6 py-0">
                                    <span class="head-card-akun__">Dropshipper</span>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('dropshipper') }}" method="get">
                            <div class="row mt-4 mb-4">
                                <div class="col-3 ml-3">
                                <input placeholder="Pilih Tanggal" class="form-date" type="text" onfocus="(this.type='date')" id="birthday" value="{{ $tgl }}" name="tgl" onchange="filter()">
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <label class="mr-2 mt-2">Urutkan</label>
                                        <select class="form-control" name="sort" onchange="filter()" style="width:70%">
                                            <option value="1" {{ $sort == '1' ? 'selected' : '' }}>Terbaru</option>
                                            <option value="2" {{ $sort == '2' ? 'selected' : '' }}>Terlama</option>
                                            {{-- <option value="3" {{ $sort == '3' ? 'selected' : '' }}>Terbaik</option> --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <input class="form-control" style="width: 70%;" value="{{ $q }}" name="q"
                                            type="search" placeholder="Cari Produk" aria-label="Search">
                                        <div class="btn btn-search ml-2" onclick="filter()">
                                            <a href="#" class="nav-box-link">
                                                <img src="{{ my_asset('img/header_dan_footer/icon/search.png') }}"></img>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" id="btnSubmit" style="display: none"></button>
                        </form>
                       
                            @if (count($orders) < 1)
                            <img style="align-self: center;width: 60%;margin: 10px;margin-bottom: 40px;" src="{{ my_asset('images/imgtransaksi-none-min.png') }}" alt="">
                            @else
                            @foreach ($orders as $key => $order)
                                @if ($order->orderDetails[0]->product != null)
                                    <div class="card-body mt-3 px-3 pt-0 mb-2">
                                        <div class="card card-pesanan__ ">
                                            <div class="container card-header pb-2 pt-2">
                                                <p class="font-weight-bold mb-0">{{ $order->created_at }}</p>
                                            </div>
                                            <div class="card-body m-0">
                                                <div class="row mt-2">
                                                    <div class="col-5">
                                                        <p class="receiver-dropshipper">#{{ $order->code }}</p>
                                                        <div class="d-flex align-items-start">
                                                            <img class=" img-thumbnail img-fluid"
                                                                src="{{ my_asset($order->orderDetails[0]->product->thumbnail_img) }}"
                                                                alt="" width="150" height="150">
                                                            <div class="ml-3">
                                                                @foreach ($order->orderDetails as $item)
                                                                    <p class="font-size-1 text-dropshipper mb-2">
                                                                        {{ $item->product->name }}
                                                                    </p>
                                                                    <p class="info-dropshipper m-0" style="font-size: 13px;">
                                                                        Jumlah Pesanan</p>
                                                                    <p class="text-dropshipper text-primary" style="font-size: 15px;">
                                                                        {{ $item->quantity }}
                                                                    </p>
                                                                @endforeach
                                                                <p class="info-dropshipper m-0" style="font-size: 13px;">Harga
                                                                </p>
                                                                <p class="text-dropshipper m-0 text-danger" style="font-size: 15px;" >
                                                                    {{ single_price($order->grand_total) }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <p class="receiver-dropshipper">Pembayaran</p>
                                                        @if ($order->payment_details !=null)
                                                        @php
                                                        $payment = json_decode($order->payment_details);
                                                        if (property_exists($payment,'bank_code')){
                                                            $pay_opt = "$payment->bank_code Virtual Account";
                                                            $pay_num = $payment->account_number;
                                                            $title = "VA";
                                                        }
                                                        elseif (property_exists($payment,'retail_outlet_name')) {
                                                            $pay_opt = $payment->retail_outlet_name;
                                                            $pay_num = $payment->payment_code;
                                                            $title = 'kode Pembayaran';
                                                        }
                                                        elseif (property_exists($payment,'card_brand')) {
                                                            $pay_opt = $payment->card_brand." (kartu kredit)";
                                                            $pay_num = $payment->masked_card_number;
                                                            $title = 'kode Kartu';
                                                        }
                                                        @endphp
                                                        <p class="text-dropshipper text-capitalize" style="margin-bottom: 0%;">
                                                            {{ $pay_opt }}
                                                        </p>
                                                        <p class="content-dropshipper" style="margin-bottom: 0%;">
                                                            No.{{ $pay_num }}</p>
                                                        @endif
                                                        @if ($order->manual_payment && is_array(json_decode($order->manual_payment, true)))
                                                            <div class="jumlah-produk-pesanan mt-3">
                                                                @php $norek = $order->payment_type == "cash_on_delivery"
                                                                ? "" : "No. 40905398604"; @endphp
                                                                <span class="virtual-pembayaran-pesanan__"
                                                                    style="text-transform:uppercase">{{ str_replace('_', ' ', $order->payment_type) }}</span>
                                                                <div class="jumlah-number-pesanan__">
                                                                    <span class="no-resi-pesanan__"> No. Rekening
                                                                        {{ json_decode($order->manual_payment)->norek }}
                                                                        <br> a/n
                                                                        {{ json_decode($order->manual_payment)->name }}</span>
                                                                </div>
                                                                <br>
                                                                @if ($order->status != 'paid')
                                                                    <a href="{{ route('payment.create', $order->id) }}"
                                                                        class="btn btn-primary1 w-80">Ubah</a>
                                                                @endif
                                                            </div>
                                                        @elseif($order->status != "paid")
                                                            {{-- <div class="jumlah-produk-pesanan mt-3">
                                                                <a href="{{ route('payment.create', $order->id) }}"
                                                                    class="btn btn-primary1 w-80">Konfirmasi
                                                                    Pembayaran</a>
                                                            </div> --}}
                                                            
                                                    <div class="mb-2">
                                                        <span class="status-pesanan__">
                                                            <span class="badge badge--2 mr-4">
                                                            
                                                                @if($order->delivery_status == 'delivered')
                                                                <i class="bg-green"
                                                                        style="text-transform: capitalize"></i>
                                                                    {{ translate('Pesanan Selesai') }}
                                                                @elseif ($order->payment_status == 'paid')
                                                                    <i class="bg-green"
                                                                        style="text-transform: capitalize"></i>
                                                                    {{ translate('Terbayar') }}
                                                                @else
                                                                    <i class="bg-red"
                                                                        style="text-transform: capitalize"></i>
                                                                    {{ translate('perlu dibayar') }}
                                                                @endif
                                                                @if ($order->payment_status_viewed == 0)
                                                                    <span class="ml-2"
                                                                        style="color:green"><strong>*</strong></span>
                                                                @endif
                                                            </span>
                                                        </span>
                                                    </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-3">
                                                        <p class="receiver-dropshipper">Status</p>
                                                        <p class="text-dropshipper" style="text-transform: capitalize">
                                                            {{ $order->payment_status == 'unpaid' ? 'belum dibayar' : 'terbayar' }}
                                                        </p>
                                                        <button class="btn btn-default" style="width:90%"
                                                            onclick="show_purchase_history_details({{ $order->id }})">Lihat
                                                            Detail</button>
                                                    </div>
                                                    <hr class="mt-0 mb-0">
                                                </div>
                                                <div class="mt-4 border-top pt-3">
                                                    <p class="tittle-dropshipper">Penerima Dropshipper</p>
                                                    <div class="row">
                                                        @php
                                                        $addr = json_decode($order->addresse);
                                                        @endphp
                                                        <div class="col-4">
                                                            <p class="text-primary font-weight-bold" style="font-size:16px">Nama</p>
                                                            <p class="content-dropshipper text-capitalize">{{ $addr->receiver }}</p>
                                                        </div>
                                                        <div class="col-3 pl-0">
                                                            <p class="text-primary font-weight-bold" style="font-size:16px">
                                                                No.Telepon</p>
                                                            <p class="content-dropshipper">{{ $addr->phone }}</p>
                                                        </div>
                                                        <div class="col-5">
                                                            <p class="text-primary font-weight-bold" style="font-size:16px">Alamat
                                                                Penerima</p>
                                                            <p class="content-dropshipper text-capitalize">{{ $addr->city }},
                                                                {{ $addr->province }},
                                                                {{ $addr->subdistrict }},<br>{{ $addr->postal_code }}
                                                            </p>
                                                            <p class="content-dropshipper text-capitalize">
                                                            {{ $addr->address }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    {!! $span !!}
                                @endif

                            @endforeach
                            @endif                                    

                            {{-- <div class="card-body mt-3 px-3 pt-0 mb-2">
                                <div class="card card-pesanan__ ">
                                    <div class="container card-header pb-2 pt-2">
                                        <p class="mb-0">16 November 2020</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <div class="row mt-2">
                                                <div class="col mb-0 ml-2 pr-0">
                                                    <p class="code-dropshipper mb-2">#20200917-103041119</p>
                                                    <img class="img-dropshipper"
                                                        src="{{ my_asset('/images/icon/obat.png') }}" alt="">
                                                </div>
                                                <div class="col-3 pl-0 mt-4">
                                                    <p class="text-dropshipper" style="margin-bottom: 0%;">CTM 4 Mg 12
                                                        Tablet</p>
                                                    <p class="info-dropshipper" style="margin-bottom: 0%;">Jumlah Pesanan
                                                    </p>
                                                    <p class="text-dropshipper" style="margin-bottom: 0%;">2</p>
                                                    <p class="info-dropshipper" style="margin-bottom: 0%;">Harga</p>
                                                    <p class="text-dropshipper" style="margin-bottom: 0%;">Rp.5.900</p>
                                                </div>
                                                <div class="col">
                                                    <p class="receiver-dropshipper">Pembayaran</p>
                                                    <p class="text-dropshipper" style="margin-bottom: 0%;">BCA Virtual
                                                        Account</p>
                                                    <p class="content-dropshipper" style="margin-bottom: 0%;">
                                                        No.4010101010102222</p>
                                                </div>
                                                <div class="col">
                                                    <p class="receiver-dropshipper">Status</p>
                                                    <p class="text-dropshipper mb-0">Selesai</p>
                                                    <i class="fa fa-star mb-2 stars" aria-hidden="true"></i>
                                                    <button class="btn btn-default " style="width:90%" data-toggle="modal"
                                                        data-target="#detail-all-pesanan">Lihat Detail</button>
                                                    <button class="btn btn-beli-lagi mt-2 mb-2" style="width:90%">Beli
                                                        Lagi</button>
                                                </div>
                                            </div>
                                            <hr class="mt-0 mb-0">
                                            <p class="tittle-dropshipper mt-2 ml-4">Penerima Dropshipper</p>
                                            <div class="row mt-2 ml-2">
                                                <div class="col-6">
                                                    <p class="text-dropshipper" style="margin-bottom: 0%;">Nama</p>
                                                    <p class="content-dropshipper">Reni Pambudi</p>
                                                </div>
                                                <div class="col pl-0">
                                                    <p class="text-dropshipper" style="margin-bottom: 0%;">No.Telepon</p>
                                                    <p class="content-dropshipper">081990992929</p>
                                                </div>
                                                <div class="col">
                                                    <p class="text-dropshipper" style="margin-bottom: 0%;">Alamat Penerima
                                                    </p>
                                                    <p class="content-dropshipper">Rungkut Mejoyo /6 Surabaya</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body mt-3 px-3 pt-0 mb-2">
                                <div class="card card-pesanan__ ">
                                    <div class="container card-header pb-2 pt-2">
                                        <p class="mb-0">16 september 2020</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <div class="row mt-2">
                                                <div class="col mb-0 ml-2 pr-0">
                                                    <p class="code-dropshipper mb-2">#20200917-103041119</p>
                                                    <img class="img-dropshipper"
                                                        src="{{ my_asset('/images/icon/obat.png') }}" alt="">
                                                </div>
                                                <div class="col-3 pl-0 mt-4">
                                                    <p class="text-dropshipper" style="margin-bottom: 0%;">CTM 4 Mg 12
                                                        Tablet</p>
                                                    <p class="info-dropshipper" style="margin-bottom: 0%;">Jumlah Pesanan
                                                    </p>
                                                    <p class="text-dropshipper" style="margin-bottom: 0%;">2</p>
                                                    <p class="info-dropshipper" style="margin-bottom: 0%;">Harga</p>
                                                    <p class="text-dropshipper" style="margin-bottom: 0%;">Rp.5.900</p>
                                                </div>
                                                <div class="col">
                                                    <p class="receiver-dropshipper">Pembayaran</p>
                                                    <p class="text-dropshipper" style="margin-bottom: 0%;">BCA Virtual
                                                        Account</p>
                                                    <p class="content-dropshipper" style="margin-bottom: 0%;">
                                                        No.4010101010102222</p>
                                                </div>
                                                <div class="col">
                                                    <p class="receiver-dropshipper">Status</p>
                                                    <p class="text-dropshipper">Belum Dibayar</p>
                                                    <button class="btn btn-default " style="width:90%" data-toggle="modal"
                                                        data-target="#detail-all-pesanan">Lihat Detail</button>
                                                    <button class="btn btn-beli-lagi mt-2 mb-2" style="width:90%">Beli
                                                        Lagi</button>
                                                </div>
                                            </div>
                                            <hr class="mt-0 mb-0">
                                            <p class="tittle-dropshipper mt-2 ml-4">Penerima Dropshipper</p>
                                            <div class="row mt-2 ml-2">
                                                <div class="col-6">
                                                    <p class="text-dropshipper" style="margin-bottom: 0%;">Nama</p>
                                                    <p class="content-dropshipper">Reni Pambudi</p>
                                                </div>
                                                <div class="col pl-0">
                                                    <p class="text-dropshipper" style="margin-bottom: 0%;">No.Telepon</p>
                                                    <p class="content-dropshipper">081990992929</p>
                                                </div>
                                                <div class="col">
                                                    <p class="text-dropshipper" style="margin-bottom: 0%;">Alamat Penerima
                                                    </p>
                                                    <p class="content-dropshipper">Rungkut Mejoyo /6 Surabaya</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <!--Card-->

                    </div>
                </div>
            </div>
            <!-- modal pop-up start -->
            <div class="modal fade" id="detail-all-pesanan" tabindex="-1" aria-labelledby="detail-all-pesananLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detail-all-pesananLabel">Detail
                                Pesanan
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <div class="col mt-3">
                                    <div class="d-flex ">
                                        <!-- <div class="img-produk-pesanan__ mr-3 p-1">
                                                    <img class="img-pesanan__"
                                                        src="assets/images/produk.png" alt="">
                                                </div> -->
                                        <div class="deskripsi-pesanan__">
                                            <div class="name-produk-pesanan__">
                                                <span class="judul-pesanan__">ANTANGIN
                                                    JRG CAIR 12
                                                    SACHET.</span>
                                            </div>
                                            <div class="jumlah-produk-pesanan mt-2">
                                                <span class="jumlah-pesanan__">Jumlah
                                                    Pesanan</span>
                                                <div class="jumlah-number-pesanan__">
                                                    <span class="number-pesanan__">2</span>
                                                </div>
                                            </div>
                                            <div class="jumlah-produk-pesanan mt-2 mb-2">
                                                <span class="jumlah-pesanan__">Harga</span>
                                                <div class="jumlah-number-pesanan__">
                                                    <span class="number-pesanan__">Rp
                                                        12.000</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col mt-3">
                                    <div class="subtotal">
                                        <span class="head-detail-pesanan">Subtotal</span>
                                        <div class="">
                                            <span class="price-blue">Rp 24.000</span>
                                        </div>
                                    </div>
                                    <div class="poin mt-2">
                                        <span class="head-detail-pesanan">Poin
                                            Ditukar</span>
                                        <div class="">
                                            <span class="price-blue">Rp 0</span>
                                        </div>
                                    </div>
                                    <div class="ongkir mt-2">
                                        <span class="head-detail-pesanan">Ongkos
                                            Kirim</span>
                                        <div class="">
                                            <span class="price-blue">Rp18.000</span>
                                        </div>
                                        <div class="mt-3">
                                            <span class="head-detail-pesanan">Total</span>
                                        </div>
                                        <div class="">
                                            <span class="price-red">Rp 42.000</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col mt-3">
                                    <div class="metode-pembayaran">
                                        <span class="font-weight-bold">Metode Pembayaran</span>
                                        @foreach ($orders as $key => $order)

                                        @if ($order->payment_details !=null)
                                        @php
                                        $payment = json_decode($order->payment_details);

                                        if (property_exists($payment,'bank_code')){
                                            $pay_opt = "$payment->bank_code Virtual Account";
                                            $pay_num = $payment->account_number;
                                            $title = "VA";
                                        }
                                        elseif (property_exists($payment,'retail_outlet_name')) {
                                            $pay_opt = $payment->retail_outlet_name;
                                            $pay_num = $payment->payment_code;
                                            $title = 'kode Pembayaran';
                                            }
                                        elseif (property_exists($payment,'card_brand')) {
                                            $pay_opt = $payment->card_brand." (kartu kredit)";
                                            $pay_num = $payment->masked_card_number;
                                            $title = 'kode Kartu';
                                        }
                                        @endphp

                                        <div class="platform-bank mt-2">
                                            <span class="address-detail-pesanan">{{ $pay_opt }}</span>
                                        </div>
                                        <div class="norek">
                                            <span class="no-rek-modal">No. 8806 0821441</span>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                    <div class="address-ship mt-3">
                                        <span class="font-weight-bold">Alamat Pengiriman</span>
                                        <div class="user-name__ mt-2">
                                            <span class="price-blue">Maclefi Abner</span>
                                        </div>
                                        <div class="telp">
                                            <span class="head-detail-pesanan">+62087878787878</span>
                                        </div>
                                        <div class="alamat mt-2">
                                            <span class="address-detail-pesanan">
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

           

        </div>
        <div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size"
                    role="document">
                    <div class="modal-content position-relative">
                        <div class="c-preloader">
                            <i class="fa fa-spin fa-spinner"></i>
                        </div>
                        <div id="order-details-modal-body">

                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
@section('script')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script type="text/javascript" src="js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/jquery.barrating.min.js"></script>
    <script type="text/javascript">
        $('#order_details').on('hidden.bs.modal', function() {
            location.reload();
        })

        function filter() {
            $("#btnSubmit").click()
        }

        $(".btn-search").click(function(e) {
            e.preventDefault()
        })

        function myFunction() {
            var copyText = document.getElementById("myInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
            alert("Copied the text: " + copyText.value);
        }

        $('.add').click(function() {
            if ($(this).prev().val() < 12) {
                $(this).prev().val(+$(this).prev().val() + 1);
            }
        });
        $('.sub').click(function() {
            if ($(this).next().val() > 1) {
                if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
            }
        });
        

    </script>

@endsection
