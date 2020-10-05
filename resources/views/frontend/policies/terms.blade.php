@extends('frontend.layouts.app')

@section('content')

<section class="section-sub-head"></section>
    <section class="section-syarat-ketentuan">
        <div class="container">
            <div class="row">
                <div class="head-text-syarat-ketentuan">
                    <span class="syarat__">SYARAT DAN KETENTUAN UNICELLE</span>
                    <div >
                        <img class="img__ img-fluid" src="{{my_asset('/images/img/banner-syarat&ketentuan.jpg')}}" alt="">
                    </div>
                </div>
                <div class="text-syarat-ketentuan">
                    <p>
                         @php
                            echo \App\Policy::where('name', 'terms')->first()->content;
                        @endphp
                    </p>
                </div>
            </div>
        </div>
    </section>
<section class="section-bg-syarat"></section>
@endsection
