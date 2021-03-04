@extends('layouts.app')

@section('content')
@if(env('MAIL_USERNAME') == null && env('MAIL_PASSWORD') == null)
    <div class="row">
        <div class="col-sm-12">
            <div class="bg-danger pad-all text-center mar-btm">
                <h4 class="text-light mar-btm">{{translate('Please Configure SMTP Setting to work all email sending funtionality')}}.</h4>
                <a class="btn btn-info btn-rounded" href="{{ route('smtp_settings.index') }}">Configure Now</a>
            </div>

            
        </div>
    </div>
@endif
@if(Auth::user()->user_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions)))
<div class="row">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-body text-center dash-widget dash-widget-left">
                <div class="dash-widget-vertical">
                    <div class="rorate">{{translate('PRODUK')}}</div>
                </div>
                <div class="pad-ver mar-top text-main">
                    <i class="demo-pli-data-settings icon-4x"></i>
                </div>
                <br>
                <p class="text-lg text-main">{{translate('Total Produk yang ditampilkan')}}: <span class="text-bold">{{ \App\Product::where('published', 1)->get()->count() }}</span></p>
                <!-- @if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                    <p class="text-lg text-main">{{translate('Total products')}}: <span class="text-bold">{{ \App\Product::where('published', 1)->where('added_by', 'seller')->get()->count() }}</span></p>
                @endif -->
                <p class="text-lg text-main">{{translate('Total Produk yang di masukkan')}}: <span class="text-bold">{{ \App\Product::where('published', 1)->where('added_by', 'admin')->get()->count() }}</span></p>
                <br>
                <a href="{{ route('products.admin') }}" class="btn btn-primary mar-top">{{ translate('Atur Produk') }} <i class="fa fa-long-arrow-right"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-sm-6">
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main">{{translate('Total Kategori Produk')}}</p>
                        <p class="text-semibold text-3x text-main">{{ \App\Category::all()->count() }}</p>
                        <a href="{{ route('categories.create') }}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Tambah Kategori')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
            <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main">{{translate('Log Admin')}}</p>
                        <p class="text-semibold text-3x text-main">{{ \App\Admin_log::all()->count() }}</p>
                        <a href="{{ route('log.index') }}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Lihat')}}</a>
                    </div>
                </div>
                <!-- <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main">{{translate('Total Produk Brand')}}</p>
                        <p class="text-semibold text-3x text-main">{{ \App\Brand::all()->count() }}</p>
                        <a href="{{ route('brands.create') }}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Tambah Brand')}}</a>
                    </div>
                </div>  -->
                <!--<div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main">{{translate('Total product sub category')}}</p>
                        <p class="text-semibold text-3x text-main">{{ \App\SubCategory::all()->count() }}</p>
                        <a href="{{ route('subcategories.create') }}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Create Sub Category')}}</a>
                    </div>
                </div>
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-normal text-main">{{translate('Total product sub sub category')}}</p>
                        <p class="text-semibold text-3x text-main">{{ \App\SubSubCategory::all()->count() }}</p>
                        <a href="{{ route('subsubcategories.create') }}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Create Sub Sub Category')}}</a>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>
@endif

