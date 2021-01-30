<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
use App\SubSubCategory;
use App\CouponVoucher;
use Schema;


class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons_voucher = CouponVoucher::orderBy('id','desc')->get();
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
        $coupons_voucher->slug = str_replace(" ","-",$request->title);
        $coupons_voucher->syarat = $request->syarat;
        $coupons_voucher->cara = $request->cara;
        $coupons_voucher->thumbnail = $this->upload_image($request);
        $coupons_voucher->start_date = $request->start_date;
        $coupons_voucher->end_date = $request->end_date;
        $coupons_voucher->is_active = '1';
        $coupons_voucher->is_delete= '0';

        $coupons_voucher->save();
        flash("berhasil menambah Voucher")->success();
        return redirect(route('voucher.index'));
    }
}