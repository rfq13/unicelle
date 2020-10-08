@php
    if (Auth::user()->user_type != "regular physician") {
        abort(404);
    }

    $usr = Auth::user();
    // dd($usr);
    $from = date_format($usr->member->created_at, "Y-m-d");
    $to = $usr->member->ended_at;
    $my_member_tier = $usr->member;
    $tier = $my_member_tier->member->title;
    $endedAt = date_format(date_create("$my_member_tier->ended_at"),"Y/m/d");

    $next_tierMember = \App\Member::where("min", ">", $usr->member->member->min)->orderBy("min")->first();
    $next_tier = $next_tierMember != null ? $next_tierMember->title : $usr->member->member->title;

    $grand_total = $usr->orders->where("payment_status", "paid")->whereBetween('created_at', [$from, $to])->sum("grand_total");

    $toNext = $next_tierMember->min - $grand_total;

    $persen = $grand_total/$next_tierMember->min*100;

    function buatRupiah($angka){
        $hasil = "Rp" . number_format($angka,0,',','.');
        return $hasil;
    }
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
                                    <span class="name-membership">{{Auth::user()->name}}</span>
                                </div>
                            {{-- </div> --}}
                            <div class="mt-3">
                                <span class="head-tag-membership">Berlaku Hingga</span>
                                <div class="dr-membership">
                                    <span class="name-membership">{{$endedAt}}</span>
                                </div>
                            </div>
                        </section>

                        <div class="progres-membership mt-3">
                            <span class="text-comment-member">Selesaikan <span class="font-weight-bold">{{buatRupiah($toNext)}}</span> Total Belanja untuk menjadi <span class="font-weight-bold">{{$next_tier}}
                                    Membership</span> </span>
                            <div class="progress my-1">
                                <div class="progress-bar" role="progressbar" style="width: {{$persen}}%;" aria-valuenow="{{$persen}}"
                                    aria-valuemin="0" aria-valuemax="100">{{$persen}}%</div>
                            </div>
                            <div class="text-right">
                                <span class="nominal-range-membership">{{buatRupiah($grand_total)." / ".buatRupiah($next_tierMember->min)}}</span>
                            </div>
                        </div>

                        @php
                            $membership = \App\Member::all();
                            $min = $membership->pluck("min")->toArray();
                        @endphp

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
                                        <td scope="row">{{buatRupiah($m)}}</td>
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