<!-- @if((Auth::user()->user_type == 'admin' || in_array('5', json_decode(Auth::user()->staff->role->permissions))) && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
    <div class="row">
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center dash-widget dash-widget-left">
                <div class="dash-widget-vertical">
                    <div class="rorate">{{translate('SELLERS')}}</div>
                </div>
                <br>
                <p class="text-normal text-main">{{translate('Total')}}</p>
                <p class="text-semibold text-3x text-main">{{ \App\Seller::all()->count() }}</p>
                <br>
                <a href="{{ route('sellers.index') }}" class="btn-link">{{translate('Manage Sellers')}} <i class="fa fa-long-arrow-right"></i></a>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center dash-widget">
                <br>
                <p class="text-normal text-main">{{translate('Total approved sellers')}}</p>
                <p class="text-semibold text-3x text-main">{{ \App\Seller::where('verification_status', 1)->get()->count() }}</p>
                <br>
                <a href="{{ route('sellers.index') }}" class="btn-link">{{translate('Manage Sellers')}} <i class="fa fa-long-arrow-right"></i></a>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body text-center dash-widget">
                <br>
                <p class="text-normal text-main">{{translate('Total pending sellers')}}</p>
                <p class="text-semibold text-3x text-main">{{ \App\Seller::where('verification_status', 0)->count() }}</p>
                <br>
                <a href="{{ route('sellers.index') }}" class="btn-link">{{translate('Manage Sellers')}} <i class="fa fa-long-arrow-right"></i></a>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>
@endif -->

@if(Auth::user()->user_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions)))
<div class="row"></div>
<div class="col-md-6">
        <div class="panel">
            <!--Panel heading-->
            <div class="panel-heading" style="display: flex;justify-content: space-between;">
                <h3 class="panel-title">{{translate('Penjualan Produk')}}</h3>
                <a href="{{ route('in_house_sale_report.index') }}" class="btn btn-primary" style="max-height: 35px;margin-top:5px;margin-right:20px">{{ translate('Selengkapnya') }} <i class="fa fa-long-arrow-right"></i></a>

            </div>

            <!--Panel body-->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped mar-no">
                        <thead>
                            <tr>
                                <th>{{translate('Nama Produk')}}</th>
                                <th>{{translate('Terjual')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (\App\Product::where('published','1')->orderBy('num_of_sale','desc')->get() as $key => $productDetail)
                                <tr>
                                    <td>{{ __($productDetail->name) }}</td>
                                    <td>{{$productDetail->num_of_sale}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel">
            <!--Panel heading-->
            <div class="panel-heading" style="display: flex;justify-content: space-between;">
                <h3 class="panel-title">{{translate('Stok Produk')}}</h3>
                <a href="{{ route('stock_report.index') }}"class="btn btn-primary" style="max-height: 35px;margin-top:5px;margin-right:20px">{{ translate('Selengkapnya') }} <i class="fa fa-long-arrow-right"></i></a>


            </div>

            <!--Panel body-->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped mar-no">
                        <thead>
                            <tr>
                                <th>{{translate('Nama Produk')}}</th>
                                <th>{{translate('Stok')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (\App\Product::where('published','1')->orderBy('current_stock','desc')->get() as $key => $category)
                                @php
                                    $products = \App\Product::where('id', $category->id)->get();
                                    $qty = 0;
                                    foreach ($products as $key => $product) {
                                        if ($product->variant_product) {
                                            foreach ($product->stocks as $key => $stock) {
                                                $qty += $stock->qty;
                                            }
                                        }
                                        else {
                                            $qty = $product->current_stock;
                                        }
                                       
                                    }
                                @endphp
                                <tr>
                                    <td>{{ __($category->name) }}</td>
                                    <td>{{ $qty }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endif

@if(Auth::user()->user_type == 'admin' || in_array('9', json_decode(Auth::user()->staff->role->permissions)))
<div class="row">
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-body text-center dash-widget pad-no">
                <div class="pad-ver mar-top text-main">
                    <i class="demo-pli-data-settings icon-4x"></i>
                </div>
                <br>
                <p class="text-3x text-main bg-primary pad-ver">{{translate('Pengaturan')}} <strong>{{translate('Tampilan')}}</strong></p>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-sm-6">
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-semibold text-lg text-main mar-ver">
                            {{translate('Pengaturan')}} <br>
                            {{translate('Halaman')}}
                        </p>
                        <br>
                        <a href="{{ route('home_settings.index') }}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Klik Disini')}}</a>
                    </div>
                </div>
                <!-- <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-semibold text-lg text-main mar-ver">
                            {{translate('Policy page')}} <br>
                            {{translate('setting')}}
                        </p>
                        <br>
                        <a href="{{route('privacypolicy.index', 'privacy_policy')}}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Klik Disini')}}</a>
                    </div>
                </div> -->
            </div>
            <div class="col-sm-6">
                <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-semibold text-lg text-main mar-ver">
                            {{translate('Pengaturan')}} <br>
                            {{translate('Umum')}}
                        </p>
                        <br>
                        <a href="{{route('generalsettings.index')}}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Klik Disini')}}</a>
                    </div>
                </div>
                <!-- <div class="panel">
                    <div class="pad-top text-center dash-widget">
                        <p class="text-semibold text-lg text-main mar-ver">
                            {{translate('Useful link')}} <br>
                            {{translate('setting')}}
                        </p>
                        <br>
                        <a href="{{route('links.index')}}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Klik Disini')}}</a>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
@endif

@if(Auth::user()->user_type == 'admin' || in_array('8', json_decode(Auth::user()->staff->role->permissions)))
    <div class="flex-row">
    <div class="flex-col-xl flex-col-lg-6 flex-col-12">
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    {{translate('Pengaturan')}} <br>
                    {{translate('Aktivasi')}}
                </p>
                <br>
                <a href="{{route('activation.index')}}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Klik Disini')}}</a>
            </div>
        </div>
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    {{translate('Pengaturan')}} <br>
                    {{translate('SMTP')}}
                </p>
                <br>
                <a href="{{ route('smtp_settings.index') }}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Klik Disini')}}</a>
            </div>
        </div>
    </div>
    <div class="flex-col-xl flex-col-lg-6 flex-col-12">
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    {{translate('Pengaturan')}} <br>
                    {{translate('Metode Pembayaran')}}
                </p>
                <br>
                <a href="{{ route('payment_method.index') }}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Klik Disini')}}</a>
            </div>
        </div>
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    {{translate('Pengaturan')}} <br>
                    {{translate('Sosial Media')}}
                </p>
                <br>
                <a href="{{ route('social_login.index') }}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Klik Disini')}}</a>
            </div>
        </div>
    </div>
    <div class="flex-col-xl flex-col-lg-12 flex-col-12">
        <div class="panel">
            <div class="panel-body text-center dash-widget bg-primary">
                <br>
                <br>
                <i class="demo-pli-gear icon-5x"></i>
                <br>
                <br>
                <br>
                <br>
                <p class="text-semibold text-2x text-light mar-ver">
                    {{translate('Pengaturan')}} <br>
                    {{translate('Bisnis')}}
                </p>
                <br>
                <br>
            </div>
        </div>
    </div>
    <div class="flex-col-xl flex-col-lg-6 flex-col-12">
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    {{translate('Pengaturan')}} <br>
                    {{translate('Mata Uang')}}
                </p>
                <br>
                <a href="{{route('currency.index')}}" class="btn btn-primary mar-top btn-block top-border-radius-no ">{{translate('Klik Disini')}}</a>
            </div>
        </div>
        <!-- <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    {{translate('Seller verification')}} <br>
                    {{translate('form setting')}}
                </p>
                <br>
                <a href="{{route('seller_verification_form.index')}}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Klik Disini')}}</a>
            </div>
        </div> -->
    </div>
    <div class="flex-col-xl flex-col-lg-6 flex-col-12">
        <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    {{translate('Pengaturan')}} <br>
                    {{translate('Bahasa')}}
                </p>
                <br>
                <a href="{{route('languages.index')}}" class="btn btn-primary mar-top btn-block top-border-radius-no">{{translate('Klik Disini')}}</a>
            </div>
        </div>
        <!-- <div class="panel">
            <div class="pad-top text-center dash-widget">
                <p class="text-semibold text-lg text-main mar-ver">
                    {{translate('Seller commission')}} <br>
                    {{translate('setting')}}
                </p>
                <br>
                <a href="{{ route('business_settings.vendor_commission') }}" class="btn btn-primary mar-top btn-block">{{translate('Klik Disini')}}</a>
            </div>
        </div> -->
    </div>
</div>
@endif

@endsection
