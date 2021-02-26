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
                        <td><a onClick="modalDetailPesanan(event,{{ $refund->order->id }})">{{ $refund->order->code }}</a></td>
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
                                    <li><a onclick="confirmDana(event,{{ $refund->id }})">{{__('Kembalikan Dana Sekarang')}}</a></li>
                                    <li><a onclick="modalShowReason(event,{{ $refund->id }})">{{__('Lihat Alasan')}}</a></li>
                                    <li><a onClick="modalDetailPesanan(event,{{ $refund->order->id }})">{{__('Detail Pesanan')}}</a></li>
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
   <!-- modal -->
   <div class="modal fade" id="exampleModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div id="exampleModal-body" class="modal-body">

                                                        </div>
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end -->
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
                                               <!-- modal -->
   <div class="modal fade" id="confirmModal" tabindex="-1"
                                                aria-labelledby="confirmModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div id="confirmModal-body" class="modal-body">
                                                    </div>
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end -->
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

        
        function modalShowReason(e,id) {
        e.preventDefault();
        if (!$('#modal-size').hasClass('modal-lg')) {
            $('#modal-size').addClass('modal-lg');
        }
        $('#exampleModal-body').html(null);
        $('#exampleModal').modal();
        $('.c-preloader').show();
        
        let data = {
            _token:'{{csrf_token()}}',
            id: id
        }
       
        $.post('{{ route("reason.showReasonModal") }}', data,
            function(d) {
                $('.c-preloader').hide();
                $('#exampleModal-body').html(d);
                $('.xzoom, .xzoom-gallery').xzoom({
                    Xoffset: 20,
                    bg: true,
                    tint: '#000',
                    defaultScale: -1
                });
            });
        }
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
        function confirmDana(e,key) {
        e.preventDefault();
        if (!$('#modal-size').hasClass('modal-lg')) {
            $('#modal-size').addClass('modal-lg');
        }
        $('#confirmModal-body').html(null);
        $('#confirmModal').modal();
        $('.c-preloader').show();
        
        let data = {
            _token:'{{csrf_token()}}',
            key: key
        }
       
        $.post('{{ route("confirmDanaModal") }}', data,
            function(d) {
                $('.c-preloader').hide();
                $('#confirmModal-body').html(d);
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
