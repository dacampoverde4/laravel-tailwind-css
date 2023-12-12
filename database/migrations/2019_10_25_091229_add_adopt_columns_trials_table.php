<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdoptColumnsTrialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('trials', 'adopt_is_accepted')){
            Schema::table('trials', function (Blueprint $table) {
                $table->integer('adopt_is_accepted')->nullable()->default(0);
            });
        }

        if (!Schema::hasColumn('trials', 'adopt_is_decline')){
            Schema::table('trials', function (Blueprint $table) {
                $table->integer('adopt_is_decline')->nullable()->default(0);
            });
        }

        if (!Schema::hasColumn('trials', 'auto_ended')){
            Schema::table('trials', function (Blueprint $table) {
                $table->integer('auto_ended')->nullable()->default(0);
            });
        }

        if (!Schema::hasColumn('trials', 'reschedule_count')){
            Schema::table('trials', function (Blueprint $table) {
                $table->integer('reschedule_count')->nullable()->default(0);
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
