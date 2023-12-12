<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionPlanUserGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_plan_user_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('main_group_id')->nullable();
            $table->integer('map_group_id')->nullable();
            $table->string('main_group_plan_id')->nullable();
            $table->string('map_group_plan_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_plan_user_groups');
    }
}
