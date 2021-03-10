@php
	if (isset($order->resi)) {
		$rajaongkir = json_decode($ship)->rajaongkir;
		if ($rajaongkir->status->code == 200) {
			$ship = $rajaongkir->result;
			$waktuKirim = $ship->details->waybill_date." ". $ship->details->waybill_time;
			$statusKirim = $ship->delivery_status->status;
			$kurir = $ship->summary->courier_name;
			$manifest = $ship->manifest;
			$penerima = $ship->delivery_status->pod_receiver;
			$tglTerima = $ship->delivery_status->pod_date." ".$ship->delivery_status->pod_time;

			// if ($ship->delivered) {
			// 	foreach ($order->orderDetails as $key => $detail) {
			// 		$detail->delivery_status = "delivered";
			// 		$detail->save();
			// 	}
			// }
		}
		// dd($rajaongkir);
	}
@endphp
@extends('layouts.app')

@section('content')

    <div class="panel">
    	<div class="panel-body">
    		<div class="invoice-masthead">
    			<div class="invoice-text">
    				<h3 class="h1 text-thin mar-no text-primary">{{ translate('Detail Order') }}</h3>
    			</div>
    		</div>
            <div class="row">
                @php
                    $delivery_status = $order->orderDetails->first()->delivery_status;
                    $payment_status = $order->orderDetails->first()->payment_status;
                @endphp
                <div class="col-lg-offset-3 col-lg-3">
                    <label for="update_payment_status">{{translate('Status Pembayaran')}}</label>
                    <select class="form-control demo-select2"  data-minimum-results-for-search="Infinity" id="update_payment_status">
                        <option value="paid" @if ($payment_status == 'paid') selected @endif>{{translate('Pembayaran Berhasil')}}</option>
                        <option value="unpaid" @if ($payment_status == 'unpaid') selected @endif>{{translate('Belum Dibayar')}}</option>
                    </select>
                </div>
                <div class="col-lg-3">
					<div class="row">
						<label for="update_delivery_status">{{ translate('Status Pesanan :')}}</label>
					</div>
					<input type="hidden" id="status-order" value="{{ $delivery_status }}">
                    <select class="form-control demo-select2"  data-minimum-results-for-search="Infinity" id="update_delivery_status">
                        <option value="pending" @if ($delivery_status == 'pending') selected @endif>{{translate('Pending')}}</option>
                        {{-- <option value="on_review" @if ($delivery_status == 'on_review') selected @endif>{{translate('On review')}}</option> --}}
						<option value="on_delivery" @if ($delivery_status == 'on_delivery') selected @endif>{{translate('Dikirim')}}</option>
                        @if ($delivery_status == 'delivered')<option value="delivered" selected>{{translate('Terkirim')}}</option>@endif
					</select>
				</div>
				<div class="col-lg-3">
					<div class="row">
						<label for="update_delivery_status">{{ translate('Resi Pengiriman :')}}</label>
						<div class="row" style="margin-top: 6px;margin-left:1px;{{ isset($order->resi) ? '' : 'font-style:italic' }}" id="row-resi">
						<a data-toggle="modal" data-target="#modalResi" id="span-resi" style="color: #{{ isset($order->resi) ? '3b78e2' : '717171' }}">{{ isset($order->resi) ? $order->resi : "resi pengiriman masih kosong" }}</a>
					</div>
					</div>
				</div>  
				
				{{-- <div class="col-lg-1">
				<div class="row">
				@php
				$dt = \Carbon\Carbon::now();
                $now=$dt->toDateString();				
				$check= \App\Log_resi::where('order_id',$order->id)->first();
				if ($check != null && $check->count() > 0) {
				$tgl_berakhir = $check->created_at->format('Y-m-d');
				$now_date = str_replace("-", "", $now);
				$created_date = str_replace("-", "", $tgl_berakhir);
				$datadata=$now_date-$created_date;
				}
				@endphp
				@if($check != null && $check->count() > 0) 
				@if($datadata >= '14' && $delivery_status == 'on_delivery')
				<a href="{{ route('confirm.order.admin',encrypt($order->id)) }}" >
                         <button type="button" style="background-color:#007944;color:#ffffff" class="btn btn-primary1">Selesai</button></a>
				@else
				<a href="#" >
                         <button type="button" style="background-color:#E6E6FA;color:#808080" class="btn btn-primary1">Selesai</button></a>
				@endif
				@endif
					</div>
					
				</div> --}}
            </div>
            <hr>
    		<div class="invoice-bill row">
    			<div class="col-sm-6 text-xs-center">
    				<address>
					<strong class="text-main">{{ translate('DETAIL PENERIMA') }}</strong><br>
                        {{$order->addresse->receiver}}<br>
						{{$order->user->email}}<br>
                        <strong class="text-main">{{ translate('ALAMAT PENGIRIMAN') }}</strong><br>
        				{{ $order->addresse->address }}<br>
                         {{ $order->addresse->phone }}<br>
        				 {{ $order->addresse->address }}, {{ $order->addresse->subdistrict }}, {{ $order->addresse->city }}<br>{{ $order->addresse->province }},{{ $order->addresse->postal_code }}
                    </address>
                    @if ($order->manual_payment && is_array(json_decode($order->manual_payment, true)))
                        <br>
                        <strong class="text-main">{{ translate('Payment Information') }}</strong><br>
                        No Rek. : {{ json_decode($order->manual_payment)->norek }}<br> A/n : {{ json_decode($order->manual_payment)->name }}
                        <br>
                        <a href="{{ my_asset(json_decode($order->manual_payment)->foto) }}" target="_blank"><img src="{{ my_asset(json_decode($order->manual_payment)->foto) }}" alt="" height="100"></a>
                    @endif

                    @if ($order->dropsiper && is_array(json_decode($order->dropsiper, true)))
                        <br><br>
                        <strong class="text-main">{{ translate('DROPSHIPPER') }}</strong><br>
                        Name: {{ json_decode($order->dropsiper)->nama }}<br>Phone: {{ json_decode($order->dropsiper)->nomor_tlp }} <br> Kota Pengirim: {{ json_decode($order->dropsiper)->kota_pengirim }}
                        <br>
        
                    @endif
    			</div>
    			<div class="col-sm-6 text-xs-center">
    				<table class="invoice-details">
    				<tbody>
    				<tr>
    					<td class="text-main text-bold">
    						{{translate('Pesanan #')}}
    					</td>
    					<td class="text-right text-info text-bold">
    						{{ $order->code }}
    					</td>
    				</tr>
    				<tr>
    					<td class="text-main text-bold">
    						{{translate('Status Pesanan')}}
    					</td>
						@php
						// dd([$order->orderDetails->first()->delivery_status,$order->orderDetails->first()->delivery_status=="delivered"]);
						$status = $order->orderDetails->first()->delivery_status == "on_delivery" ? "Dikirim":"Pending";
						$status = $order->orderDetails->first()->delivery_status == "delivered" ? "Terkirim" : $status;
						// if (isset($order->resi)) {
						// 	if ($rajaongkir->status->code == 200) {
						// 		$status = $statusKirim;
						// 	}
						// }
                        @endphp
    					<td class="text-right">
							<a href="#" {{ isset($order->resi) ? 'data-toggle="modal" data-target="#modalManifest"' : "" }}>
								<span class="badge {{ $order->orderDetails->first()->delivery_status == "delivered" ? "badge-success" : "badge-info" }}">{{ ucfirst(str_replace('_', ' ', $status)) }}</span>
							</a>
    					</td>
					</tr>
					@if (isset($order->resi) && $rajaongkir->status->code == 200)
					<tr>
						<td class="text-main text-bold">
						{{translate('Status Pengiriman')}}
						</td>
						<td class="text-right">
							<a href="#" data-toggle="modal" data-target="#modalManifest">
								<span class="badge badge-info">{{ ucfirst(str_replace('_', ' ', $statusKirim)) }}</span>
							</a>
    					</td>
					</tr>
					@endif
    				<tr>
    					<td class="text-main text-bold">
    						{{translate('Tanggal Order')}}
    					</td>
    					<td class="text-right">
    						{{ date('d-m-Y h:i A', $order->date) }}
    					</td>
    				</tr>
                    <tr>
    					<td class="text-main text-bold">
    						{{translate('Total')}}
    					</td>
    					<td class="text-right">
    					{{ single_price($order->grand_total) }}
    					</td>
    				</tr>
                    <tr>
    					<td class="text-main text-bold">
    						{{translate('Metode Pembayaran')}}
    					</td>
    					<td class="text-right">
    						{{ ucfirst(str_replace('_', ' ', $order->payment_type)) }}
    					</td>
    				</tr>
    				</tbody>
    				</table>
    			</div>
    		</div>
    		<hr class="new-section-sm bord-no">
    		<div class="row">
    			<div class="col-lg-12 table-responsive">
    				<table class="table table-bordered invoice-summary">
        				<thead>
            				<tr class="bg-trans-dark">
                                <th class="min-col">#</th>
                                <th width="10%">
            						{{translate('Gambar')}}
            					</th>
            					<th class="text-uppercase">
            						{{translate('Deskripsi')}}
            					</th>
                                <th class="text-uppercase">
            						{{translate('Tipe Pengiriman')}}
            					</th>
            					<th class="min-col text-center text-uppercase">
            						{{translate('Qty')}}
            					</th>
            					<th class="min-col text-center text-uppercase">
            						{{translate('Harga')}}
            					</th>
            					<th class="min-col text-right text-uppercase">
            						{{translate('Total')}}
            					</th>
            				</tr>
        				</thead>
        				<tbody>
                            @php
                                $admin_user_id = \App\User::where('user_type', 'admin')->first()->id;
								$obj=json_decode($order->shipping_info);

                            @endphp
                            @foreach ($order->orderDetails as $key => $orderDetail)
							@php
                            $photo = $orderDetail->product->thumbnail_img != null ? $orderDetail->product->thumbnail_img : json_decode($OrderDetail->product->photos)[0];
                        @endphp
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        @if ($orderDetail->product != null)
                    						<a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank"><img height="50" src="{{ my_asset($photo) }}"></a>
                                        @else
                                            <strong>{{ translate('N/A') }}</strong>
                                        @endif
                                    </td>
                					<td>
                                        @if ($orderDetail->product != null)
                    						<strong><a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank">{{ $orderDetail->product->name }}</a></strong>
                    						<small>{{ $orderDetail->variation }}</small>
                                        @else
                                            <strong>{{ translate('Produk Tidak Tersedia') }}</strong>
                                        @endif
                					</td>
                                    <td>{{$obj->code}}
                                    </td>
                					<td class="text-center">
                						{{ $orderDetail->quantity }}
                					</td>
                					<td class="text-center">
                						{{ single_price($orderDetail->price) }}
                					</td>
                                    <td class="text-center">
                						{{ single_price($orderDetail->price*$orderDetail->quantity) }}
                					</td>
                				</tr>
                            @endforeach
        				</tbody>
    				</table>
    			</div>
    		</div>
    		<div class="clearfix">
    			<table class="table invoice-total">
    			<tbody>
    			<tr>
    				<td>
    					<strong>{{translate('Sub Total')}} :</strong>
    				</td>
    				<td>
    					{{ single_price($order->orderDetails->sum('price')*$order->orderDetails->sum('quantity')) }}
    				</td>
    			</tr>
    			<tr>
    				<td>
    					<strong>{{translate('Pajak')}} :</strong>
    				</td>
    				<td>
    					{{ single_price($order->orderDetails->sum('tax')) }}
    				</td>
    			</tr>
                <tr>
                    <td>
                        <strong>{{translate('Pengiriman')}} :</strong>
                    </td>
                    <td>
                        {{ single_price($order->shipping_cost) }}
                    </td>
                </tr>
                <tr>
    				<td>
    					<strong>{{translate('Point Discount')}} :</strong>
    				</td>
    				<td>
    					{{ single_price($order->poin_convert) }}
    				</td>
    			</tr>
				<tr>
    				<td>
    					<strong>{{translate('Discount')}} :</strong>
    				</td>
    				<td>
    					@if($order->type_discount == 'amount')<span>Rp</span>@endif{{ $order->discount }}@if($order->type_discount == 'percent')<span>%</span>@endif
    				</td>
    			</tr>
    			<tr>
    				<td>
    					<strong>{{translate('TOTAL')}} :</strong>
    				</td>
    				<td class="text-bold h4">
    					{{ single_price($order->grand_total) }}
    				</td>
    			</tr>
    			</tbody>
    			</table>
    		</div>
    		<div class="text-right no-print">
    			<a href="{{ route('seller.invoice.download', $order->id) }}" class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></a>
    		</div>
    	</div>
	</div>
  
  <!-- Modal -->
  <div class="modal fade" id="modalManifest" tabindex="-1" role="dialog" aria-labelledby="modalManifestLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="modalManifestLabel">Detail Pengiriman</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
			@isset($penerima)
				<span class="my-3" style="margin-top: 5px">telah diterima oleh: <strong>{{ $penerima }}</strong></span><br>
				<span class="mt-2">pada: <cite>{{ $tglTerima }}</cite></span>
			@endisset

			@if($order->resi != null && $rajaongkir->status->code == 400)
				<span>{{ $rajaongkir->status->description }}</span>
			@endif
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
					@php
						$cekStatus = "";
					@endphp
					@isset($order->resi)
						@if ($rajaongkir->status->code == 200)
						@php
							if($ship->delivered){
								$cekStatus = "terkirim";
							}
						@endphp
						@foreach ($manifest as $key => $history)
							<tr>
								<td>{{ $key+1 }}</td>
								<td>{{ $history->city_name }}</td>
								<td>{{ $history->manifest_date }} {{ $history->manifest_time }}</td>
								<td>{{ $history->manifest_description }}</td>
							</tr>
						@endforeach
						@endif
					@endisset
				</tbody>
				<input type="hidden" id="cek-status" value="{{ $cekStatus }}">
			  </table>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		</div>
	  </div>
	</div>
  </div>
  
  <!-- Modal form resi -->
  <div class="modal fade" id="modalResi" tabindex="-1" role="dialog" aria-labelledby="modalResiTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
	  <div class="modal-content">
		<div class="modal-header">
			@php
				$shipping_info = json_decode($order->shipping_info);
			@endphp
		  <h5 class="modal-title" id="exampleModalLongTitle" style="text-transform: capitalize">Input Resi {{ $shipping_info->code }}</h5>
		  <cite style="color:#717171">masukkan resi kurir {{ $shipping_info->code }} dengan layanan {{ $shipping_info->services }}</cite>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
			<form id="form-input-resi" action="{{ route('add.resi',encrypt($order->id)) }}" method="POST">
				@csrf
				@method('put')
				<input type="text" name="resi" id="input-resi" class="form-control" placeholder="masukken resi pengiriman" required>
			</div>
			<div class="modal-footer">
				<button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			</div>
		</form>
	  </div>
	</div>
  </div>
