<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTokensColumnsPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('plans', 'tokens')){
            Schema::table('plans', function (Blueprint $table) {
                $table->integer('tokens')->default(0);
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
        if (Schema::hasColumn('plans', 'tokens')){
            Schema::table('plans', function (Blueprint $table) {
                $table->dropColumn('tokens');
            });
        }
    }
}
