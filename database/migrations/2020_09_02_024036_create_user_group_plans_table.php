<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGroupPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_group_plans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trial_plan_id')->unsigned()->nullable();;
            $table->foreign('trial_plan_id')->references('id')->on('trial_plans');
            
            $table->integer('user_group_id')->unsigned()->nullable();
            $table->foreign('user_group_id')->references('id')->on('usergroups');
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
        Schema::dropIfExists('user_group_plans');
    }
}
