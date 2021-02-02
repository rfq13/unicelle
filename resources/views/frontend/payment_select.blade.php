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
                                            $VA = xenditRequest();
                                            // dd($VA);
                                        @endphp
                                        @foreach ($VA as $bank)
                                            @php
                                                $bank = (object)$bank;
                                                $logo = strtolower($bank->code);

                                                $payment = json_encode([
                                                    "type" => "va",
                                                    "option" => $bank->code
                                                ])
                                            @endphp
                                            <div class="col-12 mb-3">
                                                <div class="row">
                                                    <div class="mt-4">
                                                        <label class="rb-bank">
                                                            <input type="radio" name="payment_option" value="{{ $payment }}">
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
                                    </div>
                                    <!--Batas Bank-->

                                    <div id="Indomart" class="tabcontent">
                                        <div class="col-12 mb-3">
                                            <div class="row">
                                                <div class="mt-4">
                                                    <label class="rb-bank">
                                                        <input type="radio" name="payment_option" value="{{
                                                            json_encode([
                                                                "type" => "retail",
                                                                "option" => "INDOMARET"
                                                            ]) 
                                                        }}">
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
                                                        <input type="radio" name="payment_option" value="{{
                                                            json_encode([
                                                                "type" => "retail",
                                                                "option" => "ALFAMART"
                                                            ]) 
                                                        }}">
                                                        <span class="rb-checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="col-2">
                                                    <img class="logo-bank" style="height: 50%;
                                                    margin-top: 12px;" src="{{my_asset('/images/icon/Alfmart/alfamart.png')}}" alt="{{ env('APP_NAME') }}">
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
