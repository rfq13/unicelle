<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Policy;
use App\InfoPetunjuk;

class PolicyController extends Controller
{

    public function index($type)
    {
        $policy = Policy::where('name', $type)->first();
        return view('policies.index', compact('policy'));
    }

    //updates the policy pages
    public function store(Request $request){
        $policy = Policy::where('name', $request->name)->first();
        $policy->name = $request->name;
        $policy->content = $request->content;
        $policy->save();

        flash(translate($request->name.' Update Berhasil'));
        return back();
    }
    public function manage_petunjuk()
    {
        $policy = InfoPetunjuk::where('name', 'petunjuk_dropshipper')->first();
        return view('privacy-policy.manage_dropshipper', compact('policy'));
    }
    public function store_info_dropshipper(Request $request){
        // dd($request->content);
        $detail = InfoPetunjuk::where('name', 'petunjuk_dropshipper')->first();
        $detail->content = $request->content;
        $detail->save();

        flash(translate($request->name.' Update Berhasil'));
        return back();
    }
}
