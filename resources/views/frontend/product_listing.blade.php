@extends('frontend.layouts.app')
@if(isset($subsubcategory_id))
@php
        $meta_title = \App\SubSubCategory::find($subsubcategory_id)->meta_title;
        $meta_description = \App\SubSubCategory::find($subsubcategory_id)->meta_description;
        @endphp
@elseif (isset($subcategory_id))
@php
        $meta_title = \App\SubCategory::find($subcategory_id)->meta_title;
        $meta_description = \App\SubCategory::find($subcategory_id)->meta_description;
        @endphp
@elseif (isset($category_id))
@php
        $meta_title = \App\Category::find($category_id)->meta_title;
        $meta_description = \App\Category::find($category_id)->meta_description;
        @endphp
@elseif (isset($brand_id))
@php
        $meta_title = \App\Brand::find($brand_id)->meta_title;
        $meta_description = \App\Brand::find($brand_id)->meta_description;
        @endphp
@else
        @php
        $meta_title = env('APP_NAME');
        $meta_description = \App\SeoSetting::first()->description;
        @endphp
@endif
@section('title',"Produk")

@section('meta_title'){{ $meta_title }}@stop
@section('meta_description'){{ $meta_description }}@stop

@section('meta')
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ $meta_title }}">
    <meta itemprop="description" content="{{ $meta_description }}">

    <!-- Twitter Card data -->
    <meta name="twitter:title" content="{{ $meta_title }}">
    <meta name="twitter:description" content="{{ $meta_description }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ $meta_title }}" />
    <meta property="og:description" content="{{ $meta_description }}" />
@endsection

@section('content')
{{-- <section class="section-sub-head"></section>
<section class="section-detail-produk">
        <div class="container">
            <div class="container mb-5">
                <ul class="breadcrumb">
                    <li><a href="{{ route('home') }}">{{ translate('Home')}}</a></li>
                    <li><a href="{{ route('products') }}">{{ translate('All Categories')}}</a></li>
                    @if(isset($category_id))
                        <li class="active"><a href="{{ route('products.category', \App\Category::find($category_id)->slug) }}">{{ \App\Category::find($category_id)->name }}</a></li>
                    @endif
                    @if(isset($subcategory_id))
                        <li ><a href="{{ route('products.category', \App\SubCategory::find($subcategory_id)->category->slug) }}">{{ \App\SubCategory::find($subcategory_id)->category->name }}</a></li>
                        <li class="active"><a href="{{ route('products.subcategory', \App\SubCategory::find($subcategory_id)->slug) }}">{{ \App\SubCategory::find($subcategory_id)->name }}</a></li>
                    @endif
                    @if(isset($subsubcategory_id))
                        <li ><a href="{{ route('products.category', \App\SubSubCategory::find($subsubcategory_id)->subcategory->category->slug) }}">{{ \App\SubSubCategory::find($subsubcategory_id)->subcategory->category->name }}</a></li>
                        <li ><a href="{{ route('products.subcategory', \App\SubsubCategory::find($subsubcategory_id)->subcategory->slug) }}">{{ \App\SubsubCategory::find($subsubcategory_id)->subcategory->name }}</a></li>
                        <li class="active"><a href="{{ route('products.subsubcategory', \App\SubSubCategory::find($subsubcategory_id)->slug) }}">{{ \App\SubSubCategory::find($subsubcategory_id)->name }}</a></li>
                    @endif
                </ul>
                <div class="container ml-3">
                    <div class="row">
                        <p class="text-hasilpencarian mt-3">Hasil Pencarian :</p>
                        <ul>
                            @if(isset($category_id))
                                <p class="text-hasil mt-3 active"><a href="{{ route('products.category', \App\Category::find($category_id)->slug) }}">{{ \App\Category::find($category_id)->name }}</a></p>
                            @endif
                            @if(isset($subcategory_id))
                                <li ><a href="{{ route('products.category', \App\SubCategory::find($subcategory_id)->category->slug) }}">{{ \App\SubCategory::find($subcategory_id)->category->name }}</a></li>
                                <li class="active"><a href="{{ route('products.subcategory', \App\SubCategory::find($subcategory_id)->slug) }}">{{ \App\SubCategory::find($subcategory_id)->name }}</a></li>
                            @endif
                            @if(isset($subsubcategory_id))
                                <li ><a href="{{ route('products.category', \App\SubSubCategory::find($subsubcategory_id)->subcategory->category->slug) }}">{{ \App\SubSubCategory::find($subsubcategory_id)->subcategory->category->name }}</a></li>
                                <li ><a href="{{ route('products.subcategory', \App\SubsubCategory::find($subsubcategory_id)->subcategory->slug) }}">{{ \App\SubsubCategory::find($subsubcategory_id)->subcategory->name }}</a></li>
                                <li class="active"><a href="{{ route('products.subsubcategory', \App\SubSubCategory::find($subsubcategory_id)->slug) }}">{{ \App\SubSubCategory::find($subsubcategory_id)->name }}</a></li>
                            @endif
                        </ul>
                        <div class="row col ridge ml-5">
                            <p class="text-urutkan mt-4 ml-3">Urutkan</p>
                            <a class="col-3 btn btn-urutkan ml-3 mt-3 mb-3" href="">Terlaris</a>
                            <a class="col-3 btn btn-urutkan mt-3 mb-3"href="">Harga Tertinggi</a>
                            <a class="col-3 btn btn-urutkan-active mt-3 mb-3" @isset($sort_by) @if ($sort_by == '3') selected @endif @endisset href="#">Harga Terendah</a>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="col mt-3 ml-3">
                <p>2 Search Result for "Imboost"</p>
                <hr style="width:100%;text-align:left;margin-left:0">
                <div class="mb-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="card text-center" >
                                    <div class="card-body">
                                        <img src="{{my_asset('/images/icon/obat.png')}}" style="width:100%" class="card-img-top mb-2 " alt="...">
                                    </div>
                                    <p class="text-sm-center">PERMEN TOLAK ANGIN LONZENGES SACHET</p>
                                    <p class="font-weight-bold" style="color:red" size="10px">Rp. 1.500- Rp. 8.900</p>
                                    <a href="#" class="btn btn-card-obat">Tambah</a>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="card text-center" >
                                    <div class="card-body">
                                        <img src="{{my_asset('/images/icon/obat.png')}}" style="width:100%" class="card-img-top mb-2 " alt="...">
                                    </div>
                                    <p class="text-sm-center">PERMEN TOLAK ANGIN LONZENGES SACHET</p>
                                    <p class="font-weight-bold" style="color:red; text-align: center;">Rp. 1.500- Rp. 8.900</p>
                                    <a href="#" class="btn btn-card-obat">Tambah</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section> --}}


