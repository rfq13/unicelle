@extends('frontend.layouts.app')
@section('title', 'Pesanan')
@section('style')
    <style>
        .img-pesanan__ {
            width: 59px;
            height: 70px;
        }


        fieldset,
        label {
            margin: 0;
            padding: 0;
        }

        h1 {
            font-size: 1.5em;
            margin: 10px;
        }

        /****** Style untuk rating star *****/

        .rating {
            border: none;
            float: left;
        }

        .rating>input {
            display: none;
        }

        .rating>label:before {
            margin: 5px;
            font-size: 1.25em;
            font-family: FontAwesome;
            display: inline-block;
            content: "\f005";
        }

        .rating>.half:before {
            content: "\f089";
            position: absolute;
        }

        .rating>label {
            color: #ddd;
            float: right;
        }

        /***** CSS untuk hover nya *****/

        .rating>input:checked~label,
        /* memperlihatkan warna emas pada saat di klik */
        .rating:not(:checked)>label:hover,
        /* hover untuk star berikutnya */
        .rating:not(:checked)>label:hover~label {
            color: #FFD700;
        }

        /* hover untuk star sebelumnya  */

        .rating>input:checked+label:hover,
        /* hover ketika mengganti rating */
        .rating>input:checked~label:hover,
        .rating>label:hover~input:checked~label,
        /* seleksi hover */
        .rating>input:checked~label:hover~label {
            color: #FFED85;
        }

    </style>
