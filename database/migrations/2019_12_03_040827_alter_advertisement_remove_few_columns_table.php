<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAdvertisementRemoveFewColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {           
        Schema::table('advertisement', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('paid');
            $table->dropColumn('approve');
            $table->dropColumn('start_at');
            $table->dropColumn('ended_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advertisement', function (Blueprint $table) {
            $table->enum('status', array('Inactive','Active','Pause','Suspend','Deleted','Ended'))->default('Inactive');
            $table->integer('paid')->default(0);
            $table->integer('approve')->default(0);
            $table->dateTime('start_at')->nullable();
            $table->dateTime('ended_at')->nullable();
        });
    }
}
