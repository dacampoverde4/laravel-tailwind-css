<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHudsToUsergroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('usergroups', function (Blueprint $table) {
        if(!Schema::hasColumn('usergroups', 'huds')){
          $table->string('huds', 191)->nullable()->after('adoption_request_roles');
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
        if(Schema::hasColumn('usergroups', 'huds')){
          $table->dropColumn(['huds']);
        }
      });
    }
}
