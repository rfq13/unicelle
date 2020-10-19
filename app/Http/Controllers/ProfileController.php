<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use Hash;
use Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('partials.admin_profile');
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
        if(env('DEMO_MODE') == 'On'){
            flash(translate('Sorry! the action is not permitted in demo '))->error();
            return back();
        }

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->new_password != null && ($request->new_password == $request->confirm_password)){
            $user->password = Hash::make($request->new_password);
        }
        if($request->hasFile('avatar')){
            $user->avatar_original = $request->file('avatar')->store('uploads/avatar');
        }
        if($user->save()){
            flash(translate('Your Profile has been updated successfully!'))->success();
            return back();
        }

        flash(translate('Sorry! Something went wrong.'))->error();
        return back();
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

    public function dropshipper(Request $request)
    {
        
        $tgl = $request->tgl;
        $sort = $request->sort;
        $q = $request->q;

        $orders = \App\Order::where('user_id',Auth::user()->id)->where("dropsiper",'!=',"")->with(['orderDetails','orderDetails.product'])->orderBy('code', 'desc')->paginate(9);

        $bank_setting = \App\BusinessSetting::where('type', 'bank_setting')->first();
        $config =  json_decode( $bank_setting->value);

        return view('frontend.dropshipper', compact(['orders','bank_setting','config']));
    }
}
