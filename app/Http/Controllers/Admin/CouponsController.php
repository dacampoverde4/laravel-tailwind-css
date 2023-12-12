<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\CouponDiscountType;
use Illuminate\Support\Facades\Validator;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $coupon_discount_types = CouponDiscountType::all();
        return view('admin.coupons.create', compact('coupon_discount_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|regex:/^[A-Z]+$/u|max:6|unique:coupons',
            'coupon_count' => 'required|numeric|max:100',
            'discount_type' => 'required',
            'token_amt' => 'required_if:discount_type,1,3|numeric|max:9000',
            'discount' => 'required_if:discount_type,2,3|numeric|max:100',
            'expiry_date' => 'required',
        ]);
        $coupons = new Coupon;
        $coupons->coupon_code = $request->coupon_code;
        $coupons->count = $request->coupon_count;
        $coupons->token_amt = $request->token_amt;
        $coupons->discount = $request->discount;
        $coupons->expiry_date = $request->expiry_date;
        $coupons->coupon_discount_type_id = $request->discount_type;        
        $coupons->save();
        return redirect()->route('coupons.index')->with('message', 'Coupon added successfuly.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        $coupon_discount_types = CouponDiscountType::all();
        return view('admin.coupons.edit', compact('coupon', 'coupon_discount_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $validator = Validator::make($request->all(), [
            'coupon_code' => 'required|regex:/^[A-Z]+$/u|max:6|unique:coupons,coupon_code,'.$coupon->id.',id',
            'coupon_count' => 'required|numeric|max:100',
            'discount_type' => 'required',
            'token_amt' => 'required_if:discount_type,1,3|numeric|max:9000',
            'discount' => 'required_if:discount_type,2,3|numeric|max:100',
            'expiry_date' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $coupon->coupon_code = $request->coupon_code;
        $coupon->count = $request->coupon_count;
        $coupon->token_amt = $request->token_amt;
        $coupon->discount = $request->discount;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->coupon_discount_type_id = $request->discount_type;   
        $coupon->save();
        return redirect()->route('coupons.index')->with('message', 'Coupon updated successfuly.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        try {
            $coupon->delete();
            return redirect()->back()->with('message', 'Coupon deleted successfuly.');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'Coupon not deleted successfuly.');
        }
    }
}
