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
                    <span class="badge badge-md badge-success">{{ count($carts) }} {{translate('Items')}}</span>
                </div>
            </div>
        </div>
    --}}

    <div class="card-body">
        @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
            @php
                $total_point = Auth::check() ? Auth::user()->poin : 0;
                $club_point_convert_rate = \App\BusinessSetting::where('type', 'club_point_convert_rate')->first();
                $carts = Auth::user()->carts;
                $poin_use = \App\UsePoin::where('user_id',Auth::user()->id)->first();

            @endphp
            @if (isset($poin_use))
                @php
                    $total_point -= $poin_use->poin;
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
                    <span class="badge badge-md badge-success">{{ count($carts) }} {{translate('Items')}}</span>
                </div>
            </div>
          @if(Auth::user()->user_type == 'pasien reg')
         
          @if(isset($poin_use))
          @php
          $detail_data = \App\VoucherUsage::where('user_id',Auth::user()->id)->where('voucher_id',$poin_use->poin)->first();
            @endphp
            @endif
          <form  action="{{ route('use_poin') }}" method="POST">
            @csrf
            <div class="row" style="margin-top: 8px;margin-bottom: 16px;">
               
               <div class="row_poin">
                    <input type="text" name="kode" class="form-control" @if(isset($poin_use)) value="{{$detail_data->code}}" @endif id="inlineFormInputName2" placeholder="Kode Voucher Anda">
                </div>
                <div class="col-4" style="text-align: end;">
                    <button type="submit" class="btn btn-primary1 px-4">Pakai</button>
                </div>  
            </div>
            </form>            @else
            <form  action="{{ route('use_poin') }}" method="POST">
            @csrf
            <div class="row" style="margin-top: 8px;margin-bottom: 16px;">
               
               <div class="row_poin">
                    <input type="number" min="1" name="jml" class="form-control" @if(isset($poin_use)) value="{{$poin_use->poin}}" @endif id="inlineFormInputName2" placeholder="Masukkan Poin Anda">
                </div>
                <div class="col-4" style="text-align: end;">
                    <button type="submit" class="btn btn-primary1 px-4">Pakai</button>
                </div>
              
                        
                
            </div>
            </form>
            @endif
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
                @foreach ($carts as $key => $cartItem)
                    @php
                    $product = \App\Product::where('id',$cartItem['product_id'])->first();
                        $subtotal += $cartItem['price']*$cartItem['quantity'];
                        $tax += $cartItem['tax']*$cartItem['quantity'];
                        $shipping += $cartItem['shipping'];

                        $product_name_with_choice = $product->name;
                        if ($cartItem['variant'] != null) {
                            $product_name_with_choice = $product->name.' - '.$cartItem['variant'];
                        }
                        $total_sementara = $subtotal+$tax;
                        $check_custom = \App\MemberCustom::where('user_id',Auth::user()->id)->first();
                        if($check_custom != null && $check_custom->count() > 0){
                            if($total_sementara >= $check_custom->min_order_poin){
                            if($check_custom->type_discount == 'percent'){
                                $diskon_rate=$check_custom->discount/100*$total_sementara;
                                    if($total_sementara >= $check_custom->min_order_discount){
                                        $rate=$total_sementara-$diskon_rate;
                                    }
                                    else{
                                        $rate=$total_sementara;
                                    }
                                $total_poin=$check_custom->poin/100*$rate;
                            }
                            else{
                                    if($total_sementara >= $check_custom->min_order_discount){
                                        $rate=$total_sementara-$check_custom->discount;
                                    }
                                    else{
                                        $rate=$total_sementara;
                                    }
                                    $total_poin=$check_custom->poin/100*$rate;
                            }
                            }
                        }
                        else{
                        if(Auth::user()->user_type == 'regular physician'){
                            $member= \App\userMember::where('user_id',Auth::user()->id)->first();
                            $detail_member = \App\Member::where('id',$member->member_id)->first();
                            if($detail_member->min_order_poin <= $total_sementara){
                            if($detail_member->discount_type == 'percent'){
                                $diskon_rate=$detail_member->discount_order/100*$total_sementara;
                                if($total_sementara >= $detail_member->min_order_discount){
                                    $rate=$total_sementara-$diskon_rate;
                                }
                                else{
                                    $rate=$total_sementara;
                                }
                                $total_poin = $detail_member->poin_order/100*$rate;
                            }
                            else{
                                if($total_sementara >= $detail_member->min_order_discount){
                                    $rate=$total_sementara-$detail_member->discount_order;
                                }
                                else{
                                    $rate=$total_sementara;
                                }
                                $total_poin = $detail_member->poin_order/100*$rate;
                            }
                            }
                        }                           
                        
                        else{
                            $detail_user = \App\PoinUser::where('type_user',Auth::user()->user_type)->first();
                            if($detail_user->min_order_poin <= $total_sementara)
                            {
                            if($detail_user->type_discount == 'percent'){
                                $diskon_rate=$detail_user->discount/100*$total_sementara;
                                if($total_sementara >= $detail_user->min_order_discount)
                                {
                                    $rate=$total_sementara-$diskon_rate;
                                }
                                else{
                                    $rate=$total_sementara;
                                }
                                $total_poin = $detail_user->poin/100*$rate;
                            }
                            else{
                                if($total_sementara >= $detail_user->min_order_discount){
                                $rate=$total_sementara-$detail_user->discount;
                                }
                                else{
                                $rate=$total_sementara;
                                }
                                $total_poin = $detail_user->poin/100*$rate;
                            }
                            }
                        }
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
                @if($check_custom != null && $check_custom->count() > 0)
                @if($total_sementara >= $check_custom->min_order_discount)

                <tr class="cart-shipping">
                    <th>{{translate('Discount')}}</th>
                    <td class="text-right">
                        <span class="text-italic">@if($check_custom->type_discount == 'amount')<span>Rp</span>@else<span>{{single_price($diskon_rate)}}</span>@endif{{ $check_custom->discount }}@if($check_custom->type_discount == 'percent')<span> %</span>@endif</span>
                    </td>
                </tr>
                @endif
                @if($check_custom->min_order_poin <= $total_sementara)
                <tr class="cart-shipping">
                    <th>{{translate('Poin yang didapatkan')}}</th>
                    <td class="text-right">
                        <span class="text-italic">{{ round($total_poin) }}</span>
                    </td>
                </tr>
                @endif
                @else
                @if(Auth::user()->user_type == 'regular physician')
                    @if($detail_member->min_order_discount <= $total_sementara)

                <tr class="cart-shipping">
                    <th>{{translate('Discount')}}</th>
                    <td class="text-right">
                        <span class="text-italic">@if($detail_member->discount_type == 'amount')<span>Rp</span>@else<span>{{single_price($diskon_rate)}}</span>@endif{{ $detail_member->discount_order }}@if($detail_member->discount_type == 'percent')<span> %</span>@endif</span>
                    </td>
                </tr>
                @endif
                @if($detail_member->min_order_poin <= $total_sementara)
                <tr class="cart-shipping">
                    <th>{{translate('Poin yang didapatkan')}}</th>
                    <td class="text-right">
                        <span class="text-italic">{{ round($total_poin) }}</span>
                    </td>
                </tr>
                @endif
                @else
                @if($total_sementara >= $detail_user->min_order_discount)

                <tr class="cart-shipping">
                    <th>{{translate('Discount')}}</th>
                    <td class="text-right">
                        <span class="text-italic">@if($detail_user->type_discount == 'amount')<span>{{ single_price($detail_user->discount) }}</span>@else<span>{{single_price($diskon_rate)}} ({{ $detail_user->discount }} % )</span>@endif</span>
                    </td>
                </tr>
                @endif
                @if($detail_user->min_order_poin <= $total_sementara)
                <tr class="cart-shipping">
                    <th>{{translate('Poin yang didapatkan')}}</th>
                    <td class="text-right">
                        <span class="text-italic">{{ round($total_poin) }}</span>
                    </td>
                </tr>
                @endif
                @endif
                @endif
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
                

                 @if (isset($poin_use))
                    @if(Auth::user()->user_type == 'pasien reg')
                    @php
                    $voucher = \App\CouponVoucher::where('id', $poin_use->poin)->first();

                    @endphp
                    <tr class="cart-shipping">
                        <th>{{translate('Diskon Poin')}}</th>
                        <td class="text-right">
                            <span class="text-italic">@if($voucher->discount_type == 'amount'){{single_price($voucher->potongan)}}@else($voucher->discount_type == 'percent'){{ $voucher->potongan}}<span>%</span>@endif</span>
                        </td>
                    </tr>
                    @else
                    <tr class="cart-shipping">
                        <th>{{translate('Diskon Poin')}}</th>
                        <td class="text-right">
                            <span class="text-italic">{{ single_price($poin_use->poin*$club_point_convert_rate->value) }}</span>
                        </td>
                    </tr>
                    @endif
                @endif
                @php
                if(isset($poin_use)){

                $voucher = \App\CouponVoucher::where('id', $poin_use->poin)->first();
                }
                    $total = $subtotal+$tax+$shipping;
                    if($check_custom != null && $check_custom->count() > 0){
                        if($check_custom->min_order_discount <= $total_sementara){
                            if($check_custom->type_discount == 'amount'){
                                $total_awal = $subtotal+$tax-$check_custom->discount;
                                $total=$total_awal+$shipping;
                                if(isset($poin_use)){
                                    if(Auth::user()->user_type == 'pasien reg'){
                                        if($voucher->discount_type == 'amount'){
                                        $total = $total_awal-$voucher->potongan+$shipping;
                                        }
                                        else{
                                        $convertp = $subtotal+$tax*$voucher->potongan/100;
                                        $total=$total_awal-$convertp+$shipping;
                                        }
                                    }
                                    else{
                                    $total = $total_awal-$poin_use->poin*$club_point_convert_rate->value+$shipping;
                                    }
                                }
                            }
                            else{
                                $total_awal = $subtotal+$tax;
                                $total_diskon = $check_custom->discount/100*$total_awal;
                                $total=$total_awal-$total_diskon+$shipping;
                                    if(isset($poin_use)){
                                        if(Auth::user()->user_type == 'pasien reg'){
                                            if($voucher->discount_type == 'amount'){
                                            $total = $total_awal-$total_diskon-$voucher->potongan+$shipping;
                                        }
                                        else{
                                        $convertp = $total_awal*$voucher->potongan/100;
                                        $total=$total_awal-$total-diskon-$convertp+$shipping;
                                        }

                                        }
                                        else{
                                        $convertp=$poin_use->poin*$club_point_convert_rate->value;
                                        $total=$total_awal-$total_diskon-$convertp+$shipping;
                                        }
                                    }
                            }
                        }
                    }
                    else{
                    if(Auth::user()->user_type == 'regular physician'){
                        if($detail_member->min_order_discount <= $total_sementara){

                        if($detail_member->discount_type == 'amount'){
                            $total_awal = $subtotal+$tax-$detail_member->discount_order;
                            $total=$total_awal+$shipping;
                            if(isset($poin_use)){
                                $total = $total_awal-$poin_use->poin*$club_point_convert_rate->value+$shipping;
                            
                            }
                        }
                        else{
                            $total_awal = $subtotal+$tax;
                            $total_diskon = $detail_member->discount_order/100*$total_awal;
                            $total=$total_awal-$total_diskon+$shipping;
                            if(isset($poin_use)){
                                $convertp=$poin_use->poin*$club_point_convert_rate->value;
                                $total=$total_awal-$total_diskon-$convertp+$shipping;
                            }
                        }
                    }
                    else{
                        if(isset($poin_use)){
                            $total -= $poin_use->poin*$club_point_convert_rate->value;
                        }
                    }
                    }
                    else{
                        if($detail_user->min_order_discount <= $total_sementara){

                        if($detail_user->type_discount == 'amount'){
                            $total_awal = $subtotal+$tax-$detail_user->discount;
                            $total=$total_awal+$shipping;
                            if(isset($poin_use)){
                                if(Auth::user()->user_type == 'pasien reg'){
                                    if($voucher->discount_type == 'amount'){
                                        $total = $total_awal-$voucher->potongan+$shipping;
                                    }
                                    else{
                                        $convertp = $total_awal*$voucher->potongan/100;
                                        $total=$total_awal-$convertp+$shipping;
                                    }

                                }
                                else{
                                    $total = $total_awal-$poin_use->poin*$club_point_convert_rate->value+$shipping;
                                }
                            
                            }
                        }
                        else{
                            $total_awal = $subtotal+$tax;
                            $total_diskon = $detail_user->discount/100*$total_awal;
                            $total=$total_awal-$total_diskon+$shipping;
                            if(isset($poin_use)){
                                if(Auth::user()->user_type == 'pasien reg'){
                                    if($voucher->discount_type == 'amount'){
                                        $total = $total_awal-$total_diskon-$voucher->potongan+$shipping;
                                    }
                                    else{
                                        $convertp = $total_awal*$voucher->potongan/100;
                                        $total=$total_awal-$total-diskon-$convertp+$shipping;
                                    }

                                }
                                else{
                                $convertp=$poin_use->poin*$club_point_convert_rate->value;
                                $total=$total_awal-$total_diskon-$convertp+$shipping;                                
                                }
                            }
                        }
                        
                        }
                        else{
                            if(Auth::user()->user_type == 'partner physician'){
                                if(isset($poin_use)){
                                $total -= $poin_use->poin*$club_point_convert_rate->value;
                                }
                            }
                            elseif(Auth::user()->user_type == 'pasien reg'){
                                if(isset($poin_use)){
                                    if($voucher->discount_type == 'amount'){
                                        $total -= $voucher->potongan;
                                    }
                                    else{
                                        $total_awal = $subtotal+$tax;
                                        $convertp = $total_awal*$voucher->potongan/100;
                                        $total -= $convertp;

                                    }
                                    
                                }
                            }
                        }
                    }
                    }
                    if(Session::has('coupon_discount')){
                        $total -= Session::get('coupon_discount');
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
        <form action="{{ route('checkout.store_delivery_info') }}" id="form-checkout" method="POST">
        @csrf
        <input type="hidden" name="shipping_info" id="shipping_info" @if(isset($ongkir)) value="{{ encrypt($ongkir) }}" @endif>
        <input type="hidden" name="payment_option" value="manual_transfer">
        <div class="row text-center" >
            @if(Auth::check())
                @if(isset($ongkir))
                <button type="submit" class="btn btn-default" style="margin:auto;color:white;width:100%" class="py-2">{{ translate('Checkout')}}</button>
                @else
                <button type="submit" class="btn btn-default" style="margin:auto;color:white;width:100%" class="py-2">{{ translate('Checkout')}}</button>
                @endif
            @else
                <button type="button" style="margin:auto;color:#006064" class="py-2" onclick="showCheckoutModal()">{{ translate('Checkout')}}</button>
            @endif
        </div>
        </form>
    </div>
</div>
