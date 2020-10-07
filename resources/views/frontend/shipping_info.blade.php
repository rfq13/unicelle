@extends('frontend.layouts.app')

@section('content')
<section class="section-sub-head"></section>
    <section class="section-detail-produk">
    <div class="container">
        <div class="container mb-5">
             <nav aria-label="breadcrumb">
                <ul class="breadcrumb mb-5">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Keranjang Belanda</a></li>
                    <li class="breadcrumb-item active" style="color:#3BB6B1" aria-current="page">Checkout</li>
                </ul>
            </nav>
            <div class="container">
        <div class="container">
            <div class="row">
                <div class="card col-lg-6">
                    <p class="mt-4" style="font-size: 20px;">Checkout</p>
                    <hr>
                    <div class="card mb-4" style="padding-left: 2%; padding-right: 2%;" id="all-addr">
                        <div class="container" style="border-bottom:1px solid #C4C4C4">
                            <p class="mt-3 text-checkout">Pilih Alamat Pengiriman</p>
                        </div>
                        <form class="form-default" data-toggle="validator" action="{{ route('checkout.store_shipping_infostore') }}" role="form" method="POST">
                            @csrf
                                @if(Auth::check())
                                    @foreach (Auth::user()->addresses as $key => $address)
                                    <input type="radio" style="display:none" name="address_id" value="{{ $address->id }}" {{$address->set_default == 1 ? 'checked' : ''}} required>
                                        <div class="d-flex align-items-center {{$key == 0 ? 'mt-2':''}}" style="padding-left: 0%; border-bottom:1px solid #C4C4C4">
                                            <div class="col-8 py-2">
                                                <p class="name-address" style="text-transform:capitalize">@if($address->receiver) {{$address->receiver}} @else {{Auth::user()->name}} @endif </p>
                                                <p class="address-user col-10">{{$address->address}}, {{json_decode($address->province)->province}}, {{json_decode($address->city)->city}}, {{json_decode($address->subdistrict)->subdistrict}}, {{$address->postal_code}} {{isset($address->phone) ? $address->phone : Auth::user()->phone}}</p>
                                            </div>
                                            <div class="col-5 ml-4">
                                                <div class="address"> 
                                                    <a id="setDefault" href="{{ route('addresses.set_default', $address->id) }}" data-key="{{$key}}" class="btn {{$address->set_default ? 'btn-default' : 'btn-secondary'}} col-8 ml-2 mb-3">Default</a>
                                                </div>
                                                <div class="address">
                                                    <a href="#"><i class="fa fa-trash ml-5" ></i></a>
                                                    <a href="#"><i class="fa fa-pencil ml-3"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                <!-- blablbabla -->
                                @endif
                        </form>
                        <div class="btn-add-address mt-2" style="border-bottom:1px solid #C4C4C4; border-top: 1px solid#c4c4c4;">
                            <a href="">
                                <li class="mb-2 mt-2" style="list-style-type: none; color: #006064;">+ Tambah</li>
                            </a>    
                        </div>
                    </div>
<!-- Metode Pengiriman-->
                    <div class="card mb-4" style="padding-left: 2%; padding-right: 2%;">
                        <div class="container" style="border-bottom:1px solid #C4C4C4">
                            <p class="mt-3 text-checkout">Metode Pengiriman</p>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items mt-3">
                                <label class="mt-2 cb-pengiriman">
                                    <input type="radio" checked="checked" name="radio">
                                    <span class="cb-checkmark"></span>
                                </label>
                                <div class="col-6">
                                    <p class="text-ekspedisi" style="margin-bottom: 0%;"> J&N Express</p>
                                    <p class="date-ekspedisi"> 2-3 Hari</p>
                                </div>
                                <div class="mx-auto">
                                    <p class="text-ekspedisi"> Rp. 18.000</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items mt-3">
                                <label class="mt-2 cb-pengiriman">
                                    <input type="radio" name="radio">
                                    <span class="cb-checkmark"></span>
                                </label>
                                <div class="col-6">
                                    <p class="text-ekspedisi" style="margin-bottom: 0%;"> JNE REG</p>
                                    <p class="date-ekspedisi"> 2-3 Hari</p>
                                </div>
                                <div class="mx-auto">
                                    <p class="text-ekspedisi"> Rp. 18.000</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items mt-3">
                                <label class="mt-2 cb-pengiriman">
                                    <input type="radio"name="radio">
                                    <span class="cb-checkmark"></span>
                                </label>
                                <div class="col-6">
                                    <p class="text-ekspedisi" style="margin-bottom: 0%;"> TIKI</p>
                                    <p class="date-ekspedisi"> 2-3 Hari</p>
                                </div>
                                <div class="mx-auto">
                                    <p class="text-ekspedisi"> Rp. 18.000</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items mt-3">
                                <label class="mt-2 cb-pengiriman">
                                    <input type="radio" name="radio">
                                    <span class="cb-checkmark"></span>
                                </label>
                                <div class="col-6">
                                    <p class="text-ekspedisi" style="margin-bottom: 0%;"> POS Indonesia</p>
                                    <p class="date-ekspedisi"> 2-3 Hari</p>
                                </div>
                                <div class="mx-auto">
                                    <p class="text-ekspedisi"> Rp. 18.000</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex align-items mt-3">
                                <label class="mt-2 cb-pengiriman">
                                    <input type="radio" name="radio">
                                    <span class="cb-checkmark"></span>
                                </label>
                                <div class="col-6">
                                    <p class="text-ekspedisi" style="margin-bottom: 0%;"> Si Cepat Express</p>
                                    <p class="date-ekspedisi"> 2-3 Hari</p>
                                </div>
                                <div class="mx-auto">
                                    <p class="text-ekspedisi"> Rp. 18.000</p>
                                </div>
                            </div>
                        </div>

                    </div>
