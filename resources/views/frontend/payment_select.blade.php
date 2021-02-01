@php
    // dd(decrypt($shipping_info));
@endphp
@extends('frontend.layouts.app')

@section('content')
<section class="section-sub-head"></section>
    <section class="section-detail-produk">
        <form action="{{ route('payment.checkout') }}" id="form-checkout" method="POST">
            @csrf
            <div class="container">
                <div class="container mb-5">
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb mb-5">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Keranjang Belanda</a></li>
                            <li class="breadcrumb-item"><a href="#">Checkout</a></li>
                            <li class="breadcrumb-item active" style="color:#3BB6B1" aria-current="page">Pembayaran</li>
                        </ul>
                    </nav>
                    <div class="row">
                        <div class="card col-lg-7">
                            <p class="mt-4" style="font-size: 20px;">Pembayaran</p>
                            <hr>
                            <div class="card mb-4" style="padding-left: 2%; padding-right: 4%;">
                                <div class="container ml-2" style="border-bottom:1px solid #C4C4C4">
                                    <p class="mt-3 text-checkout">Metode Pembayaran</p>
                                </div>
                                
                                <div class="container ml-2"id="myDIV">
                                    <div class="tab mt-3 mb-3" >
                                        <div class="row">
                                            <button class="col-3 btn btn-pembayaran tablinks actived" onclick="openCity(event, 'Transfer')">Transfer Bank</button>
                                            <button class="col-3 btn btn-pembayaran tablinks" onclick="openCity(event, 'Indomart')">Indomart / i.Saku</button>
                                            <button class="col-3 btn btn-pembayaran tablinks" onclick="openCity(event, 'Alfamart')">Alfamart</button>
                                            <button class="col-3 btn btn-pembayaran tablinks" onclick="openCity(event, 'Kartukredit')">Kartu Kredit</button>
                                        </div>
                                        
                                    </div>
                                        
                                    <div id="Transfer" class="tabcontent" style="display:block;">
                                        @php
                                            $VA = xenditRequest('banks');
                                        @endphp
                                        @foreach ($VA as $bank)
                                            @php
                                                $bank = (object)$bank;
                                                $logo = strtolower($bank->code);
                                            @endphp
                                            <div class="col-12 mb-3">
                                                <div class="row">
                                                    <div class="mt-4">
                                                        <label class="rb-bank">
                                                            <input type="radio" name="payment_option" value="{{ $bank->code }}">
                                                            <span class="rb-checkmark"></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-2">
                                                        <img class="logo-bank" src="{{my_asset("/images/icon/Bank/$logo-02.png")}}" alt="">
                                                    </div>
                                                    <div class="col-8 mt-3">
                                                        <p class="text-ekspedisi" style="margin-bottom: 0%;">{{ $bank->name }}</p>
                                                        <p class="date-ekspedisi"> Hanya Menerima transfer dari {{ $bank->name }}</p>
                                                    </div>
                                                </div> 
                                            </div>
                                        @endforeach
                                        
                                        {{-- <div class="col-12 mb-3">
                                            <div class="row">
                                                <div class="mt-4">
                                                    <label class="rb-bank">
                                                        <input type="radio" name="radio">
                                                        <span class="rb-checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="col-2">
                                                    <img class="logo-bank" src="{{my_asset('/images/icon/Bank/bri-02.png')}}" alt="">
                                                </div>
                                                <div class="col-8 mt-3">
                                                    <p class="text-ekspedisi" style="margin-bottom: 0%;">Bank BRI</p>
                                                    <p class="date-ekspedisi"> Hanya Menerima dari Transfer BRI</p>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="row">
                                                <div class="mt-4">
                                                    <label class="rb-bank">
                                                        <input type="radio" name="radio">
                                                        <span class="rb-checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="col-2">
                                                    <img class="logo-bank" src="{{my_asset('/images/icon/Bank/bca-02.png')}}" alt="">
                                                </div>
                                                <div class="col-8 mt-3">
                                                    <p class="text-ekspedisi" style="margin-bottom: 0%;">Bank BCA</p>
                                                    <p class="date-ekspedisi"> Hanya Menerima dari Transfer BCA</p>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="row">
                                                <div class="mt-4">
                                                    <label class="rb-bank">
                                                        <input type="radio" name="radio">
                                                        <span class="rb-checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="col-2">
                                                    <img class="logo-bank" src="{{my_asset('/images/icon/Bank/mandiri-02.png')}}" alt="">
                                                </div>
                                                <div class="col-8 mt-3">
                                                    <p class="text-ekspedisi" style="margin-bottom: 0%;">Bank Mandiri</p>
                                                    <p class="date-ekspedisi"> Hanya Menerima dari Transfer Mandiri</p>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class="row">
                                                <div class="mt-4">
                                                    <label class="rb-bank">
                                                        <input type="radio" name="radio">
                                                        <span class="rb-checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="col-2">
                                                    <img class="logo-bank" src="{{my_asset('/images/icon/Bank/permata-02.png')}}" alt="">
                                                </div>
                                                <div class="col-8 mt-3">
                                                    <p class="text-ekspedisi" style="margin-bottom: 0%;">Bank Permata</p>
                                                    <p class="date-ekspedisi"> Hanya Menerima dari Transfer Permata</p>
                                                </div>
                                            </div> 
                                        </div> --}}
                                    </div>
                                    <!--Batas Bank-->

                                    <div id="Indomart" class="tabcontent">
                                        <div class="col-12 mb-3">
                                            <div class="row">
                                                <div class="mt-4">
                                                    <label class="rb-bank">
                                                        <input type="radio" name="radio">
                                                        <span class="rb-checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="col-2">
                                                    <img class="logo-bank" src="{{my_asset('/images/icon/Indomart/indomaret-02.png')}}" alt="">
                                                </div>
                                                <div class="col-8 mt-3">
                                                    <p class="text-ekspedisi" style="margin-bottom: 0%;">Indomart</p>
                                                    <p class="date-ekspedisi"> Hanya bayar pada teller Indomart</p>
                                                </div>
                                            </div> 
                                        </div> 
                                    </div>
                                    <!--Batas Indomart-->

                                    <div id="Alfamart" class="tabcontent">
                                        <div class="col-12 mb-3">
                                            <div class="row">
                                                <div class="mt-4">
                                                    <label class="rb-bank">
                                                        <input type="radio" name="radio">
                                                        <span class="rb-checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="col-2">
                                                    <img class="logo-bank" src="{{my_asset('/images/icon/Alfmart/indomaret-02.png')}}" alt="">
                                                </div>
                                                <div class="col-8 mt-3">
                                                    <p class="text-ekspedisi" style="margin-bottom: 0%;">Alfamart</p>
                                                    <p class="date-ekspedisi"> Hanya bayar pada teller Alfamart</p>
                                                </div>
                                            </div> 
                                        </div>   
                                    </div>
                                    <!--Batas Alfamart-->

                                    <div id="Kartukredit" class="tabcontent">
                                        <div class="col-12 mb-3">
                                            <div class="row">
                                                <div class="mt-4">
                                                    <label class="rb-bank">
                                                        <input type="radio" name="radio">
                                                        <span class="rb-checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="col-2">
                                                    <img class="logo-bank" src="{{my_asset('/images/icon/Kartukredit/visa-02.png')}}" alt="">
                                                </div>
                                                <div class="col-8 mt-3">
                                                    <p class="text-ekspedisi" style="margin-bottom: 0%;">Visa</p>
                                                    <p class="date-ekspedisi"> Hanya Menerima dari Kredit / Debit</p>
                                                </div>
                                            </div> 
                                        </div>   
                                        <div class="col-12 mb-3">
                                            <div class="row">
                                                <div class="mt-4">
                                                    <label class="rb-bank">
                                                        <input type="radio" name="radio">
                                                        <span class="rb-checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="col-2">
                                                    <img class="logo-bank" src="{{my_asset('/images/icon/Kartukredit/paninbank-02.png')}}" alt="">
                                                </div>
                                                <div class="col-8 mt-3">
                                                    <p class="text-ekspedisi" style="margin-bottom: 0%;">Panin Bank</p>
                                                    <p class="date-ekspedisi"> Hanya Menerima dari Kredit / Debit</p>
                                                </div>
                                            </div> 
                                        </div>   
                                        <div class="col-12 mb-3">
                                            <div class="row">
                                                <div class="mt-4">
                                                    <label class="rb-bank">
                                                        <input type="radio" name="radio">
                                                        <span class="rb-checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="col-2">
                                                    <img class="logo-bank" src="{{my_asset('/images/icon/Kartukredit/mastercard-02.png')}}" alt="">
                                                </div>
                                                <div class="col-8 mt-3">
                                                    <p class="text-ekspedisi" style="margin-bottom: 0%;">Master Card</p>
                                                    <p class="date-ekspedisi"> Hanya Menerima dari Kredit / Debit</p>
                                                </div>
                                            </div> 
                                        </div>   
                                        <div class="col-12 mb-3">
                                            <div class="row">
                                                <div class="mt-4">
                                                    <label class="rb-bank">
                                                        <input type="radio" name="radio">
                                                        <span class="rb-checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="col-2">
                                                    <img class="logo-bank" src="{{my_asset('/images/icon/Kartukredit/digibank-02.png')}}" alt="">
                                                </div>
                                                <div class="col-8 mt-3">
                                                    <p class="text-ekspedisi" style="margin-bottom: 0%;">Digi Bank</p>
                                                    <p class="date-ekspedisi"> Hanya Menerima dari Kredit / Debit</p>
                                                </div>
                                            </div> 
                                        </div>   
                                    </div>
                                    <!--Batas Kartu Kredit-->
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-5" style="padding-bottom: 50%;">
                            <div class="container card">
                                <div class="row mt-3">
                                    <input type="hidden" name="shipping_info" value="{{ $shipping_info }}">
                                    <div class="col-6">
                                        <p class="text-rincian-bayar" style="color: #B71C1C;">Total Pembayaran</p>
                                    </div>
                                    @php
                                        $spi = decrypt($shipping_info);
                                        // dd([$spi,$total]);
                                        $total += $spi->cost;
                                    @endphp

                                    <div class="col-6">
                                        <p class="text-rincian-bayar" style="color: #B71C1C; text-align: right;">{{ single_price((int)$total) }}</p>
                                        <input type="hidden" name="total" value="{{ (int)$total }}">
                                    </div>
                                </div>
                                <div class="container" style="border-bottom:1px solid #C4C4C4">
                                    
                                </div>
                                <div class="row">
                                    <div class="col-7">
                                        <p class="text-ekspedisi">Point yang akan di dapat</p>
                                    </div>
                                    <div class="col-5">
                                        <p class="price__produk" style="text-align: right;">+18</p>
                                    </div>
                                </div>
                                <button class="mb-4 mt-2 btn btn-default">Lanjutkan Pembayaran</button>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </form>
    </section>

    <!--X END X-->
    {{-- <div id="page-content">
        <section class="slice-xs sct-color-2 border-bottom">
            <div class="container container-sm">
                <div class="row cols-delimited justify-content-center">
                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center ">
                            <div class="block-icon c-gray-light mb-0">
                                <i class="la la-shopping-cart"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">{{ translate('1. My Cart')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center ">
                            <div class="block-icon mb-0 c-gray-light">
                                <i class="la la-map-o"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">{{ translate('2. Shipping info')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center ">
                            <div class="block-icon mb-0 c-gray-light">
                                <i class="la la-truck"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">{{ translate('3. Delivery info')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center active">
                            <div class="block-icon mb-0">
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
        </section>
        <section class="py-3 gry-bg">
            <div class="container">
                <div class="row cols-xs-space cols-sm-space cols-md-space">
                    <div class="col-lg-8">
                        <form action="{{ route('payment.checkout') }}" class="form-default" data-toggle="validator" role="form" method="POST" id="checkout-form">
                            @csrf
                            <div class="card">
                                <div class="card-title px-4 py-3">
                                    <h3 class="heading heading-5 strong-500">
                                        {{ translate('Select a payment option')}}
                                    </h3>
                                </div>
                                <div class="card-body text-center">
                                    <div class="row">
                                        <div class="col-md-6 mx-auto">
                                            <div class="row">
                                                @if(\App\BusinessSetting::where('type', 'paypal_payment')->first()->value == 1)
                                                    <div class="col-6">
                                                        <label class="payment_option mb-4" data-toggle="tooltip" data-title="Paypal">
                                                            <input type="radio" id="" name="payment_option" value="paypal" class="online_payment" checked>
                                                            <span>
                                                                <img loading="lazy"  src="{{ my_asset('frontend/images/icons/cards/paypal.png')}}" class="img-fluid">
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endif
                                                @if(\App\BusinessSetting::where('type', 'stripe_payment')->first()->value == 1)
                                                    <div class="col-6">
                                                        <label class="payment_option mb-4" data-toggle="tooltip" data-title="Stripe">
                                                            <input type="radio" id="" name="payment_option" value="stripe" class="online_payment" checked>
                                                            <span>
                                                                <img loading="lazy"  src="{{ my_asset('frontend/images/icons/cards/stripe.png')}}" class="img-fluid">
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endif
                                                @if(\App\BusinessSetting::where('type', 'sslcommerz_payment')->first()->value == 1)
                                                    <div class="col-6">
                                                        <label class="payment_option mb-4" data-toggle="tooltip" data-title="sslcommerz">
                                                            <input type="radio" id="" name="payment_option" value="sslcommerz" class="online_payment" checked>
                                                            <span>
                                                                <img loading="lazy"  src="{{ my_asset('frontend/images/icons/cards/sslcommerz.png')}}" class="img-fluid">
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endif
                                                @if(\App\BusinessSetting::where('type', 'instamojo_payment')->first()->value == 1)
                                                    <div class="col-6">
                                                        <label class="payment_option mb-4" data-toggle="tooltip" data-title="Instamojo">
                                                            <input type="radio" id="" name="payment_option" value="instamojo" class="online_payment" checked>
                                                            <span>
                                                                <img loading="lazy"  src="{{ my_asset('frontend/images/icons/cards/instamojo.png')}}" class="img-fluid">
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endif
                                                @if(\App\BusinessSetting::where('type', 'razorpay')->first()->value == 1)
                                                    <div class="col-6">
                                                        <label class="payment_option mb-4" data-toggle="tooltip" data-title="Razorpay">
                                                            <input type="radio" id="" name="payment_option" value="razorpay" class="online_payment" checked>
                                                            <span>
                                                                <img loading="lazy"  src="{{ my_asset('frontend/images/icons/cards/rozarpay.png')}}" class="img-fluid">
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endif
                                                @if(\App\BusinessSetting::where('type', 'paystack')->first()->value == 1)
                                                    <div class="col-6">
                                                        <label class="payment_option mb-4" data-toggle="tooltip" data-title="Paystack">
                                                            <input type="radio" id="" name="payment_option" value="paystack" class="online_payment" checked>
                                                            <span>
                                                                <img loading="lazy"  src="{{ my_asset('frontend/images/icons/cards/paystack.png')}}" class="img-fluid">
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endif
                                                @if(\App\BusinessSetting::where('type', 'voguepay')->first()->value == 1)
                                                    <div class="col-6">
                                                        <label class="payment_option mb-4" data-toggle="tooltip" data-title="VoguePay">
                                                            <input type="radio" id="" name="payment_option" value="voguepay" class="online_payment" checked>
                                                            <span>
                                                                <img loading="lazy"  src="{{ my_asset('frontend/images/icons/cards/vogue.png')}}" class="img-fluid">
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endif
                                                @if(\App\BusinessSetting::where('type', 'payhere')->first()->value == 1)
                                                   <div class="col-6">
                                                       <label class="payment_option mb-4" data-toggle="tooltip" data-title="payhere">
                                                           <input type="radio" id="" name="payment_option" value="payhere" class="online_payment" checked>
                                                           <span>
                                                               <img loading="lazy"  src="{{ my_asset('frontend/images/icons/cards/payhere.png')}}" class="img-fluid">
                                                           </span>
                                                       </label>
                                                   </div>
                                               @endif
                                                @if(\App\Addon::where('unique_identifier', 'paytm')->first() != null && \App\Addon::where('unique_identifier', 'paytm')->first()->activated)
                                                    <div class="col-6">
                                                        <label class="payment_option mb-4" data-toggle="tooltip" data-title="Paytm">
                                                            <input type="radio" id="" name="payment_option" value="paytm" class="online_payment" checked>
                                                            <span>
                                                                <img loading="lazy" src="{{ my_asset('frontend/images/icons/cards/paytm.jpg')}}" class="img-fluid">
                                                            </span>
                                                        </label>
                                                    </div>
                                                @endif
                                                @if(\App\BusinessSetting::where('type', 'cash_payment')->first()->value == 1)
                                                    @php
                                                        $digital = 0;
                                                        foreach(Session::get('cart') as $cartItem){
                                                            if($cartItem['digital'] == 1){
                                                                $digital = 1;
                                                            }
                                                        }
                                                    @endphp
                                                    @if($digital != 1)
                                                        <div class="col-6">
                                                            <label class="payment_option mb-4" data-toggle="tooltip" data-title="Cash on Delivery">
                                                                <input type="radio" id="" name="payment_option" value="cash_on_delivery" class="online_payment" checked>
                                                                <span>
                                                                    <img loading="lazy"  src="{{ my_asset('frontend/images/icons/cards/cod.png')}}" class="img-fluid">
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @endif
                                                @endif
                                                @if (Auth::check())
                                                    @if (\App\Addon::where('unique_identifier', 'offline_payment')->first() != null && \App\Addon::where('unique_identifier', 'offline_payment')->first()->activated)
                                                        @foreach(\App\ManualPaymentMethod::all() as $method)
                                                          <div class="col-6">
                                                              <label class="payment_option mb-4" data-toggle="tooltip" data-title="{{ $method->heading }}">
                                                                  <input type="radio" id="" name="payment_option" value="{{ $method->heading }}" onchange="toggleManualPaymentData({{ $method->id }})">
                                                                  <span>
                                                                      <img loading="lazy"  src="{{ my_asset($method->photo)}}" class="img-fluid">
                                                                  </span>
                                                              </label>
                                                          </div>
                                                        @endforeach

                                                        @foreach(\App\ManualPaymentMethod::all() as $method)
                                                          <div id="manual_payment_info_{{ $method->id }}" class="d-none">
                                                              @php echo $method->description @endphp
                                                              @if ($method->bank_info != null)
                                                                  <ul>
                                                                      @foreach (json_decode($method->bank_info) as $key => $info)
                                                                          <li>Bank Name - {{ $info->bank_name }}, Account Name - {{ $info->account_name }}, Account Number - {{ $info->account_number}}, Routing Number - {{ $info->routing_number }}</li>
                                                                      @endforeach
                                                                  </ul>
                                                              @endif
                                                          </div>
                                                        @endforeach
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card mb-3 bg-gray text-left p-3 d-none">
                                        <div id="manual_payment_description">

                                        </div>
                                    </div>
                                    @if (Auth::check() && \App\BusinessSetting::where('type', 'wallet_system')->first()->value == 1)
                                        <div class="or or--1 mt-2">
                                            <span>or</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-xxl-6 col-lg-8 col-md-10 mx-auto">
                                                <div class="text-center bg-gray py-4">
                                                    <i class="fa"></i>
                                                    <div class="h5 mb-4">{{ translate('Your wallet balance :')}} <strong>{{ single_price(Auth::user()->balance) }}</strong></div>
                                                    @if(Auth::user()->balance < $total)
                                                        <button type="button" class="btn btn-base-2" disabled>{{ translate('Insufficient balance')}}</button>
                                                    @else
                                                        <button  type="button" onclick="use_wallet()" class="btn btn-base-1">{{ translate('Pay with wallet')}}</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="pt-3">
                                <input id="agree_checkbox" type="checkbox" required>
                                <label for="agree_checkbox">{{ translate('I agree to the')}}</label>
                                <a href="{{ route('terms') }}">{{ translate('terms and conditions')}}</a>,
                                <a href="{{ route('returnpolicy') }}">{{ translate('return policy')}}</a> &
                                <a href="{{ route('privacypolicy') }}">{{ translate('privacy policy')}}</a>
                            </div>

                            <div class="row align-items-center pt-3">
                                <div class="col-6">
                                    <a href="{{ route('home') }}" class="link link--style-3">
                                        <i class="ion-android-arrow-back"></i>
                                        {{ translate('Return to shop')}}
                                    </a>
                                </div>
                                <div class="col-6 text-right">
                                    <button type="button" onclick="submitOrder(this)" class="btn btn-styled btn-base-1">{{ translate('Complete Order')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-4 ml-lg-auto">
                        @include('frontend.partials.cart_summary')
                    </div>
                </div>
            </div>
        </section>
    </div> --}}
@endsection

@section('script')
    <script type="text/javascript">

        $(document).ready(function(){
          $(".online_payment").click(function(){
            $('#manual_payment_description').parent().addClass('d-none');
          });
        });

        function use_wallet(){
            $('input[name=payment_option]').val('wallet');
            if($('#agree_checkbox').is(":checked")){
                $('#checkout-form').submit();
            }else{
                showFrontendAlert('error','{{ translate('You need to agree with our policies') }}');
            }
        }
        function submitOrder(el){
            $(el).prop('disabled', true);
            if($('#agree_checkbox').is(":checked")){
                $('#checkout-form').submit();
            }else{
                showFrontendAlert('error','{{ translate('You need to agree with our policies') }}');
                $(el).prop('disabled', false);
            }
        }

        function toggleManualPaymentData(id){
            $('#manual_payment_description').parent().removeClass('d-none');
            $('#manual_payment_description').html($('#manual_payment_info_'+id).html());
        }

        function openCity(evt, TabName) {
            evt.preventDefault();
            
          var i, tabcontent, tablinks;
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
          }
          tablinks = document.getElementsByClassName("tablinks");
          for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" actived", "");
          }
          document.getElementById(TabName).style.display = "block";
          evt.currentTarget.className += " actived";
        }

        var header = document.getElementById("myDIV");
        var btns = header.getElementsByClassName("btn-pembayaran");
        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function() {
                var current = document.getElementsByClassName("actived");
                current[0].className = current[0].className.replace(" actived", "");
                this.className += " actived";
            });
        }
    </script>
@endsection
