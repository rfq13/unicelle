<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BusinessSetting;
use App\ClubPointDetail;
use App\ClubPoint;
Use App\PoinUser;
use App\Member;
use App\UsePoin;
use App\Product;
use App\Wallet;
use App\Order;
use Auth;
use DB;

class ClubPointController extends Controller
{
    public function configure_index()
    {
        
        return view('club_points.config');
    }

    public function index()
    {
        $club_points = ClubPoint::latest()->paginate(15);
        return view('club_points.index', compact('club_points'));
    }
    public function set_member_points(Request $request)
    {
        $members = Member::orderBy('id','asc')->get();
        return view('club_points.member',compact('members'));
    }
    public function set_member_setting(Request $request)
    {
        
        $member = Member::findOrfail($request->id);
        $member->poin_order = $request->poin_order;
        $member->min_order_poin = $request->min_order_poin;
        $member->discount_order = $request->discount_order;
        $member->min_order_discount = $request->min_order_discount;
        $member->discount_type = $request->discount_type;
        $member->save();
        flash(__('Submit has been updated successfully'))->success();
        // return redirect()->route('club_points.configs');
        return back();

    }
    public function userpoint_index()
    {
        $club_points = ClubPoint::where('user_id', Auth::user()->id)->latest()->paginate(15);
        $point_exchange = DB::table('club_point_exchange')->where('user_id',Auth::user()->id)->where('point','!=',0)->orderBy('created_at','desc')->paginate(15); 
        return view('club_points.frontend.index', compact('club_points','point_exchange'));
    }

    public function set_point()
    {
        $products = Product::latest()->paginate(15);
        return view('club_points.set_point', compact('products'));
    }

    public function set_products_point(Request $request)
    {
        $products = Product::whereBetween('unit_price', [$request->min_price, $request->max_price])->get();
        foreach ($products as $product) {
            $product->earn_point = $request->point;
            $product->save();
        }
        flash(__('Point has been inserted successfully for ').count($products).__(' products'))->success();
        return redirect()->route('set_product_points');
    }

    public function set_point_edit($id)
    {
        $product = Product::findOrFail(decrypt($id));
        return view('club_points.product_point_edit', compact('product'));
    }

    public function update_product_point(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->earn_point = $request->point;
        $product->save();
        flash(__('Point has been updated successfully'))->success();
        return redirect()->route('set_product_points');
    }

    public function convert_rate_store(Request $request)
    {
        $club_point_convert_rate = BusinessSetting::where('type', $request->type)->first();
        if ($club_point_convert_rate != null) {
            $club_point_convert_rate->value = $request->value;
        }
        else {
            $club_point_convert_rate = new BusinessSetting;
            $club_point_convert_rate->type = $request->type;
            $club_point_convert_rate->value = $request->value;
        }
        $club_point_convert_rate->save();
        flash(__('Point convert rate has been updated successfully'))->success();
        return redirect()->route('club_points.configs');
    }
    public function convert_rate_poin_user(Request $request)
    {
        $poin_pasien = PoinUser::where('type_user', $request->type)->first();
        if ($poin_pasien != null) {
            $pasien = PoinUser::findOrFail($poin_pasien->id);
            $pasien->min_order_poin = $request->min_order_poin;
            $pasien->poin= $request->poin;
            $pasien->min_order_discount=$request->min_order_discount;
            $pasien->discount = $request->discount;
            $pasien->type_discount = $request->type_discount;
        }
        $pasien->save();
        flash(__('Point convert rate has been updated successfully'))->success();
        return redirect()->route('club_points.configs');
    }
    public function processClubPoints(Order $order)
    {
        $user = $order->user;
        $club_point = new ClubPoint;
        $club_point->user_id = $user->id;
        $club_point->points = $order->get_poin;
        // foreach ($order->orderDetails as $key => $orderDetail) {
        //     $total_pts = ($orderDetail->product->earn_point) * $orderDetail->quantity;
        //     $club_point->points += $total_pts;
        // }
        $club_point->convert_status = 0;
        $club_point->save();
        // foreach ($order->orderDetails as $key => $orderDetail) {
        //     $club_point_detail = new ClubPointDetail;
        //     $club_point_detail->club_point_id = $club_point->id;
        //     $club_point_detail->product_id = $orderDetail->product_id;
        //     $club_point_detail->point = $total_pts;
        //     $club_point_detail->save();
        // }

        $user->poin += $club_point->points;
        $user->save();
    }

    public function club_point_detail($id)
    {
        $club_point_details = ClubPointDetail::where('club_point_id', decrypt($id))->paginate(12);
        return view('club_points.club_point_details', compact('club_point_details'));
    }

    public function convert_point_into_wallet(Request $request)
    {
        $club_point_convert_rate = BusinessSetting::where('type', 'club_point_convert_rate')->first()->value;
        $club_point = ClubPoint::findOrFail($request->el);
        $wallet = new Wallet;
        $wallet->user_id = Auth::user()->id;
        $wallet->amount = floatval($club_point->points / $club_point_convert_rate);
        $wallet->payment_method = 'Club Point Convert';
        $wallet->payment_details = 'Club Point Convert';
        $wallet->save();
        $user = Auth::user();
        $user->balance = $user->balance + floatval($club_point->points / $club_point_convert_rate);
        $user->save();
        $club_point->convert_status = 1;
        if ($club_point->save()) {
            return 1;
        }
        else {
            return 0;
        }
    }

    public function cart_club_poin(Request $request)
    {
        if($request->has('jml'))
        {
            if($request->jml <= Auth::user()->poin)
            {
                if($request->jml == null){
                    flash(__('Masukkan jumlah poin'))->error();
                }
                else{
                flash(__('sukses'))->success();
                $search= UsePoin::where('user_id',Auth::user()->id)->first();
                if(isset($search)){
                    $update = UsePoin::findOrFail($search->id);
                    $update->poin=$request->jml;
                    $update->save();
                }
                else{
                $history = new UsePoin;
                $history->user_id = Auth::user()->id;
                $history->poin = $request->jml;
                $history->save();
                }                
            }
            }else{
                flash("Poin yang anda masukan melebih poin yang anda.")->error();
            }
        }else{
            $request->session()->forget('poin_use');
        }
        
        return redirect()->back();
    } 
}
