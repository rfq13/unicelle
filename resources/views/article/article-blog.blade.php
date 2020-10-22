@extends('frontend.layouts.app')
@section('content')
<section class="mb-5"></section>
<div class="container">
            <div class="row">
                <div class="head-text-syarat-ketentuan mx-auto">
                    <span class="syarat__">Artikel / Blog</span>
                    <div>
                        @php
                            $banner = \App\Banner::where("url","#blog")->first();
                        @endphp
                        <img class="img__ img-fluid" src="{{my_asset($banner->photo)}}" alt="">
                    </div>
                </div>

                <div class="col-12 mb-5">
                    <h5 class="mb-4">Topik Artikel Terkini</h5>
                    <div class="row mb-5" id="row-ctg">
                        @php
                            $ctgs = \App\CategoryBlog::all();
                        @endphp
                        @foreach ($ctgs as $k=>$ctg)
                            <div class="col">
                                <button class="btn btn-default w-100" id="btnCtg" data-id="{{ $ctg->id }}">{{ $ctg->name }}</button>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-11 mb-5">
                        <form action="{{ route('blog.article') }}" method="get">
                                <input class="form-control mr-sm-2" name="q" type="search" placeholder="Cari Blog" aria-label="Search">
                                <input type="hidden" name="category_id" id="ctg-id">
                            </div>
                            <div class="col btn btn-search mr-3 ml-3 " style="height:10%">
                                <button type="submit" id="btnSubmit" class="nav-box-link"style="border-style:none;">
                                    <img class="img-fluid" src="{{ my_asset('img/header_dan_footer/icon/search.png') }}" >
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    {{-- {{ dd($blogs->links()) }} --}}
                    <div class="row mb-5 mx-auto">
                        {{-- @for ($i = 0; $i < 4; $i++)
                            <div class="card card-artikel col-md-3 my-3 mx-0">
                                <img class="card-img-top"  src="{{my_asset('/images/img/img-artikel.jpg')}}" alt="">
                                <div class="mx-2 mt-2">
                                    <span class="judul-blog__">Tes untuk Mendeteksi Syok Hipovolemik</span>
                                </div>
                                <div class="m-2">
                                    <span class="caption-blog__">5 Causes of Fatigu5 Causes of Fatigue when Wake Up 5 Causes of
                                        Fatigue when Wake Up 5 Causes of Fatigue when Wake Up</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-artikel" style="border-radius: 7%">
                                    <img class="card-img-top" src="{{my_asset('/images/img/img-artikel.jpg')}}" alt="Card image cap">
                                    <div class="card-body">
                                      <h5 class="card-title">Tes untuk Mendeteksi Syok Hipovolemik</h5>
                                      <p class="card-text">5 Causes of Fatigu5 Causes of Fatigue when Wake Up 5 Causes of
                                        Fatigue when Wake Up 5 Causes of Fatigue when Wake Up</p>
                                      <a href="#" class="btn btn-primary">Go somewhere</a>
                                    </div>
                                </div>
                            </div>
                        @endfor --}}
                        @include('article.inc.blogs')
                    </div>
                    <div class="col-12" >
                        <div class="products-pagination bg-white p-3">
                            <nav aria-label="Center aligned pagination">
                                <ul class="pagination justify-content-center">
                                    {{ $blogs->links() }}
                                </ul>
                            </nav>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
<script>
    $("#row-ctg #btnCtg").click(function (e) {
        e.preventDefault()
        let id = $(this).data('id')
        $("#ctg-id").val(id)
        $("#btnSubmit").click()
    })
</script>
    
@endsection