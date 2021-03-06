<!DOCTYPE html>
@if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
<html dir="rtl" lang="en">
@else
<html lang="en">
@endif
<head>

@php    
    $seosetting = \App\SeoSetting::first();
@endphp
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="index, follow">
<title>@yield('title') | {{ env("APP_NAME") }}</title>
<meta name="description" content="@yield('meta_description', $seosetting->description)" />
<meta name="keywords" content="@yield('meta_keywords', $seosetting->keyword)">
<meta name="author" content="{{ $seosetting->author }}">
<meta name="sitemap_link" content="{{ $seosetting->sitemap_link }}">

@yield('meta')

@if(!isset($detailedProduct) && !isset($shop) && !isset($page))
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="{{ config('app.name', 'Laravel') }}">
    <meta itemprop="description" content="{{ $seosetting->description }}">
    <meta itemprop="image" content="{{ my_asset(\App\GeneralSetting::first()->logo) }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ config('app.name', 'Laravel') }}">
    <meta name="twitter:description" content="{{ $seosetting->description }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ my_asset(\App\GeneralSetting::first()->logo) }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ config('app.name', 'Laravel') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route('home') }}" />
    <meta property="og:image" content="{{ my_asset(\App\GeneralSetting::first()->logo) }}" />
    <meta property="og:description" content="{{ $seosetting->description }}" />
    <meta property="og:site_name" content="{{ env('APP_NAME') }}" />
    <meta property="fb:app_id" content="{{ env('FACEBOOK_PIXEL_ID') }}">
@endif
{{-- hei --}}
<!-- Favicon -->
<link type="image/x-icon" href="{{ my_asset(\App\GeneralSetting::first()->favicon) }}" rel="shortcut icon" />

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
<!-- Bootstrap -->
<link rel="stylesheet" href="{{ my_asset('frontend/css/bootstrap.min.css') }}" type="text/css" media="all">

<!-- Icons -->
<link rel="stylesheet" href="{{ my_asset('frontend/css/font-awesome.min.css') }}" type="text/css" media="none" onload="if(media!='all')media='all'">
<link rel="stylesheet" href="{{ my_asset('frontend/css/line-awesome.min.css') }}" type="text/css" media="none" onload="if(media!='all')media='all'">

<link type="text/css" href="{{ my_asset('frontend/css/bootstrap-tagsinput.css') }}" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
<link type="text/css" href="{{ my_asset('frontend/css/jodit.min.css') }}" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
<link type="text/css" href="{{ my_asset('frontend/css/sweetalert2.min.css') }}" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
{{-- <link type="text/css" href="{{ my_asset('frontend/css/slick.css') }}" rel="stylesheet" media="all"> --}}
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

<link type="text/css" href="{{ my_asset('frontend/css/xzoom.css') }}" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
<link type="text/css" href="{{ my_asset('frontend/css/jssocials.css') }}" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
<link type="text/css" href="{{ my_asset('frontend/css/jssocials-theme-flat.css') }}" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
<link type="text/css" href="{{ my_asset('frontend/css/intlTelInput.min.css') }}" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
<link type="text/css" href="{{ my_asset('css/spectrum.css')}}" rel="stylesheet" media="none" onload="if(media!='all')media='all'">

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<!-- Global style (main) -->
<link type="text/css" href="{{ my_asset('frontend/css/active-shop.css') }}" rel="stylesheet" media="all">


<link type="text/css" href="{{ my_asset('frontend/css/main.css') }}" rel="stylesheet" media="all">

<!-- Style -->
<link type="text/css" href="{{ my_asset('css/style.css') }}" rel="stylesheet" media="all">



<!-- <link rel="stylesheet" href="{{ url('public/css/header_dan_footer.css') }}" type="text/css" media="all"> -->
@yield('stylesheet')

@if(\App\Language::where('code', Session::get('locale', Config::get('app.locale')))->first()->rtl == 1)
<!-- RTL -->
<link type="text/css" href="{{ my_asset('frontend/css/active.rtl.css') }}" rel="stylesheet" media="all">
@endif

<!-- @yield('link') -->

<!-- color theme -->
<link href="{{ my_asset('frontend/css/colors/'.\App\GeneralSetting::first()->frontend_color.'.css')}}" rel="stylesheet" media="all">

<!-- Custom style -->
<link type="text/css" href="{{ my_asset('frontend/css/custom-style.css') }}" rel="stylesheet" media="all">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src="{{ my_asset('frontend/js/vendor/jquery.min.js') }}"></script>


@if (\App\BusinessSetting::where('type', 'google_analytics')->first()->value == 1)
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ env('TRACKING_ID') }}"></script>

    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', '{{ env('TRACKING_ID') }}');
    </script>
@endif

@if (\App\BusinessSetting::where('type', 'facebook_pixel')->first()->value == 1)
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', {{ env('FACEBOOK_PIXEL_ID') }});
  fbq('track', 'PageView');
</script>
<noscript>
  <img height="1" width="1" style="display:none"
       src="https://www.facebook.com/tr?id={{ env('FACEBOOK_PIXEL_ID') }}/&ev=PageView&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->
@endif

@yield('style')
<style>
    .btn-primary{
        background-color:#3B6CB6;
        border-radius: 5px;
    }

