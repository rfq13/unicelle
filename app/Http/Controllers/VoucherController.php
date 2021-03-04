<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\SubCategory;
use App\SubSubCategory;
use App\CouponVoucher;
use App\User;
use App\VoucherUsage;
use App\ClubPointExchange;
use Schema;
use PDF;
use Auth;

use ImageOptimizer;


class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;

        $coupons_voucher = CouponVoucher::where('is_delete','0')->orderBy('id','desc')->get();
        if ($request->has('search')){
            $sort_search = $request->search;
            
            $coupons_voucher = CouponVoucher::where('is_delete','0')->where('judul','like',"%$sort_search%")->orderBy('id','desc')->get();

        }
        return view('voucher.index', compact('coupons_voucher'));
    }
    public function create()
    {
        return view('voucher.create');
    }
    public function print_pdf()
    {
        return view('voucher.list_user');
    }
    public function list_voucher(Request $request)
    {
        $sort_search = null;
        $load_id = null;
        $list =\App\VoucherUsage::where('user_id',Auth::user()->id)->with('voucher')->orderBy('created_at','desc')->limit(4)->get();
        if($request->has('load')){
            $load_id= $request->load;
            if($load_id == '1'){
            $list =\App\VoucherUsage::where('user_id',Auth::user()->id)->with('voucher')->orderBy('created_at','desc')->get();
            }
        }
        $voucher =\App\CouponVoucher::where('is_delete','0')->orderBy('created_at','desc')->get();
        if ($request->has('search')){
            $sort_search=$request->search;
            $voucher =\App\CouponVoucher::where('is_delete','0')->where('judul','like',"%$sort_search%")->orderBy('created_at','desc')->get();
            $idvoucher = $voucher->pluck('id')->toArray();

            $list =\App\VoucherUsage::where('user_id',Auth::user()->id)->where('voucher_id',$idvoucher)->with('voucher')->orderBy('created_at','desc')->get();

        }

        return view('voucher.listvoucher',compact('list','voucher','load_id'));
    }
    public function store(Request $request)
    {
        $coupons_voucher = new CouponVoucher;
        $coupons_voucher->merchant = $request->merchant;
        $coupons_voucher->judul = $request->judul;
        $coupons_voucher->point = $request->point;
        $coupons_voucher->potongan = $request->potongan;
        $coupons_voucher->discount_type = $request->discount_type;
        $coupons_voucher->slug = str_replace(" ","-",$request->judul);
        $coupons_voucher->syarat = $request->syarat;
        $coupons_voucher->cara = $request->cara;
        $messages = [
            'required' => ' :attribute harus diisi',
            'string'    => ' :attribute harus berformat teks',
            'file'    => ' :attribute harus berformat file',
            'mimes' => 'format :attribute harus :mimes',
            'max'      => 'ukuran maksimal :attribute => :max',
            'dimensions' => 'Ukuran gambar harus=> 360 * 180 ',
        ];

        $fields = [
            "thumbnail"  => "dimensions:max_width=360,max_height=180|required|mimes:jpeg,bmp,png,gif",
        ];
        $validator = \Validator::make($request->all(), $fields, $messages);
        if ($validator->fails()) {
            foreach ($validator->errors()->messages() as $msgs) {
                foreach ($msgs as $msg) {
                    flash(__("Terjadi kesalahan pada server. $msg"))->error();
                }
            }
            return back();
        }
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
        $coupons_voucher->potongan = $request->potongan;
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
    public function generate_string($input, $strength = 16) {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
     
        return $random_string;
    }
    public function tukarpoint(Request $request){
        $coupons_voucher = CouponVoucher::findOrFail($request->id);
        if ($coupons_voucher->first() != null) {

        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $random = substr(str_shuffle(str_repeat($pool, 5)), 0, 10);
        $user = User::where('id',Auth::user()->id)->get();
        $user_point = Auth::user()->poin;
        $voucher_point = $coupons_voucher->point;
        if($user_point >= $voucher_point){
        $usage = new VoucherUsage;
        $usage->user_id = Auth::user()->id;
        $usage->voucher_id = $coupons_voucher->id;
        $usage->code = $random;
        $usage->is_active ='1';
        $usage->save();
        $history = new ClubPointExchange;
        $history->user_id = Auth::user()->id;
        $history->voucher_id = $coupons_voucher->id;
        $history->point = '-'.$coupons_voucher->point;
        $history->keterangan = "Tukar Poin";
        $history->save();
        $user = User::findOrFail(Auth::user()->id);
        $update_poin = Auth::user()->poin - $coupons_voucher->point;
        $user->poin = $update_poin;
        $user->save();
        return response()->json(['stts'=>false]);

        }
        else{
            return response()->json(['stts'=>true]);


        }
    }
    else{
        return response()->json(['stts'=>true]);

    }
    }
    public function code_voucher($id)
    {
        $voucher = VoucherUsage::findOrFail($id);
        $detail= VoucherUsage::where('id',$id)->with('voucher')->first();
        $pdf = PDF::setOptions([
                        'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
                        'logOutputFile' => storage_path('logs/log.htm'),
                        'tempDir' => storage_path('logs/')
                    ])->loadView('voucher.pdf', compact('detail'));
        return $pdf->download('detail-voucher-'.$detail->code.'.pdf');
    }
    public function showVoucherModal(Request $request)
    {
        $voucher = CouponVoucher::where('id', $request->id)->first();
       
        return view('voucher.modal', compact('voucher'));
    }
    public function klaimVoucher(Request $request)
    {
        $voucher = CouponVoucher::where('id', $request->id)->first();
        return view('voucher.modalConfirm', compact('voucher'));
    }
    public function voucher_usage($id)
    {
        $coupon= CouponVoucher::where('id',$id)->first();
        $detail= VoucherUsage::where('voucher_id',$id)->with('user')->get();
        $pdf = PDF::setOptions([
                        'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
                        'logOutputFile' => storage_path('logs/log.htm'),
                        'tempDir' => storage_path('logs/')
                    ])->loadView('voucher.list_user', compact('detail','coupon'));
        return $pdf->download('voucher-usage-'.$coupon->slug.'.pdf');
    }
    public function visibility(Request $request)
    {
        $coupon = CouponVoucher::findOrFail($request->id);
        if ($coupon) {
            $st = 1;
            $msg = "aktif";
            if ($coupon->is_active === 1) {
                $msg = "non aktif";
                $st = 0;
            }
            $coupon->is_active = $st;
            $coupon->save();
            return ['msg'=>"berhasil $msg kupon $coupon->judul",'st'=>'sukses'];
        }
        return ['msg'=>"gagal $msg kupon $coupon->judul",'st'=>'hah'];
    }
}