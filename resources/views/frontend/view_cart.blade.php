@extends('frontend.layouts.app')

@section('content')

   {{-- <!-- <section class="slice-xs sct-color-2 border-bottom">
        <div class="container container-sm">
            <div class="row cols-delimited justify-content-center">
                <div class="col">
                    <div class="icon-block icon-block--style-1-v5 text-center active">
                        <div class="block-icon mb-0">
                            <i class="la la-shopping-cart"></i>
                        </div>
                        <div class="block-content d-none d-md-block">
                            <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">{{ translate('1. My Cart')}}</h3>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="icon-block icon-block--style-1-v5 text-center">
                        <div class="block-icon c-gray-light mb-0">
                            <i class="la la-map-o"></i>
                        </div>
                        <div class="block-content d-none d-md-block">
                            <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">{{ translate('2. Shipping info')}}</h3>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="icon-block icon-block--style-1-v5 text-center">
                        <div class="block-icon mb-0 c-gray-light">
                            <i class="la la-truck"></i>
                        </div>
                        <div class="block-content d-none d-md-block">
                            <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">{{ translate('3. Delivery info')}}</h3>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="icon-block icon-block--style-1-v5 text-center">
                        <div class="block-icon c-gray-light mb-0">
                            <i class="la la-credit-card"></i>
                        </div>
                        <div class="block-content d-none d-md-block">
                            <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">{{ translate('4. Payment')}}</h3>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="icon-block icon-block--style-1-v5 text-center">
                        <div class="block-icon c-gray-light mb-0">
                            <i class="la la-check-circle"></i>
                        </div>
                        <div class="block-content d-none d-md-block">
                            <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">{{ translate('5. Confirmation')}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->--}}
    <!-- <section class="section-sub-head"></section> -->
    {{--
        <section class="section-detail-produk">
            <div class="container mb-5">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb mb-5">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" style="color:#3BB6B1" aria-current="page">Keranjang Belanda</li>
                    </ul>
                </nav>
                <div class="row">
                    <div class="col-lg-7" >
                        <div class="card">
                            <div class="card-header bg-white">
                                <span class="cart-head-left p-2">Keranjang Belanja</span>
                            </div>
                            <div class="card-body" >
                                <div class="d-flex bd-highlight pb-2">
                                    <div class="nav-keranjang p-2 col-5">Nama</div>
                                    <div class="nav-keranjang p-2 mx-2 col-3 text-center">Jumlah</div>
                                    <div class="nav-keranjang p-2 mx-2 col-3 text-center">Harga</div>
                                </div>
                                    @php
                                    $total = 0;
                                    @endphp
                                    @if(Session::has('cart'))
                                    @foreach (Session::get('cart') as $key => $cartItem)
                                        @php
                                            $product = \App\Product::find($cartItem['id']);
                                            $total = $total + $cartItem['price']*$cartItem['quantity'];
                                            $product_name_with_choice = $product->name;
                                            if ($cartItem['variant'] != null) {
                                                $product_name_with_choice = $product->name.' - '.$cartItem['variant'];
                                            }
                                            // if(isset($cartItem['color'])){
                                            //     $product_name_with_choice .= ' - '.\App\Color::where('code', $cartItem['color'])->first()->name;
                                            // }
                                            // foreach (json_decode($product->choice_options) as $choice){
                                            //     $str = $choice->name; // example $str =  choice_0
                                            //     $product_name_with_choice .= ' - '.$cartItem[$str];
                                            // }
                                        @endphp
                                        <div class="produk-card__ border-top border-bottom py-2 align-items-center">
                                            <div class="d-flex bd-highlight">
                                                <div class="p-2 col-5">
                                                    <table>
                                                        <tr>
                                                            <td>
                                                                <img class="img-cart-produk__" src="{{my_asset('/images/fb.png')}}"
                                                                    alt="">
                                                            </td>
                                                            <td class="pl-3">
                                                                <span class="name-produk-cart__">Amosssxicillin 500 Mg 10 Kaplet</span>
                                                                <div class="tipe-produk__ mt-1">
                                                                    <span>Per Strip</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="p-2 mx-3 col-3 text-center">
                                                    <div class="qty__cart">
                                                        <div id="field1" class="d-flex align-items-center ">
                                                            <button type="button" id="sub"
                                                                class="sub justify-content-center align-items-center"><i
                                                                    class="fa fa-minus"></i></button>
                                                            <input class="qty__number text-center mx-1" type="text" id="1" value="1"
                                                                min="1" max="12" readonly />
                                                            <button type="button" id="add"
                                                                class="add  justify-content-center align-items-center"><i
                                                                    class="fa fa-plus"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="p-2 mx-3 col-3 text-center">
                                                    <table>
                                                        <tr>
                                                            <td><span class="harga-cart">Rp 9.000</span></td>
                                                            <th class="pl-4"><a href=""><i class="fa fa-trash-o"
                                                            aria-hidden="true" style="font-size: 18px;  color: #424242 ;"></i>
                                                            </a></th>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="dicount-cart__">
                                                                    <span>Rp 12.000</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    @endif
                                <div class="produk-card__ border-top border-bottom py-2 align-items-center">
                                    <div class="d-flex bd-highlight">
                                        <div class="p-2 col-5">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <img class="img-cart-produk__" src="{{my_asset('/images/fb.png')}}"
                                                            alt="">
                                                    </td>
                                                    <td class="pl-3">
                                                        <span class="name-produk-cart__">Amoxicillin 500 Mg 10 Kaplet</span>
                                                        <div class="tipe-produk__ mt-1">
                                                            <span>Per Strip</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="p-2 mx-3 col-3 text-center">
                                            <div class="qty__cart">
                                                <div id="field1" class="d-flex align-items-center ">
                                                    <button type="button" id="sub"
                                                        class="sub justify-content-center align-items-center"><i
                                                            class="fa fa-minus"></i></button>
                                                    <input class="qty__number text-center mx-1" type="text" id="1" value="1"
                                                        min="1" max="12" readonly />
                                                    <button type="button" id="add"
                                                        class="add  justify-content-center align-items-center"><i
                                                            class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-2 mx-3 col-3 text-center">
                                            <table>
                                                <tr>
                                                    <td><span class="harga-cart">Rp 9.000</span></td>
                                                    <th class="pl-4"><a href=""><i class="fa fa-trash-o"
                                                    aria-hidden="true" style="font-size: 18px;  color: #424242 ;"></i>
                                                    </a></th>
                                                <tr>
                                                    <td>
                                                        <div class="dicount-cart__">
                                                            <span>Rp 12.000</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="btn-add-address" style="border-bottom:1px solid #C4C4C4; border-top: 1px solid#c4c4c4;">
                                <a href="">
                                    <li class="mb-2 mt-2" style="padding-left: 5%; padding-right: 5%; list-style-type: none; color: #006064;">+ Tambah</li>
                                </a>    
                            </div>
                        </div>
                        <!-- end -->
                    </div>

                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-header bg-white pt-4">
                                <span class="text-info-keranjang">Tukar Poin</span>
                                <div class="point-cart__">
                                    <span>Poin Anda : 25.000</span>
                                </div>
                                <form>
                                    <div class="form-row align-items-center">
                                        <div class="col-8">
                                            <input type="text" class="form-control" id="inlineFormInputName2"
                                                placeholder="Masukkan Poin Anda">
                                        </div>
                                        <div class="col-4 my-3">
                                            <button type="submit" class="btn btn-primary1 px-4">Pakai</button>
                                        </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <span class="rincian-cart__">Rincian Pembayaran</span>
                                <div class="detail-total-cart__ mt-2">
                                    <table style="width: 100%;">
                                        <tr>
                                            <td class="text-info-keranjang">Subtotal</td>
                                            <td class="detail-table__">Rp 14.000</td>
                                        </tr>
                                        <tr>
                                            <td class="text-info-keranjang">Tukar Poin</td>
                                            <td class="detail-table__">Rp -500</td>
                                        </tr>
                                        <tr>
                                            <td class="total-cart__">Total</td>
                                            <td class="detail-table__ total-cart__">Rp 13.500</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <table style="width: 100%;">
                                    <tr>
                                        <td class="text-info-keranjang">Poin yang akan didapat</td>
                                        <td class="detail-table__ cart-point-plus__">+28</td>
                                    </tr>
                                </table>
                                <div class="text-right my-3">
                                    <button class="btn btn-primary1">Lanjutkan Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    --}}
    <section class="py-4 bg-white" id="cart-summary">
        <div class=" container">
            @if(Session::has('cart'))
                <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="card col-xl-8 mb-3">
                    
                    <div class="form-default bg-white p-4">
                        <div class="">
                            <div class="">
                                <table class="table-cart border-bottom">
                                    <thead>
                                        <tr>
                                            <th class="product-image text-center"></th>
                                            <th class="product-name text-center" style="font-size: 14px;text-transform:capitalize">{{ translate('nama')}}</th>
                                            <th class="product-price d-none d-lg-table-cell text-center" style="font-size: 14px;text-transform:lowercase">{{ translate('@pcs')}}</th>
                                            <th class="product-quanity d-none d-md-table-cell text-center" style="font-size: 14px;text-transform:capitalize">{{ translate('Jumlah')}}</th>
                                            <th class="product-total text-center" style="font-size: 14px;text-transform:capitalize">{{ translate('Total Harga')}}</th>
                                            <th class="product-remove text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $total = 0;
                                        @endphp
                                        @if(Session::has('cart'))
                                        @foreach (Session::get('cart') as $key => $cartItem)
                                            @php
                                                $product = \App\Product::find($cartItem['id']);
                                                $total = $total + $cartItem['price']*$cartItem['quantity'];
                                                $product_name_with_choice = $product->name;
                                                if ($cartItem['variant'] != null) {
                                                    $product_name_with_choice = $product->name.' - '.$cartItem['variant'];
                                                }
                                                // if(isset($cartItem['color'])){
                                                //     $product_name_with_choice .= ' - '.\App\Color::where('code', $cartItem['color'])->first()->name;
                                                // }
                                                // foreach (json_decode($product->choice_options) as $choice){
                                                //     $str = $choice->name; // example $str =  choice_0
                                                //     $product_name_with_choice .= ' - '.$cartItem[$str];
                                                // }

                                                $qty = 0;
                                                if($product->variant_product){
                                                    foreach ($product->stocks as $key => $stock) {
                                                        $qty += $stock->qty;
                                                    }
                                                }
                                                else{
                                                    $qty = $product->current_stock;
                                                }
                                            @endphp
                                            <tr class="cart-item">
                                                <td class="product-image">
                                                    <a href="#" class="mr-3">
                                                        <img loading="lazy"  src="{{ my_asset($product->thumbnail_img) }}">
                                                    </a>
                                                </td>

                                                <td class="product-name">
                                                    <span class="pr-4 d-block">{{ $product_name_with_choice }}</span>
                                                </td>

                                                <td class="product-price d-none d-lg-table-cell">
                                                    <span class="pr-3 d-block">{{ single_price($cartItem['price']) }}</span>
                                                </td>

                                                <td class="product-quantity d-none d-md-table-cell">
                                                    @if($cartItem['digital'] != 1)
                                                        {{--
                                                            <div class="input-group input-group--style-2 pr-4" style="width: 130px;">
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-number" type="button" data-type="minus" data-field="quantity[{{ $key }}]">
                                                                        <i class="la la-minus"></i>
                                                                    </button>
                                                                </span>
                                                                <input type="text" id="qouwah" name="quantity[{{ $key }}]" class="form-control h-auto input-number" placeholder="1" value="{{ $cartItem['quantity'] }}" min="1" max="10" data-key="{{ $key }}" onchange="updateQuantity({{$key}},this)">
                                                                <span class="input-group-btn">
                                                                    <button class="btn btn-number" type="button" data-type="plus" data-field="quantity[{{ $key }}]">
                                                                        <i class="la la-plus"></i>
                                                                    </button>
                                                                </span>
                                                            </div>
                                                        --}}
                                                        <div class="p-2 mx-3 col-3 text-center">
                                                            <div class="qty__cart">
                                                                <div id="field1" class="d-flex align-items-center ">
                                                                    <button class="btn btn-number sub justify-content-center align-items-center" type="button" data-type="minus" data-field="quantity[{{ $key }}]">
                                                                        <i class="fa fa-minus"></i>
                                                                     </button>
                                                                    <input type="text" id="quantity{{ $key }}" name="quantity[{{ $key }}]" class="qty__number text-center mx-1" placeholder="1" value="{{ $cartItem['quantity'] }}" min="1" max="{{$qty}}" data-key="{{ $key }}" onchange="updateQuantity({{$key}},this)">
                                                                    <button class="btn btn-number sub justify-content-center align-items-center" type="button" data-type="plus" data-field="quantity[{{ $key }}]">
                                                                    <i class="fa fa-plus"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="product-total">
                                                    <span>{{ single_price(($cartItem['price']+$cartItem['tax'])*$cartItem['quantity']) }}</span>
                                                </td>
                                                <td class="product-remove">
                                                    <a href="#" onclick="removeFromCartView(event, {{ $key }})" class="text-right pl-4">
                                                        <i class="la la-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="align-items-center pt-4">
                            <div class="row text-center" style="border-bottom:1px solid #C4C4C4; border-top: 1px solid#c4c4c4;">
                                @if(Auth::check())
                                    {{--<a href="{{ route('checkout.shipping_info') }}" class="btn btn-styled btn-base-1">{{ translate('Continue to Shipping')}}</a>--}}
                                        <a href="#" class="py-2" style="margin:auto; color: #006064;font-weight: bold;font-size:16px">
                                            + Tambah
                                        </a>
                                @else
                                    <button class="btn btn-styled btn-base-1" onclick="showCheckoutModal()">{{ translate('Continue to Shipping')}}</button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-6">
                            <a href="{{ route('home') }}" style="color: #006064" class="link link--style-3">
                                <i class="la la-mail-reply"></i>
                                {{ translate('Beranda')}}
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 ml-lg-auto">
                    @include('frontend.partials.cart_summary')
                </div>
            </div>
            @else
                <div class="dc-header">
                    <h3 class="heading heading-6 strong-700">{{ translate('Your Cart is empty')}}</h3>
                </div>
            @endif
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="GuestCheckout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-zoom" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">{{ translate('Login')}}</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="p-3">
                        <form class="form-default" role="form" action="{{ route('cart.login.submit') }}" method="POST">
                            @csrf
                            @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                <span>{{  translate('Use country code before number') }}</span>
                            @endif
                            <div class="form-group">
                                @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                    <input type="text" class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{ translate('Email Or Phone')}}" name="email" id="email">
                                @else
                                    <input type="email" class="form-control h-auto form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" placeholder="{{  translate('Email') }}" name="email">
                                @endif
                            </div>

                            <div class="form-group">
                                <input type="password" name="password" class="form-control h-auto form-control-lg" placeholder="{{ translate('Password')}}">
                            </div>

                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <a href="{{ route('password.request') }}" class="link link-xs link--style-3">{{ translate('Forgot password?')}}</a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn btn-styled btn-base-1 px-4">{{ translate('Sign in')}}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="text-center pt-3">
                        <p class="text-md">
                            {{ translate('Need an account?')}} <a href="{{ route('user.registration') }}" class="strong-600">{{ translate('Register Now')}}</a>
                        </p>
                    </div>
                    @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1 || \App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                        <div class="or or--1 my-3 text-center">
                            <span>{{ translate('or')}}</span>
                        </div>
                        <div class="p-3 pb-0">
                            @if (\App\BusinessSetting::where('type', 'facebook_login')->first()->value == 1)
                                <a href="{{ route('social.login', ['provider' => 'facebook']) }}" class="btn btn-styled btn-block btn-facebook btn-icon--2 btn-icon-left px-4 mb-3">
                                    <i class="icon fa fa-facebook"></i> {{ translate('Login with Facebook')}}
                                </a>
                            @endif
                            @if(\App\BusinessSetting::where('type', 'google_login')->first()->value == 1)
                                <a href="{{ route('social.login', ['provider' => 'google']) }}" class="btn btn-styled btn-block btn-google btn-icon--2 btn-icon-left px-4 mb-3">
                                    <i class="icon fa fa-google"></i> {{ translate('Login with Google')}}
                                </a>
                            @endif
                            @if (\App\BusinessSetting::where('type', 'twitter_login')->first()->value == 1)
                            <a href="{{ route('social.login', ['provider' => 'twitter']) }}" class="btn btn-styled btn-block btn-twitter btn-icon--2 btn-icon-left px-4 mb-3">
                                <i class="icon fa fa-twitter"></i> {{ translate('Login with Twitter')}}
                            </a>
                            @endif
                        </div>
                    @endif
                    @if (\App\BusinessSetting::where('type', 'guest_checkout_active')->first()->value == 1)
                        <div class="or or--1 mt-0 text-center">
                            <span>{{ translate('or')}}</span>
                        </div>
                        <div class="text-center">
                            <a href="{{ route('checkout.shipping_info') }}" class="btn btn-styled btn-base-1">{{ translate('Guest Checkout')}}</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">


    function removeFromCartView(e, key){
        e.preventDefault();
        removeFromCart(key);
    }

    function showCheckoutModal(){
        $('#GuestCheckout').modal();
    }
    // $('.add').click(function () {
    //     let Qty = $(this).prev()
    //     if (Qty.val() < 12) {
    //         Qty.val(+Qty.val() + 1);
    //     }
    // });
    // $('.sub').click(function () {
    //     if ($(this).next().val() > 1) {
    //         if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
    //     }
    // });
    </script>
@endsection
