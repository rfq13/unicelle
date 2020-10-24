

<div class="modal-header">
    <h5 class="modal-title strong-600 heading-5" style="color: #006064;">{{ translate('Order id')}}: {{ $order->code }}</h5>
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
    
    
@endphp


<div class="modal-body gry-bg px-3 pt-0">


    <div class="pt-4">
        <ul class="process-steps clearfix">
            <li @if($status == 'pending') class="active"  @else class="done"  @endif >
                <div class="icon">{{ translate('1')}}</div>
                <div class="title">{{ translate('Order placed')}}</div>
            </li>
            <li @if($status == 'on_review') class="active" @elseif($status == 'on_delivery' || $status == 'delivered') class="done"  @endif>
                <div class="icon">{{ translate('2')}}</div>
                <div class="title">{{ translate('On review')}}</div>
            </li>
            <li @if($status == 'on_delivery') class="active" @elseif($status == 'delivered') class="done"  @endif>
                <div class="icon">{{ translate('3')}}</div>
                <div class="title">{{ translate('On delivery')}}</div>
            </li>
            <li @if($status == 'delivered') class="done" @endif>
                <div class="icon" >{{ translate('4')}}</div>
                <div class="title">{{ translate('Delivered')}}</div>
            </li>
        </ul>
    </div>
    <div class="card mt-4">
        <div class="card-header py-2 px-3 heading-6 strong-600 clearfix" style="background-color: #006064;">
            <div class="float-left text-white" >{{ translate('Order Summary')}}</div>
        </div>
        <div class="card-body pb-0">
            <div class="row">
                <div class="col-lg-6">
                    <table class="details-table table">
                        <tr>
                            <td class="w-50 strong-600">{{ translate('Order Code')}}:</td>
                            <td>{{ $order->code }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{ translate('Customer')}}:</td>
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
                            <td class="w-50 strong-600">{{ translate('Order date')}}:</td>
                            <td>{{ date('d-m-Y H:i A', $order->date) }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{ translate('Order status')}}:</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $status)) }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{ translate('Total order amount')}}:</td>
                            <td>{{ single_price($order->orderDetails->sum('price') + $order->orderDetails->sum('tax')) }}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{ translate('Shipping method')}}:</td>
                            <td>{{ translate('Flat shipping rate')}}</td>
                        </tr>
                        <tr>
                            <td class="w-50 strong-600">{{ translate('Payment method')}}:</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9">
                <div class="card mt-4">
                    <div class="card-header py-2 px-3 heading-6 strong-600 text-white" style="background-color: #006064;">{{ translate('Order Details')}}</div>
                    <div class="card-body pb-0">
                        <table class="details-table table table-responsive">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="30%">{{ translate('Product')}}</th>
                                    <th>{{ translate('Variation')}}</th>
                                    <th>{{ translate('Quantity')}}</th>
                                    <th>{{ translate('Delivery Type')}}</th>
                                    <th>{{ translate('Price')}}</th>
                                    @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                                        <th>{{ translate('Refund')}}</th>
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
                                                    $detailOrder = $order->orderDetails[0];
                                                    $photos = $detailOrder->product == null ? "" :
                                                    $detailOrder->product->thumbnail_img;
                                                @endphp
                                                <a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank">
                                                    <img src="{{ my_asset($photos) }}" alt="" width="40" height="40" class="img-fluid mr-2">
                                                        {{ $orderDetail->product->name }}
                                                    </div>
                                                </a>
                                                @if ($orderDetail->delivery_status == "delivered")
                                                    @if ($orderDetail->confirmed == 1 )
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
                                                        <a href="#" id="reviewtext">
                                                            <cite>{{ $rating != 0 ? "ubah review ?":"masukkan review anda" }}</cite>
                                                        </a>
                                                        <script>
                                                            $("#reviewtext").click(function (e) {
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
                                                                                $("#reviewtext").html("<cite style='color:green'>berhasil review!</cite>")
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
                                           
                                                <strong>{{  translate('Product Unavailable') }}</strong>
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
                                            @endphp
                                            <td class="text-center">
                                                @if ($orderDetail->product != null && $orderDetail->product->refundable != 0 && $orderDetail->refund_request == null && $today_date <= $last_refund_date && $orderDetail->delivery_status == 'delivered')
                                                    <a href="#" onclick="confirm_refund('{{route('refund_request_send_page', ['id'=>$orderDetail->id,'poin'=>$orderDetail->product->earn_point])}}','{{ $orderDetail->product->name }}','{{ $orderDetail->product->earn_point }}')" class="btn btn-styled btn-sm btn-base-1">{{  translate('Send') }}</a>
                                                @elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 0)
                                                    <span class="strong-600">{{  translate('Pending') }}</span>
                                                @elseif ($orderDetail->refund_request != null && $orderDetail->refund_request->refund_status == 1)
                                                    <span class="strong-600">{{  translate('Approved') }}</span>
                                                @elseif ($orderDetail->product->refundable != 0)
                                                    <span class="strong-600">{{  translate('N/A') }}</span>
                                                @else
                                                    <span class="strong-600">{{  translate('Non-refundable') }}</span>
                                                @endif
                                            </td>
                                        @endif
                                        @if ($orderDetail->delivery_status == "delivered")
                                            @if ($orderDetail->confirmed == 0 )
                                                <td class="text-center">
                                                    <a href="{{ route('confirm.product',encrypt($orderDetail->id)) }}" class="btn btn-primary">Konfirmasi Penerimaan Produk</a>
                                                </td>
                                            @endif
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
                <div class="text-white card-header py-2 px-3 heading-6 strong-600" style="background-color: #006064;">{{ translate('Order Ammount')}}</div>
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
                                <th>{{ translate('Shipping')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">{{ single_price($order->shipping_cost) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>{{ translate('Tax')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">{{ single_price($order->orderDetails->sum('tax')) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>{{ translate('Coupon Discount')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">{{ single_price($order->coupon_discount) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>{{ translate('Point Discount')}}</th>
                                <td class="text-right">
                                    <span class="text-italic">{{ single_price($order->poin_convert) }}</span>
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
            </div>
            @if ($order->manual_payment && $order->manual_payment_data == null)
                <button onclick="show_make_payment_modal({{ $order->id }})" class="btn btn-block btn-base-1">{{ translate('Make Payment')}}</button>
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

<script>
    function confirm_refund(link,nama,poin) {
        let authpoin = $("#authpoin").val()
        if(authpoin > poin){
            $("#bodi-konfir").html(`
            <span>Melakukan refund pada produk ${nama} akan mengurangi ${poin} poin, <br> poin anda saat ini ${authpoin}</span>
            `)
            $("#footer-konfir").append(`
            <a href="${link}" id="lakukan-refund" class="btn btn-primary">Tetap Refund ?</a>
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
</script>