</style>
<style>
    type="text/css">svg:not(:root).svg-inline--fa{overflow:visible}.svg-inline--fa{display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em}.svg-inline--fa.fa-lg{vertical-align:-.225em}.svg-inline--fa.fa-w-1{width:.0625em}.svg-inline--fa.fa-w-2{width:.125em}.svg-inline--fa.fa-w-3{width:.1875em}.svg-inline--fa.fa-w-4{width:.25em}.svg-inline--fa.fa-w-5{width:.3125em}.svg-inline--fa.fa-w-6{width:.375em}.svg-inline--fa.fa-w-7{width:.4375em}.svg-inline--fa.fa-w-8{width:.5em}.svg-inline--fa.fa-w-9{width:.5625em}.svg-inline--fa.fa-w-10{width:.625em}.svg-inline--fa.fa-w-11{width:.6875em}.svg-inline--fa.fa-w-12{width:.75em}.svg-inline--fa.fa-w-13{width:.8125em}.svg-inline--fa.fa-w-14{width:.875em}.svg-inline--fa.fa-w-15{width:.9375em}.svg-inline--fa.fa-w-16{width:1em}.svg-inline--fa.fa-w-17{width:1.0625em}.svg-inline--fa.fa-w-18{width:1.125em}.svg-inline--fa.fa-w-19{width:1.1875em}.svg-inline--fa.fa-w-20{width:1.25em}.svg-inline--fa.fa-pull-left{margin-right:.3em;width:auto}.svg-inline--fa.fa-pull-right{margin-left:.3em;width:auto}.svg-inline--fa.fa-border{height:1.5em}.svg-inline--fa.fa-li{width:2em}.svg-inline--fa.fa-fw{width:1.25em}.fa-layers svg.svg-inline--fa{bottom:0;left:0;margin:auto;position:absolute;right:0;top:0}.fa-layers{display:inline-block;height:1em;position:relative;text-align:center;vertical-align:-.125em;width:1em}.fa-layers svg.svg-inline--fa{-webkit-transform-origin:center center;transform-origin:center center}.fa-layers-counter,.fa-layers-text{display:inline-block;position:absolute;text-align:center}.fa-layers-text{left:50%;top:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%);-webkit-transform-origin:center center;transform-origin:center center}.fa-layers-counter{background-color:#ff253a;border-radius:1em;-webkit-box-sizing:border-box;box-sizing:border-box;color:#fff;height:1.5em;line-height:1;max-width:5em;min-width:1.5em;overflow:hidden;padding:.25em;right:0;text-overflow:ellipsis;top:0;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:top right;transform-origin:top right}.fa-layers-bottom-right{bottom:0;right:0;top:auto;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:bottom right;transform-origin:bottom right}.fa-layers-bottom-left{bottom:0;left:0;right:auto;top:auto;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:bottom left;transform-origin:bottom left}.fa-layers-top-right{right:0;top:0;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:top right;transform-origin:top right}.fa-layers-top-left{left:0;right:auto;top:0;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:top left;transform-origin:top left}.fa-lg{font-size:1.3333333333em;line-height:.75em;vertical-align:-.0667em}.fa-xs{font-size:.75em}.fa-sm{font-size:.875em}.fa-1x{font-size:1em}.fa-2x{font-size:2em}.fa-3x{font-size:3em}.fa-4x{font-size:4em}.fa-5x{font-size:5em}.fa-6x{font-size:6em}.fa-7x{font-size:7em}.fa-8x{font-size:8em}.fa-9x{font-size:9em}.fa-10x{font-size:10em}.fa-fw{text-align:center;width:1.25em}.fa-ul{list-style-type:none;margin-left:2.5em;padding-left:0}.fa-ul>li{position:relative}.fa-li{left:-2em;position:absolute;text-align:center;width:2em;line-height:inherit}.fa-border{border:solid .08em #eee;border-radius:.1em;padding:.2em .25em .15em}.fa-pull-left{float:left}.fa-pull-right{float:right}.fa.fa-pull-left,.fab.fa-pull-left,.fal.fa-pull-left,.far.fa-pull-left,.fas.fa-pull-left{margin-right:.3em}.fa.fa-pull-right,.fab.fa-pull-right,.fal.fa-pull-right,.far.fa-pull-right,.fas.fa-pull-right{margin-left:.3em}.fa-spin{-webkit-animation:fa-spin 2s infinite linear;animation:fa-spin 2s infinite linear}.fa-pulse{-webkit-animation:fa-spin 1s infinite steps(8);animation:fa-spin 1s infinite steps(8)}@-webkit-keyframes fa-spin{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes fa-spin{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}.fa-rotate-90{-webkit-transform:rotate(90deg);transform:rotate(90deg)}.fa-rotate-180{-webkit-transform:rotate(180deg);transform:rotate(180deg)}.fa-rotate-270{-webkit-transform:rotate(270deg);transform:rotate(270deg)}.fa-flip-horizontal{-webkit-transform:scale(-1,1);transform:scale(-1,1)}.fa-flip-vertical{-webkit-transform:scale(1,-1);transform:scale(1,-1)}.fa-flip-both,.fa-flip-horizontal.fa-flip-vertical{-webkit-transform:scale(-1,-1);transform:scale(-1,-1)}:root .fa-flip-both,:root .fa-flip-horizontal,:root .fa-flip-vertical,:root .fa-rotate-180,:root .fa-rotate-270,:root .fa-rotate-90{-webkit-filter:none;filter:none}.fa-stack{display:inline-block;height:2em;position:relative;width:2.5em}.fa-stack-1x,.fa-stack-2x{bottom:0;left:0;margin:auto;position:absolute;right:0;top:0}.svg-inline--fa.fa-stack-1x{height:1em;width:1.25em}.svg-inline--fa.fa-stack-2x{height:2em;width:2.5em}.fa-inverse{color:#fff}.sr-only{border:0;clip:rect(0,0,0,0);height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;width:1px}.sr-only-focusable:active,.sr-only-focusable:focus{clip:auto;height:auto;margin:0;overflow:visible;position:static;width:auto}.svg-inline--fa .fa-primary{fill:var(--fa-primary-color,currentColor);opacity:1;opacity:var(--fa-primary-opacity,1)}.svg-inline--fa .fa-secondary{fill:var(--fa-secondary-color,currentColor);opacity:.4;opacity:var(--fa-secondary-opacity,.4)}.svg-inline--fa.fa-swap-opacity .fa-primary{opacity:.4;opacity:var(--fa-secondary-opacity,.4)}.svg-inline--fa.fa-swap-opacity .fa-secondary{opacity:1;opacity:var(--fa-primary-opacity,1)}.svg-inline--fa mask .fa-primary,.svg-inline--fa mask .fa-secondary{fill:#000}.fad.fa-inverse{color:#fff}
</style>

<style>
    type="text/css">svg:not(:root).svg-inline--fa{overflow:visible}.svg-inline--fa{display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em}.svg-inline--fa.fa-lg{vertical-align:-.225em}.svg-inline--fa.fa-w-1{width:.0625em}.svg-inline--fa.fa-w-2{width:.125em}.svg-inline--fa.fa-w-3{width:.1875em}.svg-inline--fa.fa-w-4{width:.25em}.svg-inline--fa.fa-w-5{width:.3125em}.svg-inline--fa.fa-w-6{width:.375em}.svg-inline--fa.fa-w-7{width:.4375em}.svg-inline--fa.fa-w-8{width:.5em}.svg-inline--fa.fa-w-9{width:.5625em}.svg-inline--fa.fa-w-10{width:.625em}.svg-inline--fa.fa-w-11{width:.6875em}.svg-inline--fa.fa-w-12{width:.75em}.svg-inline--fa.fa-w-13{width:.8125em}.svg-inline--fa.fa-w-14{width:.875em}.svg-inline--fa.fa-w-15{width:.9375em}.svg-inline--fa.fa-w-16{width:1em}.svg-inline--fa.fa-w-17{width:1.0625em}.svg-inline--fa.fa-w-18{width:1.125em}.svg-inline--fa.fa-w-19{width:1.1875em}.svg-inline--fa.fa-w-20{width:1.25em}.svg-inline--fa.fa-pull-left{margin-right:.3em;width:auto}.svg-inline--fa.fa-pull-right{margin-left:.3em;width:auto}.svg-inline--fa.fa-border{height:1.5em}.svg-inline--fa.fa-li{width:2em}.svg-inline--fa.fa-fw{width:1.25em}.fa-layers svg.svg-inline--fa{bottom:0;left:0;margin:auto;position:absolute;right:0;top:0}.fa-layers{display:inline-block;height:1em;position:relative;text-align:center;vertical-align:-.125em;width:1em}.fa-layers svg.svg-inline--fa{-webkit-transform-origin:center center;transform-origin:center center}.fa-layers-counter,.fa-layers-text{display:inline-block;position:absolute;text-align:center}.fa-layers-text{left:50%;top:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%);-webkit-transform-origin:center center;transform-origin:center center}.fa-layers-counter{background-color:#ff253a;border-radius:1em;-webkit-box-sizing:border-box;box-sizing:border-box;color:#fff;height:1.5em;line-height:1;max-width:5em;min-width:1.5em;overflow:hidden;padding:.25em;right:0;text-overflow:ellipsis;top:0;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:top right;transform-origin:top right}.fa-layers-bottom-right{bottom:0;right:0;top:auto;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:bottom right;transform-origin:bottom right}.fa-layers-bottom-left{bottom:0;left:0;right:auto;top:auto;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:bottom left;transform-origin:bottom left}.fa-layers-top-right{right:0;top:0;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:top right;transform-origin:top right}.fa-layers-top-left{left:0;right:auto;top:0;-webkit-transform:scale(.25);transform:scale(.25);-webkit-transform-origin:top left;transform-origin:top left}.fa-lg{font-size:1.3333333333em;line-height:.75em;vertical-align:-.0667em}.fa-xs{font-size:.75em}.fa-sm{font-size:.875em}.fa-1x{font-size:1em}.fa-2x{font-size:2em}.fa-3x{font-size:3em}.fa-4x{font-size:4em}.fa-5x{font-size:5em}.fa-6x{font-size:6em}.fa-7x{font-size:7em}.fa-8x{font-size:8em}.fa-9x{font-size:9em}.fa-10x{font-size:10em}.fa-fw{text-align:center;width:1.25em}.fa-ul{list-style-type:none;margin-left:2.5em;padding-left:0}.fa-ul>li{position:relative}.fa-li{left:-2em;position:absolute;text-align:center;width:2em;line-height:inherit}.fa-border{border:solid .08em #eee;border-radius:.1em;padding:.2em .25em .15em}.fa-pull-left{float:left}.fa-pull-right{float:right}.fa.fa-pull-left,.fab.fa-pull-left,.fal.fa-pull-left,.far.fa-pull-left,.fas.fa-pull-left{margin-right:.3em}.fa.fa-pull-right,.fab.fa-pull-right,.fal.fa-pull-right,.far.fa-pull-right,.fas.fa-pull-right{margin-left:.3em}.fa-spin{-webkit-animation:fa-spin 2s infinite linear;animation:fa-spin 2s infinite linear}.fa-pulse{-webkit-animation:fa-spin 1s infinite steps(8);animation:fa-spin 1s infinite steps(8)}@-webkit-keyframes fa-spin{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes fa-spin{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}.fa-rotate-90{-webkit-transform:rotate(90deg);transform:rotate(90deg)}.fa-rotate-180{-webkit-transform:rotate(180deg);transform:rotate(180deg)}.fa-rotate-270{-webkit-transform:rotate(270deg);transform:rotate(270deg)}.fa-flip-horizontal{-webkit-transform:scale(-1,1);transform:scale(-1,1)}.fa-flip-vertical{-webkit-transform:scale(1,-1);transform:scale(1,-1)}.fa-flip-both,.fa-flip-horizontal.fa-flip-vertical{-webkit-transform:scale(-1,-1);transform:scale(-1,-1)}:root .fa-flip-both,:root .fa-flip-horizontal,:root .fa-flip-vertical,:root .fa-rotate-180,:root .fa-rotate-270,:root .fa-rotate-90{-webkit-filter:none;filter:none}.fa-stack{display:inline-block;height:2em;position:relative;width:2.5em}.fa-stack-1x,.fa-stack-2x{bottom:0;left:0;margin:auto;position:absolute;right:0;top:0}.svg-inline--fa.fa-stack-1x{height:1em;width:1.25em}.svg-inline--fa.fa-stack-2x{height:2em;width:2.5em}.fa-inverse{color:#fff}.sr-only{border:0;clip:rect(0,0,0,0);height:1px;margin:-1px;overflow:hidden;padding:0;position:absolute;width:1px}.sr-only-focusable:active,.sr-only-focusable:focus{clip:auto;height:auto;margin:0;overflow:visible;position:static;width:auto}.svg-inline--fa .fa-primary{fill:var(--fa-primary-color,currentColor);opacity:1;opacity:var(--fa-primary-opacity,1)}.svg-inline--fa .fa-secondary{fill:var(--fa-secondary-color,currentColor);opacity:.4;opacity:var(--fa-secondary-opacity,.4)}.svg-inline--fa.fa-swap-opacity .fa-primary{opacity:.4;opacity:var(--fa-secondary-opacity,.4)}.svg-inline--fa.fa-swap-opacity .fa-secondary{opacity:1;opacity:var(--fa-primary-opacity,1)}.svg-inline--fa mask .fa-primary,.svg-inline--fa mask .fa-secondary{fill:#000}.fad.fa-inverse{color:#fff}
</style>

<style>

    /*footer*/
    .icon-footer{
        font-size:20px;
        width:50px;
        height:50px;
        margin-top:35px;
        text-align:center;
    }
    .text-dd-profile{
        font-family: "Open Sans";
        font-style: normal;
        font-weight: bold;
        font-size:14px;
        color:#3B6CB6;
    }
    .dd-profile{
        font-family: "Open Sans";
        font-style: normal;
        font-weight: bold;
        font-size:14px;
        color:#000;
    }
    @media only screen and (max-width: 768px){
#account-mobile-menu .category-name-mobile-container a {
    color: black;
    display: block;
    padding-left: 1.5rem !important;
    padding-right: 1.5rem !important;
    padding-top: 0.5rem !important;
    padding-bottom: 0.5rem !important;
}
#account-mobile-menu .category-name-mobile-container a.active {
    color: white !important;
    background-color: #3BB6B1;
    border-radius:5px;
}
    }
    #account-mobile-menu{
        display: none;
    }
    .sold-mobile{
        display: none;
    }
    @media only screen and (max-width: 972px){
        #account-mobile-menu{
        display: block;
    }
    .sold-mobile{
        display: block;
    }
    }
    .profile-icon{
        height: 74px;
        width: 74px;
        margin-left:10px;
        border-radius: 50%;
        border: 2px solid #3BB6B1;
        cursor:pointer;
    }
    .dropdown-profile{
        position: absolute;
        top: 100%;
        right: 0;
        z-index: 1000;
        display: none;
        float: left;
        min-width: 10rem;
        padding: .5rem 0;
        margin: .125rem 0 0;
        font-size: 1rem;
        color: #212529;
        text-align: left;
        list-style: none;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0,0,0,.15);
        border-radius: .25rem;
    }
    /*END*/


    /*Home*/
    .menu-icon{
        height: 110px;
        width: 110px;
        border-radius: 50%;
        border: 2px solid gray;
        cursor:pointer;
    }
    .menu-icon:active{
        border: 2px solid black;
    }
    .icon{
        height: 70%;
        width: 70%;
        cursor:pointer;

    }
    .icon-name{
        font-family: "Open Sans";
        font-style: normal;
        font-weight: bold;
        font-size: 24px;
        cursor:pointer;
        color: #000000;
    }

    .ft-icon{
        font-family: 'Open Sans';
        margin-top: 14.5px;
        font-size: 20px;
        font-style: normal;
        font-weight: 600;
        line-height: 27px;
        letter-spacing: 0em;
        text-align: center;
        color: #212121;
        height: 26.095947265625px;
        width: 100px;
        left: 245px;
        top: 839.900390625px;
        border-radius: nullpx;
    }
