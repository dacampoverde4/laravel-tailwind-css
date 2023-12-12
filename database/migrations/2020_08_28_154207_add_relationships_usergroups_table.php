<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipsUsergroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usergroups', function (Blueprint $table) {
            if(!Schema::hasColumn('usergroups', 'relationships')){
                $table->string('relationships', 191)->nullable()->after('tags');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usergroups', function (Blueprint $table) {
            if(Schema::hasColumn('usergroups', 'relationships')){
                $table->dropColumn(['relationships']);
            }
        });
    }
}
