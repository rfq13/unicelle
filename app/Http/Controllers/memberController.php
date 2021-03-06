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

    public function __construct()
    {
        
    }

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
        $member = new Member;
        // $members = $member->get();
        // if ($members->count > 0) {
        //     foreach ($members as $key => $member_min) {
        //         if ($min > $member_min->min && $min < $member[$key+1]->min) {
        //             flash("rentan minimal pembelian sudah ada pada member sebelumnya")->error();
        //             return back();
        //         }
        //     }
        // }
        $min = str_replace("Rp.", "", $request->min);
        $min = str_replace(".", "", $min);
        $min = str_replace(" ", "", $min);
        $data = [
            "title" => $request->title,
            "min" => $min,
            "periode" =>$request->periode,
            "period_unit" => $request->unit

        ];

        $member->create($data);
        flash("berhasil menambah jenis member")->success();
        return redirect(route('regular-physician-member.index'));
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
        $member= Member::findOrFail(decrypt($id));
        return view('Member.edit', compact('member'));
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
        $member->periode = $request->periode;
        $member->period_unit = $request->unit;
        if ($member->save()) {
            flash("Berhasil merubah jenis member")->success();
            return redirect(route('regular-physician-member.index'));
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
        $myMember = Auth::user()->member;
        $userMember = \App\userMember::where(['member_id'=>$myMember->id,'user_id'=>Auth::user()->id])->orderBy('created_at','desc')->first();
        $from = date_format($userMember->created_at, "Y-m-d");
        $to = $userMember->ended_at;
        $orders = Auth::user()->orders;
        $active_m_order = $orders->where("payment_status", "paid")->whereBetween('created_at', [$from, $to]);
        $grand_total = $active_m_order->sum("grand_total");
        $Current_tierMember = $userMember->member;
        $next_tierMember = \App\Member::where("min", ">", $grand_total)->orderBy("min")->first();
        
        $now = Carbon::now();
        $to = Carbon::createFromFormat('Y-m-d H:i:s', "$userMember->ended_at");
        $from = Carbon::now()->toDate()->format("Y-m-d");
        $diff_in_days = $to->diffInDays($from);
        
        if ($diff_in_days == 0) {
            if ($next_tierMember->id == $Current_tierMember->id) {
                $ended_at = $this->ended_at($userMember->member);
                $userMember->ended_at = $ended_at;
                $userMember->user_id = Auth::user()->id;
                $userMember->member_id = $next_tierMember->id;
                $userMember = $userMember->toArray();
    
                \App\userMember::create($userMember);
            }
        }
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

    public function activation($id)
    {
        $user = \App\physician_verificationModel::with("user")->where("id", $id)->first();
        $username = $user->user->name;
        $return = '';
        $now = Carbon::now();
        if ($user->verify == 0) {
            $user->verify = 1;
            if ($user->has('user')) {
                $pengguna = $user->user;
                $pengguna->email_verified_at = $now;
                $pengguna->save();
            }
            $user->save();
            $return = [
                "stts" => 'sukses',
                'btn' => 'Nonaktifkan',
                "msg" => "berhasil mengaktifkan dr $username",
                "time" => $now->format('Y-m-d H:i:s')
            ];
        } else {
            $user->verify = 0;
            $user->save();
            $return = [
                "stts" => 'sukses',
                'btn' => "Aktifkan",
                "msg" => "berhasil menonaktifkan dr $username"
            ];
        }
        return $return;
    }

    public function deleteUsermember($id)
    {
        $member = \App\physician_verificationModel::findOrFail($id);
        if ($member->delete()) {
            flash("Berhasil menghapus jenis member")->success();
        }else {
            flash("Gagal menghapus jenis member")->error();
        }
        return back();
    }
}
