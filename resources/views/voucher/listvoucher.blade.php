@extends('frontend.layouts.app')

@section('title')
    List Voucher
@endsection

@section('content')
    <style>
        .text1 {
            color: #005662;
        }
        .bg-profil-poin {
            background: url('{{ my_asset('images/bg-vc.png') }}');
        border-radius: 15px;
        width: 100%;
        height: auto;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
        .text2 {
            color: #B71C1C;
        }

        .bg_get_voc {
            background: linear-gradient(249.42deg, #005662 0%, #4FB3BF 100%);
            border-radius: 0px 5px 5px 0px;
        }
        .ic-akunpoin-change {
        width: 25px;
        height: 25px;
    }
        /* .card_hv:hover {
            background: #fafafa;
            border: 1px solid #C4C4C4;
            box-sizing: border-box;
            box-shadow: 0px 0px 8px 2px rgba(0, 0, 0, 0.25);
            border-radius: 5px;
        } */

    </style>
    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-4 d-none d-lg-block">
                    <div class="card mr-2">
                        @if (Auth::user()->user_type == 'seller')
                            @include('frontend.inc.seller_side_nav')
                        @else
                            @include('frontend.inc.customer_side_nav')
                        @endif
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header  bg-transparent mb-0">
                            <div class="row align-items-center">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6 p-3 bg-profil-poin" >
                                    <div class="row">
                                    <div class="col-lg-4">
                                    <div class="widget-profile-box text-center">
                                    @if (Auth::user()->avatar_original != null)
                                            <div class="image" style="background-image:url('{{ my_asset(Auth::user()->avatar_original) }}')"></div>
                                        @else
                                            <img src="{{ my_asset('frontend/images/user.png') }}" class="image rounded-circle">
                                        @endif                                    
                                        </div>
                                    </div>
                                    <div class="col-lg-8" style="margin-top: 10px;">
                                    <div class="info-akun-role__">
                                    <span class="tag-username-akun__">{{ Auth::user()->user_type == "pasien reg"? "" : "Dr" }} <span>{{ Auth::user()->name }}</span></span>
                                    <div class="my-1">
                                        <span class="role-user text-primary font-weight-bold" style="text-transform: capitalize">{{ Auth::user()->user_type }}</span>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="col-lg-12" style="height:20px">
                                    </div>
                                    <div class="col-lg-12" style="background: rgba(255, 255, 255, 0.7);
                            backdrop-filter: blur(1000px);
                            border-radius: 5px;">
                                    <div class="row align-items-center " style="margin:5px">
                                    <div class="col-6 col-lg-6">
                                        <span class="text-head-poin-change">Poin Saat ini</span>
                                    </div>
                                    <div class="col-6 col-lg-6 d-flex align-items-center justify-content-end">
                                    <img class="ic-akunpoin-change mr-lg-4 mr-2"
                                            src="{{ my_asset('images/icon/coin.png') }} " alt="">
                                        <div>
                                            <span class="text-head-poin-change font-weight-bold">{{ Auth::user()->poin}}</span>
                                        </div>
                                    </div>
                                </div>                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="card-body mt-2 px-0 pt-0 mb-2">
                        <form class="" id="sort_voucher" action="" method="GET">

                        <div class="col-md-6 col-sm-12">
                            <div style="position: relative;
                            display: -ms-flexbox;
                            display: flex;
                            align-items: stretch;
                            width: 100%;">

                                <input type="text" class="form-control d-inline-block" placeholder="Cari Voucher"
                                    name="search" id="srch-term" onchange="sort_voucher()"
                                    style="max-width: 100%; width: 100%;border-radius: 3px 0px 0px 3px;">
                                <div class="input-group-btn d-inline-block">
                                    <button class="btn btn-light px-3" type="submit"
                                        style="border-radius: 0px 3px 3px 0px;"><span class="fa fa-search"></span></button>
                                </div>
                            </div>
                        </div>
                        </form>

                        <div class="col-md-12" style="height:20px">
                    </div>
                        <div class="col-md-6 col-sm-12" >
                        <h5>Voucher Saya</h5>
                    </div>
                    <div class="col-md-12" >

                    <div class="row">
                    @php
                            $dt = \Carbon\Carbon::now();
                            $tes=$dt->toDateString();

                            @endphp
                            @foreach($list as $key => $l)
                        <div class="col-md-3 col-sm-6 my-2">
                            <div class="card">
                                <div class="p-1">
                                    <div class="d-flex flex-row bd-highlight mb-3">
                                        <div class="p-2 bd-highlight">
                                            <img src="{{my_asset($l->voucher->thumbnail)}}" alt="" style="width: 50px;
                                            height: 50px;
                                            border: 1px solid #C4C4C4;
                                            box-sizing: border-box; border-radius: 100px;">
                                        </div>
                                        <div class="p-2 bd-highlight">
                                            <span class="d-block pb-2">{!!\Illuminate\Support\Str::limit($l->voucher->judul,10)!!}</span>
                                            <span style="
                                            font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 14px;
                                            line-height: 27px;
                                            color: #FF6F00;">Rp. </span><span style="    font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 20px;
                                            line-height: 27px;
                                            color: #FF6F00;">{{$l->voucher->potongan}}</span>
                                        </div>
                                    </div>
                                </div>
                                @php
                                $tgl_berakhir = \Carbon\Carbon::parse(date('Y-m-d', $l->voucher->end_date));
                                @endphp
                                @if($tgl_berakhir < $tes)
                                <button class="btn btn-primary1 w-100" style="border-radius: 0px 0px 5px 5px;background-color: #A9A9A9;" disabled>Pakai
                                    Voucher</button>
                                @else
                                <a href="{{ route('myvoucher.code', $l->id) }}">
                                <button class="btn btn-primary1 w-100" style="border-radius: 0px 0px 5px 5px;">Pakai
                                    Voucher</button>
                                    </a>
                                @endif
                            </div>

                        </div>
                        
                        @endforeach
                        
                    </div>
                    </div>
                   {{-- <div class="text-center mt-md-3 mb-md-5 mb-3 mt-1">
                        <button class="btn btn-primary1 px-5">Lihat Lainnya</button>
                    </div> --}}
                    <div class="col-md-12" style="height:20px">
                    </div>
                    <div class="col-md-6 col-sm-12" >
                        <h5>Voucher Terbaru</h5>
                    </div>
                    <div class="col-md-12" >

                    <div class="row ">

                            @foreach($voucher as $key => $v)
                        <div class="col-md-4 col-12 my-2">
                        <a onclick="showDetailVoucher(event,{{ $v->id }})">                            
                        <div class="card">
                                <div class="p-1">
                                    <div class="d-flex flex-row bd-highlight mb-3">
                                        <div class="p-2 bd-highlight">
                                            <img src="{{my_asset($v->thumbnail)}}" alt="" style="width: 50px;
                                            height: 50px;
                                            border: 1px solid #C4C4C4;
                                            box-sizing: border-box; border-radius: 100px;">
                                        </div>
                                        <div class="p-2 bd-highlight">
                                            <h5>{!!\Illuminate\Support\Str::limit($v->judul,12)!!}</h5>
                                            <span style="
                                            font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 14px;
                                            line-height: 27px;
                                            color: #FF6F00;">Poin </span><span style="    font-family: Open Sans;
                                            font-style: normal;
                                            font-weight: bold;
                                            font-size: 20px;
                                            line-height: 27px;
                                            color: #FF6F00;"> {{$v->point}}</span>
                                            <a href="javascript:void(0)" onclick="addvoucher(event,{{$v->id}});">
                                            <button class=" mt-3 btn btn-primary1 w-100">Tukar Poinku</button>

                                        </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div> 
                           
                            @endforeach
                            </div>
                            </div>
   <!-- modal -->
   <div class="modal fade" id="exampleModal" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div id="exampleModal-body" class="modal-body">

                                                        </div>
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end -->
                            {{-- modal konfirm --}}
                            <div class="modal fade"id="staticBackdrop" data-backdrop="static" data-keyboard="false"
                                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="p-3">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <h4 class="font-weight-bold text1">Yakin Tukar Voucher</h4>
                                            <div class=" text-center d-flex align-items-center justify-content-center mt-4">
                                                <img class="ic-akunpoin__ mr-lg-4 mr-2"
                                                    src="{{ my_asset('images/icon/coin.png') }} " alt="">
                                                <div>
                                                    <span class="poin-now__">200 Poin</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-around border-0">
                                            <button type="button" class="btn btn-secondary1 w-25">Tukar</button>
                                            <button type="button" class="btn btn-secondary w-25">Batalkan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
@foreach (session('flash_notification', collect())->toArray() as $message)
    <script>
        showFrontendAlert('{{ $message['level'] }}', '{{ $message['message'] }}');
    </script>
@endforeach
@section('script')
<script type="text/javascript">
        function sort_voucher(el){
            $('#sort_voucher').submit();
        }
</script>
@endsection