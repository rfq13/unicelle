<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\SubSubCategory;
use App\Category;
use App\Cart;
use Session;
use App\Color;
use Cookie;
use Auth;

class CartController extends Controller
{
    public function index(Request $request)
    {
        //dd($cart->all());
        $categories = Category::all();
        return view('frontend.view_cart', compact('categories'));
    }

    public function showCartModal(Request $request)
    {
        $product = Product::find($request->id);
        return view('frontend.partials.addToCart', compact('product'));
    }

    public function updateNavCart(Request $request)
    {
        return view('frontend.partials.cart');
    }

    public function addToCart(Request $request)
    {
        // dd($request->all());
        $product = Product::find($request->id);

        $data = array();
        $data['id'] = $product->id;
        $str = '';
        $tax = 0;

        if($product->digital != 1 && $request->quantity < $product->min_qty) {
            return view('frontend.partials.minQtyNotSatisfied', [
                'min_qty' => $product->min_qty
            ]);
        }


        //check the color enabled or disabled for the product
        if($request->has('color')){
            $data['color'] = $request['color'];
            $str = Color::where('code', $request['color'])->first()->name;
        }

        if ($product->digital != 1) {
            //Gets all the choice values of customer choice option and generate a string like Black-S-Cotton
            foreach (json_decode(Product::find($request->id)->choice_options) as $key => $choice) {
                if($str != null){
                    $str .= '-'.str_replace(' ', '', $request['attribute_id_'.$choice->attribute_id]);
                }
                else{
                    $str .= str_replace(' ', '', $request['attribute_id_'.$choice->attribute_id]);
                }
            }
        }

        $data['variant'] = $str;

        if($str != null && $product->variant_product){
            $product_stock = $product->stocks->where('variant', $str)->first();
            if (Auth::user()->user_type == "regular physician") {
                $price = $product_stock->regular_physician_price;
            }elseif (Auth::user()->user_type == "partner physician") {
                $price = $product_stock->partner_physician_price;
            }elseif (Auth::user()->user_type == "pasien reg") {
                $price = $product_stock->pasien_regular_price;
            }else {
                $price = $product_stock->price;
            }

            $quantity = $product_stock->qty;

            if($quantity >= $request['quantity']){
                // $variations->$str->qty -= $request['quantity'];
                // $product->variations = json_encode($variations);
                // $product->save();
            }
            else{
                return view('frontend.partials.outOfStockCart');
            }
        }
        else{
            if (Auth::user()->user_type == "regular physician") {
                $price = $product->regular_physician_price;
            }elseif (Auth::user()->user_type == "partner physician") {
                $price = $product->partner_physician_price;
            }elseif (Auth::user()->user_type == "pasien reg") {
                $price = $product->pasien_regular_price;
            }else {
                $price = $product->unit_price;
            }
        }

        //discount calculation based on flash deal and regular discount
        //calculation of taxes
        $flash_deals = \App\FlashDeal::where('status', 1)->get();
        $inFlashDeal = false;
        foreach ($flash_deals as $flash_deal) {
            if ($flash_deal != null && $flash_deal->status == 1  && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && \App\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first() != null) {
                $flash_deal_product = \App\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first();
                if($flash_deal_product->discount_type == 'percent'){
                    $price -= ($price*$flash_deal_product->discount)/100;
                }
                elseif($flash_deal_product->discount_type == 'amount'){
                    $price -= $flash_deal_product->discount;
                }
                $inFlashDeal = true;
                break;
            }
        }
        if (!$inFlashDeal) {
            if($product->discount_type == 'percent'){
                $price -= ($price*$product->discount)/100;
            }
            elseif($product->discount_type == 'amount'){
                $price -= $product->discount;
            }
        }

        if($product->tax_type == 'percent'){
            $tax = ($price*$product->tax)/100;
        }
        elseif($product->tax_type == 'amount'){
            $tax = $product->tax;
        }

        $data['quantity'] = $request['quantity'];
        $data['price'] = (int)$price;
        $data['tax'] = $tax;
        $data['shipping'] = 0;
        $data['product_referral_code'] = null;
        $data['digital'] = $product->digital;

        if ($request['quantity'] == null){
            $data['quantity'] = 1;
        }

        if(Cookie::has('referred_product_id') && Cookie::get('referred_product_id') == $product->id) {
            $data['product_referral_code'] = Cookie::get('product_referral_code');
        }
        $carts = Cart::where("user_id",Auth::check() ? Auth::user()->id : 0);
        $save_cart = new Cart;
        $cart = $carts->where("product_id",$product->id)->first();
        if ($cart != null && $cart->variation == $data["variant"]) {
            $save_cart = Cart::where(["user_id"=>Auth::user()->id,"product_id"=>$product->id])->first();
            $save_cart->quantity += $data["quantity"] < 1 ? 1 : $data["quantity"];
        }else {
            $save_cart->user_id = Auth::check() ? Auth::user()->id : 0;
            $save_cart->quantity = $data["quantity"] < 1 ? 1 : $data["quantity"];
            $save_cart->product_id = $request->id;
            $save_cart->variation = $data["variant"];
            $save_cart->price = $data["price"];
            $save_cart->tax = $data["tax"];
            $save_cart->shipping_cost = $data["shipping"];
        }
        $save_cart->save();
        // dd([$data,$save_cart]);
        return view('frontend.partials.addedToCart', compact('product', 'data'));
    }

    //removes from Cart
    public function removeFromCart(Request $request)
    {
        // dd($request->all());
        if (Auth::check()) {
            $cart = Cart::findOrFail($request->key);
            $cart->delete();
        }

    }

    //updated the quantity for a cart item
    public function updateQuantity(Request $request)
    {
        if ($request->quantity > 0) {
            
            $cart = \App\Cart::find($request->cartId);
            
            if($cart){
                if ($product = \App\Product::find($cart->product_id)) {
                    $quantity = $product->current_stock;
                    if(strlen($cart->variation) > 0 && $product->variant_product == 1){
                        $product_stock = $product->stocks->where('variant', $cart['variation'])->first();
                        if ($product_stock) {
                            $quantity = $product_stock->qty;
                        }
                    }
                    
                    
                    if ($quantity >= $request->quantity) {
                        $cart->quantity = $request->quantity;
                        $cart->save();
                    }
                }
                
            }   
                 
        }
        return view('frontend.partials.cart_details');
    }

    
}
