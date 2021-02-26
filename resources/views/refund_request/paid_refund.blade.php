@extends('layouts.app')

@section('content')

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{__('Refund Request All')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Id Pesanan')}}</th>
                    <th>{{__('Nama Penjual')}}</th>
                    <th>{{__('Produk')}}</th>
                    <th>{{__('Harga')}}</th>
                    <th>{{__('Persetujuan Penjual')}}</th>
                    <th>{{__('Status Pengembalian Dana')}}</th>
                    <th>{{__('Status Pengembalian Dana')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($refunds as $key => $refund)
                    <tr>
                        <td>{{ ($key+1) + ($refunds->currentPage() - 1)*$refunds->perPage() }}</td>
                        <td><a onClick="modalDetailPesanan(event,{{ $refund->order->id }})">{{ $refund->order->code }}</a></td>
                        <td>
                            @if ($refund->seller != null)
                                {{ $refund->seller->name }}
                            @endif
                        </td>
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
                            @if ($refund->seller_approval == 1)
                                <div class="label label-table label-success">
                                    {{__('Disetujui')}}
                                </div>
                            @else
                                <div class="label label-table label-warning">
                                    {{__('Tertunda')}}
                                </div>
                            @endif
                        </td>
                        <td>
                            @if ($refund->admin_approval == 1)
                                <div class="label label-table label-success">
                                    {{__('Disetujui')}}
                                </div>
                            @endif
                        </td>
                        <td>
                            @if ($refund->refund_status == 1)
                                <div class="label label-table label-success">
                                    {{__('Dibayar')}}
                                </div>
                            @else
                                <div class="label label-table label-warning">
                                    {{__('Tidak Dibayar')}}
                                </div>
                            @endif
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
                                               <!-- modal -->
                                               <div class="modal fade" id="detailModal" tabindex="-1"
                                                aria-labelledby="detailModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div id="detailModal-body" class="modal-body">

                                                        </div>
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end -->
@endsection
@section('script')
<script type="text/javascript">
function modalDetailPesanan(e,key) {
        e.preventDefault();
        if (!$('#modal-size').hasClass('modal-lg')) {
            $('#modal-size').addClass('modal-lg');
        }
        $('#detailModal-body').html(null);
        $('#detailModal').modal();
        $('.c-preloader').show();
        
        let data = {
            _token:'{{csrf_token()}}',
            key: key
        }
       
        $.post('{{ route("refund.showDetailPesanan") }}', data,
            function(d) {
                $('.c-preloader').hide();
                $('#detailModal-body').html(d);
                $('.xzoom, .xzoom-gallery').xzoom({
                    Xoffset: 20,
                    bg: true,
                    tint: '#000',
                    defaultScale: -1
                });
            });
        }
    </script>
@endsection