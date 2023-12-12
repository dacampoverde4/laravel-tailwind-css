<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserVerificationQuestionnairesUsergroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_verification_questionnaires_usergroup', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_verification_questionnaires_id');
            $table->integer('usergroup_id');
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
        Schema::dropIfExists('user_verification_questionnaires_usergroup');
    }
}