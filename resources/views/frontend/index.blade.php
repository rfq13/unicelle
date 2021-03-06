@extends('frontend.layouts.app')

<!-- @section('link')

@endsection -->
@section('title', 'Home')
@section('content')


    {{-- <style>
        @media (min-width: 768px) and (max-width: 991px) {
    /* Show 4th slide on md if col-md-4*/
        .carousel-inner .active.col-md-4.carousel-item + .carousel-item + .carousel-item + .carousel-item {
            position: absolute;
            top: 0;
            right: -33.3333%;  /*change this with javascript in the future*/
            z-index: -1;
            display: block;
            visibility: visible;
            }
        }
        @media (min-width: 576px) and (max-width: 768px) {
            /* Show 3rd slide on sm if col-sm-6*/
            .carousel-inner .active.col-sm-6.carousel-item + .carousel-item + .carousel-item {
                position: absolute;
                top: 0;
                right: -50%;  /*change this with javascript in the future*/
                z-index: -1;
                display: block;
                visibility: visible;
            }
        }
        @media (min-width: 576px) {
            .carousel-item {
                margin-right: 0;
            }
            /* show 2 items */
            .carousel-inner .active + .carousel-item {
                display: block;
            }
            .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left),
            .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item {
                transition: none;
            }
            .carousel-inner .carousel-item-next {
                position: relative;
                transform: translate3d(0, 0, 0);
            }
            /* left or forward direction */
            .active.carousel-item-left + .carousel-item-next.carousel-item-left,
            .carousel-item-next.carousel-item-left + .carousel-item,
            .carousel-item-next.carousel-item-left + .carousel-item + .carousel-item {
                position: relative;
                transform: translate3d(-100%, 0, 0);
                visibility: visible;
            }
            /* farthest right hidden item must be also positioned for animations */
            .carousel-inner .carousel-item-prev.carousel-item-right {
                position: absolute;
                top: 0;
                left: 0;
                z-index: -1;
                display: block;
                visibility: visible;
            }
            /* right or prev direction */
            .active.carousel-item-right + .carousel-item-prev.carousel-item-right,
            .carousel-item-prev.carousel-item-right + .carousel-item,
            .carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item {
                position: relative;
                transform: translate3d(100%, 0, 0);
                visibility: visible;
                display: block;
                visibility: visible;
            }
        }
        /* MD */
        @media (min-width: 768px) {
            /* show 3rd of 3 item slide */
            .carousel-inner .active + .carousel-item + .carousel-item {
                display: block;
            }
            .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item + .carousel-item {
                transition: none;
            }
            .carousel-inner .carousel-item-next {
                position: relative;
                transform: translate3d(0, 0, 0);
            }
            /* left or forward direction */
            .carousel-item-next.carousel-item-left + .carousel-item + .carousel-item + .carousel-item {
                position: relative;
                transform: translate3d(-100%, 0, 0);
                visibility: visible;
            }
            /* right or prev direction */
            .carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item + .carousel-item {
                position: relative;
                transform: translate3d(100%, 0, 0);
                visibility: visible;
                display: block;
                visibility: visible;
            }
        }
        /* LG */
        @media (min-width: 991px) {
            /* show 4th item */
            .carousel-inner .active + .carousel-item + .carousel-item + .carousel-item {
                display: block;
            }
            .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left) + .carousel-item + .carousel-item + .carousel-item {
                transition: none;
            }
            /* Show 5th slide on lg if col-lg-3 */
            .carousel-inner .active.col-lg-3.carousel-item + .carousel-item + .carousel-item + .carousel-item + .carousel-item {
                position: absolute;
                top: 0;
                right: -25%;  /*change this with javascript in the future*/
                z-index: -1;
                display: block;
                visibility: visible;
            }
            /* left or forward direction */
            .carousel-item-next.carousel-item-left + .carousel-item + .carousel-item + .carousel-item + .carousel-item {
                position: relative;
                transform: translate3d(-100%, 0, 0);
                visibility: visible;
            }
            /* right or prev direction //t - previous slide direction last item animation fix */
            .carousel-item-prev.carousel-item-right + .carousel-item + .carousel-item + .carousel-item + .carousel-item {
                position: relative;
                transform: translate3d(100%, 0, 0);
                visibility: visible;
                display: block;
                visibility: visible;
            }
        }
    </style> --}}
    {{-- <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ my_asset('img/homepage/img/banner.jpg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ my_asset('img/homepage/img/banner2.jpg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ my_asset('img/homepage/img/banner3.jpg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div> --}}

                @php
                $banners = \App\Banner::where(["published"=>1,'position'=>1])->get();
                @endphp
    <div class="container mt-3">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators mx-auto" style=" bottom:10%; right:0%;">
                @foreach ($banners as $key => $value)
                    <li class="{{ $key == 0 ? 'active' : '' }}" data-target="#carouselExampleCaptions" data-slide-to="{{ $key }}"></li>
                @endforeach
            </ol>
            <div class="carousel-inner img-banner h-100">
                @foreach ($banners as $keybanner => $banner)
                    <div class="carousel-item {{ $keybanner == 0 ? 'active' : 'img-banner h-100' }}">
                        <a href="{{ $banner->url }}">
                            <img src="{{ my_asset($banner->photo) }}" class=" d-block w-100 img-fluid" alt="..." width="1110" height="100%" style="max-height: 385px;max-width:1030">
                            <div class="carousel-caption d-none d-md-block">
                            </div>
                        </a>
                    </div>
                @endforeach
                {{--
                <div class="carousel-item img-banner h-100">
                    <img src="{{ my_asset('images\fix1\img_banner\slide-home2.2-min.png') }}"
                        class="d-block w-100 img-fluid" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
                <div class="carousel-item img-banner h-100">
                    <img src="{{ my_asset('images\fix1\img_banner\slide-home2.3-min.png') }}"
                        class="d-block w-100 img-fluid" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
                --}}
            </div>
            <a class="carousel-control-prev slider-banner-left my-auto" href="#carouselExampleCaptions" role="button"
                data-slide="prev" style="height: 20px;">
                <div class=" slider-button-right">
                    <i class="fa fa-angle-left" aria-hidden="true" style="font-size:50px; color:black"></i>
                </div>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next slider-banner-right  my-auto" href="#carouselExampleCaptions" role="button"
                data-slide="next" style="height: 20px;">
                <div class=" slider-button-right">
                    <i class="fa fa-angle-right" aria-hidden="true" style="font-size:50px; color:black"></i>
                </div>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="container">
        <h2 style="
                    font-family: Open Sans;
                    font-size: 24px;
                    font-style: normal;
                    font-weight: 600;
                    line-height: 33px;
                    letter-spacing: 0em;
                    text-align: left;
                    height: 33px;
                    width: 273px;
                    left: 150px;
                    top: 631px;
                    border-radius: undefinedpx;
                    margin-top:50px

                    ">Kategori Obat</h2>
                    <div style="height:20px">
                    </div>
        {{-- Slider --}}
        {{--
        <div class="six_ slider mt-3">
            @php
            $categories = \App\Category::where('featured',1)->orderBy('created_at', 'desc')->get()->chunk(6);
            @endphp
            @foreach ($categories as $category)
                <div class="mx-1 align-content-center justify-content-center text-center">
                    @foreach ($category as $key => $value)
                        <a href="{{ route('products.category', $value->slug) }}" class="rounded mx-auto my-auto">
                            <div class="card card-icon-kategori mb-3 mx-auto">
                                <img src="{{ my_asset($value->icon) }}" alt="" class="">
                            </div>
                            <span class="text-reward">{{ $value->name }}</span>
                        </a>
                    @endforeach
                </div>
            @endforeach
        </div> --}}
        @php
        $categories = \App\Category::where('featured','!=',0)->orderBy('created_at', 'desc')->get()->chunk(6);
        @endphp
        
        

        {{-- <div id="carouselExampleControlla" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ($categories as $k => $category)
                    <div class="carousel-item active">
                        @foreach ($category as $key => $value)
                            <div class="row">
                                <div class="col">
                                    <div class="my-2">
                                        <a href="{{ route('products.category', $value->slug) }}">
                                                        <img src="{{ my_asset($value->icon) }}"
                                                            class="card-img-top mx-auto icon" alt="..." width="100" height="100">
                                                <span class="ft-icon px-2">{{ $value->name }}</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
            <a data-slide="prev" href="#carouselExampleControlla" class="p-3 bt-slide"><i class="fa fa-angle-right"></i></a>
            <a data-slide="next" href="#carouselExampleControlla" class="p-3 bt-slide"><i class="fa fa-angle-left"></i></a>
        </div> --}}

        <div class="row-slider" style="height:250px; margin-bottom: 10px;">
            <div class="col-1 my-auto px-0">
                <a data-slide="prev" href="#Carousel" class="p-3 bt-slide"><i class="fa fa-angle-left"></i></a>
            </div>
            <div class="col-slider">
                <div class="row-slider">
                    <div class="col-lg-12 contain">
                        <div id="Carousel" class="carousel slide p-0 mx-auto my-auto">
                            <div class="carousel-inner">
                                @foreach ($categories as $k=> $category)
                                    <div class="item {{ $k == 0 ? "active" : "" }} carousel-item">
                                        <div class="row-slider">
                                            @foreach ($category as $key => $value)
                                                <div class="col-md-2">
                                                    <div class="my-2">
                                                        <a href="{{ route('products.category', $value->slug) }}">
                                                            <div class="text-center">
                                                                <div class="margin-auto">
                                                                    <div class="mb-4 mx-auto menu-icon d-flex align-items-center"
                                                                        style="text-align:center;">
                                                                        <img src="{{ my_asset($value->icon) }}"
                                                                            class="card-img-top mx-auto icon" alt="..." width="100" height="100">
                                                                    </div>
                                                                </div>
                                                                <span class="ft-icon px-2">{{ $value->name }}</span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-1 my-auto px-0 text-right">
                <a data-slide="next" href="#Carousel" class="p-3 bt-slide"><i class="fa fa-angle-right"></i></a>
            </div>
        </div>


        <!--.container-->
        {{-- END SLIDER --}}
        <div class="mb-4">
            {{-- <div class="container ">
                <div class="row" style="margin-bottom: 160px;">
                    @php
                    $category = \App\Category::orderBy('created_at', 'desc')->get();
                    @endphp
                    @foreach ($category as $key => $value)
                        <div class="col-md-2">
                            <div class="my-2">
                                <a href="{{ route('products.category', $value->slug) }}">
                                    <div class="text-center">
                                        <div class="margin-auto">
                                            <div class="mb-4 mx-auto menu-icon d-flex align-items-center"
                                                style="text-align:center;">
                                                <img src="{{ my_asset($value->icon) }}" class="card-img-top mx-auto icon"
                                                    alt="...">
                                            </div>
                                        </div>
                                        <span class="ft-icon px-2">{{ $value->name }}</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div> --}}
            {{-- Lama --}}
            {{-- <a href="{{ route('products.category', $value->slug) }}">
                <img src="{{ my_asset($value->icon) }}" style="width:100px;" class="card-img-top mx-auto" alt="...">
                <div class="card-body">
                    <span style="font-family: Open Sans;
                                                        margin-top: 14.5px;
                                                        font-size: 20px;
                                                        font-style: normal;
                                                        font-weight: 600;
                                                        line-height: 27px;
                                                        letter-spacing: 0em;
                                                        text-align: center;
                                                        color: #212121;
                                                        height: 26.095947265625px;
                                                        width: 100px;
                                                        left: 245px;
                                                        top: 839.900390625px;
                                                        border-radius: nullpx;">{{ $value->name }}</span>
                </div>
            </a> --}}
            {{-- Lama --}}
            {{--
            <div class="col-md-2">
                <div class="margin:auto;" style="width: 8rem; margin:10px">
                    <img src="{{ my_asset('img/homepage/icon/jantung.png') }}" style="width:100px; margin:auto; "
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">Jantung</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="margin:auto;" style="width: 8rem; margin:10px">
                    <img src="{{ my_asset('img/homepage/icon/demam.png') }}" style="width:100px; margin:auto;"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">Demam</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="margin:auto;" style="width: 8rem; margin:10px">
                    <img src="{{ my_asset('img/homepage/icon/antibiotik.png') }}" style="width:100px; margin:auto; "
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">Anti Biotik</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="margin:auto;" style="width: 8rem; margin:10px">
                    <img src="{{ my_asset('img/homepage/icon/suplemen.png') }}" style="width:100px; margin:auto;"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">Suplemen</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2" style="text-align:center">
                <div class="margin:auto;" style="width: 8rem; margin:10px">
                    <img src="{{ my_asset('img/homepage/icon/jadwal-diet.png') }}" style="width:100px; margin:auto;"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">Diet</p>
                    </div>
                </div>
            </div>
            --}}


            <h2 style="font-size:24px;font-family: Open Sans;
                            font-style: normal;
                            font-weight: 600;
                            line-height: 33px;
                            letter-spacing: 0em;
                            text-align: left;
                            ">Produk Terbaru</h2>
            {{--
            <p style="font-family: Open Sans;
                                font-size: 20px;
                                font-style: normal;
                                font-weight: 400;
                                line-height: 27px;
                                letter-spacing: 0em;
                                text-align: left;
                                height: 27px;width: 707px;
                                left: 150px;
                                top: 1069px;
                                border-radius: undefinedpx;
                                ">Dapatkan Informasi tentang aturan, petunjuk penggunaan obat dan vitamin</p>
            --}}
            <div class="mb-4 mt-2">
                <div class="container">
                    @php
                    $products = \App\Product::where('published',1)->orderBy('created_at','desc')
                    ->limit(12)
                    ->get();
                    @endphp
                    <div class="row gutters-10">
                        @include('frontend.inc.products')
                    </div>
                    <div class="text-center">
                        <a href="{{ route('products') }}" class="btn mt-5 w-25"
                            style="background:#3BB6B1; color:#fff;">Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="bg-img-artikel">
        <div class="container pt-5">
            <h2 style="
                    height: 33px;
                    width: 150px;
                    /* left: 150px;
                    top: 1939px;
                    border-radius: nullpx; */
                    font-family: Open Sans;
                    font-size: 24px;
                    font-style: normal;
                    font-weight: 600;
                    line-height: 33px;
                    letter-spacing: 0em;
                    text-align: left;
                    ">Artikel / Blog</h2>
            <span style="
                    height: 27px;
                    width: 440px;
                    left: 150px;
                    top: 1982px;
                    border-radius: nullpx;
                    font-family: Open Sans;
                    font-size: 20px;
                    font-style: normal;
                    font-weight: 400;
                    line-height: 27px;
                    letter-spacing: 0em;
                    text-align: left;
                    ">Dapatkan Informasi terbaru seputar kesehatan</span>
            <div class="my-4">
                <div class="row">
                    @php
                    $blogs = \App\Blog::where('visible',1)->limit(8)->orderBy('created_at','desc')->get();
                    @endphp
                    @include('article.inc.blogs')
                </div>
                <div class="width:10px" style="text-align:center">
                    <a href="{{ route('blog.article') }}" class="btn mt-4 mb-5 w-25"
                        style="background:#3BB6B1;color:#fff">Lainnya</a>
                </div>
            </div>
        </div>
    </section>

    {{--
    <section class="home-banner-area mb-4">
        <div class="container">
            <div class="row no-gutters position-relative">
                <div class="col-lg-3 position-static order-2 order-lg-0">
                    <div class="category-sidebar">
                        <div class="all-category d-none d-lg-block">
                            <span>{{ translate('Categories') }}</span>
                            <a href="{{ route('categories.all') }}">
                                <span class="d-none d-lg-inline-block">{{ translate('See All') }} ></span>
                            </a>
                        </div>
                        <ul class="categories no-scrollbar">
                            <li class="d-lg-none">
                                <a href="{{ route('categories.all') }}" class="text-truncate">
                                    <img class="cat-image lazyload" src="{{ my_asset('frontend/images/placeholder.jpg') }}"
                                        data-src="{{ my_asset('frontend/images/icons/list.png') }}" width="30"
                                        alt="{{ translate('All Category') }}">
                                    <span class="cat-name">{{ translate('All') }} <br> {{ translate('Categories') }}</span>
                                </a>
                            </li>
                            @foreach (\App\Category::all()->take(11) as $key => $category)
                                @php
                                $brands = array();
                                @endphp
                                <li class="category-nav-element" data-id="{{ $category->id }}">
                                    <a href="{{ route('products.category', $category->slug) }}" class="text-truncate">
                                        <img class="cat-image lazyload"
                                            src="{{ my_asset('frontend/images/placeholder.jpg') }}"
                                            data-src="{{ my_asset($category->icon) }}" width="30"
                                            alt="{{ __($category->name) }}">
                                        <span class="cat-name">{{ __($category->name) }}</span>
                                    </a>
                                    @if (count($category->subcategories) > 0)
                                        <div class="sub-cat-menu c-scrollbar">
                                            <div class="c-preloader">
                                                <i class="fa fa-spin fa-spinner"></i>
                                            </div>
                                        </div>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                @php
                $num_todays_deal = count(filter_products(\App\Product::where('published', 1)->where('todays_deal', 1
                ))->get());
                $featured_categories = \App\Category::where('featured', 1)->get();
                @endphp

                <div class="  @if (\App\Slider::where('published', 1)->get() as $key => $slider)
                                    <div class="home-slide-item" style="height:275px;">
                                        <a href="{{ $slider->link }}" target="_blank">
                                            <img class="d-block w-100 h-100 lazyload"
                                                src="{{ my_asset('frontend/images/placeholder-rect.jpg') }}"
                                                data-src="{{ my_asset($slider->photo) }}" alt="{{ env('APP_NAME') }} promo">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @if (count($featured_categories) > 0)
                        <div class="trending-category  d-none d-lg-block">
                            <ul>
                                @foreach ($featured_categories->take(7) as $key => $category)
                                    <li @if ($key == 0) class="active"
                                @endif>
                                <div class="trend-category-single">
                                    <a href="{{ route('products.category', $category->slug) }}" class="d-block">
                                        <div class="name">{{ __($category->name) }}</div>
                                        <div class="img">
                                            <img src="{{ my_asset('frontend/images/placeholder.jpg') }}"
                                                data-src="{{ my_asset($category->banner) }}" alt="{{ __($category->name) }}"
                                                class="lazyload img-fit">
                                        </div>
                                    </a>
                                </div>
                                </li>
                    @endforeach
                    </ul>
                </div>
                @endif
            </div>

            @if ($num_todays_deal > 0)
                <div class="col-lg-2 d-none d-lg-block">
                    <div class="flash-deal-box bg-white h-100">
                        <div class="title text-center p-2 gry-bg">
                            <h3 class="heading-6 mb-0">
                                {{ translate('Todays Deal') }}
                                <span class="badge badge-danger">{{ translate('Hot') }}</span>
                            </h3>
                        </div>
                        <div class="flash-content c-scrollbar c-height">
                            @foreach (filter_products(\App\Product::where('published', 1)->where('todays_deal', '1'))->get() as $key => $product)
                                @if ($product != null)
                                    <a href="{{ route('product', $product->slug) }}" class="d-block flash-deal-item">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col">
                                                <div class="img">
                                                    <img class="lazyload img-fit"
                                                        src="{{ my_asset('frontend/images/placeholder.jpg') }}"
                                                        data-src="{{ my_asset($product->thumbnail_img) }}"
                                                        alt="{{ __($product->name) }}">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="price">
                                                    <span
                                                        class="d-block">{{ home_discounted_base_price($product->id) }}</span>
                                                    @if (home_base_price($product->id) != home_discounted_base_price($product->id))
                                                        <del class="d-block">{{ home_base_price($product->id) }}</del>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

        </div>
        </div>
    </section>

    @php
    $flash_deal = \App\FlashDeal::where('status', 1)->where('featured', 1)->first();
    @endphp
    @if ($flash_deal != null && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date)
        <section class="mb-4">
            <div class="container">
                <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
                    <div class="section-title-1 clearfix ">
                        <h3 class="heading-5 strong-700 mb-0 float-left">
                            {{ translate('Flash Sale') }}
                        </h3>
                        <div class="flash-deal-box float-left">
                            <div class="countdown countdown--style-1 countdown--style-1-v1 "
                                data-countdown-date="{{ date('m/d/Y', $flash_deal->end_date) }}"
                                data-countdown-label="show"></div>
                        </div>
                        <ul class="inline-links float-right">
                            <li><a href="{{ route('flash-deal-details', $flash_deal->slug) }}"
                                    class="active">{{ translate('View More') }}</a></li>
                        </ul>
                    </div>
                    <div class="caorusel-box arrow-round gutters-5">
                        <div class="slick-carousel" data-slick-items="6" data-slick-xl-items="5" data-slick-lg-items="4"
                            data-slick-md-items="3" data-slick-sm-items="2" data-slick-xs-items="2">
                            @foreach ($flash_deal->flash_deal_products as $key => $flash_deal_product)
                                @php
                                $product = \App\Product::find($flash_deal_product->product_id);
                                @endphp
                                @if ($product != null && $product->published != 0)
                                    <div class="caorusel-card">
                                        <div class="product-card-2 card card-product shop-cards">
                                            <div class="card-body p-0">
                                                <div class="card-image">
                                                    <a href="{{ route('product', $product->slug) }}" class="d-block">
                                                        <img class="img-fit lazyload mx-auto"
                                                            src="{{ my_asset('frontend/images/placeholder.jpg') }}"
                                                            data-src="{{ my_asset($product->thumbnail_img) }}"
                                                            alt="{{ __($product->name) }}">
                                                    </a>
                                                </div>

                                                <div class="p-md-3 p-2">
                                                    <div class="price-box">
                                                        @if (home_base_price($product->id) != home_discounted_base_price($product->id))
                                                            <del
                                                                class="old-product-price strong-400">{{ home_base_price($product->id) }}</del>
                                                        @endif
                                                        <span
                                                            class="product-price strong-600">{{ home_discounted_base_price($product->id) }}</span>
                                                    </div>
                                                    <div class="star-rating star-rating-sm mt-1">
                                                        {{ renderStarRating($product->rating) }}
                                                    </div>
                                                    <h2 class="product-title p-0">
                                                        <a href="{{ route('product', $product->slug) }}"
                                                            class=" text-truncate">{{ __($product->name) }}</a>
                                                    </h2>
                                                    @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                                                        <div
                                                            class="club-point mt-2 bg-soft-base-1 border-light-base-1 border">
                                                            {{ translate('Club Point') }}:
                                                            <span
                                                                class="strong-700 float-right">{{ $product->earn_point }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <div class="mb-4">
        <div class="container">
            <div class="row gutters-10">
                @foreach (\App\Banner::where('position', 1)
            ->where('published', 1)
            ->get()
        as $key => $banner)
                    <div class="col-lg-{{ 12 /
                            count(
                                \App\Banner::where('position', 1)->where('published', 1)->get(),
                            ) }}">
                        <div class="media-banner mb-3 mb-lg-0">
                            <a href="{{ $banner->url }}" target="_blank" class="banner-container">
                                <img src="{{ my_asset('frontend/images/placeholder-rect.jpg') }}"
                                    data-src="{{ my_asset($banner->photo) }}" alt="{{ env('APP_NAME') }} promo"
                                    class="img-fluid lazyload">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="section_featured">

    </div>

    <div id="section_best_selling">

    </div>

    <div id="section_home_categories">

    </div>

    @if (\App\BusinessSetting::where('type', 'classified_product')->first()->value == 1)
        @php
        $customer_products = \App\CustomerProduct::where('status', '1')->where('published', '1')->take(10)->get();
        @endphp
        @if (count($customer_products) > 0)
            <section class="mb-4">
                <div class="container">
                    <div class="px-2 py-4 p-md-4 bg-white shadow-sm">
                        <div class="section-title-1 clearfix">
                            <h3 class="heading-5 strong-700 mb-0 float-left">
                                <span class="mr-4">{{ translate('Classified Ads') }}</span>
                            </h3>
                            <ul class="inline-links float-right">
                                <li><a href="{{ route('customer.products') }}"
                                        class="active">{{ translate('View More') }}</a></li>
                            </ul>
                        </div>
                        <div class="caorusel-box arrow-round">
                            <div class="slick-carousel" data-slick-items="6" data-slick-xl-items="5" data-slick-lg-items="4"
                                data-slick-md-items="3" data-slick-sm-items="2" data-slick-xs-items="2">
                                @foreach ($customer_products as $key => $customer_product)
                                    <div class="product-card-2 card card-product my-2 mx-1 mx-sm-2 shop-cards shop-tech">
                                        <div class="card-body p-0">
                                            <div class="card-image">
                                                <a href="{{ route('customer.product', $customer_product->slug) }}"
                                                    class="d-block">
                                                    <img class="img-fit lazyload mx-auto"
                                                        src="{{ my_asset('frontend/images/placeholder.jpg') }}"
                                                        data-src="{{ my_asset($customer_product->thumbnail_img) }}"
                                                        alt="{{ __($customer_product->name) }}">
                                                </a>
                                            </div>

                                            <div class="p-sm-3 p-2">
                                                <div class="price-box">
                                                    <span
                                                        class="product-price strong-600">{{ single_price($customer_product->unit_price) }}</span>
                                                </div>
                                                <h2 class="product-title p-0 text-truncate-1">
                                                    <a
                                                        href="{{ route('customer.product', $customer_product->slug) }}">{{ __($customer_product->name) }}</a>
                                                </h2>
                                                <div>
                                                    @if ($customer_product->conditon == 'new')
                                                        <span class="product-label label-hot">{{ translate('new') }}</span>
                                                        @elseif($customer_product->conditon == 'used')
                                                        <span class="product-label label-hot">{{ translate('Used') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endif

    <div class="mb-4">
        <div class="container">
            <div class="row gutters-10">
                @foreach (\App\Banner::where('position', 2)
            ->where('published', 1)
            ->get()
        as $key => $banner)
                    <div class="col-lg-{{ 12 /
                            count(
                                \App\Banner::where('position', 2)->where('published', 1)->get(),
                            ) }}">
                        <div class="media-banner mb-3 mb-lg-0">
                            <a href="{{ $banner->url }}" target="_blank" class="banner-container">
                                <img src="{{ my_asset('frontend/images/placeholder-rect.jpg') }}"
                                    data-src="{{ my_asset($banner->photo) }}" alt="{{ env('APP_NAME') }} promo"
                                    class="img-fluid lazyload">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
        <div id="section_best_sellers">

        </div>
    @endif

    @if (count(\App\Category::where('top', 1)->get()) != null && count(\App\Brand::where('top', 1)->get()) != null)
        <section class="mb-3">
            <div class="container">
                <div class="row gutters-10">
                    <div class="col-lg-6">
                        <div class="section-title-1 clearfix">
                            <h3 class="heading-5 strong-700 mb-0 float-left">
                                <span class="mr-4">{{ translate('Top 10 Catogories') }}</span>
                            </h3>
                            <ul class="float-right inline-links">
                                <li>
                                    <a href="{{ route('categories.all') }}"
                                        class="active">{{ translate('View All Catogories') }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="row gutters-5">
                            @foreach (\App\Category::where('top', 1)->get() as $category)
                                <div class="mb-3 col-6">
                                    <a href="{{ route('products.category', $category->slug) }}"
                                        class="bg-white border d-block c-base-2 box-2 icon-anim pl-2">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col-3 text-center">
                                                <img src="{{ my_asset('frontend/images/placeholder.jpg') }}"
                                                    data-src="{{ my_asset($category->banner) }}"
                                                    alt="{{ __($category->name) }}" class="img-fluid img lazyload">
                                            </div>
                                            <div class="info col-7">
                                                <div class="name text-truncate pl-3 py-4">{{ __($category->name) }}</div>
                                            </div>
                                            <div class="col-2 text-center">
                                                <i class="la la-angle-right c-base-1"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="section-title-1 clearfix">
                            <h3 class="heading-5 strong-700 mb-0 float-left">
                                <span class="mr-4">{{ translate('Top 10 Brands') }}</span>
                            </h3>
                            <ul class="float-right inline-links">
                                <li>
                                    <a href="{{ route('brands.all') }}"
                                        class="active">{{ translate('View All Brands') }}</a>
                                </li>
                            </ul>
                        </div>
                        <div class="row gutters-5">
                            @foreach (\App\Brand::where('top', 1)->get() as $brand)
                                <div class="mb-3 col-6">
                                    <a href="{{ route('products.brand', $brand->slug) }}"
                                        class="bg-white border d-block c-base-2 box-2 icon-anim pl-2">
                                        <div class="row align-items-center no-gutters">
                                            <div class="col-3 text-center">
                                                <img src="{{ my_asset('frontend/images/placeholder.jpg') }}"
                                                    data-src="{{ my_asset($brand->logo) }}" alt="{{ __($brand->name) }}"
                                                    class="img-fluid img lazyload">
                                            </div>
                                            <div class="info col-7">
                                                <div class="name text-truncate pl-3 py-4">{{ __($brand->name) }}</div>
                                            </div>
                                            <div class="col-2 text-center">
                                                <i class="la la-angle-right c-base-1"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    --}}
@endsection

@section('script')
    {{-- <script>
        $(document).ready(function() {
            $.post('{{ route('
                home.section.featured ') }}', {
                    _token: '{{ csrf_token() }}'
                },
                function(data) {
                    $('#section_featured').html(data);
                    slickInit();
                });

            $.post('{{ route('
                home.section.best_selling ') }}', {
                    _token: '{{ csrf_token() }}'
                },
                function(data) {
                    $('#section_best_selling').html(data);
                    slickInit();
                });

            $.post('{{ route('
                home.section.home_categories ') }}', {
                    _token: '{{ csrf_token() }}'
                },
                function(data) {
                    $('#section_home_categories').html(data);
                    slickInit();
                });

            <
            beautify start = "@if "
            exp = "^^^\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1^^^" >
                $.post('{{ route('
                    home.section.best_sellers ') }}', {
                        _token: '{{ csrf_token() }}'
                    },
                    function(data) {
                        $('#section_best_sellers').html(data);
                        slickInit();
                    }); <
            /beautify end="</beautify
            end = "@endif" > ">
        });

    </script> --}}

    {{-- <script>
      $('#carousel-slide1').on('slide.bs.carousel', function (e) {
    /*
        CC 2.0 License Iatek LLC 2018 - Attribution required
    */
    var $e = $(e.relatedTarget);
    var idx = $e.index();
    var itemsPerSlide = 5;
    var totalItems = $('.carousel-item').length;
 
    if (idx >= totalItems-(itemsPerSlide-1)) {
        var it = itemsPerSlide - (totalItems - idx);
        for (var i=0; i<it; i++) {
            // append slides to end
            if (e.direction=="left") {
                $('.carousel-item').eq(i).appendTo('.carousel-inner');
            }
            else {
                $('.carousel-item').eq(0).appendTo('.carousel-inner');
            }
        }
    }
});
    </script> --}}

    <script>
        $('.add').click(function() {
            if ($(this).prev().val() < 12) {
                $(this).prev().val(+$(this).prev().val() + 1);
            }
        });
        $('.sub').click(function() {
            if ($(this).next().val() > 1) {
                if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
            }
        });

    </script>

    <script>
        var slideIndex = 1;
        showDivs(slideIndex);

        function plusDivs(n) {
            showDivs(slideIndex += n);
        }

        function showDivs(n) {
            var i;
            var x = document.getElementsByClassName("mySlides");
            if (n > x.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = x.length
            }
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            x[slideIndex - 1].style.display = "block";
        }

        $('.variable-width').slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            centerMode: true,
            variableWidth: true
        });

    </script>

    {{-- slider --}}
<script>

$(document).ready(function() {
    $('#Carousel').carousel({
        interval: 5000
    })
});
</script>
    
    {{-- slider --}}
@endsection
