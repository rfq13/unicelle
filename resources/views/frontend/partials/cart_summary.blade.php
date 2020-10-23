<div class="card sticky-top">
    {{--
        <div class="card-title py-3">
            <div class="row align-items-center">
                <div class="col-6">
                    <h3 class="heading heading-3 strong-400 mb-0">
                        <span>{{translate('Summary')}}</span>
                    </h3>
                </div>

                <div class="col-6 text-right">
                    <span class="badge badge-md badge-success">{{ count(Session::get('cart')) }} {{translate('Items')}}</span>
                </div>
            </div>
        </div>
    --}}

    <div class="card-body">
        @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
            @php
                $total_point = Auth::check() ? Auth::user()->poin : 0;
                $club_point_convert_rate = \App\BusinessSetting::where('type', 'club_point_convert_rate')->first();
            @endphp
            @if (Session::has('poin_use'))
                @php
                    $total_point -= Session::get('poin_use');
                @endphp
            @endif
            <span style="text-transform:capitalize;font-size:16px">tukar poin</span>
           
            <div class="row">
                <div class="col-6">
                    <div class="point-cart__">
                        <span>Poin Anda : {{ $total_point }}</span>
                    </div>
                </div>
                <div class="col-6 text-right">
                    <span class="badge badge-md badge-success">{{ count(Session::get('cart')) }} {{translate('Items')}}</span>
                </div>
            </div>
            <form  action="{{ route('use_poin') }}" method="POST">
            @csrf
            <div class="row" style="margin-top: 8px;margin-bottom: 16px;">
               
               <div class="col-8">
                    <input type="number" min="1" name="jml" class="form-control" value="{{ Session::has('poin_use') ? Session::get('poin_use') : '' }}" id="inlineFormInputName2" placeholder="Masukkan Poin Anda">
                </div>
                <div class="col-4" style="text-align: end;">
                    <button type="submit" class="btn btn-primary1 px-4">Pakai</button>
                </div>
              
                        
                
            </div>
            </form>
        @endif
        <table class="table-cart table-cart-review">
            <thead>
                <tr>
                    <th class="product-name" style="font-size:18px;text-transform:capitalize">{{translate('Rincian Pembayaran')}}</th>
                    {{--<th class="product-total text-right">{{translate('Total')}}</th>--}}
                </tr>
            </thead>
            <tbody>
                @php
                    $subtotal = 0;
                    $tax = 0;
                    $shipping = 0;
                    if(isset($ongkir))
                    {
                        $shipping = $ongkir->cost;
                    }
                @endphp
                @foreach (Session::get('cart') as $key => $cartItem)
                    @php
                        $product = \App\Product::find($cartItem['id']);
                        $subtotal += $cartItem['price']*$cartItem['quantity'];
                        $tax += $cartItem['tax']*$cartItem['quantity'];
                        $shipping += $cartItem['shipping'];

                        $product_name_with_choice = $product->name;
                        if ($cartItem['variant'] != null) {
                            $product_name_with_choice = $product->name.' - '.$cartItem['variant'];
                        }
                    @endphp
                    <tr class="cart_item">
                        <td class="product-name">
                            {{ $product_name_with_choice }}
                            <strong class="product-quantity">× {{ $cartItem['quantity'] }}</strong>
                        </td>
                        <td class="product-total text-right">
                            <span class="pl-4">{{ single_price($cartItem['price']*$cartItem['quantity']) }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="table-cart table-cart-review">

            <tfoot>
                <tr class="cart-subtotal">
                    <th>{{translate('Subtotal')}}</th>
                    <td class="text-right">
                        <span class="strong-600">{{ single_price($subtotal) }}</span>
                    </td>
                </tr>

                {{-- <tr class="cart-shipping">
                    <th>{{translate('Tax')}}</th>
                    <td class="text-right">
                        <span class="text-italic">{{ single_price($tax) }}</span>
                    </td>
                </tr> --}}

                <tr class="cart-shipping">
                    <th>{{translate('Total Shipping')}}</th>
                    <td class="text-right">
                        <span class="text-italic">{{ single_price($shipping) }}</span>
                    </td>
                </tr>

                @if (Session::has('coupon_discount'))
                    <tr class="cart-shipping">
                        <th>{{translate('Coupon Discount')}}</th>
                        <td class="text-right">
                            <span class="text-italic">{{ single_price(Session::get('coupon_discount')) }}</span>
                        </td>
                    </tr>
                @endif

                 @if (Session::has('poin_use'))
                    <tr class="cart-shipping">
                        <th>{{translate('Diskon Poin')}}</th>
                        <td class="text-right">
                            <span class="text-italic">{{ single_price(Session::get('poin_use')*$club_point_convert_rate->value) }}</span>
                        </td>
                    </tr>
                @endif

                @php
                    $total = $subtotal+$tax+$shipping;
                    if(Session::has('coupon_discount')){
                        $total -= Session::get('coupon_discount');
                    }
                    if(Session::has('poin_use')){
                        $total -= Session::get('poin_use')*$club_point_convert_rate->value;
                    }
                @endphp

                <tr class="cart-total">
                    <th><span class="strong-600">{{translate('Total')}}</span></th>
                    <td class="text-right">
                        <strong><span>{{ single_price($total) }}</span></strong>
                    </td>
                </tr>
            </tfoot>
        </table>

        @if (Auth::check() && \App\BusinessSetting::where('type', 'coupon_system')->first()->value == 1)
            @if (Session::has('coupon_discount'))
                <div class="mt-3">
                    <form class="form-inline" action="{{ route('checkout.remove_coupon_code') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group flex-grow-1">
                            <div class="form-control bg-gray w-100">{{ \App\Coupon::find(Session::get('coupon_id'))->code }}</div>
                        </div>
                        <button type="submit" class="btn btn-base-1">{{translate('Change Coupon')}}</button>
                    </form>
                </div>
            @else
                <div class="mt-3">
                    <form class="form-inline" action="{{ route('checkout.apply_coupon_code') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group flex-grow-1">
                            <input type="text" class="form-control w-100" name="code" placeholder="{{translate('Have coupon code? Enter here')}}" required>
                        </div>
                        <button type="submit" class="btn btn-base-1">{{translate('Apply')}}</button>
                    </form>
                </div>
            @endif
        @endif
        <form action="{{ route('payment.checkout') }}" id="form-checkout" method="POST">
        @csrf
        <input type="hidden" name="shipping_info" id="shipping_info" @if(isset($ongkir)) value="{{ encrypt($ongkir) }}" @endif>
        <input type="hidden" name="payment_option" value="manual_transfer">
        <div class="row text-center" >
            @if(Auth::check())
                @if(isset($ongkir))
                <button type="submit" class="btn btn-default" style="margin:auto;color:white;width:100%" class="py-2">{{ translate('Checkout')}}</button>
                @else
                <a href="{{ route('checkout.shipping_info') }}" class="btn btn-default" style="margin:auto;color:white;width:100%" class="py-2">{{ translate('Checkout')}}</a>
                @endif
            @else
                <button type="button" style="margin:auto;color:#006064" class="py-2" onclick="showCheckoutModal()">{{ translate('Checkout')}}</button>
            @endif
        </div>
        </form>
    </div>
</div>
