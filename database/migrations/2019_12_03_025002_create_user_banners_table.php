<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_banners', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('ads_id')->unsigned();
            $table->foreign('ads_id')->references('id')->on('advertisement')->onDelete('cascade');
            $table->integer('banners_id')->unsigned();
            $table->foreign('banners_id')->references('id')->on('banners')->onDelete('cascade');
            $table->string('image')->nullable();
            $table->string('url')->nullable();
            $table->string('target_audience_id')->nullable();
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
        Schema::dropIfExists('user_banners');
    }
}
