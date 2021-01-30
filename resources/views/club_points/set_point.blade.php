@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-7">
            <div class="panel">
                <div class="panel-body">
                    <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th width="40%">{{__('Nama')}}</th>
                                {{-- <th>{{__('Pemilik Produk')}}</th> --}}
                                {{-- <th>{{__('Jumlah Penjualan')}}</th>
                                <th>{{__('Harga Dasar')}}</th>--}}
                                <th>{{__('Harga')}}</th> 
                                <th>{{__('Poin')}}</th>
                                <th>{{__('aksi')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $num = 0
                                
                            @endphp
                            @foreach($products as $key => $p)
                            @php
                            $photo = $p->thumbnail_img != null ? $p->thumbnail_img : json_decode($p->photos)[0];
                        @endphp
                                <tr>
                                    <td>{{ $num++ }}</td>
                                    <td>
                                        <a href="{{ route('product', $p->slug) }}" target="_blank" class="media-block">
                                            <div class="media-left">
                                            <img loading="lazy"  class="img-md" src="{{ my_asset($photo)}}" alt="Image">
                                            </div>
                                            <div class="media-body">{{ __($p->name) }}</div>
                                        </a>
                                    </td> 
                                    {{-- <td>
                                    @if ($product->user != null)
                                        {{ $product->user->name }}
                                    @endif
                                    </td> --}}
                                    {{-- <td>
                                        @php
                                            $qty = 0;
                                            if($product->variant_product){
                                                foreach ($product->stocks as $key => $stock) {
                                                    $qty += $stock->qty;
                                                }
                                            }
                                            else{
                                                $qty = $product->current_stock;
                                            }
                                            echo $qty;
                                        @endphp
                                    </td> --}}
                                    {{-- <td>{{ number_format($product->unit_price,2) }}</td> --}}
                                    {{-- <td>{{ $product->rating }}</td>
                                    <td>{{ $product->earn_point }}</td> --}}
                                    <td>Rp. {{ number_format($p->unit_price) }}</td>
                                    <td>{{ $p->earn_point }}</td>
                                    <td>
                                        <div class="btn-group dropdown">
                                            <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                                {{__('Aksi')}} <i class="dropdown-caret"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="{{route('product_club_point.edit', encrypt($p->id))}}">{{__('Ubah')}}</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="clearfix">
                        <div class="pull-right">
                            {{ $products->appends(request()->input())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            @include('club_points.inc.form-set-point')
        </div>
    </div>


@endsection
