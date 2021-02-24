<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin_log;
use App\Language;
use ImageOptimizer;


class LogController extends Controller
{
    public function index(Request $request)
    {
        $user_id= null;
        $sort_time= null;
        $sort_search = null;

        $logs = Admin_log::orderBy('created_at', 'desc')->with('user');
        if ($request->has('search')){
            $sort_search = $request->search;
            $logs = Admin_log::where('order_id','like',"%$sort_search%")->orWhere('konsumen','like',"%$sort_search%")->orderBy('created_at', 'desc')->with('user');

        }
        if ($request->user_id != null){
            $tes = \App\User::where('id', $request->user_id)->get();
            $getuser = $tes->pluck('id')->toArray();
            $logs = Admin_log::where('user_id',$getuser)->orderBy('created_at', 'desc')->with('user');
            $user_id = $request->user_id;

        }
        if ($request->waktu != null){
            $sort_time = $request->waktu;
            $logs = Admin_log::where('updated_at',$sort_time)->orderBy('created_at', 'desc')->with('user');

        }

        $logs = $logs->paginate(50);

        return view('admin.log', compact('logs','user_id','sort_search','sort_time'));
    }

}