<div class="container">
    <div class="row cols-xs-space cols-sm-space cols-md-space">
        <div class="card col-xl-8 mb-3">
            <!-- <form class="form-default bg-white p-4" data-toggle="validator" role="form"> -->
            <div class="form-default bg-white p-4">
                <div class="">
                    <div class="">
                        <table class="table-cart border-bottom">
                            <thead>
                                <tr>
                                    <th class="product-image text-center"></th>
                                    <th class="product-name text-center" style="font-size: 14px;text-transform:capitalize">{{ translate('Nama')}}</th>
                                    <th class="product-price d-none d-lg-table-cell text-center" style="font-size: 14px;text-transform:lowercase">{{ translate('@pcs')}}</th>
                                    <th class="product-quanity d-none d-md-table-cell text-center" style="font-size: 14px;text-transform:capitalize">{{ translate('Jumlah')}}</th>
                                    <th class="product-total text-center" style="font-size: 14px;text-transform:capitalize">{{ translate('Total Harga')}}</th>
                                    <th class="product-remove text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $total = 0;
                                @endphp
                                @foreach (Auth::user()->carts as $key => $cartItem)
                                    @php
                                    $product = \App\Product::find($cartItem['product_id']);
                                    $total += $cartItem['price']*$cartItem['quantity'];
                                    $product_name_with_choice = $product->name;
                                    $keyi = $cartItem->id;
                                    if ($cartItem['variant'] != null) {
                                        $product_name_with_choice = $product->name.' - '.$cartItem['variant'];
                                    }
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
                                    <tr class="cart-item">
                                        <td class="product-image">
                                            <a href="#" class="mr-3">
                                                <img loading="lazy"  src="{{ my_asset($product->thumbnail_img) }}">
                                            </a>
                                        </td>

                                        <td class="product-name">
                                            <span class="pr-4 d-block">{{ $product_name_with_choice }}</span>
                                        </td>

                                        <td class="product-price d-none d-lg-table-cell">
                                            <span class="pr-3 d-block">{{ single_price($cartItem['price']) }}</span>
                                        </td>

                                        <td class="product-quantity d-none d-md-table-cell">
                                            @if($cartItem['digital'] != 1)
                                                {{--
                                                    <div class="input-group input-group--style-2 pr-4" style="width: 130px;">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-number" type="button" max="{{$qty}}" data-type="minus" data-field="quantity[{{ $keyi }}]">
                                                                <i class="la la-minus"></i>
                                                            </button>
                                                        </span>
                                                        <input type="text" id="quantity{{ $keyi }}" name="quantity[{{ $keyi }}]" class="qty__number text-center mx-1" placeholder="1" value="{{ $cartItem['quantity'] }}" min="1" max="{{$qty}}" data-key="{{ $keyi }}" onchange="updateQuantity({{$keyi}},this)">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-number" type="button" data-type="plus" data-field="quantity[{{ $keyi }}]">
                                                                <i class="la la-plus"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                --}}
                                                <div class="p-2 mx-3 col-3 text-center">
                                                    <div class="qty__cart">
                                                        <div id="field1" class="d-flex align-items-center ">
                                                            <button class="btn btn-number sub justify-content-center align-items-center" type="button" data-type="minus" data-key="{{ $keyi }}" data-field="quantity[{{ $keyi }}]">
                                                                <i class="fa fa-minus"></i>
                                                                </button>
                                                            <input type="text" id="quantity{{ $keyi }}" name="quantity[{{ $keyi }}]" class="input-number qty__number text-center mx-1" placeholder="1" value="{{ $cartItem['quantity'] }}" min="1" max="{{$qty}}" onchange="updateQuantity({{$keyi}},this)">
                                                            <button class="btn btn-number sub justify-content-center align-items-center" type="button" data-type="plus" data-key="{{ $keyi }}" data-field="quantity[{{ $keyi }}]">
                                                            <i class="fa fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="product-total">
                                            <span>{{ single_price($cartItem['price']*$cartItem['quantity']) }}</span>
                                        </td>
                                        <td class="product-remove">
                                            <a href="#" onclick="removeFromCartView(event, {{ $keyi }})" class="text-right pl-4">
                                                <i class="la la-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="align-items-center pt-4">
                    <div class="row text-center" style="border-bottom:1px solid #C4C4C4; border-top: 1px solid#c4c4c4;">
                        @if(Auth::check())
                            {{--<a href="{{ route('checkout.shipping_info') }}" class="btn btn-styled btn-base-1">{{ translate('Continue to Shipping')}}</a>--}}
                                <a href="#" class="py-2" style="margin:auto; color: #006064;font-weight: bold;font-size:16px">
                                    + Tambah
                                </a>
                        @else
                            <button class="btn btn-styled btn-base-1" onclick="showCheckoutModal()">{{ translate('Continue to Shipping')}}</button>
                        @endif
                    </div>
                </div>

            </div>
            <div class="row mb-1">
                <div class="col-md-6">
                    <a href="{{ route('home') }}" style="color: #006064" class="link link--style-3">
                        <i class="la la-mail-reply"></i>
                        {{ translate('Beranda')}}
                    </a>
                </div>
            </div>
            <!-- </form> -->
        </div>

        <div class="col-xl-4 ml-lg-auto">
            @include('frontend.partials.cart_summary')
        </div>
    </div>
</div>

<script type="text/javascript">
    cartQuantityInitialize();

    $("#cart-summary .btn-number").click(function (e) {
        e.preventDefault()
        let type = $(this).data("type")
        let field = $(this).data("field")
        let key = $(this).data("key")
        field = $("#quantity"+key)
        newValue = parseInt(field.val())
        // let max = $(this).attr("max")
        
        if (type == "minus") {
            newValue = newValue-1
            field.val(newValue)
            field.change()
            // updateQuantity(key,field)
            return
        }
            newValue = newValue+1
            // if (newValue < max) {
                field.val(newValue)
                field.change()
            // }else{
            //     alert('produk tersedia '+max)
            // }
            // updateQuantity(key,field)
    })
    
</script>
