
@if(isset($swift) && $swift->success == true)
@foreach ($swift->pricing as $key => $value)
@php
	$code = $value->courier_code;
	$service = $value->courier_service_code;
	$cost = $value->price;
	$hasil = '{ "code" : "'.$code.'", "services" : "'.$service.'", "cost": "'.$cost.'"}';
@endphp
<div class="col-12">
    <div class="d-flex align-items mt-3">
        <label class="mt-2 cb-pengiriman">
            <input type="radio" name="radio" value="{{ $hasil }}">
            <span class="cb-checkmark"></span>
        </label>
        <div class="col-6">
            <p class="text-ekspedisi" style="margin-bottom: 0%;">{{ strtoupper($value->courier_name) }} {{ str_replace("JNE","",$value->courier_service_name) }}</p>
            <p class="date-ekspedisi">{{ $value->duration }}</p>
        </div>
        <div class="mx-auto">
            <p class="text-ekspedisi">{{ format_price($value->price) }}</p>
        </div>
    </div>
</div>
@endforeach
@endif