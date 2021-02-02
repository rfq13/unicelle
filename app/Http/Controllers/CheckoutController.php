<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Category;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\InstamojoController;
use App\Http\Controllers\ClubPointController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\PublicSslCommerzPaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\PaytmController;
use App\Order;
use App\BusinessSetting;
use App\Coupon;
use App\CouponUsage;
use App\User;
use App\Address;
use Session;
use App\Utility\PayhereUtility;

use Carbon\Carbon;

class CheckoutController extends Controller
{

    public function __construct()
    {
        //
    }

    //check the selected payment gateway and redirect to that controller accordingly
    public function checkout(Request $request)
    {
        if ($request->payment_option != null && $request->shipping_info != null) {

            $orderController = new OrderController;
            $VA = $orderController->store($request);

            $request->session()->put('payment_type', 'cart_payment');
            $request->session()->put('shipping_info',$request->shipping_info);
            if($request->session()->get('order_id') != null){
                
                $request->session()->put('cart', collect([]));
                $request->session()->forget('delivery_info');
                $request->session()->forget('data_dropshiper');
                $request->session()->forget('poin_use');
                $request->session()->forget('delivery_info');
                $request->session()->forget('coupon_id');
                $request->session()->forget('coupon_discount');

                // flash(translate("Your order has been placed successfully"))->success();
                return $this->order_confirmed($VA);
            }
        }else {
            flash(translate('Mohon pilih metode pengiriman terlebih dahulu.'))->warning();
            return back();
        }
    }

    //redirects to this method after a successfull checkout
    public function checkout_done($order_id, $payment)
    {
        $order = Order::findOrFail($order_id);
        $order->payment_status = 'paid';
        $order->payment_details = $payment;
        $order->save();

        if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {
            $affiliateController = new AffiliateController;
            $affiliateController->processAffiliatePoints($order);
        }

        if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated) {
            $clubpointController = new ClubPointController;
            $clubpointController->processClubPoints($order);
        }

