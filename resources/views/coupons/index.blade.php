@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <a href="{{ route('coupon.create')}}" class="btn btn-rounded btn-info pull-right">{{translate('Tambah Kupon Baru')}}</a>
        </div>
    </div><br>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">{{translate('Informasi Kupon')}}</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{translate('Kode')}}</th>
                        <th>{{translate('Tipe')}}</th>
                        <th>{{translate('Mulai Tanggal')}}</th>
                        <th>{{translate('Selesai Tanggal')}}</th>
                        <th width="10%">{{translate('Pilihan')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coupons as $key => $coupon)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$coupon->code}}</td>
                            <td>@if ($coupon->type == 'cart_base')
                                    {{ translate('Basis Keranjang') }}
                                @elseif ($coupon->type == 'product_base')
                                    {{ translate('Basis Produk') }}
                            @endif</td>
                            <td>{{ date('d-m-Y', $coupon->start_date) }}</td>
                            <td>{{ date('d-m-Y', $coupon->end_date) }}</td>
                            <td>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                        {{translate('Aksi')}} <i class="dropdown-caret"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="{{route('coupon.edit', encrypt($coupon->id))}}">{{translate('Ubah')}}</a></li>
                                        <li><a onclick="confirm_modal('{{route('coupon.destroy', $coupon->id)}}');">{{translate('Hapus')}}</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
