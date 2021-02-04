<?php
namespace App\Http\Controllers\Payment;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Xendit\Xendit;
use Xendit\Cards;
use Carbon\Carbon;

class XenditController extends Controller
{    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test(){
        Xendit::setApiKey(env('XENDIT_API_KEY'));
        
        $params = [
            'token_id' => '5e2e8231d97c174c58bcf644',
            'external_id' => 'card_' . time(),
            'authentication_id' => '5e2e8658bae82e4d54d764c0',
            'amount' => 100000,
            'card_cvn' => '123',
            'capture' => false
        ];
        
        $createCharge = Cards::create($params);
        var_dump($createCharge);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Xendit::setApiKey(env('XENDIT_API_KEY'));
        $params = [        
            "amount"=> "10000",        
            "card_data"=> [
                "account_number"=> "4456530000001096",        
                "exp_month"=> "12",        
                "exp_year"=> "2020"
            ],
            "card_cvn"=> "123",
            "is_multiple_use"=> false,
            "should_authenticate"=> true,
            "customer"=> [
                "reference_id"=> "123e4567-e89b-12d3-a456-426614174000",
                "mobile_number"=> "+6208123123123",
                "email"=> "john@xendit.co",
                "given_names"=> "John",
                "surname"=> "Hudson",
                "phone_number"=> "+6208123123123",
                "nationality"=> "ID",
                "addresses"=> [
                    "country"=> "ID",
                    "street_line1"=> "Panglima Polim IV",
                    "street_line2"=> "Ruko Grand Panglima Polim, Blok E",
                    "city"=> "Jakarta Selatan",
                    "province_state"=> "DKI Jakarta",
                    "postal_code"=> "12345",
                    "category"=> "WORK"
                ],
                "date_of_birth"=> "1990-04-13",
                "description"=> "customer using promo",
                "metadata"=> []
            ]
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    function charge(Request $request)
    {
        Xendit::setApiKey(env('XENDIT_API_KEY'));
        // dd($request->all());
        $params = [
            'token_id' => $request->xenditToken,
            'external_id' => 'card_' . time(),
            'authentication_id' => $request->authid,
            'amount' => $request->amount,
            'card_cvn' => $request->cvn,
            'capture' => false
        ];
        
        try {
            $createCharge = Cards::create($params);
            $request->session()->put('ccdetails', $createCharge);
            return $createCharge;
        } catch (\Exception $e) {
            return $e;
        }
    }
}
