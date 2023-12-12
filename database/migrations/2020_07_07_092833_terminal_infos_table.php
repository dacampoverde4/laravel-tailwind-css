<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TerminalInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terminal_infos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('uuid',50)->nullable();
            $table->string('terminal_id',191)->nullable();
            $table->string('parcel_name',191)->nullable();
            $table->string('region_name',191)->nullable();
            $table->string('x')->nullable();
            $table->string('y')->nullable();
            $table->string('z')->nullable();
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
        Schema::dropIfExists('terminal_infos');
    }
}
