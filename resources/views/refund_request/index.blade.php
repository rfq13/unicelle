@extends('layouts.app')

@section('content')

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('Semua Permintaan Pengembalian Dana')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Id Pesanan')}}</th>
                    {{-- <th>{{__('Nama Penjual')}}</th> --}}
                    <th>{{__('Produk')}}</th>
                    <th>{{__('Harga')}}</th>
                    {{-- <th>{{__('Persetujuan Penjual')}}</th> --}}
                    <th>{{__('Status Pengembalian Dana')}}</th>
                    <th width="10%">{{__('Opsi')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($refunds as $key => $refund)
                    <tr>
                        <td>{{ ($key+1) + ($refunds->currentPage() - 1)*$refunds->perPage() }}</td>
                        <td>{{ $refund->order->code }}</td>
                        {{-- <td>
                            @if ($refund->seller != null)
                                {{ $refund->seller->name }}
                            @endif
                        </td> --}}
                        <td>
                            @if ($refund->orderDetail != null && $refund->orderDetail->product != null)
                                <a href="{{ route('product', $refund->orderDetail->product->slug) }}" target="_blank" class="media-block">
                                    <div class="media-left">
                                        <img loading="lazy"  class="img-md" src="{{ my_asset($refund->orderDetail->product->thumbnail_img)}}" alt="Image">
                                    </div>
                                    <div class="media-body">{{ __($refund->orderDetail->product->name) }}</div>
                                </a>
                            @endif
                        </td>
                        <td>
                            @if ($refund->orderDetail != null)
                                {{single_price($refund->orderDetail->price)}}
                            @endif
                        </td>
                        <td>
                            @if ($refund->orderDetail->product != null && $refund->orderDetail->product->added_by == 'admin')
                                <div class="label label-mint">
                                    {{__('Produk Sendiri')}}
                                </div>
                            {{-- @else
                                @if ($refund->seller_approval == 1)
                                    <div class="label label-info">
                                        {{__('Di setujui')}}
                                    </div>
                                @else
                                    <div class="label label-warning">
                                        {{__('Tertunda')}}
                                    </div>
                                @endif --}}
                            @endif
                        </td>
                        <td>
                            @if ($refund->refund_status == 1)
                                <div class="label label-secondary">
                                    {{__('Dibayar')}}
                                </div>
                            @else
                                <div class="label label-warning">
                                    {{__('Tidak Dibayar')}}
                                </div>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{__('Aksi')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a onclick="refund_request_money('{{ $refund->id }}')">{{__('Kembalikan Dana Sekarang')}}</a></li>
                                    <li><a href="{{ route('reason_show', $refund->id) }}" target="_blank">{{__('Lihat Alasan')}}</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix">
            <div class="pull-right">
                {{ $refunds->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script type="text/javascript">
        function update_refund_approval(el){
            $.post('{{ route('vendor_refund_approval') }}',{_token:'{{ @csrf_token() }}', el:el}, function(data){
                if (data == 1) {
                    showAlert('success', 'Persetujuan berhasil dilakukan');
                }
                else {
                    showAlert('danger', 'Ada yang salah');
                }
            });
        }

        function refund_request_money(el){
            $.post('{{ route('refund_request_money_by_admin') }}',{_token:'{{ @csrf_token() }}', el:el}, function(data){
                if (data == 1) {
                    location.reload();
                    showAlert('success', 'Pengembalian dana telah berhasil dikirim');
                }
                else {
                    showAlert('danger', 'Ada yang salah');
                }
            });
        }
    </script>
@endsection
