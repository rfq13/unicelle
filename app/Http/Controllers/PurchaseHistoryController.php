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
