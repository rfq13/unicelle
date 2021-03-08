

<div class="modal-header">
    <h5 class="modal-title strong-600 heading-5">{{ $order->created_at->format('Y-m-d') }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@php
$status = $order->orderDetails->first()->delivery_status;
$refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
// $rajaongkir = json_decode($ship)->rajaongkir;
if($ship != null || $ship != 0){
    $shp = json_decode($ship)->rajaongkir;
    
    if ($status == "on_delivery" || $status == "delivered") {
        if ($shp->status->code == 200) {
            $ship = $shp->result;
            $waktuKirim = $ship->details->waybill_date." ". $ship->details->waybill_time;
            $statusKirim = strtolower($ship->delivery_status->status);
            $kurir = $ship->summary->courier_name;
            $manifest = $ship->manifest;
            $penerima = $ship->delivery_status->pod_receiver;
            $tglTerima = $ship->delivery_status->pod_date." ".$ship->delivery_status->pod_time;
        }
    }
    }

    if ($order->payment_status ==  "paid") {
        foreach($order->orderDetails as $key => $value){
            if ( $value->delivery_status != "on_delivery" &&  $value->delivery_status != "delivered") {
                $value->delivery_status = "on_review";
                $value->save();
            }
        }
    }
    
    $payment = json_decode($order->payment_details);
    $testt=$order->payment_status;
    // dd($payment);
@endphp


<div class="modal-body px-3 pt-0">
<h5 class="modal-title strong-600 heading-5" >{{ translate('#')}}{{ $order->code }}</h5>
    <div style="margin-top:20px;font-size: 14px;">
    <div class="row">
                <div class="col-lg-5">
                @foreach ($order->orderDetails as $key => $orderDetail)
                @php
                    $totalPoint = [];
                    if (property_exists($payment,'bank_code')){
                        $pay_opt = "$payment->bank_code Virtual Account";
                        $pay_num = $payment->account_number;
                        $title = "VA";
                    }
                    elseif (property_exists($payment,'retail_outlet_name')) {
                        $pay_opt = $payment->retail_outlet_name;
                        $pay_num = $payment->payment_code;
                        $title = 'kode Pembayaran';
                    }
                    elseif (property_exists($payment,'card_brand')) {
                        $pay_opt = $payment->card_brand." (kartu kredit)";
                        $pay_num = $payment->masked_card_number;
                        $title = 'kode Kartu';
                    }
                    \Carbon\Carbon::setLocale('id');
                @endphp
                @if ($orderDetail->product != null)
                <div class="row" style="margin-bottom: 20px;">
                <div class="col-lg-6" style="max-width:40%">
                <a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank">
                    <img style="border: 1px solid #f0f0f0;border-radius: 10px;" src="{{ my_asset($orderDetail->product->thumbnail_img) }}" alt="" class="img-fluid mr-2">
                </a>
                @if ($orderDetail->delivery_status == "delivered")
                                                    @if ($order->user_status_konfrimasi == 1 )
                                                        @php
                                                            $order_rating = \App\Review::where(['product_id'=>$orderDetail->product->id,'user_id'=>Auth::user()->id])->first();
                                                            $rating = $order_rating != null ? $order_rating->rating : 0;
                                                        @endphp
                                                        <div class="mt-3" id="divratings{{ $key }}">
                                                            <select id="ratings{{ $key }}">
                                                                <option value=""></option>
                                                                <option value="1" {{ $rating == 1 ? "selected" : "" }}>1</option>
                                                                <option value="2" {{ $rating == 2 ? "selected" : "" }}>2</option>
                                                                <option value="3" {{ $rating == 3 ? "selected" : "" }}>3</option>
                                                                <option value="4" {{ $rating == 4 ? "selected" : "" }}>4</option>
                                                                <option value="5" {{ $rating == 5 ? "selected" : "" }}>5</option>
                                                            </select>
                                                        </div>
                                                        <div class="mt-3" id="divrating{{ $key }}" style="display: none">
                                                            <select id="updaterating{{ $key }}">
                                                                <option value=""></option>
                                                                <option value="1" {{ $rating == 1 ? "selected" : "" }}>1</option>
                                                                <option value="2" {{ $rating == 2 ? "selected" : "" }}>2</option>
                                                                <option value="3" {{ $rating == 3 ? "selected" : "" }}>3</option>
                                                                <option value="4" {{ $rating == 4 ? "selected" : "" }}>4</option>
                                                                <option value="5" {{ $rating == 5 ? "selected" : "" }}>5</option>
                                                            </select>
                                                        </div>
                                                        <a href="#" id="reviewtext{{ $key }}">
                                                            <cite>{{ $rating != 0 ? "ubah review ?":"klik disini, lalu masukkan review anda" }}</cite>
                                                        </a>
                                                        <script>
                                                            $("#reviewtext{{ $key }}").click(function (e) {
                                                                e.preventDefault()
                                                                $("#divratings{{ $key }}").hide()
                                                                $("#divrating{{ $key }}").show()
                                                            })
                                                            $("#ratings{{ $key }}").barrating({theme: 'fontawesome-stars',readonly:true})
                                                            $('#updaterating{{ $key }}').barrating({
                                                                theme: 'fontawesome-stars',
                                                                onSelect: function(value, text, event) {
                                                                    if (typeof(event) !== 'undefined') {
                                                                        let data = {
                                                                            "_token": "{{ csrf_token() }}",
                                                                            "product_id": "{{ $orderDetail->product->id }}",
                                                                            "rating":value
                                                                        }
                                                                        $.post("{{ route('rate.order') }}",data,function (respon) {
                                                                            if (respon == "sukses") {
                                                                                $('#ratings{{ $key }}').barrating('set', value);
                                                                                $("#divrating{{ $key }}").hide()
                                                                                $("#divratings{{ $key }}").show()
                                                                                $("#reviewtext{{ $key }}").html("<cite style='color:green'>berhasil review!</cite>")
                                                                            }
                                                                        })
                                                                    } else {
                                                                    // rating was selected programmatically
                                                                    // by calling `set` method
                                                                    }}
                                                            });
                                                        </script>
                                                    @endif
                                            @else
                                           
                                                <strong>{{  translate('Review Belum Tersedia') }}</strong>
                                            @endif
                </div>
                <div class="col-lg-6">
                <span class="judul-pesanan__ font-weight-bold" style="font-size: 14px; text-transform:capitalize">{{ $orderDetail->product->name }} <span>{{ $orderDetail->variation }}</span></span>
                <p style="color:#818a91;margin-bottom: 0px;">Jumlah Pesanan</p>
                <span style="color:#000000;font-weight:bold">{{ $orderDetail->quantity }}</span>
                <p style="color:#818a91;margin-bottom: 0px;">Harga</p>
                <span style="color:#000000;font-weight:bold">{{ single_price($orderDetail->price) }}</span>
                </div>
                </div>
                @endif
                @endforeach
                </div>
                <div class="col-lg-4">
                <div style="margin-bottom: 20px;">
                <p style="margin-bottom:0px">Kode pesanan</p>
                <span style="color:#000000;font-weight:bold">{{ $order->code }}</span>
                </div>
                <div style="margin-bottom: 20px;">
                <p style="margin-bottom:0px">Tanggal Pesanan</p>
                <span style="color:#000000;font-weight:bold">{{ date('d M Y', $order->date) }}</span>
                </div>
                <div style="margin-bottom: 20px;">
                <p style="margin-bottom:0px">Status Pesanan</p>
                @if($testt ==  'unpaid')
                <span style="color:#000000;font-weight:bold">Belum Dibayar</span>
                @elseif($testt ==  'paid')
                <span style="color:#000000;font-weight:bold">Terbayar</span>
                @elseif($status == 'on_review')
                <span style="color:#000000;font-weight:bold">Sedang Diproses</span>
                @elseif($status == 'on_delivery')
                <span style="color:#000000;font-weight:bold">Dalam Pengiriman</span>
                @elseif($status == 'delivered')
                <span style="color:#000000;font-weight:bold">Selesai</span>
                @else
                <span style="color:#000000;font-weight:bold">Pending</span>
                @endif
                </div>
                <div style="margin-bottom: 20px;">
                <p style="margin-bottom:0px">Subtotal</p>
                <span style="color:#000000;font-weight:bold">{{ single_price($order->grand_total) }}</span>
                </div>
                <div style="margin-bottom: 20px;">
                <p style="margin-bottom:0px">Pengiriman</p>
                <span style="color:#000000;font-weight:bold">{{ single_price($order->shipping_cost) }}</span>
                </div>
                @if(Auth::user()->user_type == 'regular physician' || Auth::user()->user_type == 'partner physician')
                <div style="margin-bottom: 20px;">
                <p style="margin-bottom:0px">Poin Diskon</p>
                <span style="color:#000000;font-weight:bold">{{ single_price($order->poin_convert) }}</span>
                </div>
                <div style="margin-bottom: 20px;">
                <p style="margin-bottom:0px">Diskon</p>
                <span style="color:#000000;font-weight:bold">@if($order->type_discount == 'amount')<span>Rp</span>@endif{{ $order->discount }}@if($order->type_discount == 'percent')<span>%</span>@endif</span>
                </div>
                @else
                <div style="margin-bottom: 20px;">
                <p style="margin-bottom:0px">Diskon</p>
                <span style="color:#000000;font-weight:bold">@if($order->type_discount == 'amount')<span>Rp</span>@endif{{ $order->discount }}@if($order->type_discount == 'percent')<span>%</span>@endif</span>
                </div>
                @endif
                <div style="margin-bottom: 20px;">
                <p style="margin-bottom:0px">Poin</p>
                <span style="color:#000000;font-weight:bold">{{$order->get_poin}}</span>
                </div>
                </div>
                
                <div class="col-lg-3">
                @if ($status == "on_delivery" || $status =="delivered" && $ship != null)
                @if ($shp->status->code == 200)
                <a onClick="pengiriman_details({{ $order->id }})" class="btn btn-styled btn-sm btn-base-1 mt-3" style="width: 80%;background-color: #3B6CB6;"><span style="font-size:15px;color:#FFFFFF">{{  translate('Detail Pengiriman') }}</span></a>
                @elseif($shp->status->code == 400)
                <span>{{ "nomor resi yang dimasukkan tidak valid" }}</span>
                @endif
                @endif
                @if ($order->payment_status == "paid" && $order->delivery_status == "on_delivery")
            @if ($order->user_status_konfrimasi == null )
                    <a href="{{ route('confirm.order',['id'=>encrypt($order->id),'poin'=>array_sum($totalPoint)]) }}"class="btn btn-styled btn-sm btn-base-1 mt-3" style="width: 80%;background-color: #3B6CB6;margin-bottom: 20px;"><span style="font-size:15px;color:#FFFFFF">{{  translate('Konfirmasi') }}</span></a></br>
                    <cite style="color: darkslategrey;font-size:12px">*lakukan konfirmasi order telah selesai</cite>
                    {{-- @else
                 @if ($orderDetail->product->refundable != 0 && $today_date <= $last_refund_date && $orderDetail->delivery_status == 'delivered' && $order->user_status_konfrimasi != 0)
                                                    <a href="#" class="btn btn-styled btn-sm btn-base-1 mt-3" style="width: 100%;" onclick="confirm_refund('{{route('refund_request_send_page', ['id'=>$orderDetail->id,'poin'=>$orderDetail->product->earn_point])}}','{{ $orderDetail->product->name }}','{{ $potongan_poin }}')" class="btn btn-styled btn-sm btn-base-1">{{  translate('Komplain') }}</a>
                @endif --}}
                
                @endif
            @endif
            <div style="margin-bottom: 20px;">
                <p style="margin-bottom:0px">Total Pesanan</p>
                <span style="color:#3B6CB6;font-weight:bold">{{ single_price($order->grand_total) }}</span>
                </div>
                
                <div style="margin-bottom: 20px;">
                <p style="margin-bottom:0px">Metode Pembayaran</p>
                <span style="color:#000000;font-weight:bold">{{ $pay_opt }}</span>
                </div>
                <div style="margin-bottom: 20px;">
                <p style="margin-bottom:0px">{{ $title }}:</p>
                <span style="color:#000000;font-weight:bold">{{ $pay_num }}</span>
                </div>
                @if (property_exists($payment,'bank_code'))
                        @php
                        $logo= strtolower($payment->bank_code);
                        @endphp
                <div>
                    <img style="border: none;height: 50%;width: 50%;" class="logo-bank" src="{{my_asset("/images/icon/Bank/$logo-02.png")}}" alt="">
                </div>
                @elseif (property_exists($payment,'retail_outlet_name'))
                    @if(strtolower($payment->retail_outlet_name) == 'alfamart')
                    <div>
                    <img style="border: none;height: 50%;width: 50%;" class="logo-bank" src="{{my_asset('/images/icon/Alfmart/alfamart.png')}}" alt="">
                    </div>
                    @else
                    <div>
                    <img style="border: none;height: 50%;width: 50%;" class="logo-bank" src="{{my_asset('/images/icon/Indomart/indomaret-02.png')}}" alt="">
                    </div>
                    @endif
                @else
                <div>
                    <img style="border: none;height: 50%;width: 50%;" class="logo-bank" src="{{my_asset('/images/icon/Kartukredit/visa-02.png')}}" alt="">
                </div>
                @endif        

                </div>
                
    </div>            
    </div>
                                   
  
  
  <!-- Modal -->
  <div class="modal fade" id="modalConfirm" tabindex="-1" aria-labelledby="modalConfirmLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalConfirmLabel">Konfirmasi Refund</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
            @php
                $poin = Session::has('poin_use') ? Session::get('poin_use') : Auth::user()->poin;
            @endphp
            <input type="hidden" id="authpoin" value="{{ $poin }}">
            <div class="modal-body" id="bodi-konfir"></div>
            <div class="modal-footer" id="footer-konfir">
                <button type="button" class="btn btn-secondary" onclick="modal_hide()">Batal</button>
            </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal detail pengiriman -->
<div class="modal fade" id="shipping_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div style="max-width: 600px;" class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size"
            role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <div id="shipping-details-modal-body">

                </div>
            </div>
        </div>
    </div>
<!-- modal confirm komplain -->
    <div class="modal fade" id="modalConfirmRefund" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div id="modalConfirmRefundbody" class="modal-body">
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="text-center">
                                <p>Pastikan Klik Button Konfirmasi terlebih dahulu untuk proses komplain/Refund</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0" style="display:flex;justify-content: center;">
                        <div style="display: flex;justify-content: space-between;">
                        <a onclick="refundConfirmClose()">
                            <button class="btn btn-primary1 w-100">Cancel</button>
                        </a>
                        </div>
                    </div>
                                                      
                 </div>
            </div>
        </div>
    </div>
<script>
    function confirm_refund(link,nama,poin) {
        let authpoin = $("#authpoin").val();
        if(poin <= authpoin){
            $("#bodi-konfir").html(`
            <span>Melakukan refund pada produk ${nama} akan mengurangi ${poin} poin, <br> poin anda saat ini ${authpoin}</span>
            `)
            $("#footer-konfir").append(`
            <a href="${link}" id="lakukan-refund" class="btn btn-primary">Tetap Komplain ?</a>
            `)
        }else{
            $("#bodi-konfir").html(`
            <span>Maaf, refund membutuhkan ${poin} poin, poin anda saat ini ${authpoin}</span>
            `)
        }
        $("#modalConfirm").modal("show")
    }

    function modal_hide() {
        $("#modalConfirm").modal("hide")
    }
    function refundConfirm() {
        $("#modalConfirmRefund").modal("show")
    }
    function refundConfirmClose() {
        $("#modalConfirmRefund").modal("hide")
    }
</script>