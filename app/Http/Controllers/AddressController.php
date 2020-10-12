<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use Auth;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->user_type == 'pasien reg'){
            $listProvince = $this->get_province();
            // dd($listProvince);
            return view('frontend.customer.address',compact('listProvince'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        if ($request->has('id')) {
            # code...
            $address = Address::findOrFail($request->id);
        }else{
            $address = new Address;
        }
        
        if($request->has('customer_id')){
            $address->user_id = $request->customer_id;
        }
        else{
            $address->user_id = Auth::user()->id;
        }

        if(Auth::user()->addresses == null || count(Auth::user()->addresses)== 0)
        {
            $address->set_default = 1;
        }

        $address->address = $request->address;
        $address->receiver = $request->receiver;
        $address->province = $request->province;
        $address->city = $request->city;
        $address->subdistrict = $request->subdistrict;
        $address->postal_code = $request->postal_code;
        $address->phone = $request->phone;
        $address->lat = $request->lat;
        $address->lng = $request->lng;
        if($address->save()){
            flash("Address added successfully")->success();
            return redirect()->back();
        }
        flash(translate('Something went wrong'))->error();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $data = DB::table('addresses')->where('id',$id);
        if ($data->first() != null) {
            $address['address'] = $request->address;
            $address['receiver'] = $request->receiver;
            $address['province'] = $request->province;
            // $address['country'] = '$request->country';
            $address['city'] = $request->city;
            $address['subdistrict'] = $request->subdistrict;
            $address['postal_code'] = $request->postal_code;
            $address['phone'] = $request->phone;
            $data->update($address);
            flash("address updated")->success();
        }
        return "sukses";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        if(!$address->set_default){
            $address->delete();
            flash(translate('Address deleted successfully'))->success();
            return back();
        }
        flash(translate('Default address can not be deleted'))->warning();
        return back();
    }

    public function profile()
    {
        // dd(Auth::user()->user_type);
        if(Auth::user()->user_type == 'pasien reg'){
            $province = $this->get_province();
            return view('frontend.customer.profile',compact("province"));
        }
        elseif(Auth::user()->user_type == 'seller'){
            return view('frontend.seller.profile');
        }
    }

    public function set_default($id){
        $return = '';
        $address = new Address;
        
        $remove = $address->where("set_default",1);
        $remove = $remove->update(['set_default'=>0]);

        $add = $address->findOrFail($id);

        if ($add != null) {
            $add->set_default = 1;
            $add->save();
            $return = ["default address has changed","sukses"];
        }else {
            $return = ["address not found","gagal"];
        }
        return $return;
    }
 
    public function get_province()
    {
        try {
            $url = "province";
            $response = request_raja_ongkir($url,"GET","");
            $result =[];
            // foreach ($response as $key => $value) {
            //     # code...
            //     array_push($result, ['province_id' => $value->province_id ,'province' => $value->province]);
            // }
            // dd($result);
            // return $response;
            return response()->json($response, 200);

        } catch (Exception $e) {
            return  response()->json($response, 500);
        }

    }

    public function get_city($id)
    {
        try {
            $url = "city?province=$id";
            $response = request_raja_ongkir($url,"GET","");
            $result =[];
            // foreach ($response as $key => $value) {
            //     # code...
            //     array_push($result, ['province_id' => $value->province_id ,'province' => $value->province]);
            // }
            // dd($result);
            // return $response;
            return response()->json($response, 200);

        } catch (Exception $e) {
            return  response()->json($response, 500);
        }
    }

    public function get_subdistrict($id)
    {
        try {
            $url = "subdistrict?city=$id";
            $response = request_raja_ongkir($url,"GET","");
            $result =[];
            // foreach ($response as $key => $value) {
            //     # code...
            //     array_push($result, ['province_id' => $value->province_id ,'province' => $value->province]);
            // }
            // dd($result);
            // return $response;
            return response()->json($response, 200);

        } catch (Exception $e) {
            return  response()->json($response, 500);
        }
    }


    public function getCostDestination(Request $request)
    {
        try {

            $items =[];

            foreach (\Session::get('cart') as $key => $cartItem) {
                # code...
                $product = \App\Product::find($cartItem['id']);
                array_push($items,[
                    "name" => $product->name,
                    "description" =>"",
                    "length" => $product->length,
                    "width" => $product->width,
                    "height" => $product->height,
                    "weight" => $product->weight,
                    "quantity" => $cartItem['quantity'],
                    "value" =>  $cartItem['price']*$cartItem['quantity']
                ]);

            }

            $paramSwift=[
                "origin_latitude" =>  floatval(env('SWIFT_ORIGIN_LAT')),
                "origin_longitude" =>  floatval(env('SWIFT_ORIGIN_LNG')),
                "destination_latitude" => floatval($request->lat),
                "destination_longitude" => floatval($request->lng),
                "couriers" => env("SWIFT_COURIER"),
                "items" => $items
            ];

            // dd($paramSwift);
            $swift= get_swift($paramSwift);
          

            $shiping_item = \View::make('frontend.partials.shiping_item',compact('swift'))->render();
            // $shiping_summary = \View::make('frontend.partials.shiping_summary')->render();
            return response()->json(compact('shiping_item'));
            
        } catch (Exception $e) {
             return response()->json($e, 500);
        }
    }

}
