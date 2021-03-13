{{-- @foreach ($products as $key => $product)
    @php
        $flash_deal = \App\FlashDeal::where('status', 1)->where('start_date' ,'<=',
        strtotime(date('d-m-Y')))->where('end_date' ,'>=', strtotime(date('d-m-Y')))->first();
        $flash_product = isset($flash_deal) ? \App\FlashDealProduct::where('product_id',
        $product->id)->where('flash_deal_id', $flash_deal->id)->first() : null;
        $product_variant=json_decode($product->choice_options);
        $qty = 0;
        if($product->variant_product){
            foreach ($product->stocks as $key => $stock) {
            $qty += $stock->qty;
            }
        }
        else{
            $qty = $product->current_stock;
        }
    @endphp
    
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-2 col-6">
            <div class="card bg-white alt-box my-md-3 ">
                <div class="position-relative overflow-hidden  py-1">
                    <a href="{{ route('product', $product->slug) }}"
                        class="d-block product-image h-100 text-center p-2" tabindex="0">
                        <img class="img-fluid lazyload gambar"
                            src="{{ my_asset('frontend/images/placeholder.jpg') }}"
                            data-src="{{ my_asset($product->thumbnail_img) }}"
                            alt="{{ __($product->name) }}">
                    </a>
                    <div class="product-btns clearfix">
                        <button class="btn add-wishlist" title="Add to Wishlist"
                            onclick="addToWishList({{ $product->id }})" type="button">
                            <i class="la la-heart-o"></i>
                        </button>
                        <button class="btn add-compare" title="Add to Compare"
                            onclick="addToCompare({{ $product->id }})" type="button">
                            <i class="la la-refresh"></i>
                        </button>
                        <button class="btn quick-view" title="Quick view"
                            onclick="showAddToCartModal({{ $product->id }})" type="button">
                            <i class="la la-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="p-md-3 p-2">
                    <div class="price-box">
                        @auth
                            @if (home_base_price($product->id) != home_discounted_base_price($product->id))
                                <del
                                    class="old-product-price strong-400">{{ home_base_price($product->id) }}</del>
                            @endif
                            <span
                                class="product-price strong-600">{{ home_discounted_price($product->id) }}
                            </span>
                            @if (home_price($product->id) != home_discounted_price($product->id))
                                @if ($flash_product)
                                    @if ($flash_product->discount_type == 'percent')
                                        <p class="mb-0 py-2 px-4"
                                            style="position: absolute; top: 0; left: 0; margin-top: 20px; background-color: #006064; color: white;">
                                            {{ __($flash_product->discount) }}%
                                        </p>
                                    @elseif($flash_product->discount_type == 'amount')
                                        <p class="mb-0 py-2 px-4"
                                            style="position: absolute; top: 0; left: 0; margin-top: 20px; background-color: #006064; color: white;">
                                            Potongan Rp {{ __($flash_product->discount) }}</p>
                                    @endif
                                @else
                                    @if ($product->discount_type == 'percent')
                                        <p class="mb-0 py-2 px-4"
                                            style="position: absolute; top: 0; left: 0; margin-top: 20px; background-color: #006064; color: white;">
                                            {{ __($product->discount) }}%
                                        </p>
                                    @elseif($product->discount_type == 'amount')
                                        <p class="mb-0 py-2 px-4"
                                            style="position: absolute; top: 0; left: 0; margin-top: 20px; background-color: #006064; color: white;">
                                            Potongan Rp {{ __($product->discount) }}</p>
                                    @endif
                                @endif
                            @else
                                <p class="d-none"></p>
                            @endif
                        @else
                            <cite style="color: #95adab;font-size:85%">Login untuk melihat harga</cite>
                        @endauth
                    </div>
                    <div class="star-rating star-rating-sm mt-1">
                        {{ renderStarRating($product->rating) }}
                    </div>
                    <h2 class="product-title font-weight-bold p-0">
                        <a href="{{ route('product', $product->slug) }}"
                            class=" text-truncate">{{ __($product->name) }}</a>
                    </h2>
                    <!-- @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                        <div class="club-point mt-2 bg-soft-base-1 border-light-base-1 border">
                            {{ translate('Point') }}:
                            <span class="strong-700 float-right">{{ $product->earn_point }}</span>
                        </div>
                    @endif -->
                </div>
                @if ($qty > 0)
                    @if ($product->variant_product > 0)
                        <a class="btn btn-default" onclick="showAddToCartModal({{ $product->id }})"
                            style="width: 100%">Tambah</a>
                    @else
                        <a class="btn btn-default" onclick="addToCart({{ $product->id }})"
                            style="width: 100%">Tambah</a>
                    @endif
                @else
                        <a class="btn btn-default" onclick="showFrontendAlert('warning','Maaf produk {{ $product->name }} sedang kosong')"
                            style="width: 100%">Tambah</a>
                @endif
            </div>
        </div>
@endforeach --}}

