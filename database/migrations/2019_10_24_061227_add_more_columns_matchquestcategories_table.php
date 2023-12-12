<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreColumnsMatchquestcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('match_quest_categories', 'description')){
            Schema::table('match_quest_categories', function (Blueprint $table) {
                $table->string('description')->nullable();
            });
        }
        if (!Schema::hasColumn('match_quest_categories', 'banner')){
            Schema::table('match_quest_categories', function (Blueprint $table) {
                $table->string('banner')->nullable();
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
