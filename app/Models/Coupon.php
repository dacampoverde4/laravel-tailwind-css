<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';
    protected $fillable = [
        'coupon_code', 'count', 'token_amt', 'discount', 'expiry_date', 'coupon_discount_type_id'
    ];

    public function discountType(){
        return $this->belongsTo('App\Models\CouponDiscountType', 'coupon_discount_type_id');
    }
}
