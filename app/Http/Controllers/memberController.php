<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Member;
use Carbon\Carbon;

class memberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::with(["user.user"])->orderBy("min", "desc")->paginate(10);
        return view("Member.manage", compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("Member.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        unset($request->_token);
        $member = new Member;
        if ($request->min < $member->max("min")) {
            flash("rentan minimal pembelian sudah ada pada member sebelumnya")->error();
            return back();
        }
        $data = [
            "title" => $request->title,
            "min" => $request->min,
            "periode" => json_encode([$request->periode, $request->unit])
        ];

        $member->create($data);
        flash("berhasil menambah jenis member")->success();
        return back();
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
        $min = str_replace("Rp.", "", $request->min);
        $min = str_replace(".", "", $min);
        $min = str_replace(" ", "", $min);
        // dd($min);

        $member = Member::findOrFail($id);
        $member->title = $request->title;
        $member->min = $min;
        $member->periode = json_encode([$request->periode, $request->unit]);
        if ($member->save()) {
            flash("Berhasil merubah jenis member")->success();
            return "sukses";
        }
        return "gagal";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
        flash("Berhasil menghapus jenis member")->success();
        return back();
    }

    public function updateMember()
    {
        $userMember = Auth::user()->member;
        $from = date_format($userMember->created_at, "Y-m-d");
        $to = $userMember->ended_at;
        $orders = Auth::user()->orders;
        $active_m_order = $orders->where("payment_status", "paid")->whereBetween('created_at', [$from, $to]);
        $grand_total = $active_m_order->sum("grand_total");

        $Current_tierMember = $userMember->member;
        // dd($Current_tierMember);
        $next_tierMember = \App\Member::where("min", ">", $grand_total)->orderBy("min")->first();
        if ($next_tierMember != null && $next_tierMember->id != $Current_tierMember->id) {
            $userMember->member_id = $next_tierMember->id;
            $userMember->save();

            $newTier = new \App\userMember;
            $newTier->user_id = Auth::user()->id;
            $newTier->member_id = $next_tierMember->id;
            $newTier->ended_at = $this->ended_at($next_tierMember);
            $newTier->save();
        }

        // $userMember = Auth::user()->member;
        // $now = Carbon::now();
        // $to = Carbon::createFromFormat('Y-m-d', "$userMember->ended_at");
        // $from = Carbon::now()->toDate()->format("Y-m-d");
        // $diff_in_days = $to->diffInDays($from);
        // // dd($diff_in_days);
        // if ($diff_in_days == 0) {
        //     # code...
        // }
        // dd([$userMember, $from, $to, $grand_total, "ctm" => $Current_tierMember]);
    }

    public function ended_at($member)
    {
        $periode = json_decode($member->periode);
        $unit = $periode[1];
        $periode = $periode[0];
        // $endedAt = 0;
        switch ($unit) {
            case 'hari':
                $endedAt = 1;
                break;
            case 'bulan':
                $endedAt = 30;
                break;
            case 'tahun':
                $endedAt = 360;
                break;
            default:
                $endedAt = 0;
                break;
        }

        $endedAt = $periode * $endedAt;
        $tgl = Carbon::now()->toDate()->format("Y-m-d");
        $tgl_berakhir = date('Y-m-d', strtotime("+$endedAt days", strtotime($tgl)));
        return $tgl_berakhir;
    }
}
