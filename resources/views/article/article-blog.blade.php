@extends('frontend.layouts.app')
@section('content')
<section class="mb-5"></section>
<div class="container">
            <div class="row">
                <div class="head-text-syarat-ketentuan">
                    <span class="syarat__">Artikel / Blog</span>
                    <div>
                        <img class="img__ img-fluid" src="{{my_asset('/images/img/bg-artikel-blog.jpg')}}" alt="">
                    </div>
                </div>

                <div class="col-12 mb-5">
                    <h5 class="mb-4">Topik Artikel Terkini</h5>
                    <div class="row mb-5">
                        <div class="col">
                            <button class="btn btn-default w-100">Diabetes</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-default w-100">Jantung</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-default w-100">Asma</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-default w-100">Alergi</button>
                        </div>
                        <div class="col">
                            <button class="btn btn-default w-100">Lainnya</button> 
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-11 mb-5">
                            <input class="form-control mr-sm-2" type="search" placeholder="Cari Produk" aria-label="Search">
                        </div>
                        <div class="col btn btn-search mr-3 ml-3 " style="height:10%">
                            <a href="#" class="nav-box-link">
                                <img src="{{ my_asset('img/header_dan_footer/icon/search.png') }}"> </img>
                            </a>
                        </div>
                    </div>
                    
                                      
                    <div class="row mb-5">
                        <div class="card-artikel mr-4 ml-2">
                            <img style="width: 100%; border-radius: 15px 15px 0 0" src="{{my_asset('/images/img/img-artikel.jpg')}}" alt="">
                            <div class="mx-2 mt-2">
                                <span class="judul-blog__">Tes untuk Mendeteksi Syok Hipovolemik</span>
                            </div>
                            <div class="m-2">
                                <span class="caption-blog__">5 Causes of Fatigu5 Causes of Fatigue when Wake Up 5 Causes of
                                    Fatigue when Wake Up 5 Causes of Fatigue when Wake Up</span>
                            </div>
                        </div>
                        <div class="card-artikel mr-4">
                            <img style="width: 100%; border-radius: 15px 15px 0 0" src="{{my_asset('/images/img/img-artikel.jpg')}}" alt="">
                            <div class="mx-2 mt-2">
                                <span class="judul-blog__">Tes untuk Mendeteksi Syok Hipovolemik</span>
                            </div>
                            <div class="m-2">
                                <span class="caption-blog__">5 Causes of Fatigu5 Causes of Fatigue when Wake Up 5 Causes of
                                    Fatigue when Wake Up 5 Causes of Fatigue when Wake Up</span>
                            </div>
                        </div>
                        <div class="card-artikel mr-4">
                            <img style="width: 100%; border-radius: 15px 15px 0 0" src="{{my_asset('/images/img/img-artikel.jpg')}}" alt="">
                            <div class="mx-2 mt-2">
                                <span class="judul-blog__">Tes untuk Mendeteksi Syok Hipovolemik</span>
                            </div>
                            <div class="m-2">
                                <span class="caption-blog__">5 Causes of Fatigu5 Causes of Fatigue when Wake Up 5 Causes of
                                    Fatigue when Wake Up 5 Causes of Fatigue when Wake Up</span>
                            </div>
                        </div>    <div class="card-artikel">
                            <img style="width: 100%; border-radius: 15px 15px 0 0" src="{{my_asset('/images/img/img-artikel.jpg')}}" alt="">
                            <div class="mx-2 mt-2">
                                <span class="judul-blog__">Tes untuk Mendeteksi Syok Hipovolemik</span>
                            </div>
                            <div class="m-2">
                                <span class="caption-blog__">5 Causes of Fatigu5 Causes of Fatigue when Wake Up 5 Causes of
                                    Fatigue when Wake Up 5 Causes of Fatigue when Wake Up</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12" >
                        <button class="btn btn-selanjutnya">Selanjutnya</button>
                    </div>
                </div>
            </div>
        </div>
@endsection