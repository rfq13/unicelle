<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\User;
use App\Order;
use App\MemberCustom;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $user = User::all()->pluck("id")->toArray();
        $customers = Customer::whereIn('user_id',$user)->with('user.member')->orderBy('created_at', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $user_ids = User::where('user_type',"!=", 'admin')->where(function($user) use ($sort_search){
                $user->where('name', 'like', '%'.$sort_search.'%')->orWhere('email', 'like', '%'.$sort_search.'%');
            })->pluck('id')->toArray();
            $customers = $customers->where(function($customer) use ($user_ids){
                $customer->whereIn('user_id', $user_ids);
            });
        }
        $customers = $customers->paginate(15);
        return view('customers.index', compact('customers', 'sort_search'));
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
        Order::where('user_id', Customer::findOrFail($id)->user->id)->delete();
        User::destroy(Customer::findOrFail($id)->user->id);
        if(Customer::destroy($id)){
            flash(translate('Customer has been deleted successfully'))->success();
            return redirect()->route('customers.index');
        }

        flash(translate('Something went wrong'))->error();
        return back();
    }

    public function login($id)
    {
        $customer = Customer::findOrFail(decrypt($id));

        $user  = $customer->user;

        auth()->login($user, true);

        return redirect()->route('dashboard');
    }

    public function ban($id) {
        $customer = Customer::findOrFail($id);

        if($customer->user->banned == 1) {
            $customer->user->banned = 0;
        } else {
            $customer->user->banned = 1;
        }

        $customer->user->save();

        return back();
    }
    public function edit_poin($id)
    {

        $customer = $id;


        return view('customers.set_poin', compact('customer'));
    }
    public function override_poin(Request $request){
        $id_user = $request->user_id;
        $check = MemberCustom::where('user_id',$id_user)->first();
        if($check != null && $check->count() > 0){
            $create = MemberCustom::findOrFail($check->id);
            $create->user_id = $request->user_id;
            $create->min_order_poin = $request->min_order_poin;
            $create->poin = $request->poin;
            $create->min_order_discount = $request->min_order_discount;
            $create->discount = $request->discount;
            $create->type_discount = $request->type_discount;
            $create->save();
        }
        else{
            $create = new MemberCustom;
            $create->user_id = $request->user_id;
            $create->min_order_poin = $request->min_order_poin;
            $create->poin = $request->poin;
            $create->min_order_discount = $request->min_order_discount;
            $create->discount = $request->discount;
            $create->type_discount = $request->type_discount;
            $create->save();
        }
        flash(translate('Diskon dan poin mutlak berhasil disimpan'))->success();
        return redirect()->route('customers.index');

    }
}
