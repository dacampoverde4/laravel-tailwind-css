<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPlanIdCloumnNullablePrepurchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('prepurches', function (Blueprint $table) {
            // $table->string('plan_id')->nullable()->change();
            $table->integer('plan_id')->nullable()->unsigned()->change()    ;
        });


        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
