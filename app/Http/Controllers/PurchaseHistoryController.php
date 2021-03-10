<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderDetail;
use Auth;
use DB;

class PurchaseHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dt = \Carbon\Carbon::now();
        $hari= date('Y-m-d H:i:s', time() - (60 * 60 * 24 * 14));
        //check log resi lebih dari 14 hari
        // dd(Auth::user()->id);
        $check= \App\Log_resi::where('updated_at','<=',$hari)->where('user_id',Auth::user()->id)->get();
        // dd($check);
        if ($check != null && $check->count() > 0) {
            $id_order = $check->pluck("order_id")->toArray();
            $order_data = order::with('orderDetails')->whereIn('id',$id_order)->where('delivery_status','on_delivery')->get();
            //check jika ada data yg resi lebih 14 hari
            if ($order_data != null && $order_data->count() > 0) {
                foreach ($order_data as $key => $o) {
                    $o->user_status_konfrimasi = 1;
                    $o->delivery_status = 'delivered';
                    $detail_id_order = $order_data->pluck("id")->toArray();
                    $order_detail_data = OrderDetail::whereIn('order_id',$detail_id_order)->get();
                foreach ($order_detail_data as $key => $value) {
                    $value->delivery_status = "delivered";
                    $value->save();
                }
                if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated) {
                    $detail_user_order = $order_data->pluck("user_id")->toArray();
                    if($o->get_poin != null){
                        $user = $o['user_id'];
                        $cp = new \App\ClubPoint;
                        $cp->user_id = $user;
                        $cp->points = $o['get_poin'];
                        $cp->convert_status = 0;
                        $user_add = \App\User::whereIn('id',$detail_user_order)->get();
                        foreach ($user_add as $key => $us) {
                            $us->poin += $cp->points;
                            $us->save();
                        }
                        $cp->save();
                    
                    }
                }
                $o->save();
                }
            }
        }
        $orders = Order::where('user_id', Auth::user()->id)
        ->whereNull("dropsiper")            
        ->with(['orderDetails','orderDetails.product'])
        ->has('orderDetails')
        ->orderBy('code', 'desc')
        ->paginate(5);

        return view('frontend.purchase_history', compact('orders'));
    }

    public function digital_index()
    {
        $orders = DB::table('orders')
                        ->orderBy('code', 'desc')
                        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                        ->join('products', 'order_details.product_id', '=', 'products.id')
                        ->where('orders.user_id', Auth::user()->id)
                        ->where('products.digital', '1')
                        ->where('order_details.payment_status', 'paid')
                        ->select('order_details.id')
                        ->paginate(1);
        return view('frontend.digital_purchase_history', compact('orders'));
    }

    public function purchase_history_details(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->delivery_viewed = 1;
        $order->payment_status_viewed = 1;
        $order->save();
        $status = $order->orderDetails->first()->delivery_status;
        $ship = 0;
        $ship_info = 0;
        if ($status == "on_delivery" || $status == "delivered") {
            $ship_info = json_decode($order->shipping_info);
            $ship = app('\App\Http\Controllers\OrderController')->statusPengiriman($order->resi,$ship_info->code);
        }
        $compact = ['order','ship'];
        return view('frontend.partials.order_details_customer', compact($compact));
    }
    public function shipping_details(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->delivery_viewed = 1;
        $order->payment_status_viewed = 1;
        $order->save();
        $status = $order->orderDetails->first()->delivery_status;
        $ship = 0;
        $ship_info = 0;
        if ($status == "on_delivery" || $status == "delivered") {
            $ship_info = json_decode($order->shipping_info);
            $ship = app('\App\Http\Controllers\OrderController')->statusPengiriman($order->resi,$ship_info->code);
        }
        $compact = ['order','ship'];
        return view('frontend.tracking', compact($compact));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
