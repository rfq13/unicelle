<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Member;

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
}
