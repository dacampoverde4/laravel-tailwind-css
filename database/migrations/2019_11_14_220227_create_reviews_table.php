<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable()->comment('User ID who left the review');   
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('other_user_id')->unsigned()->nullable()->comment('User ID who got the review');   
            $table->foreign('other_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('stars');
            $table->string('type')->default('trail');
            $table->string('subject')->nullable();
            $table->text('message')->nullable();
            $table->integer('report')->nullable()->default(0);
            $table->integer('helpful')->nullable()->default(0);
            $table->integer('not_helpful')->nullable()->default(0);
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
        Schema::dropIfExists('reviews');
    }
}
