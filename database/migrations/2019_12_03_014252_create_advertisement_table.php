<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisement', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('banner_ids')->nullable();
            $table->string('target_audience_ids')->nullable();           
            $table->bigInteger('total_amt')->nullable();
            $table->string('banner_plan')->nullable();
            $table->bigInteger('plan_period')->nullable();
            $table->enum('status', array('Inactive','Active','Pause','Suspend','Deleted','Ended'))->default('Inactive');
            $table->integer('paid')->default(0);
            $table->integer('approve')->default(0);
            $table->dateTime('start_at')->nullable();
            $table->dateTime('ended_at')->nullable();
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
        Schema::dropIfExists('advertisement');
    }
}