        if(\App\Addon::where('unique_identifier', 'seller_subscription')->first() == null || !\App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated){
            if (BusinessSetting::where('type', 'category_wise_commission')->first()->value != 1) {
                $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;
                foreach ($order->orderDetails as $key => $orderDetail) {
                    $orderDetail->payment_status = 'paid';
                    $orderDetail->save();
                    if($orderDetail->product->user->user_type == 'seller'){
                        $seller = $orderDetail->product->user->seller;
                        $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price*(100-$commission_percentage))/100 + $orderDetail->tax + $orderDetail->shipping_cost;
                        $seller->save();
                    }
                }
            }
            else{
                foreach ($order->orderDetails as $key => $orderDetail) {
                    $orderDetail->payment_status = 'paid';
                    $orderDetail->save();
                    if($orderDetail->product->user->user_type == 'seller'){
                        $commission_percentage = $orderDetail->product->category->commision_rate;
                        $seller = $orderDetail->product->user->seller;
                        $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price*(100-$commission_percentage))/100  + $orderDetail->tax + $orderDetail->shipping_cost;
                        $seller->save();
                    }
                }
            }
        }
        else {
            foreach ($order->orderDetails as $key => $orderDetail) {
                $orderDetail->payment_status = 'paid';
                $orderDetail->save();
                if($orderDetail->product->user->user_type == 'seller'){
                    $seller = $orderDetail->product->user->seller;
                    $seller->admin_to_pay = $seller->admin_to_pay + $orderDetail->price + $orderDetail->tax + $orderDetail->shipping_cost;
                    $seller->save();
                }
            }
        }

        $order->commission_calculated = 1;
        $order->save();

        Session::put('cart', collect([]));
        // Session::forget('order_id');
        Session::forget('payment_type');
        Session::forget('delivery_info');
        Session::forget('coupon_id');
        Session::forget('coupon_discount');
        Session::forget('poin_use');
        Session::forget('data_dropshiper');

        flash(translate('Payment completed'))->success();
        return view('frontend.order_confirmed', compact('order'));
    }

    public function get_shipping_info(Request $request)
    {
        // dd(count(Session::get('cart')));
        $carts = Auth::check() ? \App\Models\Cart::where("user_id",Auth::user()->id)->with("product")->get() : $carts; 

        if($carts && $carts->count() > 0){
            $categories = Category::all();
            return view('frontend.shipping_info', compact('categories','carts'));
        }
        flash(translate('Your cart is empty'))->success();
        return back();
    }

    public function store_shipping_info(Request $request)
    {
        if (Auth::check()) {
            if($request->address_id == null){
                flash(translate("Please add shipping address"))->warning();
                return back();
            }
            $address = Address::findOrFail($request->address_id);
            $data['name'] = Auth::user()->name;
            $data['email'] = Auth::user()->email;
            $data['address'] = $address->address;
            $data['country'] = $address->country;
            $data['city'] = $address->city;
            $data['postal_code'] = $address->postal_code;
            $data['phone'] = $address->phone;
            $data['checkout_type'] = $request->checkout_type;
        }
        else {
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['address'] = $request->address;
            $data['country'] = $request->country;
            $data['city'] = $request->city;
            $data['postal_code'] = $request->postal_code;
            $data['phone'] = $request->phone;
            $data['checkout_type'] = $request->checkout_type;
        }

        $shipping_info = $data;
        $request->session()->put('shipping_info', $shipping_info);

        $subtotal = 0;
        $tax = 0;
        $shipping = 0;
        $cart = Auth::check() ? \App\Models\Cart::where("user_id",Auth::user()->id)->with("product")->get() : $cart; 

        foreach ($cart as $key => $cartItem){
            $subtotal += $cartItem['price']*$cartItem['quantity'];
            $tax += $cartItem['tax']*$cartItem['quantity'];
            $shipping += $cartItem['shipping']*$cartItem['quantity'];
        }

        $total = $subtotal + $tax + $shipping;

        if(Session::has('coupon_discount')){
                $total -= Session::get('coupon_discount');
        }

        return view('frontend.delivery_info');
        // return view('frontend.payment_select', compact('total'));
    }

    public function store_delivery_info(Request $request)
    {
        $cart = Auth::check() ? \App\Models\Cart::where("user_id",Auth::user()->id)->with("product")->get() : $cart; 
        
        if($cart && $cart->count() > 0){

            $subtotal = 0;
            $tax = 0;
            $shipping = 0;
            $cart = Auth::check() ? \App\Models\Cart::where("user_id",Auth::user()->id)->with("product")->get() : $cart; 
            // dd($cart);
            foreach ($cart as $key => $cartItem){
                $subtotal += $cartItem['price']*$cartItem['quantity'];
                $tax += $cartItem['tax']*$cartItem['quantity'];
                $shipping += $cartItem['shipping']*$cartItem['quantity'];
            }

            $total = $subtotal + $tax + $shipping;

            if(Session::has('coupon_discount')){
                    $total -= Session::get('coupon_discount');
            }

            $total = (int)$total;
            $shipping_info = $request->shipping_info;
            // dd("ownge");
            return view('frontend.payment_select', compact('total','shipping_info'));
        }
        else {
            flash(translate('Your Cart was empty'))->warning();
            return redirect()->route('home');
        }
    }

    public function get_payment_info(Request $request)
    {
        
        $subtotal = 0;
        $tax = 0;
        $shipping = 0;
        $cart = Auth::check() ? \App\Models\Cart::where("user_id",Auth::user()->id)->with("product")->get() : $cart; 
        // dd($cart);
       
        foreach ($cart as $key => $cartItem){
            $subtotal += $cartItem['price']*$cartItem['quantity'];
            $tax += $cartItem['tax']*$cartItem['quantity'];
            $shipping += $cartItem['shipping']*$cartItem['quantity'];
        }

        $total = $subtotal + $tax + $shipping;

        if(Session::has('coupon_discount')){
                $total -= Session::get('coupon_discount');
        }

        return view('frontend.payment_select', compact('total'));
    }

    public function apply_coupon_code(Request $request){
        //dd($request->all());
        $coupon = Coupon::where('code', $request->code)->first();

        if($coupon != null){
            if(strtotime(date('d-m-Y')) >= $coupon->start_date && strtotime(date('d-m-Y')) <= $coupon->end_date){
                if(CouponUsage::where('user_id', Auth::user()->id)->where('coupon_id', $coupon->id)->first() == null){
                    $coupon_details = json_decode($coupon->details);

                    if ($coupon->type == 'cart_base')
                    {
                        $subtotal = 0;
                        $tax = 0;
                        $shipping = 0;
                        $cart = Auth::check() ? \App\Models\Cart::where("user_id",Auth::user()->id)->with("product")->get() : $cart; 

                        foreach ($cart as $key => $cartItem)
                        {
                            $subtotal += $cartItem['price']*$cartItem['quantity'];
                            $tax += $cartItem['tax']*$cartItem['quantity'];
                            $shipping += $cartItem['shipping']*$cartItem['quantity'];
                        }
                        $sum = $subtotal+$tax+$shipping;

                        if ($sum > $coupon_details->min_buy) {
                            if ($coupon->discount_type == 'percent') {
                                $coupon_discount =  ($sum * $coupon->discount)/100;
                                if ($coupon_discount > $coupon_details->max_discount) {
                                    $coupon_discount = $coupon_details->max_discount;
                                }
                            }
                            elseif ($coupon->discount_type == 'amount') {
                                $coupon_discount = $coupon->discount;
                            }
                            $request->session()->put('coupon_id', $coupon->id);
                            $request->session()->put('coupon_discount', $coupon_discount);
                            flash(translate('Coupon has been applied'))->success();
                        }
                    }
                    elseif ($coupon->type == 'product_base')
                    {
                        $coupon_discount = 0;
                        $cart = Auth::check() ? \App\Models\Cart::where("user_id",Auth::user()->id)->with("product")->get() : $cart; 

                        foreach ($cart as $key => $cartItem){
                            foreach ($coupon_details as $key => $coupon_detail) {
                                if($coupon_detail->product_id == $cartItem['id']){
                                    if ($coupon->discount_type == 'percent') {
                                        $coupon_discount += $cartItem['price']*$coupon->discount/100;
                                    }
                                    elseif ($coupon->discount_type == 'amount') {
                                        $coupon_discount += $coupon->discount;
                                    }
                                }
                            }
                        }
                        $request->session()->put('coupon_id', $coupon->id);
                        $request->session()->put('coupon_discount', $coupon_discount);
                        flash(translate('Coupon has been applied'))->success();
                    }
                }
                else{
                    flash(translate('You already used this coupon!'))->warning();
                }
            }
            else{
                flash(translate('Coupon expired!'))->warning();
            }
        }
        else {
            flash(translate('Invalid coupon!'))->warning();
        }
        return back();
    }

    public function remove_coupon_code(Request $request){
        $request->session()->forget('coupon_id');
        $request->session()->forget('coupon_discount');
        return back();
    }

    public function order_confirmed($va){
        $order = Order::findOrFail(Session::get('order_id'));
        if ($order->payment_details == null) {
            $order->payment_details = json_encode($va);
            $order->save();
        }
        return view('frontend.order_confirmed', compact('order','va'));
    }

    public function set_ongkir(Request $request)
    {
        $ongkir = json_decode( decrypt($request->param));
        $cart_summary = \View::make('frontend.partials.cart_summary',compact('ongkir'))->render();
        return response()->json(compact('cart_summary'));
    }

    public function dropshipper(Request $request)
    {
        $request->session()->put("data_dropshiper",$request->all());
        flash(translate('Dropshipper has been applied'))->success();
        return back();
    }
}
