<div class="modal-body">
    <div class="col-md-12">
        <div class="row">
        <div class="col-md-6">
        <h4>Detail Penerima</h4>
    {{$order->user->name}}</br>
    {{$order->user->email}}</br>
    {{$order->user->phone}}</br>
    </div>
    <div class="col-md-6">
  <h4>Alamat Pengiriman</h4>
    {{$order->addresse->address}}</br>
    {{$order->addresse->phone}}</br>
    {{ $order->addresse->address }}, {{ $order->addresse->subdistrict }}, {{ $order->addresse->city }}<br>{{ $order->addresse->province }},{{ $order->addresse->postal_code }}
    </div>
        </div>
    </div>

    <div class="col-md-12">
    <div>
    <h4 style="margin-top:20px">Detail Pesanan</h4>

    <table class="table table-striped res-table mar-no" cellspacing="0" width="100%">
  <tr>
    <th>Gambar</th>
    <th>Produk</th> 
    <th>Qty</th>
    <th>Harga</th>
    <th>Total</th>
  </tr>
  @foreach ($orderDetails as $key => $orderDetail)
  @php
  $photo = $orderDetail->product->thumbnail_img != null ? $orderDetail->product->thumbnail_img : json_decode($OrderDetail->product->photos)[0];
    @endphp
  <tr>
    <td><a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank"><img height="50" src="{{ my_asset($photo) }}"></a></td>
    <td><strong><a href="{{ route('product', $orderDetail->product->slug) }}" target="_blank">{{ $orderDetail->product->name }}</a></strong></td>
    <td>
    {{ $orderDetail->quantity }}
    </td>
    <td>
    {{ single_price($orderDetail->price) }}
    </td>
    <td>
    {{ single_price($orderDetail->price*$orderDetail->quantity) }}
    </td>
  </tr>
  @endforeach
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
    					<strong>{{translate('TOTAL')}} :</strong>
    				</td>
    				<td class="text-bold h4">
    					{{ single_price($order->grand_total) }}
    				</td>
    			</tr>
    			</tbody>
    			</table>
    		</div>
</div>
<div style="border-top:none" class="modal-footer border-0">
<button type="button" class="btn btn-danger mr-3"
    data-dismiss="modal">Close</button>
</div>


