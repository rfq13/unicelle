@extends('frontend.layouts.app')

@section('content')

    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-4 d-none d-lg-block">
                    <div class="card mr-2">
                        @if(Auth::user()->user_type == 'seller')
                            @include('frontend.inc.seller_side_nav')
                        @elseif(Auth::user()->user_type == 'customer' || Auth::user()->user_type == 'pasien reg'  || Auth::user()->user_type == 'regular physician' || Auth::user()->user_type == 'partner physician')
                            @include('frontend.inc.customer_side_nav')
                        @endif

                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="main-content">
                        <div class="row card pt-3 shop-default-wrapper shop-cards-wrapper shop-tech-wrapper mt-0">
                                <div class="col-lg-6">
                                    <span class="head-card-akun__">Produk Disimpan</span>
                                </div>
                                <hr>
                                <div class="pad" style="padding:12px">
                            @foreach ($wishlists as $key => $wishlist)
                                @if ($wishlist->product != null)
                                    {{--<div class="col-xl-4 col-6" id="wishlist_{{ $wishlist->id }}">
                                        <div class="card card-product mb-3 product-card-2">
                                            <div class="card-body p-3">
                                                <div class="card-image">
                                                    <a href="{{ route('product', $wishlist->product->slug) }}" class="d-block" style="background-image:url('{{ my_asset($wishlist->product->thumbnail_img) }}');">
                                                    </a>
                                                </div>

                                                <h2 class="heading heading-6 strong-600 mt-2 text-truncate-2">
                                                    <a href="{{ route('product', $wishlist->product->slug) }}">{{ $wishlist->product->name }}</a>
                                                </h2>
                                                <div class="star-rating star-rating-sm mb-1">
                                                    {{ renderStarRating($wishlist->product->rating) }}
                                                </div>
                                                <div class="mt-2">
                                                    <div class="price-box">
                                                        @if(home_base_price($wishlist->product->id) != home_discounted_base_price($wishlist->product->id))
                                                            <del class="old-product-price strong-400">{{ home_base_price($wishlist->product->id) }}</del>
                                                        @endif
                                                        <span class="product-price strong-600">{{ home_discounted_base_price($wishlist->product->id) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer p-3">
                                                <div class="product-buttons">
                                                    <div class="row align-items-center">
                                                        <div class="col-2">
                                                            <a href="#" class="link link--style-3" data-toggle="tooltip" data-placement="top" title="Remove from wishlist" onclick="removeFromWishlist({{ $wishlist->id }})">
                                                                <i class="la la-close"></i>
                                                            </a>
                                                        </div>
                                                        <div class="col-10">
                                                            <button type="button" class="btn btn-block btn-base-1 btn-circle btn-icon-left" onclick="showAddToCartModal({{ $wishlist->product->id }})">
                                                                <i class="la la-shopping-cart mr-2"></i>{{ translate('Add to cart')}}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>--}}
                                    <div class="col-md-2 col-6 col-lg-4 mt-4">
                                        <div class="card text-center">
                                            <div class="img-wishlist__ mt-3">
                                                <a href="{{ route('product', $wishlist->product->slug) }}"><img class="img-wish__ img-fluid" src="{{ my_asset(json_decode($wishlist->product->photos)[0]) }}" alt="">
                                                </a>
                                            </div>
                                            <div class="name-produk-wish__ mt-3">
                                                <a href="{{ route('product', $wishlist->product->slug) }}"><span class="produk-wish__" style="text-transform:uppercase;">{{ $wishlist->product->name }}</span></a>
                                            </div>
                                            <div class="price-wishlist__ mt-2">
                                                @if(home_base_price($wishlist->product->id) != home_discounted_base_price($wishlist->product->id))
                                                    <del class="old-product-price strong-400">{{ home_base_price($wishlist->product->id) }}</del>
                                                @endif
                                                <span class="price-wish-__">{{ home_discounted_base_price($wishlist->product->id) }}</span>
                                            </div>
                                            <div class="star-rating star-rating-sm mb-1">
                                                {{ renderStarRating($wishlist->product->rating) }}
                                            </div>
                                            <div class="align-items-end mt-3">
                                                <a href="#" style="display:none" class="link link--style-3" data-toggle="tooltip" data-placement="top" title="Remove from wishlist" onclick="removeFromWishlist({{ $wishlist->id }})">
                                                    <i class="la la-close"></i>
                                                </a>
                                                <a href="#" onclick="showAddToCartModal({{ $wishlist->product->id }})" class="btn btn-primary1" style="width: 100%; border-radius: 0px 0px 0.25rem 0.25rem;">Tambah</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                                </div>
                        </div>

                        <div class="pagination-wrapper py-4">
                            <ul class="pagination justify-content-end">
                                {{ $wishlists->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="addToCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

@endsection

@section('script')
    <script type="text/javascript">
        function removeFromWishlist(id){
            $.post('{{ route('wishlists.remove') }}',{_token:'{{ csrf_token() }}', id:id}, function(data){
                $('#wishlist').html(data);
                $('#wishlist_'+id).hide();
                showFrontendAlert('success', 'Item has been renoved from wishlist');
            })
        }
    </script>
@endsection