@endsection
@section('stylesheet')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/themes/fontawesome-stars.css">
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
                                <div class="col-lg-6 col-md-4 col-sm-4 col-6 py-0">
                                    <span class="head-card-akun__ ">Pesanan Saya</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mt-3 px-3 pt-0 mb-2" id="list-product">
                            @if (count($orders) > 0)
                                @foreach ($orders as $key => $order)
                                    <div class="card card-pesanan__ my-3 ">
                                        <div class="container pb-2 pt-2">
                                            <span class="text-left p-0 mb-0">{{ date('d-m-Y H:i:s', $order->date) }}</span>
                                        </div>
                                        <div style="box-shadow: 0px 0px 4px 1px rgb(0 0 0 / 25%);" class="card-group">
                                            <div
                                                class="col-md-4 mb-0  boder-bottom-unset border-top-unset border-left-unset">
                                                <div class="card-body p-2">
                                                    <p class="mb-0 text-left">
                                                        <span class="title-id-pesanan__"> {{ '#' . $order->code }}</span>
                                                    </p>
                                                    <div class="d-flex mt-3">
                                                        @php
                                                        foreach ($order->orderDetails as $key => $value) {
                                                            $detailOrder = $value;
                                                        }
                                                        $photos = !isset($detailOrder->product) ? "" :
                                                        $detailOrder->product->thumbnail_img;
                                                        @endphp
                                                        <div class=" text-center mr-3 p-1">
                                                            <img class=" img-fluid" src="{{ my_asset($photos) }}" alt="{{ json_encode([
                                                                "did"=>$detailOrder->id,
                                                                "oid"=>$order->id
                                                                ]) }}"
                                                                width="80">
                                                        </div>
                                                        <div class="deskripsi-pesanan__">
                                                            <div class="name-produk-pesanan__">
                                                                <span class="judul-pesanan__ font-weight-bold"
                                                                    style="font-size: 16px; text-transform:capitalize"> {!!
                                                                    isset($detailOrder->product) ?
                                                                    $detailOrder->product->name : "<cite
                                                                        style='color:#63A6E6'>Produk tidak ditemukan</cite>"
                                                                    !!}</span>
                                                            </div>
                                                            <div class="jumlah-produk-pesanan mt-1">
                                                                <span style="color: #818a91;font-size: 13px;" class="jumlah-pesanan__">Total Belanja</span>
                                                                <div class="jumlah-number-pesanan__">
                                                                    <span style="font-weight:700">{{ single_price($order->grand_total) }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="jumlah-produk-pesanan mt-2 mb-2">
                                                                <div class="jumlah-number-pesanan__">
                                                                    <span style="color:#3B6CB6" class="number-pesanan__">+{{ count($order->orderDetails) }} Produk Lainnya</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="col-md-4 mb-0  borer-bottom-unset border-top-unset border-left-unset">
                                                <div class="card-body p-2">
                                                    <p class="mb-0 text-left">
                                                        <span class="title-id-pesanan__">Pembayaran</span>
                                                    </p>
                                                    <div class="mt-3">
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
                                                        <div class="jumlah-produk-pesanan mt-3 mb-2">
                                                            @isset($order->resi)
                                                                <span>{{ $order->resi }}</span>
                                                            @endisset
                                                            @php
                                                            $norek = $order->payment_type == "cash_on_delivery" ? "" : "No.
                                                            40905398604";
                                                            @endphp
                                                            <span class="virtual-pembayaran-pesanan__"
                                                                style="text-transform:uppercase">{{ str_replace('_', ' ', $order->payment_type) }}</span>
                                                            <div class="jumlah-number-pesanan__">
                                                                @if (json_decode($order->manual_payment) != null)
                                                                    <span class="no-resi-pesanan__"> No. Rek
                                                                        {{ json_decode($order->manual_payment)->norek }}
                                                                        <br> a/n
                                                                        {{ json_decode($order->manual_payment)->name }}</span>
                                                                @endif
                                                            </div>
                                                            <br>
                                                            @if ($order->payment_status == 'unpaid')
                                                                <a href="{{ route('payment.create', $order->id) }}"
                                                                    class="btn btn-primary1 w-80">Ubah</a>
                                                            @endif
                                                        </div>
                                                    @elseif ($order->payment_status=="unpaid" && $order->payment_type == "manual_transfer")
                                                        <div class="jumlah-produk-pesanan mt-3 mb-2">
                                                            <a href="{{ route('payment.create', $order->id) }}"
                                                                class="btn btn-primary1 w-80">Konfirmasi Pembayaran</a>
                                                        </div>
                                                    @endif

                                                    {{-- <select id="rating">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select> --}}
                                                </div>
                                                </div>
                                            </div>
                                            <div
                                                class="col-md-4 mb-0  borer-bottom-unset border-top-unset border-left-unset border-right-unset">
                                                <div class="card-body p-2">
                                                
                                                    <p class="mb-0 text-left">
                                                       <span class="title-id-pesanan__">Status</span>
                                                    </p>
                                                    <div class="mt-3">
                                                    <div class="mb-2">
                                                        <span class="status-pesanan__">
                                                            <span style="color:#000000;font-weight: bold;font-size: 14px;" class="badge badge--2 mr-4">
                                                                @php
                                                                $search = \App\RefundRequest::where('order_id',$order->id)->first();
                                                                @endphp
                                                                @if($order->delivery_status == 'delivered')
                                                                    {{ translate('Pesanan Selesai') }}
                                                                @elseif ($order->payment_status == 'paid')
                                                                    
                                                                    {{ translate('Terbayar') }}
                                                                @else
                                                                    
                                                                    {{ translate('perlu dibayar') }}
                                                                @endif
                                                                @if ($order->payment_status_viewed == 0)
                                                                    <span class="ml-2"
                                                                        style="color:green"><strong>*</strong></span>
                                                                @endif
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <div class="jumlah-produk-pesanan mt-3">
                                                        <a href="#{{ $order->code }}" onclick="show_purchase_history_details({{ $order->id }})" class="btn btn-primary1 mb-2 w-75">Lihat Detail </a>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <div class="pagination-wrapper py-4">
                                <ul class="pagination justify-content-end">
                                    {{ $orders->links() }}
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                    @if(Auth::user()->user_type == 'seller')
                        @include('frontend.seller.seller_sold')
                        @endif
                </div>
            </div>
        </div>
    </section>

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

    <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{ translate('Make Payment') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="payment_modal_body"></div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/jquery.barrating.min.js"></script>
    <script type="text/javascript">
        $('#list-product #rating').barrating({
            theme: 'fontawesome-stars'
        });


        $(".page-link").css("backgorund-color", "#006064")

        $('#order_details').on('hidden.bs.modal', function() {
            location.reload();
        })



        $(".page-link").css("backgorund-color", "#006064")

        $('#order_details').on('hidden.bs.modal', function() {
            location.reload();
        })

    </script>

@endsection
