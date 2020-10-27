@php
if(Auth::check()){
$point = Auth::user()->poin;
    if (Session::has('poin_use')) {
        $point -= Session::get('poin_use');
    }
}
@endphp

<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container text-center">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img class="navbar-brand" style="height: 57px;"
                src="{{ my_asset(\App\GeneralSetting::first()->logo) }}">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class=" input-group w-100 mx-lg-4 mx-0 mt-lg-0 mt-2">
                <input class="form-control border-right-0" type="search" id="inputSearchNav" placeholder="Cari Produk">
                <div class="input-group-append">
                    <button class=" btn bg-light border-right rounded-right border-top border-bottom"
                        data-href="{{ route('suggestion.search', 'slug') }}" id="btnSearchNav">
                        <span class="fa fa-search"></span>
                    </button>
                    {{-- <a class="nav-box-link d-none">
                        <img src="{{ my_asset('img/header_dan_footer/icon/search.png') }}">
                    </a> --}}
                </div>
            </div>
            @auth
                <ul class="navbar-nav ml-lg-auto">
                    {{-- <li class="nav-item my-auto mr-lg-4 mr-0">
                        <i id="" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            class="fa fa-bell-o font-weight-bold" aria-hidden="true" style="font-size: 22px "></i>
                    </li> --}}
                    <li class="nav-item my-auto mr-lg-3 mr-0">
                        <a href="{{ route('wishlists.index') }}" style="color:black">
                            <div class="d-flex">
                                <i id="" type="button" aria-haspopup="true" aria-expanded="false"
                                    class=" fa fa-heart-o font-weight-bold" aria-hidden="true" style="font-size: 22px ">

                                </i>
                                {{-- <div
                                    class="px-1 bg-danger align-items-center text-center justify-content-center absolute-bottom"
                                    style="border-radius: 100px">
                                    <span class="text-white p-0 my-auto top-0 line-height-1_2">6</span>
                                </div> --}}
                            </div>
                        </a>
                    </li>
                    <li class="nav-item my-auto mr-lg-3 mr-0">
                        <a href="{{ route('cart') }}">
                            <div class="d-flex align-items-start">
                                <i class="" id="" type="button" aria-haspopup="true" aria-expanded="false" style="margin-right:-12px!important;">
                                    <img class="mx-2" width="20" height="25"
                                        src="{{ my_asset('img/header_dan_footer/icon/bag.png') }}">
                                </i>
                                @if (Session::has('cart'))
                                <a style="margin-top:-5px!important;">
                                    <span class="nav-box-number bg-red rounded-circle p-0 m-0 line-height-1_8 px-2"
                                        id="cart_items_sidenav">{{ count(Session::get('cart')) }}</span>
                                </a>
                                @else
                                    {{-- <span id="cart_items_sidenav">0</span>
                                    --}}
                                @endif
                            </div>
                        </a>
                    </li>
                    <li class="nav-item my-auto mr-lg-3 mr-0">

                        <div class="btn-group">
                            <i type="button" class="fa fa-user-o font-weight-bold" data-toggle="dropdown"
                                data-display="static" aria-haspopup="true" aria-expanded="false" style="font-size: 22px ">
                            </i>
                            <div class="dropdown-menu dropdown-menu-right mt-3">
                                @auth
                                    <div class="dropdown-item d-flex align-items-center">
                                        <img class="profile-icon"
                                            src="{{ Auth::user()->avatar_original != null ? my_asset(Auth::user()->avatar_original) : my_asset('img/header_dan_footer/icon/fb.png') }}"
                                            alt="">
                                        <div class="ml-3">
                                            <p class="dd-profile pb-0 pl-0 mt-2 mb-2 mr-2" style="text-transform:capitalize">
                                                {{ Auth::user()->name }}
                                            </p>
                                            <span class="text-dd-profile">{{ $point }}</span><span class="ml-2">Poin</span>
                                        </div>
                                    </div>
                                    <a class="dropdown-item" href="{{ route('profile') }}">Akun Saya</a>
                                    <hr class=" mt-0 mb-0 mr-2 ml-2">
                                    <a class="dropdown-item" href="{{ route('purchase_history.index') }}">Pesanan</a>
                                    <hr class=" mt-0 mb-0 mr-2 ml-2">
                                    @if (Auth::user()->user_type == 'regular physician')
                                        <a class="dropdown-item" href="{{ route('membership') }}">Membership</a>
                                        <hr class=" mt-0 mb-0 mr-2 ml-2">
                                    @endif
                                    <a class="dropdown-item my-2 btn bg-primary text-white"
                                        href="{{ route('logout') }}">Logout</a>
                                @else
                                    <a type="button" href="{{ route('user.login') }}" class="dropdown-item mt-3"
                                        role="button">Login</a>
                                    <a href="{{ route('user.registration') }}" class="dropdown-item" type="button"
                                        role="button">Daftar</a>
                                    <a href="{{ route('user.registration', 'physician') }}" class="dropdown-item" type="button"
                                        role="button">Daftar Physician</a>
                                @endauth

                            </div>
                        </div>


                    </li>
                </ul>

            @else
                <ul class="navbar-nav ml-lg-auto">
                    <li class="nav-item my-auto mr-lg-3 mr-0">
                        <a href="{{ route('user.login') }}" class=" btn btn-primary  w-100 mt-lg-0 mt-2">Login</a>
                    </li>
                    <li class="nav-item my-auto mt-lg-0">
                        <a href="{{ route('user.registration') }}"
                            class="btn btn-outline-primary w-100 rounded mt-lg-0 mt-3">Daftar</a>
                    </li>
                </ul>
            @endauth
        </div>
    </div>
