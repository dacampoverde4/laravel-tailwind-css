<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponDiscountType extends Model
{
    protected $table = 'coupon_discount_types';

    protected $fillable = [
        'coupon_code', 'count', 'token_amt', 'discount', 'expiry_date',
    ];

    public function coupons(){
        return $this->hasManny('App\Models\Coupon', 'coupon_discount_type_id', 'id');
    }
}
