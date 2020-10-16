@php
	$ship = json_decode($ship)->rajaongkir->result;
	$waktuKirim = $ship->details->waybill_date." ". $ship->details->waybill_time;
	$statusKirim = $ship->delivery_status->status;
	$kurir = $ship->summary->courier_name;
	$manifest = $ship->manifest;
	// dd($manifest);
@endphp
@extends('layouts.app')

@section('content')

    <div class="panel">
    	<div class="panel-body">
    		<div class="invoice-masthead">
    			<div class="invoice-text">
    				<h3 class="h1 text-thin mar-no text-primary">{{ translate('Order Details') }}</h3>
    			</div>
    		</div>
            <div class="row">
                @php
                    $delivery_status = $order->orderDetails->first()->delivery_status;
                    $payment_status = $order->orderDetails->first()->payment_status;
                @endphp
                <div class="col-lg-offset-3 col-lg-3">
                    <label for="update_payment_status">{{translate('Payment Status')}}</label>
                    <select class="form-control demo-select2"  data-minimum-results-for-search="Infinity" id="update_payment_status">
                        <option value="paid" @if ($payment_status == 'paid') selected @endif>{{translate('Paid')}}</option>
                        <option value="unpaid" @if ($payment_status == 'unpaid') selected @endif>{{translate('Unpaid')}}</option>
                    </select>
                </div>
                <div class="col-lg-3">
					<div class="row">
						<label for="update_delivery_status">{{ translate('nomor Resi :')}}</label>
					</div>
                    <select class="form-control demo-select2"  data-minimum-results-for-search="Infinity" id="update_delivery_status">
                        <option value="pending" @if ($delivery_status == 'pending') selected @endif>{{translate('Pending')}}</option>
                        <option value="on_review" @if ($delivery_status == 'on_review') selected @endif>{{translate('On review')}}</option>
                        <option value="on_delivery" @if ($delivery_status == 'on_delivery') selected @endif>{{translate('On delivery')}}</option>
                        <option value="delivered" @if ($delivery_status == 'delivered') selected @endif>{{translate('Delivered')}}</option>
					</select>
				</div>
				<div class="col-lg-3">
					<div class="row" style="margin-top: 1px" id="row-resi">
						<span id="resi" style="color: #3b78e2">{{ $order->resi }}</span>
						<form action="{{ route('add.resi',encrypt($order->id)) }}" method="POST">
							@csrf
							@method('put')
							<input type="text" name="resi" id="resi" class="form-control">
							<button type="submit" class="btn btn-primary" style="margin-top: 3px;float: right;"><i class="fa fa-file" aria-hidden="true"></i></button>
						</form>
					</div>
                </div>
            </div>
            <hr>
    		<div class="invoice-bill row">
    			<div class="col-sm-6 text-xs-center">
    				<address>
                        
                        <strong class="text-main">{{ translate('ALAMAT PENGIRIMAN') }}</strong>
        				<strong class="text-main">{{ $order->addresse->name }}</strong><br>
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
                        Name: {{ json_decode($order->dropsiper)->nama }}<br>Phone: {{ json_decode($order->dropsiper)->nomor_tlp }}
                        <br>
        
                    @endif
    			</div>
    			<div class="col-sm-6 text-xs-center">
    				<table class="invoice-details">
    				<tbody>
    				<tr>
    					<td class="text-main text-bold">
    						{{translate('Order #')}}
    					</td>
    					<td class="text-right text-info text-bold">
    						{{ $order->code }}
    					</td>
    				</tr>
    				<tr>
    					<td class="text-main text-bold">
    						{{translate('Order Status')}}
    					</td>
                        @php
							$status = isset($order->resi) ? $statusKirim : $order->orderDetails->first()->delivery_status;
                        @endphp
    					<td class="text-right">
                            @if($status == 'delivered')
                                <span class="badge badge-success">{{ ucfirst(str_replace('_', ' ', $status)) }}</span>
                            @else
                                <span class="badge badge-info">{{ ucfirst(str_replace('_', ' ', $status)) }}</span>
                            @endif
    					</td>
    				</tr>
    				<tr>
    					<td class="text-main text-bold">
    						{{translate('Status Pengiriman')}}
    					</td>
    					<td class="text-right">
                            @if($ship->delivered)
                                <span class="badge badge-success">{{ ucfirst(str_replace('_', ' ', "Delivered")) }}</span>
							@else
								<a data-toggle="modal" data-target="#modalManifest" class="btn btn-info">{{ ucfirst(str_replace('_', ' ', $statusKirim)) }}</a>
                            @endif
						</td>
    				</tr>
    				<tr>
    					<td class="text-main text-bold">
    						{{translate('Order Date')}}
    					</td>
    					<td class="text-right">
    						{{ date('d-m-Y h:i A', $order->date) }}
    					</td>
    				</tr>
                    <tr>
    					<td class="text-main text-bold">
    						{{translate('Total amount')}}
    					</td>
    					<td class="text-right">
    						{{ single_price($order->orderDetails->sum('price') + $order->orderDetails->sum('tax')) }}
    					</td>
    				</tr>
                    <tr>
    					<td class="text-main text-bold">
    						{{translate('Payment method')}}
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
            						{{translate('Photo')}}
            					</th>
            					<th class="text-uppercase">
            						{{translate('Description')}}
            					</th>
                                <th class="text-uppercase">
            						{{translate('Delivery Type')}}
            					</th>
            					<th class="min-col text-center text-uppercase">
            						{{translate('Qty')}}
            					</th>
            					<th class="min-col text-center text-uppercase">
            						{{translate('Price')}}
            					</th>
            					<th class="min-col text-right text-uppercase">
            						{{translate('Total')}}
            					</th>
            				</tr>
        				</thead>
        				<tbody>
                            @php
                                $admin_user_id = \App\User::where('user_type', 'admin')->first()->id;
                            @endphp
                            @foreach ($order->orderDetails->where('seller_id', $admin_user_id) as $key => $orderDetail)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        @if ($orderDetail->product != null)
                    						<a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank"><img height="50" src={{ my_asset($orderDetail->product->thumbnail_img) }}/></a>
                                        @else
                                            <strong>{{ translate('N/A') }}</strong>
                                        @endif
                                    </td>
                					<td>
                                        @if ($orderDetail->product != null)
                    						<strong><a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank">{{ $orderDetail->product->name }}</a></strong>
                    						<small>{{ $orderDetail->variation }}</small>
                                        @else
                                            <strong>{{ translate('Product Unavailable') }}</strong>
                                        @endif
                					</td>
                                    <td>
                                        @if ($orderDetail->shipping_type != null && $orderDetail->shipping_type == 'home_delivery')
                                            {{ translate('Home Delivery') }}
                                        @elseif ($orderDetail->shipping_type == 'pickup_point')
                                            @if ($orderDetail->pickup_point != null)
                                                {{ $orderDetail->pickup_point->name }} ({{ translate('Pickup Point') }})
                                            @else
                                                {{ translate('Pickup Point') }}
                                            @endif
                                        @endif
                                    </td>
                					<td class="text-center">
                						{{ $orderDetail->quantity }}
                					</td>
                					<td class="text-center">
                						{{ single_price($orderDetail->price/$orderDetail->quantity) }}
                					</td>
                                    <td class="text-center">
                						{{ single_price($orderDetail->price) }}
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
    					{{ single_price($order->orderDetails->where('seller_id', $admin_user_id)->sum('price')) }}
    				</td>
    			</tr>
    			<tr>
    				<td>
    					<strong>{{translate('Tax')}} :</strong>
    				</td>
    				<td>
    					{{ single_price($order->orderDetails->where('seller_id', $admin_user_id)->sum('tax')) }}
    				</td>
    			</tr>
                <tr>
                    <td>
                        <strong>{{translate('Shipping')}} :</strong>
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
		<div class="modal-footer">
		  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		</div>
	  </div>
	</div>
  </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('#update_delivery_status').on('change', function(){
            var order_id = {{ $order->id }};
            var status = $('#update_delivery_status').val();
            $.post('{{ route('orders.update_delivery_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
                showAlert('success', 'Delivery status has been updated');
            });
        });

        $('#update_payment_status').on('change', function(){
            var order_id = {{ $order->id }};
            var status = $('#update_payment_status').val();
            $.post('{{ route('orders.update_payment_status') }}', {_token:'{{ @csrf_token() }}',order_id:order_id,status:status}, function(data){
                showAlert('success', 'Payment status has been updated');
            });
        });
    </script>
@endsection