<!--X END X-->

    <div class="breadcrumb-area" style="background-color: white;border:none; min-height: 10vh">
        <div class="container ">
            <div class="row-card">
                <div class="col">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('home') }}">{{ translate('Home')}}</a></li>
                        <li><a href="{{ route('products') }}">{{ translate('All Categories')}}</a></li>
                        @if(isset($category_id))
                            <li class="active"><a href="{{ route('products.category', \App\Category::find($category_id)->slug) }}">{{ \App\Category::find($category_id)->name }}</a></li>
                        @endif
                        @if(isset($subcategory_id))
                            <li ><a href="{{ route('products.category', \App\SubCategory::find($subcategory_id)->category->slug) }}">{{ \App\SubCategory::find($subcategory_id)->category->name }}</a></li>
                            <li class="active"><a href="{{ route('products.subcategory', \App\SubCategory::find($subcategory_id)->slug) }}">{{ \App\SubCategory::find($subcategory_id)->name }}</a></li>
                        @endif
                        @if(isset($subsubcategory_id))
                            <li ><a href="{{ route('products.category', \App\SubSubCategory::find($subsubcategory_id)->subcategory->category->slug) }}">{{ \App\SubSubCategory::find($subsubcategory_id)->subcategory->category->name }}</a></li>
                            <li ><a href="{{ route('products.subcategory', \App\SubsubCategory::find($subsubcategory_id)->subcategory->slug) }}">{{ \App\SubsubCategory::find($subsubcategory_id)->subcategory->name }}</a></li>
                            <li class="active"><a href="{{ route('products.subsubcategory', \App\SubSubCategory::find($subsubcategory_id)->slug) }}">{{ \App\SubSubCategory::find($subsubcategory_id)->name }}</a></li>
                        @endif
                    </ul>
                    <div class="container ml-3">
                        <div class="row-card">
                            <p class="text-hasilpencarian mt-3">{{ isset($query) && $query != "" ? "Hasil Pencarian : ''$query''" : ""}}</p>
                            <ul>
                                @if(isset($category_id))
                                    <p class="text-hasil mt-3 active"><a href="{{ route('products.category', \App\Category::find($category_id)->slug) }}">{{ \App\Category::find($category_id)->name }}</a></p>
                                @endif
                                @if(isset($subcategory_id))
                                    <li ><a href="{{ route('products.category', \App\SubCategory::find($subcategory_id)->category->slug) }}">{{ \App\SubCategory::find($subcategory_id)->category->name }}</a></li>
                                    <li class="active"><a href="{{ route('products.subcategory', \App\SubCategory::find($subcategory_id)->slug) }}">{{ \App\SubCategory::find($subcategory_id)->name }}</a></li>
                                @endif
                                @if(isset($subsubcategory_id))
                                    <li ><a href="{{ route('products.category', \App\SubSubCategory::find($subsubcategory_id)->subcategory->category->slug) }}">{{ \App\SubSubCategory::find($subsubcategory_id)->subcategory->category->name }}</a></li>
                                    <li ><a href="{{ route('products.subcategory', \App\SubsubCategory::find($subsubcategory_id)->subcategory->slug) }}">{{ \App\SubsubCategory::find($subsubcategory_id)->subcategory->name }}</a></li>
                                    <li class="active"><a href="{{ route('products.subsubcategory', \App\SubSubCategory::find($subsubcategory_id)->slug) }}">{{ \App\SubSubCategory::find($subsubcategory_id)->name }}</a></li>
                                @endif
                            </ul>
                            <div class="row col ridge ml-5 mt-3">
                            <div>
                                <p class="text-urutkan mt-4 ml-3">Urutkan</p>
                            </div>
                            <div style="width:90%">
                                <a class="col-3 btn {{ isset($sort_by) && $sort_by == '5' ? 'btn-urutkan-active' : 'btn-urutkan' }} mt-3 mb-3 mt-3 mb-3" id="btn-urutkan" href="#" onclick="select(5)">Terlaris</a>
                                <a class="col-3 btn {{ isset($sort_by) && $sort_by == '4' ? 'btn-urutkan-active' : 'btn-urutkan' }} mt-3 mb-3 mt-3 mb-3 "id="btn-urutkan" href="#" onclick="select(4)">Harga Tertinggi</a>
                                <a class="col-3 btn {{ isset($sort_by) && $sort_by == '3' ? 'btn-urutkan-active' : 'btn-urutkan' }} mt-3 mb-3" id="btn-urutkan" href="#" onclick="select(3)">Harga Terendah</a>
                            
                            </div>
                        </div>
                        <p>{{ isset($query) && $query != "" ? $products->total()." Search Result for ''$query''" : ""}}</p>
                        <hr style="width:100%;text-align:left;margin-left:0">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="py-4">
        <div class="container sm-px-0">
            <form class="" id="search-form" action="{{ route('search') }}" method="GET">
                <div class="row">
                {{--
                    <div class="col-xl-3 side-filter d-xl-block">
                        <div class="filter-overlay filter-close"></div>
                        <div class="filter-wrapper c-scrollbar">
                            <div class="filter-title d-flex d-xl-none justify-content-between pb-3 align-items-center">
                                <h3 class="h6">Filters</h3>
                                <button type="button" class="close filter-close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            
                                <div class="bg-white sidebar-box mb-3">
                                    <div class="box-title text-center">
                                        {{ translate('Categories')}}
                                    </div>
                                    <div class="box-content">
                                        <div class="category-filter">
                                            <ul>
                                                @if(!isset($category_id) && !isset($category_id) && !isset($subcategory_id) && !isset($subsubcategory_id))
                                                    @foreach(\App\Category::all() as $category)
                                                        <li class=""><a href="{{ route('products.category', $category->slug) }}">{{  __($category->name) }}</a></li>
                                                    @endforeach
                                                @endif
                                                @if(isset($category_id))
                                                    <li class="active"><a href="{{ route('products') }}">{{ translate('All Categories')}}</a></li>
                                                    <li class="active"><a href="{{ route('products.category', \App\Category::find($category_id)->slug) }}">{{  translate(\App\Category::find($category_id)->name) }}</a></li>
                                                    @foreach (\App\Category::find($category_id)->subcategories as $key2 => $subcategory)
                                                        <li class="child"><a href="{{ route('products.subcategory', $subcategory->slug) }}">{{  __($subcategory->name) }}</a></li>
                                                    @endforeach
                                                @endif
                                                @if(isset($subcategory_id))
                                                    <li class="active"><a href="{{ route('products') }}">{{ translate('All Categories')}}</a></li>
                                                    <li class="active"><a href="{{ route('products.category', \App\SubCategory::find($subcategory_id)->category->slug) }}">{{  translate(\App\SubCategory::find($subcategory_id)->category->name) }}</a></li>
                                                    <li class="active"><a href="{{ route('products.subcategory', \App\SubCategory::find($subcategory_id)->slug) }}">{{  translate(\App\SubCategory::find($subcategory_id)->name) }}</a></li>
                                                    @foreach (\App\SubCategory::find($subcategory_id)->subsubcategories as $key3 => $subsubcategory)
                                                        <li class="child"><a href="{{ route('products.subsubcategory', $subsubcategory->slug) }}">{{  __($subsubcategory->name) }}</a></li>
                                                    @endforeach
                                                @endif
                                                @if(isset($subsubcategory_id))
                                                    <li class="active"><a href="{{ route('products') }}">{{ translate('All Categories')}}</a></li>
                                                    <li class="active"><a href="{{ route('products.category', \App\SubsubCategory::find($subsubcategory_id)->subcategory->category->slug) }}">{{  translate(\App\SubSubCategory::find($subsubcategory_id)->subcategory->category->name) }}</a></li>
                                                    <li class="active"><a href="{{ route('products.subcategory', \App\SubsubCategory::find($subsubcategory_id)->subcategory->slug) }}">{{  translate(\App\SubsubCategory::find($subsubcategory_id)->subcategory->name) }}</a></li>
                                                    <li class="current"><a href="{{ route('products.subsubcategory', \App\SubsubCategory::find($subsubcategory_id)->slug) }}">{{  translate(\App\SubsubCategory::find($subsubcategory_id)->name) }}</a></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-white sidebar-box mb-3">
                                    <div class="box-title text-center">
                                        {{ translate('Price range')}}
                                    </div>
                                    <div class="box-content">
                                        <div class="range-slider-wrapper mt-3">
                                        
                                            <div
                                                id="input-slider-range"
                                                data-range-value-min="@if(count(\App\Product::query()->get()) < 1) 0 @else {{ filter_products(\App\Product::query())->get()->min('unit_price') }} @endif"
                                                
                                                data-range-value-max="@if(count(\App\Product::query()->get()) < 1) 0 @else {{ filter_products(\App\Product::query())->get()->max('unit_price') }} @endif"></div>

                                            <div class="row">
                                                <div class="col-6">
                                                    <span class="range-slider-value value-low"
                                                        @if (isset($min_price))
                                                            data-range-value-low="{{ $min_price }}"
                                                        @elseif($products->min('unit_price') > 0)
                                                            data-range-value-low="{{ $products->min('unit_price') }}"
                                                        @else
                                                            data-range-value-low="0"
                                                        @endif
                                                        id="input-slider-range-value-low">
                                                </div>

                                                <div class="col-6 text-right">
                                                    <span class="range-slider-value value-high"
                                                        @if (isset($max_price))
                                                            data-range-value-high="{{ $max_price }}"
                                                        @elseif($products->max('unit_price') > 0)
                                                            data-range-value-high="{{ $products->max('unit_price') }}"
                                                        @else
                                                            data-range-value-high="0"
                                                        @endif
                                                        id="input-slider-range-value-high">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white sidebar-box mb-3">
                                    <div class="box-title text-center">
                                        {{ translate('Filter by color')}}
                                    </div>
                                    <div class="box-content">
                                        
                                        <ul class="list-inline checkbox-color checkbox-color-circle mb-0">
                                            @foreach ($all_colors as $key => $color)
                                                <li>
                                                    <input type="radio" id="color-{{ $key }}" name="color" value="{{ $color }}" @if(isset($selected_color) && $selected_color == $color) checked @endif onchange="filter()">
                                                    <label style="background: {{ $color }};" for="color-{{ $key }}" data-toggle="tooltip" data-original-title="{{ \App\Color::where('code', $color)->first()->name }}"></label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                @foreach ($attributes as $key => $attribute)
                                    @if (\App\Attribute::find($attribute['id']) != null)
                                        <div class="bg-white sidebar-box mb-3">
                                            <div class="box-title text-center">
                                                Filter by {{ \App\Attribute::find($attribute['id'])->name }}
                                            </div>
                                            <div class="box-content">
                                                
                                                <div class="filter-checkbox">
                                                    @if(array_key_exists('values', $attribute))
                                                        @foreach ($attribute['values'] as $key => $value)
                                                            @php
                                                                $flag = false;
                                                                if(isset($selected_attributes)){
                                                                    foreach ($selected_attributes as $key => $selected_attribute) {
                                                                        if($selected_attribute['id'] == $attribute['id']){
                                                                            if(in_array($value, $selected_attribute['values'])){
                                                                                $flag = true;
                                                                                break;
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            @endphp
                                                            <div class="checkbox">
                                                                <input type="checkbox" id="attribute_{{ $attribute['id'] }}_value_{{ $value }}" name="attribute_{{ $attribute['id'] }}[]" value="{{ $value }}" @if ($flag) checked @endif onchange="filter()">
                                                                <label for="attribute_{{ $attribute['id'] }}_value_{{ $value }}">{{ $value }}</label>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            <button type="submit" class="btn btn-styled btn-block btn-base-4">Apply filter</button>
                        </div>
                    </div>
                --}}
                <div class="col">
                  
                        @isset($category_id)
                            <input type="hidden" name="category" value="{{ \App\Category::find($category_id)->slug }}">
                        @endisset
                        @isset($subcategory_id)
                            <input type="hidden" name="subcategory" value="{{ \App\SubCategory::find($subcategory_id)->slug }}">
                        @endisset
                        @isset($subsubcategory_id)
                            <input type="hidden" name="subsubcategory" value="{{ \App\SubSubCategory::find($subsubcategory_id)->slug }}">
                        @endisset

                        <div class="sort-by-bar row no-gutters bg-white mb-3 px-3 pt-2 d-none">
                            <div class="col-xl-4 d-flex d-xl-block justify-content-between align-items-end ">
                                <div class="sort-by-box flex-grow-1">
                                    <div class="form-group">
                                        <label>{{ translate('Search')}}</label>
                                        <div class="search-widget">
                                            <input class="form-control input-lg" type="text" name="q" placeholder="{{ translate('Search products')}}" @isset($query) value="{{ $query }}" @endisset>
                                            <button type="submit" class="btn-inner">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-xl-none ml-3 form-group">
                                    <button type="button" class="btn p-1 btn-sm" id="side-filter">
                                        <i class="la la-filter la-2x"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-xl-7 offset-xl-1">
                                <div class="row no-gutters">
                                    <div class="col-4">
                                        <div class="sort-by-box px-1">
                                            <div class="form-group">
                                                <label>{{ translate('Sort by')}}</label>
                                                <select class="form-control sortSelect" data-minimum-results-for-search="Infinity" name="sort_by" onchange="filter()">
                                                    <option value="1">{{ translate('Newest')}}</option>
                                                    <option value="2">{{ translate('Oldest')}}</option>
                                                    <option value="3">{{ translate('Price low to high')}}</option>
                                                    <option value="4">{{ translate('Price high to low')}}</option>
                                                    <option value="5">{{ translate('Terlari')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="sort-by-box px-1">
                                            <div class="form-group">
                                                <label>{{ translate('Brands')}}</label>
                                                <select class="form-control sortSelect" data-placeholder="{{ translate('All Brands')}}" name="brand" onchange="filter()">
                                                    <option value="">{{ translate('All Brands')}}</option>
                                                    @foreach (\App\Brand::all() as $brand)
                                                        <option value="{{ $brand->slug }}" @isset($brand_id) @if ($brand_id == $brand->id) selected @endif @endisset>{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="sort-by-box px-1">
                                            <div class="form-group">
                                                <label>{{ translate('Sellers')}}</label>
                                                <select class="form-control sortSelect" data-placeholder="{{ translate('All Sellers')}}" name="seller_id" onchange="filter()">
                                                    <option value="">{{ translate('All Sellers')}}</option>
                                                    @foreach (\App\Seller::all() as $key => $seller)
                                                        @if ($seller->user != null && $seller->user->shop != null)
                                                            <option value="{{ $seller->id }}" @isset($seller_id) @if ($seller_id == $seller->id) selected @endif @endisset>{{ $seller->user->shop->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="min_price" value="">
                        <input type="hidden" name="max_price" value="">
                      
                        <div class="products-box-bar p-3 bg-white">
                            <div class="row sm-no-gutters gutters-5">
                                {{-- @foreach ($products as $key => $product)
                                    <div class="col-xxl-3 col-xl-2 col-lg-3 col-md-2 col-6">
                                        <div class="product-box-2 bg-white alt-box my-md-2">
                                            <div class="position-relative overflow-hidden">
                                                <a href="{{ route('product', $product->slug) }}" class="d-block product-image h-100 text-center" tabindex="0">
                                                    <img class="img-fit lazyload" src="{{ my_asset('frontend/images/placeholder.jpg') }}" data-src="{{ my_asset($product->thumbnail_img) }}" alt="{{  __($product->name) }}">
                                                </a>
                                                <div class="product-btns clearfix">
                                                    <button class="btn add-wishlist" title="Add to Wishlist" onclick="addToWishList({{ $product->id }})" type="button">
                                                        <i class="la la-heart-o"></i>
                                                    </button>
                                                    <button class="btn add-compare" title="Add to Compare" onclick="addToCompare({{ $product->id }})" type="button">
                                                        <i class="la la-refresh"></i>
                                                    </button>
                                                    <button class="btn quick-view" title="Quick view" onclick="showAddToCartModal({{ $product->id }})" type="button">
                                                        <i class="la la-eye"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="p-md-3 p-2">
                                                <div class="price-box">
                                                    @if(home_base_price($product->id) != home_discounted_base_price($product->id))
                                                        <del class="old-product-price strong-400">{{ home_base_price($product->id) }}</del>
                                                    @endif
                                                    <span class="product-price strong-600">{{ home_discounted_base_price($product->id) }}</span>
                                                </div>
                                                <div class="star-rating star-rating-sm mt-1">
                                                    {{ renderStarRating($product->rating) }}
                                                </div>
                                                <h2 class="product-title p-0">
                                                    <a href="{{ route('product', $product->slug) }}" class=" text-truncate">{{  __($product->name) }}</a>
                                                </h2>
                                                @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                                                    <div class="club-point mt-2 bg-soft-base-1 border-light-base-1 border">
                                                        {{  translate('Point') }}:
                                                        <span class="strong-700 float-right">{{ $product->earn_point }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <a class="btn btn-default" onclick="addToCart({{ $product->id }})" style="width: 100%">Tambah</a>
                                        </div>
                                    </div>
                                @endforeach --}}
                                @include('frontend.inc.products')
                            </div>
                        </div>
                        <div class="products-pagination bg-white p-3">
                            <nav aria-label="Center aligned pagination">
                                <ul class="pagination justify-content-center">
                                    {{ $products->links() }}
                                </ul>
                            </nav>
                        </div>
                </div>
            </div>
            </form>
        </div>
    </section>

@endsection

@section('script')
    <script type="text/javascript">
        document.addEventListener("click", function (e) {
            if (e.target.id == "btn-urutkan") {
                e.preventDefault()
            }

        })

        function select(id) {
            $('.sortSelect').val(id)
            $(".sortSelect").change()
        }

        function filter(){
            $('#search-form').submit();
        }
        function rangefilter(arg){
            $('input[name=min_price]').val(arg[0]);
            $('input[name=max_price]').val(arg[1]);
            filter();
        }
    </script>
@endsection
