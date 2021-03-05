<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\OTPVerificationController;
use App\Http\Controllers\ClubPointController;
use App\Http\Controllers\AffiliateController;
use App\Order;
use App\Product;
use App\Color;
use App\OrderDetail;
use App\ClubPoint;
use App\UsePoin;
use App\Admin_log;
use App\Member;
use App\Log_resi;
use App\userMember;
use App\CouponUsage;
use App\ClubPointExchange;
use App\Mail\NotifikasiManager;
use App\OtpConfiguration;
use App\User;
use App\BusinessSetting;
use Auth;
use Session;
use DB;
use PDF;
use Mail;
use App\Mail\InvoiceEmailManager;
use CoreComponentRepository;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource to seller.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $payment_status = null;
        $delivery_status = null;
        $sort_search = null;
        $orders = DB::table('orders')
                    ->orderBy('code', 'desc')
                    ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                    ->where('order_details.seller_id', Auth::user()->id)
                    ->select('orders.id')
                    ->distinct();

        if ($request->payment_status != null){
            $orders = $orders->where('order_details.payment_status', $request->payment_status);
            $payment_status = $request->payment_status;
        }
        if ($request->delivery_status != null) {
            $orders = $orders->where('order_details.delivery_status', $request->delivery_status);
            $delivery_status = $request->delivery_status;
        }
        if ($request->has('search')){
            $sort_search = $request->search;
            $orders = $orders->where('code', 'like', '%'.$sort_search.'%');
        }

        $orders = $orders->paginate(15);

        foreach ($orders as $key => $value) {
            $order = \App\Order::find($value->id);
            $order->viewed = 1;
            $order->save();
        }

        return view('frontend.seller.orders', compact('orders','payment_status','delivery_status', 'sort_search'));
    }

    /**
     * Display a listing of the resource to admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_orders(Request $request)
    {
        CoreComponentRepository::instantiateShopRepository();

        $payment_status = null;
        $delivery_status = null;
        $sort_search = null;
        $admin_user_id = User::where('user_type', 'admin')->first()->id;
        // dd($admin_user_id);
        $orders = DB::table('orders')
        ->orderBy('code', 'desc')
        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
        //->where('order_details.seller_id', $admin_user_id)
        ->where('is_product_digital',0)
                    ->distinct()
                    ->select(['orders.id']);

        if ($request->payment_type != null){
            $orders = $orders->where('order_details.payment_status', $request->payment_type);
            $payment_status = $request->payment_type;
        }
        if ($request->delivery_status != null) {
            $orders = $orders->where('order_details.delivery_status', $request->delivery_status);
            $delivery_status = $request->delivery_status;
        }
        if ($request->has('search')){
            $sort_search = $request->search;
            $orders = $orders->where('code', 'like', '%'.$sort_search.'%');
        }
        $orders = $orders->paginate(15);
        return view('orders.index', compact('orders','payment_status','delivery_status', 'sort_search', 'admin_user_id'));
    }

    public function statusPengiriman($resi,$kurir)
    {
        $curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://pro.rajaongkir.com/api/waybill",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => "waybill=$resi&courier=$kurir",
		CURLOPT_HTTPHEADER => array(
			"content-type: application/x-www-form-urlencoded",
			"key: ".env("RAJA_ONGKIR_KEY")
		),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		    return "cURL Error #:" . $err;
		} else {
		    return $response;
		}
    }

    /**
     * Display a listing of the sales to admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function sales(Request $request)
    {
        CoreComponentRepository::instantiateShopRepository();

        $sort_search = null;
        $orders = Order::orderBy('code', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $orders = $orders->where('code', 'like', '%'.$sort_search.'%');
        }
        $orders = $orders->paginate(15);
        return view('sales.index', compact('orders', 'sort_search'));
    }


    public function order_index(Request $request)
    {
        if (Auth::user()->user_type == 'staff' && Auth::user()->staff->pick_up_point != null) {
            //$orders = Order::where('pickup_point_id', Auth::user()->staff->pick_up_point->id)->get();
            $orders = DB::table('orders')
                        ->orderBy('code', 'desc')
                        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                        ->where('order_details.pickup_point_id', Auth::user()->staff->pick_up_point->id)
                        ->select('orders.id')
                        ->distinct()
                        ->paginate(15);

            return view('pickup_point.orders.index', compact('orders'));
        }
        else{
            //$orders = Order::where('shipping_type', 'Pick-up Point')->get();
            $orders = DB::table('orders')
                        ->orderBy('code', 'desc')
                        ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                        ->where('order_details.shipping_type', 'pickup_point')
                        ->select('orders.id')
                        ->distinct()
                        ->paginate(15);

            return view('pickup_point.orders.index', compact('orders'));
        }
    }

    public function pickup_point_order_sales_show($id)
    {
        if (Auth::user()->user_type == 'staff') {
            $order = Order::findOrFail(decrypt($id));
            return view('pickup_point.orders.show', compact('order'));
        }
        else{
            $order = Order::findOrFail(decrypt($id));
            return view('pickup_point.orders.show', compact('order'));
        }
    }

    /**
     * Display a single sale to admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function sales_show($id)
    {
        $order = Order::findOrFail(decrypt($id));
        return view('sales.show', compact('order'));
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
        $ccdetails=false;

        if ($request->session()->has('ccdetails')) {
            $ccdetails = $request->session()->get('ccdetails');
            $request->session()->forget('ccdetails');
        }

        $order = new Order;
        
        if(Auth::check()){
            $order->user_id = Auth::user()->id;
        }
        else{
            $order->guest_id = mt_rand(100000, 999999);
        }

        $defaultAddr = Auth::user()->addresseDefault;

        if (!$defaultAddr){
            flash("pilih alamat pengiriman terlebih dahulu");
            return redirect(route('checkout.shipping_info'));
        }
        if($request->discount != null){
            $poin_total=$request->get_poin;
            $order->get_poin= $poin_total;

        }
        if($request->discount != null){
            $discount_total=$request->discount;
            $order->discount= $discount_total;
        }
        $shipping_info = decrypt($request->shipping_info);
        $order->shipping_address = $defaultAddr->id;
        $order->type_discount= $request->type_discount;
        $order->shipping_info = json_encode($shipping_info);
        $order->payment_type = json_decode($request->payment_option)->option;
        $order->delivery_viewed = '0';
        $order->payment_status_viewed = '0';
        $order->delivery_status = 'pending';
        $order->is_product_digital = '0';
        $order->code = date('Ymd-His').rand(10,99);
        $order->date = strtotime('now');

        $xendit = false;

        if($order->save()){
            $subtotal = 0;
            $tax = 0;
            $shipping = 0;

            //calculate shipping is to get shipping costs of different types
            $admin_products = array();
            $seller_products = array();

            //Order Details Storing
            foreach (Auth::user()->carts as $key => $cartItem){
                $product = Product::find($cartItem['product_id']);

                if($product->added_by == 'admin'){
                    array_push($admin_products, $cartItem['id']);
                }
                else{
                    $product_ids = array();
                    if(array_key_exists($product->user_id, $seller_products)){
                        $product_ids = $seller_products[$product->user_id];
                    }
                    array_push($product_ids, $cartItem['id']);
                    $seller_products[$product->user_id] = $product_ids;
                }

                $subtotal += $cartItem['price']*$cartItem['quantity'];
                $tax += $cartItem['tax']*$cartItem['quantity'];

                $product_variation = $cartItem['variant'];

                if($product_variation != null){
                    $product_stock = $product->stocks->where('variant', $product_variation)->first();
                    $product_stock->qty -= $cartItem['quantity'];
                    $product_stock->save();
                }
                else {
                    $product->current_stock -= $cartItem['quantity'];
                    $product->save();
                }

                $order_detail = new OrderDetail;
                $order_detail->order_id  =$order->id;
                $order_detail->seller_id = $product->user_id;
                $order_detail->product_id = $product->id;
                $order_detail->variation = $product_variation;
                $order_detail->price = $cartItem['price'] * $cartItem['quantity'];
                $order_detail->tax = $cartItem['tax'] * $cartItem['quantity'];
                $order_detail->product_referral_code = $cartItem['product_referral_code'];

                $order_detail->quantity = $cartItem['quantity'];
                $order_detail->save();

                $product->num_of_sale++;
                $product->save();
            }

            
            $total_beli=$subtotal + $tax + $shipping;
            $poin_use = UsePoin::where('user_id',Auth::user()->id)->first();
            $club_point_convert_rate = \App\BusinessSetting::where('type', 'club_point_convert_rate')->first();

            if(Auth::user()->user_type == 'regular physician'){
                $member= \App\userMember::where('user_id',Auth::user()->id)->first();
                $detail_member = \App\Member::where('id',$member->member_id)->first();
                $diskon=$detail_member->discount_order;
                if($detail_member->min_order_discount <= $subtotal){
                            if($detail_member->discount_type == 'amount'){
                            $total2 =$subtotal + $tax -$diskon;
                            $total_beli =$total2+$shipping;
                            if(isset($poin_use)){
                                $total_beli = $total2-$poin_use->poin*$club_point_convert_rate->value+$shipping;
                                
                            }
                            }
                            else{
                                    $total=$subtotal + $tax ;
                                    $total_diskon = $diskon/100*$total;
                                    $total_beli = $subtotal + $tax -$total_diskon+ $shipping;
                                    if(isset($poin_use)){
                                        $total_beli = $subtotal + $tax -$total_diskon-$poin_use->poin*$club_point_convert_rate->value+$shipping;
                                    }
                            }
                }
                else{
                    if(isset($poin_use)){
                        $total_beli = $subtotal + $tax - $poin_use->poin*$club_point_convert_rate->value+$shipping;
                    }
                }
            }
            if(Auth::user()->user_type == 'pasien reg' || Auth::user()->user_type == 'partner physician' ){
                $detail_user = \App\PoinUser::where('type_user',Auth::user()->user_type)->first();
                if($detail_user->min_order_discount <= $subtotal){
                $diskon=$detail_user->discount;
                if($detail_user->type_discount == 'amount'){
                    $total2 =$subtotal+$tax-$diskon;
                        $total_beli =$total2+$shipping;
                        if(isset($poin_use)){
                            $total_beli = $total2-$poin_use->poin*$club_point_convert_rate->value+$shipping;
                        
                    }
                                }
                                else{
                                    $total2=$subtotal + $tax;
                                    $total_diskon = $diskon/100*$total2;
                                    $total_beli =  $total2-$total_diskon+ $shipping;
                                    if(isset($poin_use)){
                                        $total_beli = $total2-$total_diskon-$poin_use->poin*$club_point_convert_rate->value+$shipping;
                                    
                                }
                                }
                }
                else{
                    if(Auth::user()->user_type == 'partner physician'){
                        if(isset($poin_use)){
                        $total_beli =$total- $poin_use->poin*$club_point_convert_rate->value +$shipping;
                        }
                    }
                }
            }

            if(isset($poin_use)){
                $total = $poin_use->poin*$club_point_convert_rate->value;
                $order->poin_convert = $total;
                $order->use_poin =$poin_use->poin;
                Auth::user()->poin -= $poin_use->poin;
                Auth::user()->save();
                $history = new ClubPointExchange;
                $history->user_id = Auth::user()->id;
                $history->voucher_id = '0';
                $history->point = '-'.$poin_use->poin;
                $history->keterangan = "Tukar Poin";
                $history->save();
                UsePoin::destroy($poin_use->id);

            }
            if(Session::has('coupon_discount')){
                $order->grand_total -= Session::get('coupon_discount');
                $order->coupon_discount = Session::get('coupon_discount');

                $coupon_usage = new CouponUsage;
                $coupon_usage->user_id = Auth::user()->id;
                $coupon_usage->coupon_id = Session::get('coupon_id');
                $coupon_usage->save();
            }
            $order->grand_total = $total_beli;
            
            
            if(Session::has('data_dropshiper')){
              
                $dropshiper = Session::get('data_dropshiper');
                $order->dropsiper = json_encode($dropshiper);
            }

            if(isset($shipping_info))
            {
                $order->grand_total += $shipping_info->cost;
                $order->shipping_cost = $shipping_info->cost;
                
            }
            // dd($order->grand_total);
            $params = [
                "external_id" => $order->code,
                "name" => Auth::user()->name,
                "expected_amount" => $order->grand_total,
                "is_close" => false,
                "expiration_date"=> Carbon::now()->addDays(1)->toISOString(),
                "is_single_use"=> true
            ];            

            $xendit = $ccdetails ? $ccdetails : xenditRequest($params,$request->payment_option);

            $order->payment_details = json_encode($xendit);

            $order->save();
            
            // $point_club = new ClubPoint;
            // $point_club->user_id = Auth::user()->id;
            // $point_club->points = $request->totalpoin;
            // $point_club->convert_status = '0';
            // $point_club->save();
            // $user = User::findOrFail(Auth::user()->id);
            // $update_poin = Auth::user()->poin + $request->totalpoin;
            // $user->poin = $update_poin;
            // $user->save();
            //stores the pdf for invoice
            // $pdf = PDF::setOptions([
            //                 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
            //                 'logOutputFile' => storage_path('logs/log.htm'),
            //                 'tempDir' => storage_path('logs/')
            //             ])->loadView('invoices.customer_invoice', compact('order'));
            // $output = $pdf->output();
    		// file_put_contents('public/invoices/'.'Order#'.$order->code.'.pdf', $output);

            // if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_order')->first()->value){
            //     try {
            //         $otpController = new OTPVerificationController;
            //         $otpController->send_order_code($order);
            //     } catch (\Exception $e) {

            //     }
            // }

            // //sends email to customer with the invoice pdf attached
            // if(env('MAIL_USERNAME') != null){
            //     try {
            //         Mail::to($request->session()->get('shipping_info')['email'])->queue(new InvoiceEmailManager($array));
            //         Mail::to(User::where('user_type', 'admin')->first()->email)->queue(new InvoiceEmailManager($array));
            //     } catch (\Exception $e) {

            //     }
            // }
            // unlink($array['file']);

            // $request->session()->put('order_id', $order->id);

            $request->session()->forget('data_dropshiper');
            \App\Cart::where("user_id",Auth::id())->delete();
            $generalsetting = \App\GeneralSetting::first();
            
            $email= $generalsetting->email_notif;
            if($email != null){
            try {
            $array['view'] = 'invoices.invoice_notifikasi';
            $array['from'] = env('MAIL_USERNAME');
            $array['subject'] = "Ada Pesanan Baru";
            $array['order_id'] = $order->id;
           
            Mail::to($email)->queue(new NotifikasiManager($array));
            } catch (\Exception $e) {
            dd($e);
            }
            }
        }
        return ['xendit' => $xendit,'id'=>$order->id,'creditcard'=>$ccdetails ? true : false];
    }

    public function xenditHandle(Request $request)
    {
        $msg = "order not found";
        if ($request->has('external_id')) {
            $order = Order::where("code",$request->external_id)->with('user')->first();

            if ($order) {
                $msg = "order finded, but user not found";
                $stts = 200;
                $user = $order->user;
                if ($user && $user->email) {
                    $msg = "user ditemukan";

                    $pdf = PDF::setOptions([
                        'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
                        'logOutputFile' => storage_path('logs/log.htm'),
                        'tempDir' => storage_path('logs/')
                    ])->loadView('invoices.customer_invoice', compact('order'));
                    $output = $pdf->output();
                    file_put_contents('public/invoices/'.'Order#'.$order->code.'.pdf', $output);

                    $array['view'] = 'emails.invoice';
                    $array['subject'] = 'Order Placed - '.$order->code;
                    $array['from'] = env('MAIL_USERNAME');
                    $array['content'] = translate('Hi. A new order has been placed. Please check the attached invoice.');
                    $array['file'] = 'public/invoices/Order#'.$order->code.'.pdf';
                    $array['file_name'] = 'Order#'.$order->code.'.pdf';
            
                    
                    try {
                        Mail::to($user->email)->queue(new InvoiceEmailManager($array));
                        $msg = "email has sended";
                    } catch (\Exception $e) {
                        Log::info($e);
                    }
                }
                
            }
            
        }

        return response()->json([
            "message" => $msg
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail(decrypt($id));
        $order->viewed = 1;
        $order->save();
        $shipping_info = json_decode($order->shipping_info);

        $ship = $this->statusPengiriman($order->resi,$shipping_info->code);
        return view('orders.show', compact(['order','ship']));
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

    public function add_resi(Request $request,$id)
    {
        $id = decrypt($id);
        $order = Order::findOrFail($id);
        $order->resi = $request->resi;
        $order->save();
        $now = Carbon::now();

        $log= new Log_resi;
        $log->user_id = Auth::user()->id;
        $log->order_id = $order->id;
        $log->resi = $request->resi;
        $log->tgl_input = strtotime($now);
        $log->save();
        flash("Berhasil menambah resi")->success();
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        if($order != null){
            foreach($order->orderDetails as $key => $orderDetail){
                $orderDetail->delete();
            }
            $order->delete();
            flash(translate('Order has been deleted successfully'))->success();
        }
        else{
            flash(translate('Something went wrong'))->error();
        }
        return back();
    }

    public function order_details(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        //$order->viewed = 1;
        $order->save();
        return view('frontend.partials.order_details_seller', compact('order'));
    }

    public function update_delivery_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->delivery_viewed = '0';
        $nama_user= User::where('id',$order->user_id)->first();

        $detail= 'Mengubah status pengiriman dari "'.$order->delivery_status.'" menjadi "'.$request->status.'" ';
        $log= new Admin_log;
        $log->user_id= Auth::user()->id;
        $log->order_id= $order->code;
        $log->konsumen= $nama_user->name;

        $log->event= $detail;
        $log->save();
        $order->delivery_status = $request->status;
        $order->save();
        if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'seller'){
            foreach($order->orderDetails as $key => $orderDetail){
                $orderDetail->delivery_status = $request->status;
                $orderDetail->save();
            }
        }
        else{
            foreach($order->orderDetails->where('seller_id', \App\User::where('user_type', 'admin')->first()->id) as $key => $orderDetail){
                $orderDetail->delivery_status = $request->status;
                $orderDetail->save();
            }
        }

        if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_delivery_status')->first()->value){
            try {
                $otpController = new OTPVerificationController;
                $otpController->send_delivery_status($order);
            } catch (\Exception $e) {
            }
        }

        return 1;
    }

    public function update_payment_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);
        $order->payment_status_viewed = '0';
        $order->save();
        $nama_user= User::where('id',$order->user_id)->first();

        $detail= 'Mengubah status pembayaran dari " '.$order->payment_status.' " menjadi "'.$request->status.'" ';
        $log= new Admin_log;
        $log->user_id= Auth::user()->id;
        $log->order_id= $order->code;
        $log->konsumen= $nama_user->name;

        $log->event= $detail;
        $log->save();

        if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'seller'){
            foreach($order->orderDetails as $key => $orderDetail){
                $orderDetail->payment_status = $request->status;
                $orderDetail->save();
            }
        }
        else{
            foreach($order->orderDetails->where('seller_id', \App\User::where('user_type', 'admin')->first()->id) as $key => $orderDetail){
                $orderDetail->payment_status = $request->status;
                $orderDetail->save();
            }
        }

        $status = 'paid';
        foreach($order->orderDetails as $key => $orderDetail){
            if($orderDetail->payment_status != 'paid'){
                $status = 'unpaid';
            }
        }
        $order->payment_status = $status;
        $order->save();


        if($order->payment_status == 'paid' && $order->commission_calculated == 0){
            if(\App\Addon::where('unique_identifier', 'seller_subscription')->first() == null || !\App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated){
                if ($order->payment_type == 'cash_on_delivery') {
                    if (BusinessSetting::where('type', 'category_wise_commission')->first()->value != 1) {
                        $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;
                        foreach ($order->orderDetails as $key => $orderDetail) {
                            $orderDetail->payment_status = 'paid';
                            $orderDetail->save();
                            if($orderDetail->product->user->user_type == 'seller'){
                                $seller = $orderDetail->product->user->seller;
                                $seller->admin_to_pay = $seller->admin_to_pay - ($orderDetail->price*$commission_percentage)/100;
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
                                $seller->admin_to_pay = $seller->admin_to_pay - ($orderDetail->price*$commission_percentage)/100;
                                $seller->save();
                            }
                        }
                    }
                }
                elseif($order->manual_payment) {
                    if (BusinessSetting::where('type', 'category_wise_commission')->first()->value != 1) {
                        $commission_percentage = BusinessSetting::where('type', 'vendor_commission')->first()->value;
                        foreach ($order->orderDetails as $key => $orderDetail) {
                            $orderDetail->payment_status = 'paid';
                            $orderDetail->save();
                            if($orderDetail->product->user->user_type == 'seller'){
                                $seller = $orderDetail->product->user->seller;
                                $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price*(100-$commission_percentage))/100;
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
                                $seller->admin_to_pay = $seller->admin_to_pay + ($orderDetail->price*(100-$commission_percentage))/100;
                                $seller->save();
                            }
                        }
                    }
                }
            }

            if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated) {
                $affiliateController = new AffiliateController;
                $affiliateController->processAffiliatePoints($order);
            }

            $order->commission_calculated = 1;
            $order->save();
        }

        if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated && \App\OtpConfiguration::where('type', 'otp_for_paid_status')->first()->value){
            try {
                $otpController = new OTPVerificationController;
                $otpController->send_payment_status($order);
            } catch (\Exception $e) {
            }
        }
        return 1;
    }

    public function dropshipper(Request $request)
    {
        // dd($request->all());
        
        $tgl = $request->tgl;
        $sort = isset($request->sort) ? $request->sort : '0';
        $q = $request->q;
        $product = 'orderDetails.product';
        $orders = \App\Order::with(['orderDetails',$product]);
        
        if (isset($q)) {
            $orders = \App\Order::with(['orderDetails',"orderDetails.product"=> function ($name) use($q){
                $name->where('name',$q);}
            ]);  
        }




        
        if (isset($tgl)) {
            $orders = $orders->where('created_at','like',"%$tgl%");
            // dd($cond);
        }
        switch ($sort) {
            case '1':
                $orders->orderBy('created_at','desc');
                break;
            case '2':
                $orders->orderBy('created_at');
                break;
            case '3':
                $orders->withCount('orderDetails')->orderBy('order_details_count','desc');
                break;
            
            default:
                $orders->orderBy('code', 'desc');
                break;
        }
        

        $orders = $orders->where('user_id',Auth::user()->id)->where("dropsiper",'!=',null)->paginate(9);
        $bank_setting = \App\BusinessSetting::where('type', 'bank_setting')->first();
        $config =  json_decode( $bank_setting->value);
        // dd([$orders,Auth::user()->id]);
        return view('frontend.dropshipper', compact(['orders','bank_setting','config','tgl','sort','q']));
    }

    public function confirm_order($id,$poin)
    {
        $order = order::with('orderDetails')->where('id',decrypt($id))->first();
        $order->user_status_konfrimasi = 1;
        $order->delivery_status = 'delivered';

        foreach ($order->orderDetails as $key => $value) {
            $value->delivery_status = "delivered";
            $value->save();
        }
        $order->save();
        if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated) {
            if($order->get_poin != null){
            $clubpointController = new ClubPointController;
            $clubpointController->processClubPoints($order);
            }
        }

        $au_id = Auth::user()->referred_by;
       
        if ($au_id != null) {
            $affiliate = new AffiliateController;
            $affiliate->affiliateProccessPoint($au_id);         
        }
        if(Auth::user()->user_type == 'regular physician'){
            $orderU = \App\Order::where('user_id', Auth::user()->id);
            $log = new \App\userMember;
            $tiers = new \App\Member;    
            $logs = new \App\Membership_user_log;

            $myMember = Auth::user()->member;
            $userMember = \App\userMember::where(['member_id'=>$myMember->id,'user_id'=>Auth::user()->id])->orderBy('created_at','desc')->first();
            $from = date_format($userMember->created_at, "Y-m-d");
    
            $to = $userMember->ended_at;
            $orders = Auth::user()->orders;
            $active_m_order = $orders->where("payment_status", "paid")->whereBetween('created_at', [$from, $to]);
            $grand_total = $active_m_order->sum("grand_total");
            $u_log = $userMember;

            $n_tier = $tiers->where('min',">",$grand_total)->first();
            $up_tier = $tiers->where('min',"<",$grand_total)->orderBy('min','desc')->first();
            $next = '';
            $next_max = 0;
            $to_next = 0;
            $ct = $u_log->member->title;
            if($n_tier != null){
                if ($grand_total < $n_tier->min) {
                 // dd(Auth::user()->member_id);
                $newMember = \App\Member::where('min','<=',$grand_total)->orderBy('min','desc')->first();
                Auth::user()->member_id = $newMember->id;
                Auth::user()->save();
                $id_user_member= \App\userMember::where('user_id',Auth::user()->id)->first();
                $newUserMmber = \App\userMember::find($id_user_member->id);
                $newUserMmber->member_id = $newMember->id;
                $unit = $newMember->period_unit;
                $d='';
                if($unit == 1){$d = 365;}elseif($unit == 2){$d = 30;}elseif($unit == 3){$d = 7;}
                    $d = (int)$d * $unit;
                    $d = "+$d day";
                    $start_date = strtotime(date('d-m-Y'));
                    $end_date = strtotime($d, $start_date);
                    $end_date = date("Y-m-d H:i:s",$end_date);
                $newUserMmber->ended_at = $end_date;
                $newUserMmber->save();
                $tier = $tiers->orderBy('id','desc')->first();
                $lebihan = $grand_total - $tier->min;
                $data = [
                        'user_id' => Auth::user()->id,
                        'member_id' => $newMember->id,
                        'ends_on' => $end_date,
                        'lebihan' => $lebihan < 0 ? 0 : $lebihan
                    ];
                    $logs->create($data);
                }
            }
        }
        flash('berhasil melakukan konfimasi')->success();
        return redirect()->back();
    }
    public function confirm_order_admin($id)
    {
        $order = order::with('orderDetails')->where('id',decrypt($id))->first();
        $order->user_status_konfrimasi = 1;
        $order->delivery_status = 'delivered';

        foreach ($order->orderDetails as $key => $value) {
            $value->delivery_status = "delivered";
            $value->save();
        }
        $order->save();
        if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated) {
            if($order->get_poin != null){
            $clubpointController = new ClubPointController;
            $clubpointController->processClubPoints($order);
            }
        }

        $au_id = Auth::user()->referred_by;
       
        if ($au_id != null) {
            $affiliate = new AffiliateController;
            $affiliate->affiliateProccessPoint($au_id);         
        }
        if(Auth::user()->user_type == 'regular physician'){
            $orderU = \App\Order::where('user_id', $order->user_id);
            $log = new \App\userMember;
            $tiers = new \App\Member;    
            $logs = new \App\Membership_user_log;

            $myMember = Auth::user()->member;
            $userMember = \App\userMember::where(['member_id'=>$myMember->id,'user_id'=>$order->user_id])->orderBy('created_at','desc')->first();
            $from = date_format($userMember->created_at, "Y-m-d");
    
            $to = $userMember->ended_at;
            $orders = Auth::user()->orders;
            $active_m_order = $orders->where("payment_status", "paid")->whereBetween('created_at', [$from, $to]);
            $grand_total = $active_m_order->sum("grand_total");
            $u_log = $userMember;

            $n_tier = $tiers->where('min',">",$grand_total)->first();
            $up_tier = $tiers->where('min',"<",$grand_total)->orderBy('min','desc')->first();
            $next = '';
            $next_max = 0;
            $to_next = 0;
            $ct = $u_log->member->title;
            if($n_tier != null){
                if ($grand_total < $n_tier->min) {
                 // dd(Auth::user()->member_id);
                $newMember = \App\Member::where('min','<=',$grand_total)->orderBy('min','desc')->first();
                Auth::user()->member_id = $newMember->id;
                Auth::user()->save();
                $id_user_member= \App\userMember::where('user_id',Auth::user()->id)->first();
                $newUserMmber = \App\userMember::find($id_user_member->id);
                $newUserMmber->member_id = $newMember->id;
                $unit = $newMember->period_unit;
                $d='';
                if($unit == 1){$d = 365;}elseif($unit == 2){$d = 30;}elseif($unit == 3){$d = 7;}
                    $d = (int)$d * $unit;
                    $d = "+$d day";
                    $start_date = strtotime(date('d-m-Y'));
                    $end_date = strtotime($d, $start_date);
                    $end_date = date("Y-m-d H:i:s",$end_date);
                $newUserMmber->ended_at = $end_date;
                $newUserMmber->save();
                $tier = $tiers->orderBy('id','desc')->first();
                $lebihan = $grand_total - $tier->min;
                $data = [
                        'user_id' => Auth::user()->id,
                        'member_id' => $newMember->id,
                        'ends_on' => $end_date,
                        'lebihan' => $lebihan < 0 ? 0 : $lebihan
                    ];
                    $logs->create($data);
                }
            }
        }
        flash('berhasil melakukan konfimasi')->success();
        return redirect()->back();
    }
}
