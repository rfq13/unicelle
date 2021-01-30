<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
use App\SubSubCategory;
use App\CouponVoucher;
use Schema;
use ImageOptimizer;


class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons_voucher = CouponVoucher::where('is_delete','0')->orderBy('id','desc')->get();
        return view('voucher.index', compact('coupons_voucher'));
    }
    public function create()
    {
        return view('voucher.create');
    }

    public function store(Request $request)
    {
        $coupons_voucher = new CouponVoucher;
        $coupons_voucher->merchant = $request->merchant;
        $coupons_voucher->judul = $request->judul;
        $coupons_voucher->point = $request->point;
        $coupons_voucher->slug = str_replace(" ","-",$request->judul);
        $coupons_voucher->syarat = $request->syarat;
        $coupons_voucher->cara = $request->cara;
        $coupons_voucher->thumbnail = $request->thumbnail->store('uploads/voucher/thumbnail');
        ImageOptimizer::optimize(base_path('public/').$coupons_voucher->thumbnail);   
        $coupons_voucher->start_date = strtotime($request->start_date);
        $coupons_voucher->end_date = strtotime($request->end_date);     
        $coupons_voucher->is_active = '1';
        $coupons_voucher->is_delete= '0';

        $coupons_voucher->save();
        flash("berhasil menambah Voucher")->success();
        return redirect(route('voucher.index'));
    }
    public function edit($id)
    {
        $coupon_voucher = CouponVoucher::findOrFail(decrypt($id));
        return view('voucher.edit', compact('coupon_voucher'));

    }
    public function update_voucher(Request $request, $id)
    {

        $coupons_voucher = CouponVoucher::findOrFail($id);
        $coupons_voucher->merchant = $request->merchant;
        $coupons_voucher->judul = $request->judul;
        $coupons_voucher->point = $request->point;
        $coupons_voucher->slug = str_replace(" ","-",$request->judul);
        $coupons_voucher->syarat = $request->syarat;
        $coupons_voucher->cara = $request->cara;
        $coupons_voucher->start_date = strtotime($request->start_date);
        $coupons_voucher->end_date = strtotime($request->end_date);     
        $coupons_voucher->is_active = '1';
        $coupons_voucher->is_delete= '0';
        if($request->hasFile('thumbnail')){
            $coupons_voucher->thumbnail = $request->thumbnail->store('uploads/voucher/thumbnail');
            ImageOptimizer::optimize(base_path('public/').$coupons_voucher->thumbnail);   
        }
        if ($coupons_voucher->save()) {
            flash('Voucher has been saved successfully')->success();
            return redirect()->route('voucher.index');
        }
        else{
            flash('Something went wrong')->error();
            return back();
        }
    }
    public function delete_voucher($id)
    {
        $coupons_voucher = CouponVoucher::findOrFail($id);
        if ($coupons_voucher->first() != null) {
            $coupons_voucher->is_active= '0';
            $coupons_voucher->is_delete= '1';
            $coupons_voucher->save();
            flash("Voucher deleted successfully")->success();
        }
        return redirect()->back();

    }
}