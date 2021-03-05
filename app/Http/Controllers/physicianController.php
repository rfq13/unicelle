<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class physicianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verification(Request $request)
    {
        $user_type = null;
        $sort_by = null;
        $sort_search= null;

        $users = \App\physician_verificationModel::with(["user",'user.instansi']);
        if ($request->has('sort_search')){
            $sort_search = $request->sort_search;
            
            $getname = \App\User::select('id')->where('name','like',"%$sort_search%")->orWhere('email','like',"%$sort_search%")->orWhere('phone','like',"%$sort_search%")->get();
            if ($getname != null && $getname->count() > 0) {
                $users = \App\physician_verificationModel::whereIn('user_id',$getname)->with(["user",'user.instansi']);

            }

        }
        if ($request->user_type != null) {
           $check = \App\User::where('user_type',$request->user_type)->get();
            $idUser = $check->pluck('id')->toArray();
            $users = \App\physician_verificationModel::whereIn('user_id',$idUser)->with(["user",'user.instansi']);

            $user_type = $request->user_type;
        }
        if ($request->sort_by != null) {
            if($request->sort_by == 'terbaru'){
                $users = $users->orderBy('created_at','desc');
            }
            else{
                $users = $users->orderBy('created_at','asc');
            }
            $sort_by = $request->sort_by;
        }
        
        $users = $users->paginate(15);
        return view('physician.verify', compact('users','user_type','sort_by','sort_search'));
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
       //
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
        $userDetail = \App\User::findOrFail($id);
        return view('physician.edit', compact('userDetail'));
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
        $userDetail = \App\User::findOrFail($id);
        $userDetail->name = $request->name;
        $userDetail->email = $request->email;
        $userDetail->phone = $request->phone;
        $userDetail->gender = $request->gender;
        $userDetail->birth = $request->birth;
        $userDetail->poin = $request->poin;
        if ($userDetail->save()) {
            flash('Data has been saved successfully')->success();
            return redirect()->route('physician.verify');
        }
        else{
            flash('Something went wrong')->error();
            return back();
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
