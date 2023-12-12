<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTrialsTableToAddDateFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trials', function (Blueprint $table) {

            $table->dateTime('trail_sent_at')->nullable();
            $table->dateTime('trail_accepted_at')->nullable();
            $table->dateTime('trail_end_at')->nullable();
            $table->dateTime('adoption_send_at')->nullable();
            $table->dateTime('adoption_accept_decline_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trials', function (Blueprint $table) {
            //
        });
    }
}
