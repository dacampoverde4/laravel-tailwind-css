<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCouponDiscountTypeColumnsCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coupons', function (Blueprint $table) {
            $table->integer('coupon_discount_type_id')->unsigned()->default(1);
            $table->foreign('coupon_discount_type_id')->references('id')->on('coupon_discount_types')->onDelete('cascade');
            $table->integer('token_amt')->default(0)->change();
            $table->integer('discount')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
