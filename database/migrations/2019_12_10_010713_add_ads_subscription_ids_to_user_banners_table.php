<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdsSubscriptionIdsToUserBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('user_banners', 'ads_subscription_id')){
            Schema::table('user_banners', function (Blueprint $table) {
                $table->integer('ads_subscription_id')->unsigned()->nullable()->after('ads_id');
                $table->foreign('ads_subscription_id')->references('id')->on('ads_subscriptions')->onDelete('cascade');
            });
        }        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_banners', function (Blueprint $table) {
            //
        });
    }
}