@foreach ($products as $key => $product)
    @php
        $flash_deal = \App\FlashDeal::where('status', 1)->where('start_date' ,'<=',
        strtotime(date('d-m-Y')))->where('end_date' ,'>=', strtotime(date('d-m-Y')))->first();
        $flash_product = isset($flash_deal) ? \App\FlashDealProduct::where('product_id',$product->id)->where('flash_deal_id', $flash_deal->id)->first() : null;
        $product_variant=json_decode($product->choice_options);
        $qty = 0;
        if($product->variant_product){
        foreach ($product->stocks as $key => $stock) {
        $qty += $stock->qty;
        }
        }
        else{
        $qty = $product->current_stock;
        }
    @endphp

    <div class="col-md-2 col-md-2 col-lg-2 col-md-2 col-6" style="margin-bottom: 20px;">            
    <div class="card bg-white my-md-3">
                <div class="position-relative overflow-hidden" style="display: flex;justify-content: center;">
                    <a href="{{ route('product', $product->slug) }}"
                        class="d-block product-image text-center p-2" tabindex="0">
                        <img class="img-fluid lazyload gambar"
                            src="{{ my_asset('frontend/images/placeholder.jpg') }}"
                            data-src="{{ my_asset($product->thumbnail_img) }}"
                            alt="{{ __($product->name) }}">
                    </a>
                    {{-- <div class="product-btns clearfix">
                        <button class="btn add-wishlist" title="Add to Wishlist"
                            onclick="addToWishList({{ $product->id }})" type="button">
                            <i class="la la-heart-o"></i>
                        </button>
                        <button class="btn add-compare" title="Add to Compare"
                            onclick="addToCompare({{ $product->id }})" type="button">
                            <i class="la la-refresh"></i>
                        </button>
                        <button class="btn quick-view" title="Quick view"
                            onclick="showAddToCartModal({{ $product->id }})" type="button">
                            <i class="la la-eye"></i>
                        </button>
                    </div> --}}
                </div>
                <div class="p-md-3 p-2">
                <h2 class="product-title font-weight-bold p-0">
                        <a href="{{ route('product', $product->slug) }}"
                            class="text-truncate">{{ __($product->name) }}</a>
                    </h2>
                    <div class="price-box" style="height: 50px">
                        @auth
                            @if (home_base_price($product->id) != home_discounted_base_price($product->id))
                                <del
                                    class="old-product-price strong-400">{{ home_base_price($product->id) }}</del>
                            @endif
                            <span style="color:#B71C1C" class="product-price strong-600">{{ home_discounted_price($product->id) }}
                            </span>
                            @if (home_price($product->id) != home_discounted_price($product->id))
                                @if ($flash_product)
                                    @if ($flash_product->discount > 0)
                                        @if ($flash_product->discount_type == 'percent')
                                            <p class="mb-0 py-2 px-4"
                                                style="position: absolute; top: 0; left: 0; margin-top: 20px; background-color: #006064; color: white;">
                                                {{ __($flash_product->discount) }}%
                                            </p>
                                        @elseif($flash_product->discount_type == 'amount')
                                            <p class="mb-0 py-2 px-4"
                                                style="position: absolute; top: 0; left: 0; margin-top: 20px; background-color: #006064; color: white;">
                                                Potongan Rp {{ __($flash_product->discount) }}</p>
                                        @endif
                                    @endif
                                @else
                                    @if ($product->discount > 0)
                                        @if ($product->discount_type == 'percent')
                                            <p class="mb-0 py-2 px-4"
                                                style="position: absolute; top: 0; left: 0; margin-top: 20px; background-color: #006064; color: white;">
                                                {{ __($product->discount) }}%
                                            </p>
                                        @elseif($product->discount_type == 'amount')
                                            <p class="mb-0 py-2 px-4"
                                                style="position: absolute; top: 0; left: 0; margin-top: 20px; background-color: #006064; color: white;">
                                                Potongan Rp {{ __($product->discount) }}</p>
                                        @endif
                                    @endif
                                @endif
                            @else
                                <p class="d-none"></p>
                            @endif
                        @else
                            <cite style="color: #95adab;font-size:85%">Login untuk melihat harga</cite>
                        @endauth
                    </div>
                    {{-- <div class="star-rating star-rating-sm mt-1">
                        {{ renderStarRating($product->rating) }}
                    </div> --}}
                    
                    <!-- @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                        <div class="club-point mt-2 bg-soft-base-1 border-light-base-1 border">
                            {{ translate('Point') }}:
                            <span class="strong-700 float-right">{{ $product->earn_point }}</span>
                        </div>
                    @endif -->
                </div>
                @auth
                    @if ($qty > 0)
                        @if ($product->variant_product > 0)
                            <a class="btn btn-default" onclick="showAddToCartModal({{ $product->id }})"
                                style="width: 100%">Tambah</a>
                        @else
                            <a class="btn btn-default" onclick="addToCart({{ $product->id }})"
                                style="width: 100%">Tambah</a>
                        @endif
                    @else
                        <a class="btn btn-default" onclick="showFrontendAlert('warning','Maaf produk {{ $product->name }} sedang kosong')"
                        style="width: 100%">Tambah</a>
                    @endif
                @else
                    <a class="btn btn-default" onclick="showFrontendAlert('warning','Maaf, silahkan login terlebih dahulu untuk menambahkan ke keranjang')" style="width: 100%">Tambah</a>
                @endauth
            </div>
        </div>
      
@endforeach
