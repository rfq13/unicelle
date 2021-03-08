<div class="modal-header">
    <h5 class="modal-title strong-600 heading-5">Detail Pengiriman</h5>
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
                            <div style="max-height: 400px;overflow-y: auto;" class="card-body pb-0">
                                @isset($penerima)
                                    <span class="my-3" style="margin-top: 5px;text-transform:capitalize">telah diterima oleh: <strong style="color:green">{{ $penerima }}</strong></span><br>
                                    <span class="mt-2" style="text-transform:capitalize">pada: <cite>{{ $tglTerima }}</cite></span>
                                @endisset
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Deskripsi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($manifest as $key => $history)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $history->manifest_date }} {{ $history->manifest_time }}</td>
                                                <td>{{ $history->manifest_description }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