</nav>

{{-- ------------------------------------------------- --}}
{{-- <nav class="navbar navbar-expand-lg bg-white navbar-light">
    --}}
    {{-- <a class="navbar-brand" href="{{ route('home') }}">
        <img class="navbar-brand ml-5" style="height: 57px;"
            src="{{ my_asset('img/header_dan_footer/icon/logonav.png') }}">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button> --}}
    {{-- <div class="row py-1 px-1 mr-2"
        style="border-color:#F1F1F1;border-style:solid;width:60%;border-radius:6px">
        <input class="form-control" id="inputSearchNav" style="width:762px;border:none;border-radius:6px" type="search"
            placeholder="Cari Produk" aria-label="Search">
        <div class="btn btn-search">
            <a href="{{ route('suggestion.search', 'slug') }}" class="nav-box-link" id="btnSearchNav">
                <img src="{{ my_asset('img/header_dan_footer/icon/search.png') }}"> </img>
            </a>
        </div>
    </div> --}}


    {{-- @auth --}}
    {{-- <i id="" type="button" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false" class="fa fa-bell-o " aria-hidden="true"></i>

    <a href="{{ route('wishlists.index') }}" style="color:black">
        <i id="" type="button" aria-haspopup="true" aria-expanded="false" class="fa fa-heart-o icon-footer"
            aria-hidden="true"></i>
    </a>

    <a href="{{ route('cart') }}">
        <i class="ml-3 mr-3" id="" type="button" aria-haspopup="true" aria-expanded="false">
            <img style="width:20px; height:20px ml-2 mr-2" src="{{ my_asset('img/header_dan_footer/icon/bag.png') }}">
        </i>
        @if (Session::has('cart'))
            <span id="cart_items_sidenav">{{ count(Session::get('cart')) }}</span>
            @else
            <span id="cart_items_sidenav">0</span>
        @endif
    </a> --}}

    {{-- <div class="btn-group" role="group">
        <i class="fa fa-user-o icon-footer" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false"></i> --}}

        {{-- <div class="dropdown-menu pb-0"
            style="width: 240px; border-radius: 20px; top: 70px; left: -80px; border: 2px #000;"
            aria-labelledby="btnGroupDrop1">
            @auth
            <div class="row">
                <div class="ml-4 mr-2 pr-0">
                    <img class="profile-icon"
                        src="{{ Auth::user()->avatar_original != null ? my_asset(Auth::user()->avatar_original) : my_asset('img/header_dan_footer/icon/fb.png') }}"
                        alt="">
                </div>
                <div class="col pl-0 mt-2" style="width:20px; text-align:left;">
                    <p class="dd-profile pb-0 pl-0 mt-2 mb-2 mr-2" style="text-transform:capitalize">
                        {{ Auth::user()->name }}
                    </p>
                    <span class="text-dd-profile">{{ $point }}</span><span class="ml-2">point</span>
                </div>
            </div>
            <a class="dropdown-item" href="{{ route('profile') }}">Akun Saya</a>
            <hr class=" mt-0 mb-0 mr-2 ml-2">
            <a class="dropdown-item" href="{{ route('purchase_history.index') }}">Pesanan</a>
            <hr class=" mt-0 mb-0 mr-2 ml-2">
            @if (Auth::user()->user_type == 'regular physician')
                <a class="dropdown-item" href="{{ route('membership') }}">Membership</a>
                <hr class=" mt-0 mb-0 mr-2 ml-2">
            @endif
            <a class="dropdown-item" style="background-color:#3B6CB6; color:#fff"
                href="{{ route('logout') }}">Logout</a>
            @else
            <a type="button" href="{{ route('user.login') }}" class="dropdown-item mt-3" role="button">Login</a>
            <a href="{{ route('user.registration') }}" class="dropdown-item" type="button" role="button">Daftar</a>
            <a href="{{ route('user.registration', 'physician') }}" class="dropdown-item" type="button"
                role="button">Daftar Physician</a>
            @endauth

        </div> --}}
        <!-- <a  class="btn btn-outline-success mr-2 my-sm-2" type="button" role="button">Logout</a> -->
        {{--
    </div> --}}
    {{-- @else
    <a href="{{ route('user.login') }}" class="btn btn-primary mr-2" style="width:80px">Login</a>
    <a href="{{ route('user.registration') }}" class="btn btn-outline-primary" style="width:80px">Daftar</a>
    @endauth --}}
    {{--
    <!-- <li>
                <a href="{{ route('dashboard') }}" class="top-bar-item">{{ translate('My Panel') }}</a>
            </li> -->
    <!-- <li>
                <a href="{{ route('logout') }}" class="top-bar-item">{{ translate('Logout') }}</a>
            </li> -->

    <!-- <li>
                <a href="{{ route('user.login') }}" class="top-bar-item">{{ translate('Login') }}</a>
            </li>
            <li>
                <a href="{{ route('user.registration') }}" class="top-bar-item">{{ translate('Registration') }}</a>
            </li> -->

    <!-- <a type="button" href="{{ route('user.login') }}" class="btn btn-primary mr-2" role="button">Login</a>
        <a href="{{ route('user.registration') }}" class="btn btn-outline-primary mr-2 my-sm-2" type="button" role="button">Daftar</a>      -->
    --}}
    {{--
</nav> --}}
{{--
<!-- <div class="header bg-white"> -->
<!-- Top Bar -->
<!-- <div class="top-navbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col">
                    <ul class="inline-links d-lg-inline-block d-flex justify-content-between">
                        <li class="dropdown" id="lang-change">
                            @php
                                if(Session::has('locale')){
                                    $locale = Session::get('locale', Config::get('app.locale'));
                                }
                                else{
                                    $locale = 'en';
                                }
                            @endphp
                            <a href="" class="dropdown-toggle top-bar-item" data-toggle="dropdown">
                                <img src="{{ my_asset('frontend/images/placeholder.jpg') }}" height="11" data-src="{{ my_asset('frontend/images/icons/flags/' . $locale . '.png') }}" class="flag lazyload" alt="{{ \App\Language::where('code', $locale)->first()->name }}" height="11"><span class="language">{{ \App\Language::where('code', $locale)->first()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                @foreach (\App\Language::all() as $key => $language)
                                    <li class="dropdown-item @if ($locale == $language) active @endif">
                                        <a href="#" data-flag="{{ $language->code }}"><img src="{{ my_asset('frontend/images/placeholder.jpg') }}" data-src="{{ my_asset('frontend/images/icons/flags/' . $language->code . '.png') }}" class="flag lazyload" alt="{{ $language->name }}" height="11"><span class="language">{{ $language->name }}</span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="dropdown" id="currency-change">
                            @php
                                if(Session::has('currency_code')){
                                    $currency_code = Session::get('currency_code');
                                }
                                else{
                                    $currency_code = \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
                                }
                            @endphp
                            <a href="" class="dropdown-toggle top-bar-item" data-toggle="dropdown">
                                {{ \App\Currency::where('code', $currency_code)->first()->name }} {{ \App\Currency::where('code', $currency_code)->first()->symbol }}
                            </a>
                            <ul class="dropdown-menu">
                                @foreach (\App\Currency::where('status', 1)->get() as $key => $currency)
                                    <li class="dropdown-item @if ($currency_code == $currency->code) active @endif">
                                        <a href="" data-currency="{{ $currency->code }}">{{ $currency->name }} ({{ $currency->symbol }})</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>

                <div class="col-5 text-right d-none d-lg-block">
                    <ul class="inline-links">
                        <li>
                            <a href="{{ route('orders.track') }}" class="top-bar-item">{{ translate('Track Order') }}</a>
                        </li>
                        @auth
                        <li>
                            <a href="{{ route('dashboard') }}" class="top-bar-item">{{ translate('My Panel') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" class="top-bar-item">{{ translate('Logout') }}</a>
                        </li>
                        @else
                        <li>
                            <a href="{{ route('user.login') }}" class="top-bar-item">{{ translate('Login') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('user.registration') }}" class="top-bar-item">{{ translate('Registration') }}</a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </div>
    </div> -->
<!-- END Top Bar -->

<!-- mobile menu -->
<!-- <div class="mobile-side-menu d-lg-none">
        <div class="side-menu-overlay opacity-0" onclick="sideMenuClose()"></div>
        <div class="side-menu-wrap opacity-0">
            <div class="side-menu closed">
                <div class="side-menu-header ">
                    <div class="side-menu-close" onclick="sideMenuClose()">
                        <i class="la la-close"></i>
                    </div>

                    @auth
                        <div class="widget-profile-box px-3 py-4 d-flex align-items-center">
                            @if (Auth::user()->avatar_original != null)
                                <div class="image " style="background-image:url('{{ my_asset(Auth::user()->avatar_original) }}')"></div>
                            @else
                                <div class="image " style="background-image:url('{{ my_asset('frontend/images/user.png') }}')"></div>
                            @endif

                            <div class="name">{{ Auth::user()->name }}</div>
                        </div>
                        <div class="side-login px-3 pb-3">
                            <a href="{{ route('logout') }}">{{ translate('Sign Out') }}</a>
                        </div>
                    @else
                        <div class="widget-profile-box px-3 py-4 d-flex align-items-center">
                                <div class="image " style="background-image:url('{{ my_asset('frontend/images/icons/user-placeholder.jpg') }}')"></div>
                        </div>
                        <div class="side-login px-3 pb-3">
                            <a href="{{ route('user.login') }}">{{ translate('Sign In') }}</a>
                            <a href="{{ route('user.registration') }}">{{ translate('Registration') }}</a>
                        </div>
                    @endauth
                </div>
                <div class="side-menu-list px-3">
                    <ul class="side-user-menu">
                        <li>
                            <a href="{{ route('home') }}">
                                <i class="la la-home"></i>
                                <span>{{ translate('Home') }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('dashboard') }}">
                                <i class="la la-dashboard"></i>
                                <span>{{ translate('Dashboard') }}</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('purchase_history.index') }}">
                                <i class="la la-file-text"></i>
                                <span>{{ translate('Purchase History') }}</span>
                            </a>
                        </li>
                        @auth
                            @php
                                $conversation = \App\Conversation::where('sender_id', Auth::user()->id)->where('sender_viewed', '1')->get();
                            @endphp
                            @if (\App\BusinessSetting::where('type', 'conversation_system')->first()->value == 1)
                                <li>
                                    <a href="{{ route('conversations.index') }}" class="{{ areActiveRoutesHome(['conversations.index', 'conversations.show']) }}">
                                        <i class="la la-comment"></i>
                                        <span class="category-name">
                                            {{ translate('Conversations') }}
                                            @if (count($conversation) > 0)
                                                <span class="ml-2" style="color:green"><strong>({{ count($conversation) }})</strong></span>
                                            @endif
                                        </span>
                                    </a>
                                </li>
                            @endif
                        @endauth
                        <li>
                            <a href="{{ route('compare') }}">
                                <i class="la la-refresh"></i>
                                <span>{{ translate('Compare') }}</span>
                                @if (Session::has('compare'))
                                    <span class="badge" id="compare_items_sidenav">{{ count(Session::get('compare')) }}</span>
                                @else
                                    <span class="badge" id="compare_items_sidenav">0</span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('cart') }}">
                                <i class="la la-shopping-cart"></i>
                                <span>{{ translate('Cart') }}</span>
                                @if (Session::has('cart'))
                                    <span class="badge" id="cart_items_sidenav">{{ count(Session::get('cart')) }}</span>
                                @else
                                    <span class="badge" id="cart_items_sidenav">0</span>
                                @endif
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('wishlists.index') }}">
                                <i class="la la-heart-o"></i>
                                <span>{{ translate('Wishlist') }}</span>
                            </a>
                        </li>

                        @if (\App\BusinessSetting::where('type', 'classified_product')->first()->value == 1)
                        <li>
                            <a href="{{ route('customer_products.index') }}">
                                <i class="la la-diamond"></i>
                                <span>{{ translate('Classified Products') }}</span>
                            </a>
                        </li>
                        @endif

                        @if (\App\BusinessSetting::where('type', 'wallet_system')->first()->value == 1)
                            <li>
                                <a href="{{ route('wallet.index') }}">
                                    <i class="la la-dollar"></i>
                                    <span>{{ translate('My Wallet') }}</span>
                                </a>
                            </li>
                        @endif

                        <li>
                            <a href="{{ route('profile') }}">
                                <i class="la la-user"></i>
                                <span>{{ translate('Manage Profile') }}</span>
                            </a>
                        </li>

                        @php
                        $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
                        $club_point_addon = \App\Addon::where('unique_identifier', 'club_point')->first();
                        @endphp
                        @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                            <li>
                                <a href="{{ route('customer_refund_request') }}" class="{{ areActiveRoutesHome(['customer_refund_request']) }}">
                                    <i class="la la-file-text"></i>
                                    <span class="category-name">
                                        {{ translate('Sent Refund Request') }}
                                    </span>
                                </a>
                            </li>
                        @endif

                        @if ($club_point_addon != null && $club_point_addon->activated == 1)
                            <li>
                                <a href="{{ route('earnng_point_for_user') }}" class="{{ areActiveRoutesHome(['earnng_point_for_user']) }}">
                                    <i class="la la-dollar"></i>
                                    <span class="category-name">
                                        {{ translate('Earning Points') }}
                                    </span>
                                </a>
                            </li>
                        @endif

                        <li>
                            <a href="{{ route('support_ticket.index') }}" class="{{ areActiveRoutesHome(['support_ticket.index', 'support_ticket.show']) }}">
                                <i class="la la-support"></i>
                                <span class="category-name">
                                    {{ translate('Support Ticket') }}
                                </span>
                            </a>
                        </li>

                    </ul>
                    @if (Auth::check() && Auth::user()->user_type == 'seller')
                        <div class="sidebar-widget-title py-0">
                            <span>{{ translate('Shop Options') }}</span>
                        </div>
                        <ul class="side-seller-menu">
                            <li>
                                <a href="{{ route('seller.products') }}">
                                    <i class="la la-diamond"></i>
                                    <span>{{ translate('Products') }}</span>
                                </a>
                            </li>

                            @if (\App\Addon::where('unique_identifier', 'pos_system')->first() != null && \App\Addon::where('unique_identifier', 'pos_system')->first()->activated)
                                <li>
                                    <a href="{{ route('poin-of-sales.seller_index') }}">
                                        <i class="la la-fax"></i>
                                        <span>
                                            {{ translate('POS Manager') }}
                                        </span>
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ route('orders.index') }}">
                                    <i class="la la-file-text"></i>
                                    <span>{{ translate('Orders') }}</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('shops.index') }}">
                                    <i class="la la-cog"></i>
                                    <span>{{ translate('Shop Setting') }}</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('withdraw_requests.index') }}">
                                    <i class="la la-money"></i>
                                    <span>
                                        {{ translate('Money Withdraw') }}
                                    </span>
                                </a>
                            </li>

                            @php
                                $conversation = \App\Conversation::where('receiver_id', Auth::user()->id)->where('receiver_viewed', '1')->get();
                            @endphp
                            @if (\App\BusinessSetting::where('type', 'conversation_system')->first()->value == 1)
                                <li>
                                    <a href="{{ route('conversations.index') }}" class="{{ areActiveRoutesHome(['conversations.index', 'conversations.show']) }}">
                                        <i class="la la-comment"></i>
                                        <span class="category-name">
                                            {{ translate('Conversations') }}
                                            @if (count($conversation) > 0)
                                                <span class="ml-2" style="color:green"><strong>({{ count($conversation) }})</strong></span>
                                            @endif
                                        </span>
                                    </a>
                                </li>
                            @endif

                            <li>
                                <a href="{{ route('payments.index') }}">
                                    <i class="la la-cc-mastercard"></i>
                                    <span>{{ translate('Payment History') }}</span>
                                </a>
                            </li>
                        </ul>
                        <div class="sidebar-widget-title py-0">
                            <span>{{ translate('Earnings') }}</span>
                        </div>
                        <div class="widget-balance py-3">
                            <div class="text-center">
                                <div class="heading-4 strong-700 mb-4">
                                    @php
                                        $orderDetails = \App\OrderDetail::where('seller_id', Auth::user()->id)->where('created_at', '>=', date('-30d'))->get();
                                        $total = 0;
                                        foreach ($orderDetails as $key => $orderDetail) {
                                            if($orderDetail->order != null && $orderDetail->order != null && $orderDetail->order->payment_status == 'paid'){
                                                $total += $orderDetail->price;
                                            }
                                        }
                                    @endphp
                                    <small class="d-block text-sm alpha-5 mb-2">{{ translate('Your earnings (current month)') }}</small>
                                    <span class="p-2 bg-base-1 rounded">{{ single_price($total) }}</span>
                                </div>
                                <table class="text-left mb-0 table w-75 m-auto">
                                    <tbody>
                                        <tr>
                                            @php
                                                $orderDetails = \App\OrderDetail::where('seller_id', Auth::user()->id)->get();
                                                $total = 0;
                                                foreach ($orderDetails as $key => $orderDetail) {
                                                    if($orderDetail->order != null && $orderDetail->order->payment_status == 'paid'){
                                                        $total += $orderDetail->price;
                                                    }
                                                }
                                            @endphp
                                            <td class="p-1 text-sm">
                                                {{ translate('Total earnings') }}:
                                            </td>
                                            <td class="p-1">
                                                {{ single_price($total) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            @php
                                                $orderDetails = \App\OrderDetail::where('seller_id', Auth::user()->id)->where('created_at', '>=', date('-60d'))->where('created_at', '<=', date('-30d'))->get();
                                                $total = 0;
                                                foreach ($orderDetails as $key => $orderDetail) {
                                                    if($orderDetail->order != null && $orderDetail->order->payment_status == 'paid'){
                                                        $total += $orderDetail->price;
                                                    }
                                                }
                                            @endphp
                                            <td class="p-1 text-sm">
                                                {{ translate('Last Month earnings') }}:
                                            </td>
                                            <td class="p-1">
                                                {{ single_price($total) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif -->
<!-- <div class="sidebar-widget-title py-0">
                        <span>Categories</span>
                    </div>
                    <ul class="side-seller-menu">
                        @foreach (\App\Category::all() as $key => $category)
                            <li>
                            <a href="{{ route('products.category', $category->slug) }}" class="text-truncate">
                                <img class="cat-image lazyload" src="{{ my_asset('frontend/images/placeholder.jpg') }}" data-src="{{ my_asset($category->icon) }}" width="13" alt="{{ __($category->name) }}">
                                <span>{{ __($category->name) }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul> -->
<!-- </div>
            </div>
        </div>
    </div> -->
<!-- end mobile menu -->

<!-- <div class="position-relative logo-bar-area">
        <div class="">
            <div class="container">
                <div class="row no-gutters align-items-center">
                    <div class="col-lg-3 col-8">
                        <div class="d-flex">
                            <div class="d-block d-lg-none mobile-menu-icon-box"> -->
<!-- Navbar toggler  -->
<!-- <a href="" onclick="sideMenuOpen(this)">
                                    <div class="hamburger-icon">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                            </div> -->

<!-- Brand/Logo -->
<!-- <a class="navbar-brand w-100" href="{{ route('home') }}">
                                @php
                                    $generalsetting = \App\GeneralSetting::first();
                                @endphp
                                @if ($generalsetting->logo != null)
                                    <img src="{{ my_asset($generalsetting->logo) }}" alt="{{ env('APP_NAME') }}">
                                @else
                                    <img src="{{ my_asset('frontend/images/logo/logo.png') }}" alt="{{ env('APP_NAME') }}">
                                @endif
                            </a>

                            @if (Route::currentRouteName() != 'home' && Route::currentRouteName() != 'categories.all')
                                <div class="d-none d-xl-block category-menu-icon-box">
                                    <div class="dropdown-toggle navbar-light category-menu-icon" id="category-menu-icon">
                                        <span class="navbar-toggler-icon"></span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-9 col-4 position-static">
                        <div class="d-flex w-100">
                            <div class="search-box flex-grow-1 px-4">
                                <form action="{{ route('search') }}" method="GET">
                                    <div class="d-flex position-relative">
                                        <div class="d-lg-none search-box-back">
                                            <button class="" type="button"><i class="la la-long-arrow-left"></i></button>
                                        </div>
                                        <div class="w-100">
                                            <input type="text" aria-label="Search" id="search" name="q" class="w-100" placeholder="{{ translate('I am shopping for...') }}" autocomplete="off">
                                        </div>
                                        <div class="form-group category-select d-none d-xl-block">
                                            <select class="form-control selectpicker" name="category">
                                                <option value="">{{ translate('All Categories') }}</option>
                                                @foreach (\App\Category::all() as $key => $category)
                                                <option value="{{ $category->slug }}"
                                                    @isset($category_id)
                                                        @if ($category_id == $category->id)
                                                            selected
                                                        @endif
                                                    @endisset
                                                    >{{ __($category->name) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button class="d-none d-lg-block" type="submit">
                                            <i class="la la-search la-flip-horizontal"></i>
                                        </button>
                                        <div class="typed-search-box d-none">
                                            <div class="search-preloader">
                                                <div class="loader"><div></div><div></div><div></div></div>
                                            </div>
                                            <div class="search-nothing d-none">

                                            </div>
                                            <div id="search-content">

                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>

                            <div class="logo-bar-icons d-inline-block ml-auto">
                                <div class="d-inline-block d-lg-none">
                                    <div class="nav-search-box">
                                        <a href="#" class="nav-box-link">
                                            <i class="la la-search la-flip-horizontal d-inline-block nav-box-icon"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="d-none d-lg-inline-block">
                                    <div class="nav-compare-box" id="compare">
                                        <a href="{{ route('compare') }}" class="nav-box-link">
                                            <i class="la la-refresh d-inline-block nav-box-icon"></i>
                                            <span class="nav-box-text d-none d-xl-inline-block">{{ translate('Compare') }}</span>
                                            @if (Session::has('compare'))
                                                <span class="nav-box-number">{{ count(Session::get('compare')) }}</span>
                                            @else
                                                <span class="nav-box-number">0</span>
                                            @endif
                                        </a>
                                    </div>
                                </div>
                                <div class="d-none d-lg-inline-block">
                                    <div class="nav-wishlist-box" id="wishlist">
                                        <a href="{{ route('wishlists.index') }}" class="nav-box-link">
                                            <i class="la la-heart-o d-inline-block nav-box-icon"></i>
                                            <span class="nav-box-text d-none d-xl-inline-block">{{ translate('Wishlist') }}</span>
                                            @if (Auth::check())
                                                <span class="nav-box-number">{{ count(Auth::user()->wishlists) }}</span>
                                            @else
                                                <span class="nav-box-number">0</span>
                                            @endif
                                        </a>
                                    </div>
                                </div>
                                <div class="d-inline-block" data-hover="dropdown">
                                    <div class="nav-cart-box dropdown" id="cart_items">
                                        <a href="" class="nav-box-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="la la-shopping-cart d-inline-block nav-box-icon"></i>
                                            <span class="nav-box-text d-none d-xl-inline-block">{{ translate('Cart') }}</span>
                                            @if (Session::has('cart'))
                                                <span class="nav-box-number">{{ count(Session::get('cart')) }}</span>
                                            @else
                                                <span class="nav-box-number">0</span>
                                            @endif
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right px-0">
                                            <li>
                                                <div class="dropdown-cart px-0">
                                                    @if (Session::has('cart'))
                                                        @if (count($cart = Session::get('cart')) > 0)
                                                            <div class="dc-header">
                                                                <h3 class="heading heading-6 strong-700">{{ translate('Cart Items') }}</h3>
                                                            </div>
                                                            <div class="dropdown-cart-items c-scrollbar">
                                                                @php
                                                                    $total = 0;
                                                                @endphp
                                                                @foreach ($cart as $key => $cartItem)
                                                                    @php
                                                                        $product = \App\Product::find($cartItem['id']);
                                                                        $total = $total + $cartItem['price']*$cartItem['quantity'];
                                                                    @endphp
                                                                    <div class="dc-item">
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="dc-image">
                                                                                <a href="{{ route('product', $product->slug) }}">
                                                                                    <img src="{{ my_asset('frontend/images/placeholder.jpg') }}" data-src="{{ my_asset($product->thumbnail_img) }}" class="img-fluid lazyload" alt="{{ __($product->name) }}">
                                                                                </a>
                                                                            </div>
                                                                            <div class="dc-content">
                                                                                <span class="d-block dc-product-name text-capitalize strong-600 mb-1">
                                                                                    <a href="{{ route('product', $product->slug) }}">
                                                                                        {{ __($product->name) }}
                                                                                    </a>
                                                                                </span>

                                                                                <span class="dc-quantity">x{{ $cartItem['quantity'] }}</span>
                                                                                <span class="dc-price">{{ single_price($cartItem['price'] * $cartItem['quantity']) }}</span>
                                                                            </div>
                                                                            <div class="dc-actions">
                                                                                <button onclick="removeFromCart({{ $key }})">
                                                                                    <i class="la la-close"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <div class="dc-item py-3">
                                                                <span class="subtotal-text">{{ translate('Subtotal') }}</span>
                                                                <span class="subtotal-amount">{{ single_price($total) }}</span>
                                                            </div>
                                                            <div class="py-2 text-center dc-btn">
                                                                <ul class="inline-links inline-links--style-3">
                                                                    <li class="px-1">
                                                                        <a href="{{ route('cart') }}" class="link link--style-1 text-capitalize btn btn-base-1 px-3 py-1">
                                                                            <i class="la la-shopping-cart"></i> {{ translate('View cart') }}
                                                                        </a>
                                                                    </li>
                                                                    @if (Auth::check())
                                                                    <li class="px-1">
                                                                        <a href="{{ route('checkout.shipping_info') }}" class="link link--style-1 text-capitalize btn btn-base-1 px-3 py-1 light-text">
                                                                            <i class="la la-mail-forward"></i> {{ translate('Checkout') }}
                                                                        </a>
                                                                    </li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        @else
                                                            <div class="dc-header">
                                                                <h3 class="heading heading-6 strong-700">{{ translate('Your Cart is empty') }}</h3>
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div class="dc-header">
                                                            <h3 class="heading heading-6 strong-700">{{ translate('Your Cart is empty') }}</h3>
                                                        </div>
                                                    @endif
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hover-category-menu" id="hover-category-menu">
            <div class="container">
                <div class="row no-gutters position-relative">
                    <div class="col-lg-3 position-static">
                        <div class="category-sidebar" id="category-sidebar">
                            <div class="all-category">
                                <span>{{ translate('CATEGORIES') }}</span>
                                <a href="{{ route('categories.all') }}" class="d-inline-block">{{ translate('See All') }} ></a>
                            </div>
                            <ul class="categories">
                                @foreach (\App\Category::all()->take(11) as $key => $category)
                                    @php
                                        $brands = array();
                                    @endphp
                                    <li class="category-nav-element" data-id="{{ $category->id }}">
                                        <a href="{{ route('products.category', $category->slug) }}">
                                            <img class="cat-image lazyload" src="{{ my_asset('frontend/images/placeholder.jpg') }}" data-src="{{ my_asset($category->icon) }}" width="30" alt="{{ __($category->name) }}">
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

                </div>
            </div>
        </div>
    </div> -->
<!-- Navbar -->

<!-- <div class="main-nav-area d-none d-lg-block">
        <nav class="navbar navbar-expand-lg navbar--bold navbar--style-2 navbar-light bg-default">
            <div class="container">
                <div class="collapse navbar-collapse align-items-center justify-content-center" id="navbar_main">
                    <ul class="navbar-nav">
                        @foreach (\App\Search::orderBy('count', 'desc')
        ->get()
        ->take(5)
    as $key => $search)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('suggestion.search', $search->query) }}">{{ $search->query }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>
    </div> 
    </div>-->
--}}
