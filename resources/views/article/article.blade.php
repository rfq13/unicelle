
@extends('frontend.layouts.app')
@section('content')
    <div class="container">
    <nav aria-label="breadcrumb">
            <ul class="breadcrumb mb-5 mt-5">
                <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('blog.article')}}">Artikel</a></li>
                <li class="breadcrumb-item active" style="color:#3BB6B1" aria-current="page">{{ $blog->title }}</li>
            </ul>
        </nav>
        <div class="container">
            <div class="container">
                <div class="card mb-5">
                    <div class="ml-5" >
                        <p class="judul-artikel">{{ $blog->title }}</p>
                    </div>
                    <div class="container" >
                        <img class="gambar-artikel" src="{{my_asset($blog->thumbnail)}}" style="width:70%;height:70%;margin-bottom:5%;margin-top:5%" alt="">
                    </div>
                    <div class="container">
                        {!! $blog->content !!}
                    </div>                   
                </div>
                <div class="col-12 mb-5 mt-5">
                    <h5 class="mb-4">Artikel Serupa</h5>
                    <div class="row">
                        @foreach ($similiar as $blogSame)
                            <div class="col-3">
                                <div class="card card-artikel">
                                    <img class="img-fluid w-100" src="{{my_asset($blogSame->thumbnail)}}" style="border-radius: 15px 15px 0 0" alt="">
                                    <p class="judul-card-artikel">
                                        {{ $blogSame->title }}
                                    </p>
                                    <p class="text-card-artikel">
                                        {{$blogSame->subtitle}}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
        </div>
        </div>
    </div>
@endsection