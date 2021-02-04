@php
                    $delivery_viewed = App\Order::where('user_id', Auth::user()->id)->where('delivery_viewed', 0)->get()->count();
                    $payment_status_viewed = App\Order::where('user_id', Auth::user()->id)->where('payment_status_viewed', 0)->get()->count();
                    $refund_request_addon = \App\Addon::where('unique_identifier', 'refund_request')->first();
                    $club_point_addon = \App\Addon::where('unique_identifier', 'club_point')->first();
                @endphp
<div id="account-mobile-menu" class="mb-5">
<div class="category-name-mobile-container">
<a href="{{ route('profile') }}" class="{{ areActiveRoutesHome(['profile'])}}">
                                        <span>Dashboard</span>
                                </a>   
                                </div>
                                <div class="category-name-mobile-container">
<a href="{{ route('purchase_history.index') }}" class="{{ areActiveRoutesHome(['purchase_history.index'])}}">
                                        <span>{{ translate('Purchase History')}} @if($delivery_viewed > 0 || $payment_status_viewed > 0)<span class="ml-2" style="color:green"><strong>({{  translate(' New Notifications') }})</strong></span>@endif
</span>
                                </a>   
                                </div>
                                <div class="category-name-mobile-container">
                                <a href="{{ route('digital_purchase_history.index') }}" class="{{ areActiveRoutesHome(['digital_purchase_history.index'])}}">
                                        <span>Downloads</span>
                                </a>   
                                </div>
                                <div class="category-name-mobile-container">
                                <a href="{{ route('wishlists.index') }}" class="{{ areActiveRoutesHome(['wishlists.index'])}}">
                                        <span class="menu-collapsed">Wishlist</span>
                                </a>   
                                </div>
                                <div class="category-name-mobile-container">
                                <a href="{{ route('seller.products') }}" class="{{ areActiveRoutesHome(['seller.products', 'seller.products.upload', 'seller.products.edit'])}}">
                                        <span class="menu-collapsed">Products</span>
                                </a>   
                                </div>
                                <div class="category-name-mobile-container">
                                <a href="{{ route('seller.digitalproducts') }}" class="{{ areActiveRoutesHome(['seller.digitalproducts', 'seller.digitalproducts.upload', 'seller.digitalproducts.edit'])}}">
                                        <span class="menu-collapsed">Digital Products</span>
                                </a>   
                                </div>
                                @if(\App\BusinessSetting::where('type', 'classified_product')->first()->value == 1)
                                <div class="category-name-mobile-container">
                                <a href="{{ route('customer_products.index') }}" class="{{ areActiveRoutesHome(['customer_products.index', 'customer_products.create', 'customer_products.edit'])}}">
                                        <span class="menu-collapsed">Classified Products</span>
                                </a>   
                                </div>
                                @endif
                                @if (\App\Addon::where('unique_identifier', 'pos_system')->first() != null && \App\Addon::where('unique_identifier', 'pos_system')->first()->activated)
                    @if (\App\BusinessSetting::where('type', 'pos_activation_for_seller')->first() != null && \App\BusinessSetting::where('type', 'pos_activation_for_seller')->first()->value != 0)
                    <div class="category-name-mobile-container">
                    <a href="{{route('poin-of-sales.seller_index')}}" class="{{ areActiveRoutesHome(['poin-of-sales.seller_index'])}}">
                                        <span class="menu-collapsed">POS Manager</span>
                                </a>   
                                </div>
                    @endif
                @endif
                                <div class="category-name-mobile-container">
                                <a href="{{route('product_bulk_upload.index')}}" class="{{ areActiveRoutesHome(['product_bulk_upload.index'])}}">
                                        <span class="menu-collapsed">Product Bulk Upload</span>
                                </a>   
                                </div>
                                @php
                                $orders = DB::table('orders')
                                ->orderBy('code', 'desc')
                                ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                                ->where('order_details.seller_id', Auth::user()->id)
                                ->where('orders.viewed', 0)
                                ->select('orders.id')
                                ->distinct()
                                ->count();
                                @endphp
                                <div class="category-name-mobile-container">
                                <a href="{{ route('orders.index') }}" class="{{ areActiveRoutesHome(['orders.index'])}}">
                                        <span class="menu-collapsed">{{ translate('Orders')}} @if($orders > 0)<span class="ml-2" style="color:green"><strong>({{ $orders }} {{  translate('New') }})</strong></span>@endif
                                </a>   
                                </div>
                                @if ($refund_request_addon != null && $refund_request_addon->activated == 1)
                                <div class="category-name-mobile-container">
                                <a href="{{ route('vendor_refund_request') }}" class="{{ areActiveRoutesHome(['vendor_refund_request'])}}">
                                        <span class="menu-collapsed">{{ translate('Recieved Refund Request')}}</span>
                                </a>   
                                </div>
                                <div class="category-name-mobile-container">
                                <a href="{{ route('customer_refund_request') }}" class="{{ areActiveRoutesHome(['customer_refund_request'])}}">
                                        <span class="menu-collapsed"> {{ translate('Sent Refund Request')}}</span>
                                </a>   
                                </div>
                                @endif
                                @php
                                $review_count = DB::table('reviews')
                                ->orderBy('code', 'desc')
                                ->join('products', 'products.id', '=', 'reviews.product_id')
                                ->where('products.user_id', Auth::user()->id)
                                ->where('reviews.viewed', 0)
                                ->select('reviews.id')
                                ->distinct()
                                ->count();
                                @endphp
                                <div class="category-name-mobile-container">
                                <a href="{{ route('reviews.seller') }}" class="{{ areActiveRoutesHome(['reviews.seller'])}}">
                                <span class="menu-collapsed"> {{ translate('Product Reviews')}}@if($review_count > 0)<span class="ml-2" style="color:green"><strong>({{ $review_count }} {{  translate('New') }})</strong></span>@endif</span>
                                </a>   
                                </div>
                                @if (\App\BusinessSetting::where('type', 'conversation_system')->first()->value == 1)
                                    @php
                                    $conversation_sent = \App\Conversation::where('sender_id', Auth::user()->id)->where('sender_viewed', 0)->get();
                                    $conversation_recieved = \App\Conversation::where('receiver_id', Auth::user()->id)->where('receiver_viewed', 0)->get();
                                    @endphp
                                    <div class="category-name-mobile-container">
                                    <a href="{{ route('conversations.index') }}" class="{{ areActiveRoutesHome(['conversations.index', 'conversations.show'])}}">
                                        <span class="menu-collapsed">{{ translate('Conversations')}}@if (count($conversation_sent)+count($conversation_recieved) > 0)<span class="ml-2" style="color:green"><strong>({{ count($conversation_sent)+count($conversation_recieved) }})</strong></span>
                                    @endif</span>
                                    </a>   
                                    </div>
                                 @endif
                                 <div class="category-name-mobile-container">
                                 <a href="{{ route('shops.index') }}" class="{{ areActiveRoutesHome(['shops.index'])}}">
                                        <span class="menu-collapsed">{{ translate('Shop Setting')}}</span>
                                    </a>   
                                </div>
                                <div class="category-name-mobile-container">
                                <a href="{{ route('payments.index') }}" class="{{ areActiveRoutesHome(['payments.index'])}}">
                                        <span class="menu-collapsed"> {{ translate('Payment History')}}</span>
                                    </a>   
                                </div>
                                <div class="category-name-mobile-container">
                                <a href="{{ route('profile') }}" class="{{ areActiveRoutesHome(['profile'])}}">
                                        <span class="menu-collapsed"> {{ translate('Manage Profile')}}</span>
                                    </a>   
                                </div>
                                <div class="category-name-mobile-container">
                                <a href="{{ route('withdraw_requests.index') }}" class="{{ areActiveRoutesHome(['withdraw_requests.index'])}}">
                                        <span class="menu-collapsed"> {{ translate('Money Withdraw')}}</span>
                                    </a>   
                                </div>
                                @if (\App\BusinessSetting::where('type', 'wallet_system')->first()->value == 1)
                                <div class="category-name-mobile-container">
                                <a href="{{ route('wallet.index') }}" class="{{ areActiveRoutesHome(['wallet.index'])}}">
                                        <span class="menu-collapsed">{{ translate('My Wallet')}}</span>
                                    </a>   
                                </div>
                                @endif
                                @if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated && Auth::user()->affiliate_user != null && Auth::user()->affiliate_user->status)
                                <div class="category-name-mobile-container">
                                <a href="{{ route('affiliate.user.index') }}" class="{{ areActiveRoutesHome(['affiliate.user.index', 'affiliate.payment_settings'])}}">
                                        <span class="menu-collapsed">{{ translate('Affiliate System')}}</span>
                                    </a>   
                                </div>
                                @endif
                                @if ($club_point_addon != null && $club_point_addon->activated == 1)
                                <div class="category-name-mobile-container">
                                <a href="{{ route('earnng_point_for_user') }}" class="{{ areActiveRoutesHome(['earnng_point_for_user'])}}">
                                        <span class="menu-collapsed">{{ translate('Earning Points')}}</span>
                                    </a>   
                                </div>
                                @endif
                                @php
                                $support_ticket = DB::table('tickets')
                                ->where('client_viewed', 0)
                                ->where('user_id', Auth::user()->id)
                                ->count();
                                @endphp
                                <div class="category-name-mobile-container">
                                <a href="{{ route('support_ticket.index') }}" class="{{ areActiveRoutesHome(['support_ticket.index', 'support_ticket.show'])}}">
                                        <span class="menu-collapsed"> {{ translate('Support Ticket')}} @if($support_ticket > 0)<span class="ml-2" style="color:green"><strong>({{ $support_ticket }} {{  translate('New') }})</strong></span></span>@endif
                                    </a>   
                                </div>

</div>