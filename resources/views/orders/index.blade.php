@extends('layouts.app')

@section('content')
@php
    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
@endphp
<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{translate('Pesanan')}}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_orders" action="" method="GET">
                <div class="box-inline pad-rgt pull-left">
                    <div class="select" style="min-width: 300px;">
                        <select class="form-control demo-select2" name="payment_type" id="payment_type" onchange="sort_orders()">
                            <option value="">{{translate('Filter Berdasarkan Status Pembayaran')}}</option>
                            <option value="paid"  @isset($payment_status) @if($payment_status == 'paid') selected @endif @endisset>{{translate('Dibayar')}}</option>
                            <option value="unpaid"  @isset($payment_status) @if($payment_status == 'unpaid') selected @endif @endisset>{{translate('Tidak Dibayar')}}</option>
                        </select>
                    </div>
                </div>
                <div class="box-inline pad-rgt pull-left">
                    <div class="select" style="min-width: 300px;">
                        <select class="form-control demo-select2" name="delivery_status" id="delivery_status" onchange="sort_orders()">
                            <option value="">{{translate('Filter Berdasarkan Status Pengiriman')}}</option>
                            <option value="pending"   @isset($delivery_status) @if($delivery_status == 'pending') selected @endif @endisset>{{translate('Pending')}}</option>
                            {{-- <option value="on_review"   @isset($delivery_status) @if($delivery_status == 'on_review') selected @endif @endisset>{{translate('On review')}}</option> --}}
                            <option value="on_delivery"   @isset($delivery_status) @if($delivery_status == 'on_delivery') selected @endif @endisset>{{translate('Dikirim')}}</option>
                            <option value="delivered"   @isset($delivery_status) @if($delivery_status == 'delivered') selected @endif @endisset>{{translate('Terkirim')}}</option>
                        </select>
                    </div>
                </div>
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Ketik Kode Pesanan') }}">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{translate('Kode Pesanan')}}</th>
                    <th>{{translate('Nomor Produk')}}</th>
                    <th>{{translate('Pelanggan')}}</th>
                    <th>{{translate('Jumlah')}}</th>
                    <th>{{translate('Status Pengiriman')}}</th>
                    <th>{{translate('Metode Pembayaran')}}</th>
                    <th>{{translate('Status Pembayaran')}}</th>
                    @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                        <th>{{translate('Pengembalian Dana')}}</th>
                    @endif
                    <th width="10%">{{translate('Opsi')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $key => $order_id)
                    @php
                        $order = \App\Order::find($order_id->id);
                    @endphp
                    @if($order != null)
                        <tr>
                            <td>
                                {{ ($key+1) + ($orders->currentPage() - 1)*$orders->perPage() }}
                            </td>
                            <td>
                                {{ $order->code }} @if($order->viewed == 0) <span class="pull-right badge badge-info">{{ translate('Baru') }}</span> @endif
                            </td>
                            <td>
                                {{ count($order->orderDetails) }}
                            </td>
                            <td>
                                @if ($order->user != null)
                                    {{ $order->user->name }}
                                @else
                                    Guest ({{ $order->guest_id }})
                                @endif
                            </td>
                            <td>
                                {{ single_price($order->grand_total) }}
                            </td>
                            <td>
                                @php
                                    $status = $order->orderDetails->first()->delivery_status;
                                @endphp
                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                            </td>
                            <td>
                                {{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}
                            </td>
                            <td>
                                    @if ($order->orderDetails->where('is_product_digital',0)->first()->payment_status == 'paid')
                                    <span style="background-color:#007944" class="badge badge--2 mr-4">
                                        <i class="bg-green">{{ translate('Dibayar') }}</i> 
                                    </span>
                                    @else
                                    <span style="background-color:#ec4646" class="badge badge--2 mr-4">
                                        <i class="bg-red">{{ translate('Belum Dibayar') }}</i>
                                    </span> 
                                    @endif
                            </td>
                            @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                                <td>
                                    @if (count($order->refund_requests) > 0)
                                        {{ count($order->refund_requests) }} {{ translate('Refund') }}
                                    @else
                                        {{ translate('Tidak Ada Pengembalian Dana') }}
                                    @endif
                                </td>
                            @endif
                            <td>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                        {{translate('Aksi')}} <i class="dropdown-caret"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="{{ route('orders.show', encrypt($order->id)) }}">{{translate('Lihat')}}</a></li>
                                        <li><a href="{{ route('seller.invoice.download', $order->id) }}">{{translate('Unduh Tagihan')}}</a></li>
                                        <li><a onclick="confirm_modal('{{route('orders.destroy', $order->id)}}');">{{translate('Hapus')}}</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $orders->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')
    <script type="text/javascript">
        function sort_orders(el){
            $('#sort_orders').submit();
        }
    </script>
@endsection
