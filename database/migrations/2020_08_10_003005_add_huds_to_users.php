<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHudsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function (Blueprint $table) {
        if(!Schema::hasColumn('users', 'huds')){
          $table->string('huds', 191)->nullable()->after('pride_friendly');
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
      Schema::table('users', function (Blueprint $table) {
        if(Schema::hasColumn('users', 'huds')){
          $table->dropColumn(['huds']);
        }
      });
    }
}
