@php
   // dd($orders);
@endphp
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
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="card col-lg-4 d-none d-lg-block">
                    @if(Auth::user()->user_type == 'seller')
                        @include('frontend.inc.seller_side_nav')
                    @elseif(Auth::user()->user_type == 'customer' || Auth::user()->user_type == 'pasien reg')
                        @include('frontend.inc.customer_side_nav')
                    @endif
                </div>

                <div class="col-lg-8">
                    {{--<div class="main-content">
                        <!-- Page title -->
                        <div class="page-title">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-12">
                                    <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                        {{ translate('Purchase History')}}
                                    </h2>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="float-md-right">
                                        <ul class="breadcrumb">
                                            <li><a href="{{ route('home') }}">{{ translate('Home')}}</a></li>
                                            <li><a href="{{ route('dashboard') }}">{{ translate('Dashboard')}}</a></li>
                                            <li class="active"><a href="{{ route('purchase_history.index') }}">{{ translate('Purchase History')}}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (count($orders) > 0)
                            <!-- Order history table -->
                            <div class="card no-border mt-4">
                                <div>
                                    <table class="table table-sm table-hover table-responsive-md">
                                        <thead>
                                            <tr>
                                                <th>{{ translate('Code')}}</th>
                                                <th>{{ translate('Date')}}</th>
                                                <th>{{ translate('Amount')}}</th>
                                                <th>{{ translate('Delivery Status')}}</th>
                                                <th>{{ translate('Payment Status')}}</th>
                                                <th>{{ translate('Options')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $key => $order)
                                                @if (count($order->orderDetails) > 0)
                                                    <tr>
                                                        <td>
                                                            <a href="#{{ $order->code }}" onclick="show_purchase_history_details({{ $order->id }})">{{ $order->code }}</a>
                                                        </td>
                                                        <td>{{ date('d-m-Y', $order->date) }}</td>
                                                        <td>
                                                            {{ single_price($order->grand_total) }}
                                                        </td>
                                                        <td>
                                                            {{ ucfirst(str_replace('_', ' ', $order->orderDetails->first()->delivery_status)) }}
                                                            @if($order->delivery_viewed == 0)
                                                                <span class="ml-2" style="color:green"><strong>*</strong></span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span class="badge badge--2 mr-4">
                                                                @if ($order->payment_status == 'paid')
                                                                    <i class="bg-green"></i> {{ translate('Paid')}}
                                                                @else
                                                                    <i class="bg-red"></i> {{ translate('Unpaid')}}
                                                                @endif
                                                                @if($order->payment_status_viewed == 0)
                                                                    <span class="ml-2" style="color:green"><strong>*</strong></span>
                                                                @endif
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fa fa-ellipsis-v"></i>
                                                                </button>

                                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="">
                                                                    <button onclick="show_purchase_history_details({{ $order->id }})" class="dropdown-item">{{ translate('Order Details')}}</button>
                                                                    <a href="{{ route('customer.invoice.download', $order->id) }}" class="dropdown-item">{{ translate('Download Invoice')}}</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif

                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                {{ $orders->links() }}
                            </ul>
                        </div>
                    </div>--}}

                    <div class="card">
                        <div class="card-header  bg-transparent mb-0">
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-4 col-sm-4 col-6 p-3">
                                    <span class="head-card-akun__">Pesanan Saya</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mt-3 px-3 pt-0 mb-2">
                        @if (count($orders) > 0)
                        @foreach ($orders as $key => $order)
                            <div class="card card-pesanan__ my-3 ">
                                <div class="container card-header pb-2 pt-2">
                                    <span class="text-left p-0 mb-0">{{ date('d-m-Y H:i:s', $order->date) }}</span>
                                </div>
                                <div class="card-group">
                                    <div
                                        class="card col-md-4 mb-0  boder-bottom-unset border-top-unset border-left-unset">
                                        <div class="card-body p-2">
                                            <p class="mb-0 text-left">
                                                <span class="title-id-pesanan__"> {{ "#".$order->code }}</span>
                                            </p>
                                            <div class="d-flex mt-3">
                                                @php
                                                    $detailOrder = $order->orderDetails[0];
                                                    $photos = json_decode($detailOrder->product->photos)[0];
                                                @endphp
                                                <div class="img-produk-pesanan__ mr-3 p-1">
                                                    <img class="img-pesanan__ img-thumbnail" src="{{my_asset($photos)}}" alt="">
                                                </div>
                                                <div class="deskripsi-pesanan__">
                                                    <div class="name-produk-pesanan__">
                                                        <span class="judul-pesanan__" style="text-transform:capitalize"> {{$detailOrder->product->name}}</span>
                                                    </div>
                                                    <div class="jumlah-produk-pesanan mt-2">
                                                        <span class="jumlah-pesanan__">Jumlah Pesanan</span>
                                                        <div class="jumlah-number-pesanan__">
                                                            <span class="number-pesanan__">{{count($order->orderDetails)}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="jumlah-produk-pesanan mt-2 mb-2">
                                                        <span class="jumlah-pesanan__">Harga</span>
                                                        <div class="jumlah-number-pesanan__">
                                                            <span class="number-pesanan__">{{ single_price($order->grand_total) }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="card col-md-4 mb-0  borer-bottom-unset border-top-unset border-left-unset">
                                        <div class="card-body p-2">
                                            <p class="mb-0 text-left">
                                                <span class="title-id-pesanan__">Pembayaran</span>
                                            </p>
                                            <div class="jumlah-produk-pesanan mt-3">
                                                @php( $norek = $order->payment_type == "cash_on_delivery" ? "" : "No. 40905398604" )
                                                <span class="virtual-pembayaran-pesanan__" style="text-transform:uppercase">{{ str_replace("_"," ",$order->payment_type) }}</span>
                                                <div class="jumlah-number-pesanan__">
                                                    <span class="no-resi-pesanan__">{{$norek}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="card col-md-4 mb-0  borer-bottom-unset border-top-unset border-left-unset border-right-unset">
                                        <div class="card-body p-2">
                                            <p class="mb-0 text-left">
                                                <span class="title-id-pesanan__">Status</span>
                                            </p>
                                            <div class="jumlah-produk-pesanan mt-3">
                                                <div class="mb-2">
                                                    <span class="status-pesanan__">
                                                        <span class="badge badge--2 mr-4">
                                                            @if ($order->payment_status == 'paid')
                                                                <i class="bg-green"></i> {{ translate('Paid')}}
                                                            @else
                                                                <i class="bg-red"></i> {{ translate('Unpaid')}}
                                                            @endif
                                                            @if($order->payment_status_viewed == 0)
                                                                <span class="ml-2" style="color:green"><strong>*</strong></span>
                                                            @endif
                                                        </span>
                                                    </span>
                                                </div>
                                                <a href="#{{ $order->code }}" onclick="show_purchase_history_details({{ $order->id }})" class="btn btn-primary1 mb-2 w-75">Lihat Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="order_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <div id="order-details-modal-body">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{ translate('Make Payment')}}</h5>
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
    <script type="text/javascript">
        $('#order_details').on('hidden.bs.modal', function () {
            location.reload();
        })
    </script>

@endsection