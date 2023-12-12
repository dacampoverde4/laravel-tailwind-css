<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnDeletedByToAdsSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        if(!Schema::hasColumn('ads_subscriptions', 'deleted_by')){
            Schema::table('ads_subscriptions', function (Blueprint $table) {
                $table->integer('deleted_by')->nullable()->after('ended_at');
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
        Schema::table('ads_subscriptions', function (Blueprint $table) {
            //
        });
    }
}
