@php
    $spi = decrypt($shipping_info);
    // dd([$spi,$total]);
    $total += $spi->cost;
    $club_point_convert_rate = \App\BusinessSetting::where('type', 'club_point_convert_rate')->first();
    $poin_use = \App\UsePoin::where('user_id',Auth::user()->id)->first();
    $total -= $poin_use->poin*$club_point_convert_rate->value;
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
                                                            <input type="radio" name="payment_option" value="{{ $payment }}" required>
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
                                                        }}" @if ($total > 2500000)
                                                            disabled
                                                        @endif>
                                                        <span class="rb-checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="col-2">
                                                    <img class="logo-bank" style="height: 50%;
                                                    margin-top: 12px;" src="{{my_asset('/images/icon/Alfmart/alfamart.png')}}" alt="{{ env('APP_NAME') }}">
                                                </div>
                                                <div class="col-8 mt-3">
                                                    <p class="text-ekspedisi" style="margin-bottom: 0%;">Alfamart</p>
                                                    @if ($total > 2500000)
                                                    <p class="date-ekspedisi" style="color: red">tidak dapat menggunakan alfamart, maksimal {{ single_price(2500000) }}</p>
                                                    @else
                                                    <p class="date-ekspedisi"> Hanya bayar pada teller Alfamart</p>
                                                    @endif
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
                                                        <input type="radio" name="payment_option" onchange="creditCard(event,'cc',this)">
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
                                                        <input type="radio" name="payment_option" onchange="creditCard(event,'cc',this)">
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
                                                        <input type="radio" name="payment_option" onchange="creditCard(event,'cc',this)">
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
                                                        <input type="radio" name="payment_option" onchange="creditCard(event,'cc',this)">
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

                                    <div class="col-6">
                                        <p class="text-rincian-bayar" style="color: #B71C1C; text-align: right;">{{ single_price((int)$total) }}</p>
                                        <input type="hidden" id="total" name="total" value="{{ (int)$total }}">
                                    </div>
                                </div>
                                <div class="container" style="border-bottom:1px solid #C4C4C4">
                                    
                                </div>
                                @php

                                @endphp
                                <div class="row">
                                    <div class="col-7">
                                        <p class="text-ekspedisi">Point yang akan di dapat</p>
                                    </div>
                                    <input type="hidden" value={{$totalpoin}} name="totalpoin">

                                    <div class="col-5">
                                        <p class="price__produk" style="text-align: right;">{{$totalpoin}}</p>
                                    </div>
                                </div>
                                <button type="submit" class="mb-4 mt-2 btn btn-default">Lanjutkan Pembayaran</button>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </form>
    </section>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" data-backdrop="false" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container-fluid" id="modal-body"></div>
            </div>
          </div>
        </div>
      </div>
@endsection

@section('script')
<script type="text/javascript" src="https://js.xendit.co/v1/xendit.min.js"></script>      
<script type="text/javascript">      
    // Xendit.setPublishableKey('xnd_public_development_PWCqySYjlZTScsztBK61UseKJi3qtQNE7jynoIDdLy2wZRtY2x8daw3QV3eLZdL'); //unicelle dev
    Xendit.setPublishableKey('xnd_public_development_XcABnMBJ5QBPSIpBndtQZ8pJbeX0iZDCdTX9uJ1nVyWDDExwEo7mGPbCL0leRo'); //dummy rfh
    let submitStatus = 0;
    function tokenizeXendit() {
        Xendit.card.createToken({        
            amount: document.getElementById('total').value,
            card_number: document.getElementById('AccountNumber').value,
            card_exp_month: document.getElementById('expmonth').value,
            card_exp_year: document.getElementById('expyear').value,
            card_cvn: document.getElementById('cradcvn').value,
            is_multiple_use: false
        }, xenditResponseHandler);        
        
		// Prevent the form from being submitted:        
		return false;
    }

    function xenditResponseHandler (err, creditCardCharge) {        
        const submitbtn = document.getElementsByClassName('submit')
        if (err) {        
            // Show the errors on the form        
            console.error(err);       
            showFrontendAlert('danger',err.message)
            $(submitbtn).prop('disabled', false);
            $(submitbtn).text('Confirm');
            return;        
        }


        if (creditCardCharge.status === 'IN_REVIEW' && submitStatus == 0) {
            submitStatus = 1;
            window.open(creditCardCharge.payer_authentication_url, 'sample-inline-frame');
            $(submitbtn).prop('disabled', false);
            $(submitbtn).text('Next');
        }else if (creditCardCharge.status !== 'FAILED') {
            var token = creditCardCharge.id;
            var authid = creditCardCharge.authentication_id;

            var total = $("#total").val();
            const ccform = $('#ccform')

            $("#modal-body #xenditToken").val(token);
            $("#modal-body #authid").val(authid);
            $("#modal-body #totalamount").val(total)
            $.post("{{ route('xendit.charge') }}",ccform.serialize(),function (data) {
                if (data.status === "AUTHORIZED") {
                    // console.log(JSON.stringify([data]));return;
                    $("#form-checkout").prepend(`
                    <input type="hidden" name="ccdetails" value="${JSON.stringify([data])}">
                    `).submit()
                }else{
                    $("#modal-body").html("<h1>maaf ada kesalahan</h1>")
                }
            })
        }else{
            $('#error pre').text(creditCardCharge.failure_reason);
            console.warn('failed',creditCardCharge);
            $(submitbtn).prop('disabled', false);
            $(submitbtn).text('Confirm');
        }     
    }    
</script>
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

    function creditCard(e,method,ini) {
        e.preventDefault()
        let paymentOption = JSON.stringify({option:"cc"})
        $(ini).val(paymentOption)
        if (method == "cc") {
            $.get("{{ route('xendit.ccform') }}",function (data) {
                $("#modal-body").html(data)
                $("#exampleModalCenter").modal({backdrop: 'static', keyboard: false})
            })

        }
    }

    

    
</script>
@endsection
