

<div class="modal-header">
    <h5 class="modal-title strong-600 heading-5" style="color: #006064;">{{ translate('Id Pesanan')}}: {{ $order->code }}</h5>
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
    // dd($payment);
@endphp


<div class="modal-body gry-bg px-3 pt-0">


    <div class="pt-4">
        <ul class="process-steps clearfix">
            <li @if($status == 'pending') class="active"  @else class="done"  @endif >
                <div class="icon">{{ translate('0')}}</div>
                <div class="title">{{ translate('Perlu Dibayar')}}</div>
            </li>
            <li @if($status == 'on_review') class="active" @elseif($status == 'on_delivery' || $status == 'delivered') class="done"  @endif>
                <div class="icon">{{ translate('1')}}</div>
                <div class="title">{{ translate('Diproses Admin')}}</div>
            </li>
            <li @if($status == 'on_delivery') class="active" @elseif($status == 'delivered') class="done"  @endif>
                <div class="icon">{{ translate('2')}}</div>
                <div class="title">{{ translate('Dalam Pengiriman')}}</div>
            </li>
            <li @if($status == 'delivered') class="done" @endif>
                <div class="icon" >{{ translate('3')}}</div>
                <div class="title">{{ translate('Selesai')}}</div>
            </li>
        </ul>
    </div>
    <div class="card mt-4">
        <div class="card-header py-2 px-3 heading-6 strong-600 clearfix" style="background-color: #006064;">
            <div class="float-left text-white" >{{ translate('Ringkasan Pesanan')}}</div>
        </div>
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-lg-6">
                    <table class="details-table table">
                        <tr>
                            <td class="w-50 strong-600">{{ translate('Kode Pesanan')}}:</td>
                            <td>{{ $order->code }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{ translate('Pelanggan')}}:</td>
                            <td>{{ $order->user->name }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{ translate('Email')}}:</td>
                            @if ($order->user_id != null)
                                <td>{{ $order->user->email }}</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{ translate('Shipping address')}}:</td>
                            <td>{{ $order->addresse->address }}, {{ $order->addresse->subdistrict }}, {{ $order->addresse->city }} {{ $order->addresse->postal_code }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6">
                    <table class="details-table table">
                        <tr>
                            <td class="w-50 strong-600">{{ translate('Tanggal Pesanan')}}:</td>
                            <td>{{ date('d-m-Y H:i A', $order->date) }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{ translate('Status Pesanan')}}:</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $status)) }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{ translate('Jumlah Total Pesanan')}}:</td>
                            <td>{{ single_price($order->orderDetails->sum('price') + $order->orderDetails->sum('tax')) }}</td>
                        </tr>
                        
                        {{-- <tr>
                            <td class="w-50 strong-600">{{ translate('Metode Pengiriman')}}:</td>
                            <td>{{ translate('Flat shipping rate')}}</td>
                        </tr> --}}

                        @if ($order->payment_details !=null)
                        @php
                            // {"status":"AUTHORIZED","authorized_amount":819000,"capture_amount":0,"currency":"IDR","credit_card_token_id":"601bac90b9f6ef0019d24875","business_id":"60189bffdf7ce6407ad6cc44","merchant_id":"xendit_ctv_agg","merchant_reference_code":"601bac90aee4610541c25370","external_id":"card_1612426386","eci":"07","charge_type":"SINGLE_USE_TOKEN","masked_card_number":"411111XXXXXX1111","card_brand":"VISA","card_type":"CREDIT","descriptor":"XENDIT*UNICELLE","authorization_id":"601bac988aa36b001b7ba0a6","bank_reconciliation_id":"6124263927646982803007","cvn_code":"M","approval_code":"831000","created":"2021-02-04T08:13:13.418Z","id":"601bac998aa36b001b7ba0a7"}

                            if (property_exists($payment,'bank_code')){
                                $pay_opt = "$payment->bank_code Virtual Account";
                                $pay_num = $payment->account_number;
                                $title = "VA";
                            }
                            elseif (property_exists($payment,'retail_outlet_name')) {
                                $pay_opt = $payment->retail_outlet_name;
                                $pay_num = $payment->payment_code;
                                $title = 'kode Pembayaran';
                            }elseif (property_exists($payment,'card_brand')) {
                                $pay_opt = $payment->card_brand." (kartu kredit)";
                                $pay_num = $payment->masked_card_number;
                                $title = 'kode Kartu';
                            }

                            \Carbon\Carbon::setLocale('id');
                        @endphp
                        <tr>
                            <td class="w-50 strong-600">{{ 'Metode Pembayaran' }}:</td>
                            <td>{{ $pay_opt }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{ $title }}:</td>
                            <td>{{ $pay_num }}</td>
                        </tr>
                        <tr>
                            @if ($order->payment_status == "unpaid")
                                <td class="w-50 strong-600">{{ "Kadaluarsa" }}:</td>
                                <td>{{ \Carbon\Carbon::parse($payment->expiration_date)->translatedFormat('l, d F Y H:i') }}</td>
                            @endif
                        </tr>
                            
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
                                    @php
                                        $totalPoint = [];
                                    @endphp
    <div class="row">
        <div class="col-lg-9">
                <div class="card mt-4">
                    <div class="card-header py-2 px-3 heading-6 strong-600 text-white" style="background-color: #006064;">{{ translate('Detail Pesanan')}}</div>
                    <div class="card-body pb-0">
                        <table class="details-table table table-responsive">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="30%">{{ translate('Produk')}}</th>
                                    <th>{{ translate('Variasi')}}</th>
                                    <th>{{ translate('Jumlah')}}</th>
                                    <th>{{ translate('Tipe Pengiriman')}}</th>
                                    <th>{{ translate('Harga')}}</th>
                                    @if ($refund_request_addon != null && $refund_request_addon->activated == 1 && $order->user_status_konfrimasi != 1)
                                        <th>{{ translate('')}}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody id="order-products">
                                @foreach ($order->orderDetails as $key => $orderDetail)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                            @if ($orderDetail->product != null)
                                                @php
                                                    array_push($totalPoint,$orderDetail->product->earn_point);
                                                    $detailOrder = $order->orderDetails[0];
                                                    $photos = $detailOrder->product == null ? "" :
                                                    $detailOrder->product->thumbnail_img;
                                                @endphp
                                                <a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank">
                                                    <img src="{{ my_asset($orderDetail->product->thumbnail_img) }}" alt="" width="40" height="40" class="img-fluid mr-2">
                                                        {{ $orderDetail->product->name }}
                                                    </div>
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
                                                @endif
                                            @else
                                           
                                                <strong>{{  translate('Produk Tidak Tersedia') }}</strong>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{ $orderDetail->variation }}
                                        </td>
                                        <td class="text-center">
                                            {{ $orderDetail->quantity }}
                                        </td>
                                        <td class="text-center">
                                            @php
                                            $shipping_info = json_decode($order->shipping_info);
                                            @endphp 
                                            {{--@if ($orderDetail->shipping_type != null && $orderDetail->shipping_type == 'home_delivery')
                                                {{  translate('Home Delivery') }}
                                            @elseif ($orderDetail->shipping_type == 'pickup_point')
                                                @if ($orderDetail->pickup_point != null)
                                                    {{ $orderDetail->pickup_point->name }} ({{  translate('Pickip Point') }})
                                                @endif
                                            @endif--}}
                                           
                                            {{ $shipping_info->code }} {{ $shipping_info->services }}
    
                                        </td>
                                        <td class="text-center">{{ single_price($orderDetail->price) }}</td>
                                        @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                                            @php
                                                $no_of_max_day = \App\BusinessSetting::where('type', 'refund_request_time')->first()->value;
                                                $last_refund_date = $orderDetail->created_at->addDays($no_of_max_day);
                                                $today_date = Carbon\Carbon::now();
                                                $search = \App\RefundRequest::where('order_id',$order->id)->get();
                                                $business_settings = \App\BusinessSetting::where('type', 'refund_request_poin')->first();
                                                if($business_settings != null){
                                                    $potongan_poin=$business_settings->value;
                                                }
                                                else{
                                                    $potongan_poin='0';
                                                }
                                                // $point_use = 
                                            @endphp
                                            <td class="text-center">
                                                @if ($search != null && $search->count() > 0)
                                                <span class="strong-600">{{  translate('Dalam Proses Penukaran / Refund') }}</span>
                                                @elseif ($orderDetail->product != null && $orderDetail->product->refundable != 0 && $today_date <= $last_refund_date && $order->delivery_status == 'on_delivery' && $order->user_status_konfrimasi != 1)
                                                    <a href="#" onclick="refundConfirm()" class="btn btn-styled btn-sm btn-base-1">{{  translate('Komplain') }}</a> 
                                                @elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 0)
                                                    <span class="strong-600">{{  translate('Tertunda') }}</span>
                                                @elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 1)
                                                    <span class="strong-600">{{  translate('Disetujui') }}</span>
                                                @elseif ($orderDetail->product->refundable != 0)
                                                    <span class="strong-600">{{  translate('N/A') }}</span>
                                                @else
                                                    <span class="strong-600">{{  translate('Tidak bisa dikembalikan') }}</span>
                                                @endif
                                            </td>
                                        @endif
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($status == "on_delivery" || $status =="delivered" && $ship != null)
                {{-- @php
                    dd($ship);
                @endphp --}}
                    {{-- @php
                    $rajaongkir = json_decode($ship)->rajaongkir;
                    @endphp --}}
                    @if ($shp->status->code == 200)
                        <div class="card mt-4">
                            <div class="card-header py-2 px-3 heading-6 strong-600">{{ translate('Detail Pengiriman')}}</div>
                            <div class="card-body pb-0">
                                @isset($penerima)
                                    <span class="my-3" style="margin-top: 5px;text-transform:capitalize">telah diterima oleh: <strong style="color:green">{{ $penerima }}</strong></span><br>
                                    <span class="mt-2" style="text-transform:capitalize">pada: <cite>{{ $tglTerima }}</cite></span>
                                @endisset
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Kota</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Deskripsi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($manifest as $key => $history)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $history->city_name }}</td>
                                                <td>{{ $history->manifest_date }} {{ $history->manifest_time }}</td>
                                                <td>{{ $history->manifest_description }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @elseif($shp->status->code == 400)
                        <span>{{ "nomor resi yang dimasukkan tidak valid" }}</span>
                    @endif
                @endif
        </div>
        <div class="col-lg-3">
            <div class="card mt-4">
                <div class="text-white card-header py-2 px-3 heading-6 strong-600" style="background-color: #006064;">{{ translate('Jumlah pesanan')}}</div>
                <div class="card-body pb-0">
                    <table class="table details-table">
                        <tbody>
                            <tr>
                                <th>{{ translate('Subtotal')}}</th>
                                <td class="text-right">
                                    <span class="strong-600">{{ single_price($order->orderDetails->sum('price')) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>{{ translate('Pengiriman')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">{{ single_price($order->shipping_cost) }}</span>
                                </td>
                            </tr>
                            {{-- <tr>
                                <th>{{ translate('Tax')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">{{ single_price($order->orderDetails->sum('tax')) }}</span>
                                </td>
                            </tr> --}}
                            {{-- <tr>
                                <th>{{ translate('Coupon Discount')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">{{ single_price($order->coupon_discount) }}</span>
                                </td>
                            </tr> --}}
                            @if(Auth::user()->user_type == 'regular physician' || Auth::user()->user_type == 'partner physician')
                            <tr>
                                <th>{{ translate('Point Diskon')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">{{ single_price($order->poin_convert) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>{{ translate('Diskon')}}</th>
                                <td class="text-right">
                                <span class="text-italic">@if($order->type_discount == 'amount')<span>Rp</span>@endif{{ $order->discount }}@if($order->type_discount == 'percent')<span>%</span>@endif</span>
                                </td>
                            </tr>
                            @else
                            <tr>
                                <th>{{ translate('Diskon')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">@if($order->type_discount == 'amount')<span>Rp</span>@endif{{ $order->discount }}@if($order->type_discount == 'percent')<span>%</span>@endif</span>
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <th>{{ translate('Poin')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">{{$order->get_poin}}</span>
                                </td>
                            </tr>
                            <tr>
                                <th><span class="strong-600">{{ translate('Total')}}</span></th>
                                <td class="text-right">
                                    <strong><span>{{ single_price($order->grand_total) }}</span></strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                {{-- @if ($order->manual_payment && $order->manual_payment_data == null)
                    <button onclick="show_make_payment_modal({{ $order->id }})" class="btn btn-block btn-base-1">{{ translate('Make Payment')}}</button>
                @endif --}}
            </div>
            @if ($order->payment_status == "paid")
            @if ($order->user_status_konfrimasi == null )
                    <a href="{{ route('confirm.order',['id'=>encrypt($order->id),'poin'=>array_sum($totalPoint)]) }}"class="btn btn-styled btn-sm btn-base-1 mt-3" style="width: 100%;"><span style="font-size:15px;color:#FFFFFF">{{  translate('Konfirmasi') }}</span></a>
                    <cite style="color: darkslategrey;font-size:12px">*lakukan konfirmasi order telah selesai</cite>
                @else
                @if ($orderDetail->product->refundable != 0 && $today_date <= $last_refund_date && $orderDetail->delivery_status == 'delivered' && $order->user_status_konfrimasi != 0)
                                                    <a href="#" class="btn btn-styled btn-sm btn-base-1 mt-3" style="width: 100%;" onclick="confirm_refund('{{route('refund_request_send_page', ['id'=>$orderDetail->id,'poin'=>$orderDetail->product->earn_point])}}','{{ $orderDetail->product->name }}','{{ $potongan_poin }}')" class="btn btn-styled btn-sm btn-base-1">{{  translate('Komplain') }}</a>
                @endif
                @endif
            @endif
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