/*carousel Menu*/
.mySlides{display:none;}
.menu-icon{
    height: 110px;
    width: 110px;
    border-radius: 50%;
    border: 2px solid gray;
    cursor:pointer;
}

.bt-slide{
    color: #3BB6B1;
    font-size: 50px;
    background-color:white;
    border: none;

}
/*carousel Menu*/
    /*END*/




    /* breadcrumb Blog*/
        .breadcrumb li:not(:last-of-type):after{
        content: '';
    }
    ul.breadcrumb {
    padding: 10px 16px;
    list-style: none;
    font-size:18px;
    }

    ul.breadcrumb li {
    display: inline;
    }
    ul.breadcrumb li a {
    color: #000;
    font-size:18px;
    text-decoration: none;
    }
    ul.breadcrumb li+li:before {
    color: black;
    content: "/\00a0";
    }
    ul.breadcrumb li a:hover {
    color: #3BB6B1;
    text-decoration: underline;
    }
    /*--END--*/

    /*Artikel-Blog*/
    .gambar-artikel
    {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 80%;
    }
    p.judul-artikel{
        text-align: left;
        font-family: "Open Sans";
        font-style: bold;
        font-weight: normal;
        margin-top: 5%;
        font-size: 24px;
        color: #000000;
    }
    p.judul-card-artikel{
        text-align: left;
        margin-left: 5%;
        margin-right: 5%;
        font-family: "Open Sans";
        font-style: normal;
        font-weight: bold;
        font-size: 14px;
        color: #000000;
    }
    p.text-card-artikel{
        text-align: left;
        margin-left: 5%;
        margin-right: 5%;
        font-family: "Open Sans";
        font-style: normal;
        font-weight: normal;
        font-size: 12px;
        color: gray;
    }
    p.text-artikel{
        text-align: left;
        margin-left: 5%;
        margin-right: 5%;
        font-family: "Open Sans";
        font-style: normal;
        font-weight: normal;
        font-size: 14px;
        color: #000000;
    }
    /* .card-artikel{
        box-shadow: 0 2px 5px 1px rgba(0,0,0,0.2);
        transition: 0.3s;
        pointer-events: painted;
        border-radius: 15px 15px 0px 0px;
        cursor:pointer;
    } */
    .card-artikel:hover {
        box-shadow: 0px 0px 18px 0 rgba(0,0,0,0.2);
    }
    .btn-default{
        background-color: #3B6CB6;
        color: #FFFFFF;
    }
    .btn-selanjutnya{
        background-color:#3BB6B1;
        border: none;
        border-radius:4px;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        font-size: 18px;
        display: block;
        margin-left: auto;
        margin-right: auto;
        cursor: pointer;
    }
    .btn-selanjutnya:hover {
    background-color: #006064;
    color: white;
    }
    .btn:active {
    background-color: #E5E5E5;
    box-shadow: 0 1px #fff;
    transform: translateY(4px);
    }
    /*--END--*/

    /* Footer*/
    .section-bg-syarat {
        min-height: 100vh;
        margin-top: -35%;
        background-image: url('{{my_asset('/images/img/bg-sdank.jpg')}}');
        width: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    /*--END--*/

    /*Cart/Belanja*/
    .btn-add-address{
        text-align: center;
        margin-bottom: 5%;
        font-family: Open Sans;
        font-style: normal;
        font-weight: bold;
        font-size: 16px;
        color: #B71C1C;
    }
    .nav-keranjang{
        font-family: "Open Sans";
        font-style: normal;
        font-weight: bold;
        font-size: 14px;
        color: #000000;
    }
    .text-info-keranjang{
        font-family: "Open Sans";
        font-style: normal;
        font-weight: normal;
        font-size: 16px;
        color: #000000;
    }
    /*--END--*/
    /*Checkout*/
    p.name-address{
        font-family: "Open Sans";
        font-style: normal;
        font-weight: bold;
        font-size: 14px;
        margin-bottom: 0%;
        color: #000000;
    }
    p.address-user{
        font-family: "Open Sans";
        font-style: normal;
        font-weight: normal;
        padding-left: 0%;
        font-size: 14px;
        margin-bottom: 0%;
        color: #000000;
    }
    p.text-checkout{
        font-family: "Open Sans";
        font-style: normal;
        font-weight: bold;
        font-size: 18px;
        margin-bottom: 2%;
        color: #3B6CB6;
    }
    p.date-ekspedisi{
        font-family: "Open Sans";
        font-style: normal;
        font-weight: normal;
        font-size: 12px;
        color: #000000;
    }
    p.text-ekspedisi{
        font-family: "Open Sans";
        font-style: normal;
        font-weight: bold;
        font-size: 16px;
        color: #000000;
    }
    p.text-rincian-bayar{
        font-family: "Open Sans";
        font-style: normal;
        font-weight: bold;
        font-size: 20px;
        color: #000000;
    }
    p.text-rincian-harga{
        font-family: "Open Sans";
        font-style: normal;
        font-weight: normal;
        font-size: 18px;
    }
    p.price__produk {
        font-family: "Open Sans";
        font-style: normal;
        font-weight: bold;
        font-size: 20px;
        color: #B71C1C;
    }
    .cb-pengiriman {
        display: block;
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;

    }
    
    /* Hide the browser's default radio button */
    .cb-pengiriman input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }
    
    /* Create a custom radio button */
    .cb-checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #fff;
        border-color: #006064;
        border-radius: 15%;
        border-style: solid;
    }

    
    /* On mouse-over, add a grey background color */
    .cb-pengiriman:hover input ~ .cb-checkmark {
        background-color: #fff;
    }
    
    /* When the radio button is checked, add a blue background */
    .cb-pengiriman input:checked ~ .cb-checkmark {
        background-color: #fff;
    }
    
    /* Create the indicator (the dot/circle - hidden when not checked) */
    .cb-checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }
    
    /* Show the indicator (dot/circle) when checked */
    .cb-pengiriman input:checked ~ .cb-checkmark:after {
        display: block;
    }
    
    /* Style the indicator (dot/circle) */
    .cb-pengiriman .cb-checkmark:after {
        left: 5px;
        top: 1px;
        width: 10px;
        height: 15px;
        border: solid #000;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    /*--END--*/

    /*Pilih Pembayaran*/
    .logo-bank {
        width: 100%;
        height: 90%;
        border: 1px solid #ECE8E5;
        border-radius: 5px;
    }
    .btn-pembayaran {
        background-color: #fff;
        color:#3B6CB6;
        border-style: solid;
        border-radius: 2px;
        border-color: #c4c4c4;
        cursor: pointer;
        font-size: 14px;
    }
    .actived, .btn-pembayaran:hover {
        background-color: #3B6CB6;
        border: none;
        color: white;
    }
    /*--END--*/

    /*Hasil Pencarian*/
    .btn-card-obat{
        background-color: #3B6CB6;
        color: #FFFFFF;
    }
    p.text-hasilpencarian{
        font-family: "Open Sans";
        font-style: normal;
        font-weight: normal;
        font-size: 24px;
        text-align: center;
        color: #000000;
    }
    p.text-hasil{
        font-family: "Open Sans";
        font-style: normal;
        font-weight: normal;
        font-size: 24px;
        text-align: center;
        color: #B71C1C;
        margin-left: 5px;
    }
    .ridge {
        border-style: ridge;
        border: 1px solid #DADBDC;
        width:50%;
        border-radius: 5px;
    }
    p.text-urutkan{
        font-family: "Open Sans";
        font-style: normal;
        font-weight: normal;
        font-size: 18px;
        text-align: center;
        color: #000000;
    }
    /*--END--*/

    /*riferal*/
    p.referal-head{
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 600;
        font-size: 20px;
        color: #154FAE;
    }
    /*--END--*/

    /*dropshipper*/
    p.head-dropshipper{
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: bold;
        font-size: 18px;
        color: #000000;
    }
    p.tittle-dropshipper{
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: bold;
        font-size: 16px;
        color: #3B6CB6;
    }
    @media (max-width: 767px){
.sm-no-gutters > .col, .sm-no-gutters > [class*="col-"] {
    padding-right: 5px;
    padding-left: 5px;
}
    }
    @media screen and (min-width: 976px) {

    .nav-item{
        margin-bottom: auto!important;
    }
    }
    
    @media screen and (max-width: 976px) {
        .nav-item{
        margin-bottom: 10px;
    }
    .navbar-nav {
    display: flex;
    margin-top: 20px;
    align-items: center;
    flex-direction: column;
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
}
    }
    .gambar{
        max-height: 200px; 
        max-width: 140px; 
        min-height: 200px; 
        min-width: 140px;
    }
    @media screen and (max-width: 431px) {
            .gambar{
                max-height: 160px;
    max-width: 120px;
    min-height: 160px;
    min-width: 120px;
            }
            .w-25 {
    width: 55%!important;
}
    }
    .row-card {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-left: -15px;
}
    .img-dropshipper{
        width: 80%;
        height: 70%;
        border: 1px solid #ECE8E5;
        border-radius: 5px;
    }
    .row-slider{
    display: flex;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
    }
    .col-slider {
    flex-basis: 0;
    flex-grow: 1;
    max-width: 100%;
}
.product-cart{
    max-width:20%;
    margin-left:10%;
    margin-right:5%;
    margin-bottom:5%;
}
.row_poin{
    position: relative;
    width: 66%;
    padding-right: 15px;
    padding-left: 15px;
}
@media screen and (max-width: 730px) {
    .summary{
    padding-top: 10%;

    }
}

    @media screen and (max-width: 730px) {
  .row-slider{
    display: flex;
    flex-wrap: nowrap;
    margin-right: -15px;
    margin-left: -15px;
    }
    .col-slider {
    flex-basis: 0;
    flex-grow: 1;
    max-width: 80%;
}

.contain{
    max-width: 90%;    
    margin-left: 30px;
    margin-top: 20px;
}
    }
     @media screen and (min-width: 380px) and (max-width: 540px)
     {
        .contain{
    max-width: 92%;    
    margin-left: 30px;
    margin-top: 20px;
}

     }
     @media screen and (min-width: 375px) and (max-width: 414px)
     {
        .contain{
    max-width: 85%;    
    margin-left: 40px;
    margin-top: 20px;
}
     }
     @media screen and (min-width: 320px) and (max-width: 320px)
     {
        .contain{
    max-width: 100%;    
    margin-left: 7px;
    margin-top: 20px;
}
.gambar {
    max-height: 140px;
    max-width: 100px;
    min-height: 140px;
    min-width: 100px;
}
     }
     @media (max-width: 300px)
     {
        .contain{
            max-width: 60%;
    margin-left: 30%;
    margin-top: 20px;
}
.gambar {
    max-height: 100px;
    max-width: 80px;
    min-height: 100px;
    min-width: 80px;
}
     }
    @media screen and (max-width: 494px) {
        .col-3 {
    flex: 0 0 25%;
    max-width: 100%;
}
.ml-3, .mx-3 {
    margin-left: 0px;
}
    }
    .code-dropshipper{
        font-family: "Open Sans";
        font-style: normal;
        font-weight: bold;
        font-size: 16px;
        color: #474747;
    }
    p.receiver-dropshipper{
        font-family: "Open Sans";
        font-style: normal;
        font-weight: bold;
        font-size: 16px;
        color: #474747;
    }
    p.text-dropshipper{
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: bold;
        font-size: 12px;
        color: #000000;
    }
    p.content-dropshipper{
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: bold;
        font-size: 14px;
        color: #000000;
    }
    p.info-dropshipper{
        font-family: "Open Sans";
        font-style: normal;
        font-weight: bold;
        font-size: 12px;
        color: #979797;
    }
    .form-date{
        width: 100%;
        padding: 5px ;
        border: 1px solid #ECE8E5;
        border-radius: 4px;
    }
    .head-detail-pesanan{
        font-family: "Open Sans";
        font-style: normal;
        font-weight: bold;
        font-size: 14px;
        color: #474747;
    }
    .price-blue{
        font-family: "Open Sans";
        font-style: normal;
        font-weight: bold;
        font-size: 16px;
        color: #3B82CF;
    }
    .price-red{
        font-family: "Open Sans";
        font-style: normal;
        font-weight: bold;
        font-size: 16px;
        color: #B71C1C;
    }
    .address-detail-pesanan{
        font-family: "Open Sans";
        font-style: normal;
        font-weight: normal;
        font-size: 14px;
        color: #000;
    }
    .no-rek-modal{
        font-family: "Open Sans";
        font-style: normal;
        font-weight: bold;
        font-size: 14px;
        color: #B71C1C;
    }
    .btn-beli-lagi{
        background-color: #3BB6B1;
        color: #FFFFFF;
    }
    .stars{
        color: linear-gradient yellow;
    }
    /*--END--*/

    /*Complaint*/
    .produk-complaint{
        width: 100px;
        height: 100px;
        border: 1px solid #ECE8E5;
        border-radius: 5px;
    }
    .produk-detail-complaint{
        width: 70px;
        height: 70px;
        border: 1px solid #ECE8E5;
        border-radius: 5px;
    }
    .add-image-produk{
    font-size:30px;
    text-align:center;
    margin-top:20px;
    }
        
    /*--END--*/

    /*Media Query*/
    @media screen and (min-width: 400px) {
    .card-media {
        background-color: yellow;
    }
    }

    @media screen and (min-width: 800px) {
    .card-media {
        background-color: red;
    }
    }
    /*--END--*/


    /* banner */

    .img-banner{
	height:400px;
	border-radius:25px 25px 25px 25px;
}
.slider-banner-left{
    left: -85px;
    color:#424242;
}

.slider-banner-right{
    right: -85px;
    color:#424242;
	
}
.radius-slider{
	border-radius: 50%;
    height: 20px;
    width: 20px;
}
.slider-button-left{
    left: -85px;
 	width: 60px;
	height:60px;
    border: 3px solid #424242;
    border-radius: 50%;
	
}.slider-button-right{
    right: -85px;
	width: 60px;
	height:60px;
    border: 3px solid #424242;
    border-radius: 50%;
}
.carousel-indicators li.active{
	width:88px !important;
	height:17px !important;
	border: 1px !important;
	margin-top:10px !important;
	border-radius: 10px 10px 10px 10px !important;
	background-color:#3BB6B1;
}
.carousel-indicators li{
	width:15px !important;
	height:15px !important;
	border: 1px !important;
	margin-top:10px !important;
	border-radius: 50% !important;
    background-color:white;
    opacity: 100% !important;
}

/* body{padding-top:20px;} */
.carousel {
    margin-bottom: 0;
    padding: 0 40px 30px 40px;
}
/* The controlsy */
.carousel-control {
	left: -12px;
    height: 40px;
	width: 40px;
    background: none repeat scroll 0 0 #222222;
    border: 4px solid #FFFFFF;
    border-radius: 23px 23px 23px 23px;
    margin-top: 90px;
}
.carousel-control.right {
	right: -12px;
}
/* The indicators */
.carousel-indicators {
	right: 50%;
	top: auto;
	bottom: -10px;
	margin-right: -19px;
}
.carousel-indicators .active {
background: #428bca;
}

/* ------------------------------- */


    /* end banner */

</style>

</head>
<body>


<!-- MAIN WRAPPER -->
<div class="body-wrap shop-default shop-cards shop-tech">

    <!-- Header -->
    @include('frontend.inc.nav')

    @yield('content')
    @include('frontend.inc.footer')

    <!-- @include('frontend.partials.modal') -->

    @if (\App\BusinessSetting::where('type', 'facebook_chat')->first()->value == 1)
        <div id="fb-root"></div>
        <!-- Your customer chat code -->
        <div class="fb-customerchat"
          attribution=setup_tool
          page_id="{{ env('FACEBOOK_PAGE_ID') }}">
        </div>
    @endif

    <div class="modal fade" id="addToCart">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-zoom product-modal" id="modal-size" role="document">
            <div class="modal-content position-relative">
                <div class="c-preloader">
                    <i class="fa fa-spin fa-spinner"></i>
                </div>
                <button type="button" class="close absolute-close-btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div id="addToCart-modal-body">

                </div>
            </div>
        </div>
    </div>

</div><!-- END: body-wrap -->

<!-- SCRIPTS -->
<!-- <a href="#" class="back-to-top btn-back-to-top"></a> -->

<!-- Core -->
<script src="{{ my_asset('frontend/js/vendor/popper.min.js') }}"></script>
<script src="{{ my_asset('frontend/js/vendor/bootstrap.min.js') }}"></script>

<!-- Plugins: Sorted A-Z -->
<script src="{{ my_asset('frontend/js/jquery.countdown.min.js') }}"></script>
<script src="{{ my_asset('frontend/js/select2.min.js') }}"></script>
<script src="{{ my_asset('frontend/js/nouislider.min.js') }}"></script>
<script src="{{ my_asset('frontend/js/sweetalert2.min.js') }}"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

{{--<script src="{{ my_asset('frontend/js/slick.min.js') }}"></script>--}}

<script src="{{ my_asset('frontend/js/jssocials.min.js') }}"></script>
<script src="{{ my_asset('frontend/js/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ my_asset('frontend/js/jodit.min.js') }}"></script>
<script src="{{ my_asset('frontend/js/xzoom.min.js') }}"></script>
<script src="{{ my_asset('frontend/js/fb-script.js') }}"></script>
<script src="{{ my_asset('frontend/js/lazysizes.min.js') }}"></script>
<script src="{{ my_asset('frontend/js/intlTelInput.min.js') }}"></script>
<script src="{{ my_asset('frontend/js/jquery.blockUI.min.js') }}"></script>

<!-- App JS -->
<script src="{{ my_asset('frontend/js/active-shop.js') }}"></script>
<script src="{{ my_asset('frontend/js/main.js') }}"></script>


<script>
    function blockui(refrence){
        $(refrence).block({message: '<i class="icon-spinner4 spinner"></i> Mohon tunggu...',
            // timeout: 2000, //unblock after 2 seconds
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'transparent'
            }
         }); 
    }

    function unblockui(refrence){
        $(refrence).unblock();
    }
    
    function showFrontendAlert(type, message){
        if(type == 'danger'){
            type = 'error';
        }
        swal({
            position: 'top-end',
            type: type,
            title: message,
            showConfirmButton: false,
            timer: 3000
        });
    }