<!--x Metode Pengiriman x-->
                        <div class="card mb-4 mt-2" style="padding-left: 2%; padding-right: 2%;">
                            <div class="row">
                                <div class="ml-3 col-10">
                                    <p class="mt-3 text-checkout">Kirim Sebagai Dropshipper</p>
                                </div>
                                <label class="mt-3 cb-pengiriman">
                                    <input type="checkbox" id="myCheck" onclick="myFunction()">
                                    <span class="cb-checkmark"></span>
                                </label>
                            </div>
                            <hr>
                            <div class="container"  id="form_dropshipper" style="display:none;">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group ">
                                            <input type="name" class="form-control" placeholder="Nama">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group ">
                                            <input type="name" class="form-control" placeholder="No.Telepon">
                                        </div>
                                    </div>
                                    <div class="mx-auto">
                                        <button class="ml-5 btn btn-default">Simpan</button>
                                        <li class="date-ekspedisi ml-4 mb-2 mt-2" style="list-style-type: none; color: #424242;">
                                            <a style="color: #424242;" href="#">Petunjuk Dropshipper</li></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-sm-5 ml-4" style="padding-bottom: 50%;">
                        {{--<div class="container card">
                            <p class="mt-3 text-rincian-bayar" style="size: 20px;">Rincian Pembayaran</p>
                            <div class="row">
                                <div class="col-6">
                                    <p class="text-rincian-harga">Subtotal</p>
                                </div>
                                <div class="col-6">
                                    <p class="text-rincian-harga" style="text-align: right;">Rp. 13.000</p>
                                </div>
                                <div class="col-6">
                                    <p class="text-rincian-harga">Biaya Pengiriman</p>
                                </div>
                                <div class="col-6">
                                    <p class="text-rincian-harga" style="text-align: right;">Rp. 13.000</p>
                                </div>
                                <div class="col-6">
                                    <p class="text-rincian-harga" style="color: #B71C1C;">Total</p>
                                </div>
                                <div class="col-6">
                                    <p class="text-rincian-harga" style="color: #B71C1C; text-align: right;">Rp. 13.000</p>
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
                            <button class="mb-2 btn btn-default">Lanjutkan Pembayaran</button>

                            
                        </div>--}}
                        @include('frontend.partials.cart_summary')
                    </div>
            </div>
        </div>
    </div>
        </div>
    </div>
    </section>
    <!--X END X-->
    <div id="page-content">
        <section class="slice-xs sct-color-2 border-bottom">
            <div class="container container-sm">
                <div class="row cols-delimited justify-content-center">
                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center ">
                            <div class="block-icon c-gray-light mb-0">
                                <i class="la la-shopping-cart"></i>
                            </div>
                            <div class="block-content d-none d-md-block">
                                <h3 class="heading heading-sm strong-300 c-gray-light text-capitalize">{{ translate('1. My Csssart')}}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="icon-block icon-block--style-1-v5 text-center active">
                            <div class="block-icon mb-0">
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
        </section>

        <section class="py-4 gry-bg">
            <div class="container">
                <div class="row cols-xs-space cols-sm-space cols-md-space">
                    <div class="col-lg-8">
                        <form class="form-default" data-toggle="validator" action="{{ route('checkout.store_shipping_infostore') }}" role="form" method="POST">
                            @csrf
                            <input type="text" id="address_id" name="address_id" value="0" required>
                                @if(Auth::check())
                                    <div class="row gutters-5">
                                        @foreach (Auth::user()->addresses as $key => $address)
                                            <div class="col-md-6">
                                                <label class="aiz-megabox d-block bg-white">
                                                    <span class="d-flex p-3 aiz-megabox-elem">
                                                        <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                        <span class="flex-grow-1 pl-3">
                                                            <div>
                                                                <span class="alpha-6">{{ translate('Address') }}:</span>
                                                                <span class="strong-600 ml-2">{{ $address->address }}</span>
                                                            </div>
                                                            <div>
                                                                <span class="alpha-6">{{ translate('Postal Code') }}:</span>
                                                                <span class="strong-600 ml-2">{{ $address->postal_code }}</span>
                                                            </div>
                                                            <div>
                                                                <span class="alpha-6">{{ translate('City') }}:</span>
                                                                <span class="strong-600 ml-2">{{ $address->city }}</span>
                                                            </div>
                                                            <div>
                                                                <span class="alpha-6">{{ translate('Country') }}:</span>
                                                                <span class="strong-600 ml-2">{{ $address->country }}</span>
                                                            </div>
                                                            <div>
                                                                <span class="alpha-6">{{ translate('Phone') }}:</span>
                                                                <span class="strong-600 ml-2">{{ $address->phone }}</span>
                                                            </div>
                                                        </span>
                                                    </span>
                                                </label>
                                            </div>
                                        @endforeach
                                        <input type="hidden" name="checkout_type" value="logged">
                                        <div class="col-md-6 mx-auto" onclick="add_new_address()">
                                            <div class="border p-3 rounded mb-3 c-pointer text-center bg-white">
                                                <i class="la la-plus la-2x"></i>
                                                <div class="alpha-7">{{ translate('Add New Address') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{ translate('Name')}}</label>
                                                    <input type="text" class="form-control" name="name" placeholder="{{ translate('Name')}}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{ translate('Email')}}</label>
                                                    <input type="text" class="form-control" name="email" placeholder="{{ translate('Email')}}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{ translate('Address')}}</label>
                                                    <input type="text" class="form-control" name="address" placeholder="{{ translate('Address')}}" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">{{ translate('Select your country')}}</label>
                                                    <select class="form-control custome-control" data-live-search="true" name="country">
                                                        @foreach (\App\Country::where('status', 1)->get() as $key => $country)
                                                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{ translate('City')}}</label>
                                                    <input type="text" class="form-control" placeholder="{{ translate('City')}}" name="city" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{ translate('Postal code')}}</label>
                                                    <input type="text" class="form-control" placeholder="{{ translate('Postal code')}}" name="postal_code" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group has-feedback">
                                                    <label class="control-label">{{ translate('Phone')}}</label>
                                                    <input type="number" min="0" class="form-control" placeholder="{{ translate('Phone')}}" name="phone" required>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="checkout_type" value="guest">
                                    </div>
                                    </div>
                                @endif
                            <div class="row align-items-center pt-4">
                                <div class="col-md-6">
                                    <a href="{{ route('home') }}" class="link link--style-3">
                                        <i class="ion-android-arrow-back"></i>
                                        {{ translate('Return to shop')}}
                                    </a>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn btn-styled btn-base-1">{{ translate('Continue to Delivery Info')}}</a>
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
    </div>

    <div class="modal fade" id="new-address-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-zoom" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">{{ translate('New Address')}}</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-default" role="form" action="{{ route('addresses.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="p-3">
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Address')}}</label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control textarea-autogrow mb-3" placeholder="{{ translate('Your Address')}}" rows="1" name="address" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Country')}}</label>
                            </div>
                            <div class="col-md-10">
                                <div class="mb-3">
                                    <select class="form-control mb-3 selectpicker" data-placeholder="{{ translate('Select your country')}}" name="country" required>
                                        @foreach (\App\Country::where('status', 1)->get() as $key => $country)
                                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('City')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('Your City')}}" name="city" value="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Postal code')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('Your Postal Code')}}" name="postal_code" value="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Phone')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3" placeholder="{{ translate('+880')}}" name="phone" value="" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-base-1">{{  translate('Save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $("#all-addr").on("click", "#setDefault", function (e) {
            e.preventDefault()
            let key = $(this).data("key")
            let urL = $(this).attr("href")
            let setDefault = $("#all-addr #setDefault")
            // alert(setDefault); return
            setDefault.removeClass("btn-default")
            setDefault.addClass("btn-secondary")
            let setthis = $(this)
            $.get(urL,function (data) {
                if (data[1] == "sukses") {
                    showFrontendAlert("success",data[0])
                    $("#defaulted"+key).html('')
                    setthis.removeClass("btn-secondary")
                    setthis.addClass("btn-default")
                }else{
                    showFrontendAlert("danger",data[0])
                }
            })
        })
    })

    function add_new_address(){
        $('#new-address-modal').modal('show');
    }
    $('.add').click(function () {
        if ($(this).prev().val() < 12) {
            $(this).prev().val(+$(this).prev().val() + 1);
        }
    });
    $('.sub').click(function () {
        if ($(this).next().val() > 1) {
            if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
        }
    });
    function myFunction() {
  var checkBox = document.getElementById("myCheck");
  var text = document.getElementById("form_dropshipper");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
@endsection
