<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <meta http-equiv="Content-Type" content="text/html;"/>
    <meta charset="UTF-8">
	<style media="all">
		@font-face {
            font-family: 'Roboto';
            src: url("{{ my_asset('fonts/Roboto-Regular.ttf') }}") format("truetype");
            font-weight: normal;
            font-style: normal;
        }
        *{
            margin: 0;
            padding: 0;
            line-height: 1.3;
            font-family: 'Roboto';
            color: #333542;
        }
		body{
			font-size: .875rem;
		}
		.gry-color *,
		.gry-color{
			color:#878f9c;
		}
		table{
			width: 100%;
		}
		table th{
			font-weight: normal;
		}
		table.padding th{
			padding: .5rem .7rem;
		}
		table.padding td{
			padding: .7rem;
		}
		table.sm-padding td{
			padding: .2rem .7rem;
		}
		.border-bottom td,
		.border-bottom th{
			border-bottom:1px solid #eceff4;
		}
		.text-left{
			text-align:left;
		}
		.text-right{
			text-align:right;
		}
		.small{
			font-size: .85rem;
		}
		.currency{

		}
	</style>
</head>
<body>
	<div style="margin-left:auto;margin-right:auto;">

		@php
        $order = \App\Order::where('id',$order_id)->first();
		$generalsetting = \App\GeneralSetting::first();

		@endphp

		<div style="border-bottom: 1px solid #eceff4;padding: 1.5rem;">
			<table>
				<tr>
					<td>
						@if (Auth::user()->user_type == 'seller')
							@if(Auth::user()->shop->logo != null)
                            <div style="display: flex;">
								<img loading="lazy"  src="{{ my_asset(Auth::user()->shop->logo) }}" height="40" style="display:inline-block;">
                                <span style="padding-top: 10px;padding-left: 10px;font-size: 18px;font-weight: 600;">Unicelle</span>
                            </div>
                            @else
                            <div style="display: flex;">
								<img loading="lazy"  src="{{ my_asset('frontend/images/logo/logo.png') }}" height="40" style="display:inline-block;">
                                <span style="padding-top: 10px;padding-left: 10px;font-size: 18px;font-weight: 600;">Unicelle</span>
                            </div>
							@endif
						@else
							@if($generalsetting->logo != null)
                            <div style="display: flex;">
								<img loading="lazy"  src="{{ my_asset($generalsetting->logo) }}" height="40" style="display:inline-block;">
                                <span style="padding-top: 10px;padding-left: 10px;font-size: 18px;font-weight: 600;">Unicelle</span>
                            </div>
                            @else
                            <div style="display: flex;">
								<img loading="lazy"  src="{{ my_asset('frontend/images/logo/logo.png') }}" height="40" style="display:inline-block;">
                                <span style="padding-top: 10px;padding-left: 10px;font-size: 18px;font-weight: 600;">Unicelle</span>
                            </div>
                            @endif
						@endif
					</td>
				</tr>
			</table>

		</div>
        
		<div style="padding: 1.5rem;padding-bottom: 0">
        <h2 style="color:#000000">{{ translate('Pesanan Baru') }}:</h2>
		</div>
		<div style="padding: 1.5rem;padding-bottom: 0;width: 100%;">
        <table class="table table-striped" style="width: 100%;">
        <thead>
        <th style="text-align:left">ID Pesanan</th>
        <th style="text-align:left">: {{$order->code}}</th>
        </thead>
        <thead>
        <th style="text-align:left">Nama</th>
        <th style="text-align:left;color:#3B6CB6">: {{$order->user->name}}</th>
        </thead>
        <thead>
        <th style="text-align:left">Email</th>
        <th style="text-align:left">: {{$order->user->email}}</th>
        </thead>
        <thead>
        <th style="text-align:left">No Telepon</th>
        <th style="text-align:left">: {{$order->user->phone}}</th>
        </thead>
        <thead>
        <th style="text-align:left">Alamat Pengiriman</th>
        <th style="text-align:left">: {{$order->addresse->address}}</th>
        </thead>
		<thead>
        <th style="text-align:left"><h4 style="color:#3B6CB6">{{ translate('Status Pembayaran') }}:</h4></th>
        @if($order->payment_status == 'paid')
        <th style="text-align:left"><h4 style="color:#3B6CB6">: Terbayar</h4></th>
        @else
        <th style="text-align:left"><h4 style="color:#3B6CB6">: Belum Terbayar</h4></th>
        @endif
        </thead>
    </table>
	    <div style="padding: 1.5rem;overflow-x:auto;">
			<table class="padding text-left small border-bottom">
				<thead>
	                <tr class="gry-color" style="background: #eceff4;">
	                    <th width="35%">{{ translate('Nama Produk') }}</th>
						<th width="15%">{{ translate('Tipe Pengiriman') }}</th>
	                    <th width="10%">{{ translate('Qty') }}</th>
	                    <th width="15%">{{ translate('Harga Satuan') }}</th>
	                    <th width="10%">{{ translate('Pajak') }}</th>
	                    <th width="15%" class="text-right">{{ translate('Total') }}</th>
	                </tr>
				</thead>
				<tbody class="strong">
					@php
						if ((Auth::user()->user_type == 'seller')) {
							$user_id = Auth::user()->id;
						}
						else {
							$user_id = \App\User::where('user_type', 'admin')->first()->id;
						}
						$obj=json_decode($order->shipping_info);

					@endphp
	                @foreach ($order->orderDetails as $key => $orderDetail)
		                @if ($orderDetail->product)
							<tr class="">
								<td>{{ $orderDetail->product->name }} @if($orderDetail->variation != null) ({{ $orderDetail->variation }}) @endif / {{$orderDetail->product->unit}}</td>
								<td>{{$obj->code}}</td>
								<td class="gry-color">{{ $orderDetail->quantity }}</td>
								<td class="gry-color currency">{{ single_price($orderDetail->price/$orderDetail->quantity) }}</td>
								<td class="gry-color currency">{{ single_price($orderDetail->tax/$orderDetail->quantity) }}</td>
			                    <td class="text-right currency">{{ single_price($orderDetail->price+$orderDetail->tax) }}</td>
							</tr>
		                @endif
					@endforeach
	            </tbody>
			</table>
		</div>

	    <div style="padding:0 1.5rem;">
	        <table style="width: 40%;margin-left:auto;" class="text-right sm-padding small strong">
		        <tbody>
					<tr>
			            <th class="gry-color text-left">{{ translate('Sub Total') }}</th>
			            <td class="currency">{{ single_price($order->orderDetails->sum('price')) }}</td>
			        </tr>
			        <tr>
			            <th class="gry-color text-left">{{ translate('Biaya Pengiriman') }}</th>
			            <td class="currency">{{ single_price($order->shipping_cost) }}</td>
			        </tr>
					
					@if(Auth::user()->user_type == 'regular physician' || Auth::user()->user_type == 'partner physician')
                            <tr>
							<th class="gry-color text-left">{{ translate('Point Diskon')}}</th>
							<td class="currency">{{ single_price($order->poin_convert) }}</td>
                            </tr>
                            <tr>
							<th class="gry-color text-left">{{ translate('Diskon')}}</th>
                            <td class="currency">@if($order->type_discount == 'amount')<span>Rp</span>@endif{{ $order->discount }}@if($order->type_discount == 'percent')<span>%</span>@endif</td>
                            </tr>
                            @else
                            <tr>
							<th class="gry-color text-left">{{ translate('Diskon')}}</th>
                            <td class="currency">@if($order->type_discount == 'amount')<span>Rp</span>@endif{{ $order->discount }}@if($order->type_discount == 'percent')<span>%</span>@endif</td>
                            </tr>
                            @endif
			        <tr class="border-bottom">
			            <th class="gry-color text-left">{{ translate('Total Pajak') }}</th>
			            <td class="currency">{{ single_price($order->orderDetails->sum('tax')) }}</td>
			        </tr>
			        <tr>
			            <th style="color:#ec4646" class="text-left strong">{{ translate('Total Semua') }}</th>
			            <td style="color:#ec4646" class="currency">{{ single_price($order->grand_total) }}</td>
			        </tr>
		        </tbody>
		    </table>
	    </div>
        <div style="margin-top:20px">
        <h3>Silahkan login ke halaman akun admin untuk detail order pesanan</h3>
        <h3>Terimakasih</h3>
        </div>

	</div>
</body>
</html>
