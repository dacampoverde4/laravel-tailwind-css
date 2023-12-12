<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rid')->unsigned()->nullable()->comment('Review id');   
            $table->foreign('rid')->references('id')->on('reviews')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->nullable()->comment('User ID who got the review');   
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('helpful')->default(0)->nullable()->comment('Review helpful yes = 1 & no = 0'); 
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
        Schema::dropIfExists('review_comments');
    }
}
