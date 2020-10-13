@if (Auth::user()->user_type != "regular physician")
    abort(404);
@endif
@php

    $orderU = \App\Order::where('user_id', Auth::user()->id);
    $log = new \App\userMember;
    $tiers = new \App\Member;

    
    
    $myMember = Auth::user()->member;
    $userMember = \App\userMember::where(['member_id'=>$myMember->id,'user_id'=>Auth::user()->id])->orderBy('created_at','desc')->first();
    $from = date_format($userMember->created_at, "Y-m-d");
    $to = $userMember->ended_at;
    $orders = Auth::user()->orders;
    $active_m_order = $orders->where("payment_status", "paid")->whereBetween('created_at', [$from, $to]);
    $grand_total = $active_m_order->sum("grand_total");

    $u_log = $userMember;


    $n_tier = $tiers->where('min',">",$grand_total)->first();
    $next = '';
    $next_max = 0;
    $to_next = 0;
    $ct = $u_log->member->title;
    if(isset($n_tier)){
        if ($grand_total > $n_tier->min) {
            // dd(Auth::user()->member_id);
            $newMember = \App\Member::where('min','>',$grand_total)->orderBy('min','desc')->first();
            Auth::user()->member_id = $newMember->id;
            Auth::user()->save();

            $newUserMmber = new \App\userMember;
            $newUserMmber->member_id = $newMember->id;
            $newUserMmber->user_id = Auth::user()->id;
            $newUserMmber->ended_at = app('\App\Http\Controllers\memberController')->ended_at($newMember);
            $newUseMember->save();
        }

        $next = $n_tier->title;
        $next_max = $n_tier->min;
        $to_next = (int)$next_max - (int)$grand_total;
    }
    $persen = $grand_total != 0 && $next_max != 0 ? ($grand_total/$next_max)*100 : 0;
@endphp

@extends('frontend.layouts.app')

@section('content')

<section class="gry-bg py-4 profile">
    <div class="container">
        <div class="row cols-xs-space cols-sm-space cols-md-space">
            <div class="col-lg-4 d-none d-lg-block card">
                    @include('frontend.inc.customer_side_nav')
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header  bg-transparent mb-0">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-4 col-sm-4 col-6">
                                <span class="head-card-akun__">Membership</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body mb-2">
                        <section class="bg-rank-membership-now m-0 p-3">
                            {{-- <div class="mt-4"> --}}
                                <span class="head-tag-membership">Username</span>
                                <div class="dr-membership">
                                    <span class="name-membership" style="text-transform: capitalize">{{Auth::user()->name}}</span>
                                </div>
                            {{-- </div> --}}
                            <div class="mt-3">
                                <span class="head-tag-membership">Berlaku Hingga</span>
                                <div class="dr-membership">
                                    <span class="name-membership">{{$u_log->ended_at}}</span>
                                </div>
                            </div>
                        </section>
                        @if ($n_tier != null)
                        <div class="progres-membership mt-3">
                            <span class="text-comment-member">Selesaikan <span class="font-weight-bold">{{toRp($to_next)}}</span> Total Belanja untuk menjadi <span class="font-weight-bold">{{$n_tier->title}}
                                Membership</span> </span>
                                <div class="progress my-1">
                                    <div class="progress-bar" role="progressbar" style="width: {{$persen}}%;" aria-valuenow="{{$persen}}"
                                    aria-valuemin="0" aria-valuemax="100">{{$persen}}%</div>
                                </div>
                                <div class="text-right">
                                    <span class="nominal-range-membership">{{$n_tier != null ? toRp($grand_total)." / ". toRp($n_tier->min): ""}}</span>
                                </div>
                        </div>
                        @else
                        <h4 class="text-center">Selamat anda sudah mencapai Membership tertinggi!</h4>
                            
                        @endif

                        @php
                            $membership = \App\Member::orderBy("min")->get();
                            $min = $membership->pluck("min")->toArray();
                        @endphp
                        {{-- <h1>{{ toRp($grand_total)." ".Auth::user()->member->title }}</h1> --}}
                        <table class="table table-hover text-center mt-3">
                            <thead class="table-riwayat-poin__">
                                <tr>
                                    <th  scope="col"></th>
                                    @foreach ($membership as $mmbr)
                                        <th scope="col" style="color: white">{{$mmbr->title}}</th>
                                    @endforeach
                                    {{-- <th  scope="col">Platinum</th>
                                    <th  scope="col">Ambasador</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row" class="text-left">Total Belanja</th>
                                    @foreach ($min as $m)
                                        <td scope="row">{{toRp($m)}}</td>
                                    @endforeach
                                    {{-- <td scope="row">Rp6.000.000</td>
                                    <td scope="row">Rp10.000.000</td> --}}
                                </tr>
                                <tr>
                                    <th scope="row" class="text-left">Poin Afiliate Pendaftaran</th>
                                    <td scope="row">100 Poin</td>
                                    <td scope="row">200 Poin</td>
                                    <td scope="row">1.500 Poin</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="text-left">Diskon Belanja</th>
                                    <td scope="row"><i class="fa fa-check"></i></td>
                                    <td scope="row"><i class="fa fa-times"></i></td>
                                    <td scope="row"><i class="fa fa-check"></i></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
