<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessSetting;
use App\RefundRequest;
use App\OrderDetail;
use App\Order;
use App\ClubPointExchange;
use App\Seller;
use App\Wallet;
use App\User;
use Auth;

class RefundRequestController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Store Customer Refund Request
    public function request_store(Request $request, $id)
    {
        $order_detail = OrderDetail::where('id', $id)->first();
        $refund = new RefundRequest;
        $refund->user_id = Auth::user()->id;
        $refund->order_id = $order_detail->order_id;
        $refund->order_detail_id = $order_detail->id;
        $refund->seller_id = $order_detail->seller_id;
        $refund->seller_approval = 0;
        $refund->reason = $request->reason;
        $refund->admin_approval = 0;
        $refund->admin_seen = 0;
        $refund->refund_amount = $order_detail->price + $order_detail->tax;
        $refund->refund_status = 0;
        if ($refund->save()) {
            
            flash("Permintaan Pengembalian Dana telah berhasil dikirim")->success();
            return redirect()->route('purchase_history.index');
        }
        else {
            flash("Ada yang salah")->error();
            return back();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vendor_index()
    {
        $refunds = RefundRequest::where('seller_id', Auth::user()->id)->latest()->paginate(10);
        if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff') {
            return view('refund_request.frontend.recieved_refund_request.index', compact('refunds'));
        }
        else {
            return view('refund_request.frontend.recieved_refund_request.index', compact('refunds'));
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customer_index()
    {
        $refunds = RefundRequest::where('user_id', Auth::user()->id)->latest()->paginate(10);
        return view('refund_request.frontend.refund_request.index', compact('refunds'));
    }

    //Set the Refund configuration
    public function refund_config()
    {
        return view('refund_request.config');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function refund_time_update(Request $request)
    {
        $business_settings = BusinessSetting::where('type', $request->type)->first();
        if ($business_settings != null) {
            $business_settings->value = $request->value;
            $business_settings->save();
        }
        else {
            $business_settings = new BusinessSetting;
            $business_settings->type = $request->type;
            $business_settings->value = $request->value;
            $business_settings->save();
        }
        flash("Waktu pengiriman Permintaan Pengembalian Dana telah berhasil diperbarui")->success();
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function refund_sticker_update(Request $request)
    {
        $business_settings = BusinessSetting::where('type', $request->type)->first();
        if ($business_settings != null) {
            if($request->hasFile('logo')){
                $business_settings->value = $request->file('logo')->store('frontend/refund_sticker');
            }
            $business_settings->save();
        }
        else {
            $business_settings = new BusinessSetting;
            $business_settings->type = $request->type;
            if($request->hasFile('logo')){
                $business_settings->value = $request->file('logo')->store('frontend/refund_sticker');
            }
            $business_settings->save();
        }
        flash("Stiker Pengembalian Dana berhasil diperbarui")->success();
        return back();
    }

    public function refund_poin_update(Request $request){
        $business_settings = BusinessSetting::where('type', $request->type)->first();
        if ($business_settings != null) {
            $business_settings->value = $request->value;
            $business_settings->save();
        }
        else {
            $business_settings = new BusinessSetting;
            $business_settings->type = $request->type;
            $business_settings->value = $request->value;
            $business_settings->save();
        }
        flash("Poin Potongan Pengembalian Dana berhasil diperbarui")->success();
        return back();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_index()
    {
        $refund2 = null;
        $refunds = RefundRequest::where('refund_status', 0)->latest()->paginate(15);
        return view('refund_request.index', compact('refunds','refund2'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function paid_index()
    {
        $refunds = RefundRequest::where('refund_status', 1)->with('order')->latest()->paginate(15);
        return view('refund_request.paid_refund', compact('refunds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function request_approval_vendor(Request $request)
    {
        $refund = RefundRequest::findOrFail($request->el);
        if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff') {
            $refund->seller_approval = 1;
            $refund->admin_approval = 1;
        }
        else {
            $refund->seller_approval = 1;
        }

        if ($refund->save()) {
            return 1;
        }
        else {
            return 0;
        }
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function refund_pay(Request $request)
    {
        $refund = RefundRequest::findOrFail($request->el);
        $business_settings = BusinessSetting::where('type', 'refund_request_poin')->first();
        if ($business_settings != null) {
            $potongan_poin=$business_settings->value;
        }
        else{
            $potongan_poin='0';
        }
        if ($refund->seller_approval == 1) {
            $seller = Seller::where('user_id', $refund->seller_id)->first();
            if ($seller != null) {
                $seller->admin_to_pay -= $refund->refund_amount;
            }
            $seller->save();
        }
        $wallet = new Wallet;
        $wallet->user_id = $refund->user_id;
        $wallet->amount = $refund->refund_amount;
        $wallet->payment_method = 'Refund';
        $wallet->payment_details = 'Product Money Refund';
        $wallet->save();
        $user = User::findOrFail($refund->user_id);
        $user->balance += $refund->refund_amount;
        $user->poin -= $potongan_poin;
        $user->save();
        $history = new ClubPointExchange;
        $history->user_id = $refund->user_id;
        $history->point = '-'.$potongan_poin;
        $history->keterangan = "Komplain";
        $history->save();
        if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff') {
            $refund->admin_approval = 1;
            $refund->seller_approval = 1;
            $refund->refund_status = 1;
        }
        if ($refund->save()) {
            return 1;
        }
        else {
            return 0;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function refund_request_send_page(Request $request,$id,$poin=0)
    {
        $order_detail = OrderDetail::findOrFail($id);
        if ($order_detail->product != null && $order_detail->product->refundable == 1) {
            $authpoin = $request->session()->has('poin_use') ? $request->session()->get('poin_use') : Auth::user()->poin;
            // dd($authpoin);
            if ($authpoin>(int)$poin) {
                $authpoin -= (int)$poin;
                $request->session()->put('poin_use',$authpoin);
            }
            // dd($request->session()->get('poin_use'));
            return view('refund_request.frontend.refund_request.create', compact('order_detail'));
        }
        else {
            return back();
        }
    }

    /**
     * Show the form for view the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Shows the refund reason
    public function reason_view($id)
    {
        $refund = RefundRequest::findOrFail($id);
        if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff') {
            if ($refund->orderDetail != null) {
                $refund->admin_seen = 1;
                $refund->save();
                return view('refund_request.reason', compact('refund'));
            }
        }
        else {
            return view('refund_request.frontend.refund_request.reason', compact('refund'));
        }
    }
    public function showReasonModal(Request $request)
    {
        $refund = RefundRequest::where('id', $request->id)->first();
        $update = RefundRequest::findOrFail($request->id);
        if (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff') {
            if ($update->orderDetail != null) {
                $update->admin_seen = 1;
                $update->save();
                return view('refund_request.modal_reason', compact('refund'));
            }
        }
    }
    public function showDetailPesanan(Request $request)
    {
        $order = Order::where('id', $request->key)->with('orderDetails','user','addresse')->first();
        $orderDetails = OrderDetail::where('order_id',$request->key)->with('product')->get();
        // dd($orderDetails);
        return view('refund_request.modal_detail', compact('order','orderDetails'));
    }
    public function confirmDanaModal(Request $request)
    {
        $refund2 = RefundRequest::where('id', $request->key)->first();
        return view('refund_request.confirm', compact('refund2'));

    }
}