@endsection

@section('script')
	<script type="text/javascript">
		const statusOrder = $('#update_delivery_status');
		
        statusOrder.on('change', function(){
            var order_id = {{ $order->id }};
            var status = $(this).val();
			let orderStatus = $("#status-order").val()

			if(status == "on_delivery") {
				if ($("#span-resi").text() == "resi pengiriman masih kosong") {
					$(this).val(orderStatus)
					$("#modalResi").modal()
					return;
				}
				let cekStatus = $("#cek-status").val()
					if (cekStatus == "terkirim") {
						$(this).val(orderStatus)
						showAlert("warning","Barang sudah terkirim, status tidak dapat berubah"); return;
					}
			}else{
				$.post('{{ route('orders.update_delivery_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
					showAlert('success', 'Delivery status has been updated');
					$("#status-order").val($('#update_delivery_status').val())
				});
			}

        });

		$("#form-input-resi").on("submit", function (e) {
			e.preventDefault()
			let data = {
				_token: "{{ csrf_token() }}",
				resi: $("#input-resi").val()
			}
			let urL = $(this).attr("action")

			$.ajax(urL,{
				type:"put",
				data:data,
				success:function(data){
					if (data == 1) {
						$("#span-resi").text(data.resi)
						var order_id = {{ $order->id }};
						var status = "on_delivery"
						$.post('{{ route('orders.update_delivery_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
							showAlert('success', 'Delivery status has been updated');
							location.reload()
						});
					}
				}
			})
		})

        $('#update_payment_status').on('change', function(){
            var order_id = {{ $order->id }};
            var status = $('#update_payment_status').val();
				$.post('{{ route('orders.update_payment_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
                showAlert('success', 'Payment status has been updated');
            });
        });
    </script>
@endsection
