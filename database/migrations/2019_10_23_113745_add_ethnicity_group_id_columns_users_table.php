<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEthnicityGroupIdColumnsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'ethnicity_group_id')){
            Schema::table('users', function (Blueprint $table) {
                $table->integer('ethnicity_group_id')->unsigned()->nullable();
                $table->foreign('ethnicity_group_id')->references('id')->on('ethnicity_groups')->onDelete('cascade');
            });
        }
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