</script>

@foreach (session('flash_notification', collect())->toArray() as $message)
    <script>
        showFrontendAlert('{{ $message['level'] }}', '{{ $message['message'] }}');
    </script>
@endforeach
<script>

    $(document).ready(function() {
        $('.category-nav-element').each(function(i, el) {
            $(el).on('mouseover', function(){
                if(!$(el).find('.sub-cat-menu').hasClass('loaded')){
                    $.post('{{ route('category.elements') }}', {_token: '{{ csrf_token()}}', id:$(el).data('id')}, function(data){
                        $(el).find('.sub-cat-menu').addClass('loaded').html(data);
                    });
                }
            });
        });
        if ($('#lang-change').length > 0) {
            $('#lang-change .dropdown-item a').each(function() {
                $(this).on('click', function(e){
                    e.preventDefault();
                    var $this = $(this);
                    var locale = $this.data('flag');
                    $.post('{{ route('language.change') }}',{_token:'{{ csrf_token() }}', locale:locale}, function(data){
                        location.reload();
                    });

                });
            });
        }

        if ($('#currency-change').length > 0) {
            $('#currency-change .dropdown-item a').each(function() {
                $(this).on('click', function(e){
                    e.preventDefault();
                    var $this = $(this);
                    var currency_code = $this.data('currency');
                    $.post('{{ route('currency.change') }}',{_token:'{{ csrf_token() }}', currency_code:currency_code}, function(data){
                        location.reload();
                    });

                });
            });
        }
    });

    $("#inputSearchNav").on('keyup', function (e) {
        if (e.keyCode == 13) {
            let link = $("#btnSearchNav").attr("data-href").replace("slug",$(this).val())
            window.location.href = link
        }
    })

    $("#btnSearchNav").click(function (e) {
        e.preventDefault()
        if ($("#inputSearchNav").val() == "") {
            showFrontendAlert("warning","kata kunci kosong")
            return;
        }
        let link = $(this).attr("data-href").replace("slug",$("#inputSearchNav").val())
        window.location.href = link
    })


    $("#account-mobile-menu").slick({
        dots: false,
        infinite: false,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        variableWidth: true
    });

    $('#search').on('keyup', function(){
        search();
    });

    $('#search').on('focus', function(){
        search();
    });

    function search(){
        var search = $('#search').val();
        if(search.length > 0){
            $('body').addClass("typed-search-box-shown");

            $('.typed-search-box').removeClass('d-none');
            $('.search-preloader').removeClass('d-none');
            $.post('{{ route('search.ajax') }}', { _token: '{{ @csrf_token() }}', search:search}, function(data){
                if(data == '0'){
                    // $('.typed-search-box').addClass('d-none');
                    $('#search-content').html(null);
                    $('.typed-search-box .search-nothing').removeClass('d-none').html('Sorry, nothing found for <strong>"'+search+'"</strong>');
                    $('.search-preloader').addClass('d-none');

                }
                else{
                    $('.typed-search-box .search-nothing').addClass('d-none').html(null);
                    $('#search-content').html(data);
                    $('.search-preloader').addClass('d-none');
                }
            });
        }
        else {
            $('.typed-search-box').addClass('d-none');
            $('body').removeClass("typed-search-box-shown");
        }
    }

    function updateNavCart(){
        $.post('{{ route('cart.nav_cart') }}', {_token:'{{ csrf_token() }}'}, function(data){
            $('#cart_items').html(data);
        });
    }

    function removeFromCart(key){
        $.post('{{ route('cart.removeFromCart') }}', {_token:'{{ csrf_token() }}', key:key}, function(data){
            updateNavCart();
            $('#cart-summary').html(data);
            showFrontendAlert('success', 'Item has been removed from cart');
            $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())-1);
            location.reload();
        });
    }

    function addToCompare(id){
        $.post('{{ route('compare.addToCompare') }}', {_token:'{{ csrf_token() }}', id:id}, function(data){
            $('#compare').html(data);
            showFrontendAlert('success', 'Item has been added to compare list');
            $('#compare_items_sidenav').html(parseInt($('#compare_items_sidenav').html())+1);
        });
    }

    function addToWishList(id){
        @if (Auth::check())
            @if (Auth::user()->user_type != 'admin' && Auth::user()->user_type != 'seller')
                $.post('{{ route('wishlists.store') }}', {_token:'{{ csrf_token() }}', id:id}, function(data){
                    if(data != 0){
                        // $('#wishlist').html(data);
                        // let wl = parseInt(document.getElementById("wishlist_items_sidenav").textContent)
                        document.getElementById("wishlist_items_sidenav").textContent = data
                        showFrontendAlert('success', `Item has been added to wishlist`);
                    }
                    else{
                        showFrontendAlert('warning', 'stok produk habis');
                    }
                });
            @else
                showFrontendAlert('warning', 'admin/seller tidak dapat menambah wishlist');
            @endif
        @else
            showFrontendAlert('warning', 'mohon login terlebih dahulu');
        @endif
    }

    function updateQuantity(cartId, element){
        
            $.post('{{ route('cart.updateQuantity') }}', { _token:'{{ csrf_token() }}', cartId:cartId, quantity: element.value}, function(data){
                updateNavCart();
                $('#cart-summary').html(data);
            });
    }

    function showAddToCartModal(id){
        if(!$('#modal-size').hasClass('modal-lg')){
            $('#modal-size').addClass('modal-lg');
        }
        $('#addToCart-modal-body').html(null);
        $('#addToCart').modal();
        $('.c-preloader').show();
        $.post('{{ route('cart.showCartModal') }}', {_token:'{{ csrf_token() }}', id:id}, function(data){
            $('.c-preloader').hide();
            $('#addToCart-modal-body').html(data);
            $('.xzoom, .xzoom-gallery').xzoom({
                Xoffset: 20,
                bg: true,
                tint: '#000',
                defaultScale: -1
            });
            getVariantPrice();
        });
    }

    $('#option-choice-form #input-q').on('change', function(){
        getVariantPrice();
    });

    function getVariantPrice(){
        if($('#option-choice-form #input-q').val() > 0 && checkAddToCartValidity()){
            $.ajax({
               type:"POST",
               url: '{{ route('products.variant_price') }}',
               data: $('#option-choice-form').serializeArray(),
               success: function(data){
                   $('#option-choice-form #chosen_price_div').removeClass('d-none');
                   $('#chosen_pricek').html(data.price);
                   $('#available-quantity').html(data.quantity);
                   $('.input-number').prop('max', data.quantity);
                   $('.qty__number').prop('max', data.quantity)
                   //console.log(data.quantity);
                   if(parseInt(data.quantity) < 1 && data.digital  != 1){
                       $('.buy-now').hide();
                       $('.add-to-cart').hide();
                   }
                   else{
                       $('.buy-now').show();
                       $('.add-to-cart').show();
                   }
               }
           });
        }
    }

    function checkAddToCartValidity(){
        var names = {};
        $('#option-choice-form input:radio').each(function() { // find unique names
              names[$(this).attr('name')] = true;
        });
        var count = 0;
        $.each(names, function() { // then count them
              count++;
        });

        if($('#option-choice-form input:radio:checked').length == count){
            return true;
        }

        return false;
    }

    function addToCart(id = 0){
        if(checkAddToCartValidity()) {
            $('#addToCart').modal();
            $('.c-preloader').show();
            let product = id != 0 ? {_token:"{{csrf_token()}}",id:id,quantity:1} : $('#option-choice-form').serializeArray()
            // console.log(product) return;
            $.ajax({
               type:"POST",
               url: '{{ route('cart.addToCart') }}',
               data: product,
               success: function(data){
                   $('#addToCart-modal-body').html(null);
                   $('.c-preloader').hide();
                   $('#modal-size').removeClass('modal-lg');
                   $('#addToCart-modal-body').html(data);
                   updateNavCart();
                   $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())+1);
               }
           });
        }
        else{
            showFrontendAlert('warning', 'Please choose all the options');
        }
    }
    function rekom() {
            $.get("{{route('list.voucher')}}", function (data) {
            })
        }
        function showDetailVoucher(e,id) {
        e.preventDefault();
        if (!$('#modal-size').hasClass('modal-lg')) {
            $('#modal-size').addClass('modal-lg');
        }
        $('#exampleModal-body').html(null);
        $('#exampleModal').modal();
        $('.c-preloader').show();
        
        let data = {
            _token:'{{csrf_token()}}',
            id: id
        }
       
        $.post('{{ route("voucher.showVoucherModal") }}', data,
            function(d) {
                $('.c-preloader').hide();
                $('#exampleModal-body').html(d);
                $('.xzoom, .xzoom-gallery').xzoom({
                    Xoffset: 20,
                    bg: true,
                    tint: '#000',
                    defaultScale: -1
                });
            });
        }
        function show_confirm(e,id){
            $('#modalconfirm-body').html(null);
            $('#modalconfirm').modal();
            $('.c-preloader').show();
            let data = {
            _token:'{{csrf_token()}}',
            id: id
        }
            $.post('{{ route("voucher.klaim") }}', data,
            function(d) {
                $('.c-preloader').hide();
                $('#modalconfirm-body').html(d);
                $('.xzoom, .xzoom-gallery').xzoom({
                    Xoffset: 20,
                    bg: true,
                    tint: '#000',
                    defaultScale: -1
                });
            });
            
        }
    function addvoucher(e,key){
        e.preventDefault()
        $.post('{{ route('tukar.voucher') }}', {_token:'{{ csrf_token() }}',id:key}, function(data){
            if (data.stts === false) {
            showFrontendAlert('success', 'Voucher berhasil ditukar');
            location.reload();
            }else{
                showFrontendAlert('warning', 'Poin tidak mencukupi');
                location.reload();
            }
        });
                
    }

    function buyNow(){
        if(checkAddToCartValidity()) {
            $('#addToCart').modal();
            $('.c-preloader').show();
            $.ajax({
               type:"POST",
               url: '{{ route('cart.addToCart') }}',
               data: $('#option-choice-form').serializeArray(),
               success: function(data){
                   //$('#addToCart-modal-body').html(null);
                   //$('.c-preloader').hide();
                   //$('#modal-size').removeClass('modal-lg');
                   //$('#addToCart-modal-body').html(data);
                   updateNavCart();
                   $('#cart_items_sidenav').html(parseInt($('#cart_items_sidenav').html())+1);
                   window.location.replace("{{ route('cart') }}");
               }
           });
        }
        else{
            showFrontendAlert('warning', 'Please choose all the options');
        }
    }

    function show_purchase_history_details(order_id)
    {
        $('#order-details-modal-body').html(null);

        if(!$('#modal-size').hasClass('modal-lg')){
            $('#modal-size').addClass('modal-lg');
        }

        $.post('{{ route('purchase_history.details') }}', { _token : '{{ @csrf_token() }}', order_id : order_id}, function(data){
            $('#order-details-modal-body').html(data);
            $('#order_details').modal();
            $('.c-preloader').hide();
        });
    }

    function show_order_details(order_id)
    {
        $('#order-details-modal-body').html(null);

        if(!$('#modal-size').hasClass('modal-lg')){
            $('#modal-size').addClass('modal-lg');
        }

        $.post('{{ route('orders.details') }}', { _token : '{{ @csrf_token() }}', order_id : order_id}, function(data){
            $('#order-details-modal-body').html(data);
            $('#order_details').modal();
            $('.c-preloader').hide();
        });
    }

    function cartQuantityInitialize(){
        $('.btn-number').click(function(e) {
            e.preventDefault();

            fieldName = $(this).attr('data-field');
            type = $(this).attr('data-type');
            var input = $("input[name='" + fieldName + "']");
            var currentVal = parseInt(input.val());

            if (!isNaN(currentVal)) {
                if (type == 'minus') {

                    if (currentVal > input.attr('min')) {
                        input.val(currentVal - 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('min')) {
                        $(this).attr('disabled', true);
                    }

                } else if (type == 'plus') {

                    if (currentVal < input.attr('max')) {
                        input.val(currentVal + 1).change();
                    }
                    if (parseInt(input.val()) == input.attr('max')) {
                        $(this).attr('disabled', true);
                    }

                }
            } else {
                input.val(0);
            }
        });

        $('.input-number').focusin(function() {
            $(this).data('oldValue', $(this).val());
        });

        $('#cart-summary .input-number').change(function() {
            minValue = parseInt($(this).attr('min'));
            maxValue = parseInt($(this).attr('max'));
            valueCurrent = parseInt($(this).val());
            oldValue = parseInt($(this).data('oldValue'))
            name = $(this).attr('name');
            key = $(this).data("key")

            
            if (valueCurrent >= minValue) {
                $("#btnAdd[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('Sorry, the minimum value was reached');
                $(this).val(oldValue);
            }
            if (valueCurrent <= maxValue) {
                $("#btnAdd[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
            } else {
                alert('maaf,produk tersedia '+maxValue);
                $(this).val(oldValue);
            }


        });
        $(".input-number").keydown(function(e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    }

     function imageInputInitialize(){
         $('.custom-input-file').each(function() {
             var $input = $(this),
                 $label = $input.next('label'),
                 labelVal = $label.html();

             $input.on('change', function(e) {
                 var fileName = '';

                 if (this.files && this.files.length > 1)
                     fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
                 else if (e.target.value)
                     fileName = e.target.value.split('\\').pop();

                 if (fileName)
                     $label.find('span').html(fileName);
                 else
                     $label.html(labelVal);
             });

             // Firefox bug fix
             $input
                 .on('focus', function() {
                     $input.addClass('has-focus');
                 })
                 .on('blur', function() {
                     $input.removeClass('has-focus');
                 });
         });
     }

</script>

@yield('script')

</body>
</html>
