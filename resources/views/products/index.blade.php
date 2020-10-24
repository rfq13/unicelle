@extends('layouts.app')

@section('content')

@if($type != 'Seller')
    <div class="row">
        <div class="col-lg-12 pull-right">
            <a href="{{ route('products.create')}}" class="btn btn-rounded btn-info pull-right">{{translate('Tambah Produk Baru')}}</a>
        </div>
    </div>
@endif

<br>

<div class="panel">
    <!--Panel heading-->
    <div class="panel-heading bord-btm clearfix pad-all h-100">
        <h3 class="panel-title pull-left pad-no">{{ translate($type.' Produk') }}</h3>
        <div class="pull-right clearfix">
            <form class="" id="sort_products" action="" method="GET">
                @if($type == 'Seller')
                    <div class="box-inline pad-rgt pull-left">
                        <div class="select" style="min-width: 200px;">
                            <select class="form-control demo-select2" id="user_id" name="user_id" onchange="sort_products()">
                                <option value="">All Sellers</option>
                                @foreach (App\Seller::all() as $key => $seller)
                                    @if ($seller->user != null && $seller->user->shop != null)
                                        <option value="{{ $seller->user->id }}" @if ($seller->user->id == $seller_id) selected @endif>{{ $seller->user->shop->name }} ({{ $seller->user->name }})</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif
                <div class="box-inline pad-rgt pull-left">
                    <div class="select" style="min-width: 200px;">
                        <select class="form-control demo-select2" name="type" id="type" onchange="sort_products()">
                            <option value="">Tampilkan Berdasarkan</option>
                            <option value="rating,desc" @isset($col_name , $query) @if($col_name == 'rating' && $query == 'desc') selected @endif @endisset>{{translate('Rating (Tinggi > Rendah)')}}</option>
                            <option value="rating,asc" @isset($col_name , $query) @if($col_name == 'rating' && $query == 'asc') selected @endif @endisset>{{translate('Rating (Rendah > Tinggi)')}}</option>
                            <option value="num_of_sale,desc"@isset($col_name , $query) @if($col_name == 'num_of_sale' && $query == 'desc') selected @endif @endisset>{{translate('Num of Sale (Tinggi > Rendah)')}}</option>
                            <option value="num_of_sale,asc"@isset($col_name , $query) @if($col_name == 'num_of_sale' && $query == 'asc') selected @endif @endisset>{{translate('Num of Sale (Rendah > Tinggi)')}}</option>
                            <option value="unit_price,desc"@isset($col_name , $query) @if($col_name == 'unit_price' && $query == 'desc') selected @endif @endisset>{{translate('Base Price (Tinggi > Rendah)')}}</option>
                            <option value="unit_price,asc"@isset($col_name , $query) @if($col_name == 'unit_price' && $query == 'asc') selected @endif @endisset>{{translate('Base Price (Rendah > Tinggi)')}}</option>
                        </select>
                    </div>
                </div>
                <div class="box-inline pad-rgt pull-left">
                    <div class="" style="min-width: 200px;">
                        <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Ketik Nama Produk') }}">
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
                    <th width="20%">{{translate('Nama')}}</th>
                    @if($type == 'Seller')
                        <th>{{translate('Nama Penjual')}}</th>
                    @endif
                    <th>{{translate('Jumlah Penjualan')}}</th>
                    <th>{{translate('Total Stok')}}</th>
                    <th>{{translate('Harga Reguler Physician')}}</th>
                    <th>{{translate('Harga Partner Physician')}}</th>
                    <th>{{translate('Harga Pasien Reguler ')}}</th>
                    {{--<th>{{translate('Deal Hari ini')}}</th>--}}
                    {{--<th>{{translate('Peringkat')}}</th>--}}
                    {{--<th>{{translate('Published')}}</th>--}}
                    <th>{{translate('Tampilkan')}}</th>
                    <th>{{translate('Opsi')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $key => $product)
                    <tr>
                        <td>{{ ($key+1) + ($products->currentPage() - 1)*$products->perPage() }}</td>
                        <td>
                        @php
                            $photo = $product->thumbnail_img != null ? $product->thumbnail_img : json_decode($product->photos)[0];
                        @endphp

                            <a href="{{ route('product', $product->slug) }}" target="_blank" class="media-block">
                                <div class="media-left">
                                    <img loading="lazy"  class="img-md" src="{{ my_asset($photo)}}" alt="Image">
                                </div>
                                <div class="media-body">{{ __($product->name) }}</div>
                            </a>
                        </td>
                        @if($type == 'Seller')
                            <td>{{ $product->user->name }}</td>
                        @endif
                        <td>{{ $product->num_of_sale }} {{translate('times')}}</td>
                        <td>
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
                        </td>
                        <td>{{ number_format($product->regular_physician_price,2) }}</td>
                        <td>{{ number_format($product->partner_physician_price,2) }}</td>
                        <td>{{ number_format($product->pasien_regular_price,2) }}</td>
                        {{--
                        <td><label class="switch">
                                <input onchange="update_todays_deal(this)" value="{{ $product->id }}" type="checkbox" @if if($product->todays_deal == 1) {{"checked"}}@endif >
                                <span class="slider round"></span></label> 
                        </td>
                        
                        <td>{{ $product->rating }}</td>
                        <td><label class="switch">
                                <input onchange="update_featured(this)" value="{{ $product->id }}" type="checkbox" @if($product->featured == 1) {{ "checked" }}@endif >
                                <span class="slider round"></span></label></td>--}}
                        <td><label class="switch">
                            <input onchange="update_published(this)" value="{{ $product->id }}" type="checkbox" @if($product->published == 1) {{"checked"}}@endif >
                            <span class="slider round"></span></label></td>
                        <td>
                            <div class="btn-group dropdown">
                                <button class="btn btn-primary dropdown-toggle dropdown-toggle-icon" data-toggle="dropdown" type="button">
                                    {{translate('Aksi')}} <i class="dropdown-caret"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    @if ($type == 'Seller')
                                        <li><a href="{{route('products.seller.edit', encrypt($product->id))}}">{{translate('Edit')}}</a></li>
                                    @else
                                        <li><a href="{{route('products.admin.edit', encrypt($product->id))}}">{{translate('Edit')}}</a></li>
                                    @endif
                                    <li><a onclick="confirm_modal('{{route('products.destroy', $product->id)}}');">{{translate('Hapus')}}</a></li>
                                    <li><a href="{{route('products.duplicate', $product->id)}}">{{translate('Duplikat')}}</a></li>
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

@endsection


@section('script')
    <script type="text/javascript">

        $(document).ready(function(){
            //$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
        });

        function update_todays_deal(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.todays_deal') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Todays Deal updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        function update_published(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.published') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Published products updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        function update_featured(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('products.featured') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    showAlert('success', 'Featured products updated successfully');
                }
                else{
                    showAlert('danger', 'Something went wrong');
                }
            });
        }

        function sort_products(el){
            $('#sort_products').submit();
        }

    </script>
@endsection
