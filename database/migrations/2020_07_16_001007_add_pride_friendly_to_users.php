<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrideFriendlyToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function (Blueprint $table) {
        if(!Schema::hasColumn('users', 'pride_friendly')){
          $table->string('pride_friendly')->nullable();
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
        if(Schema::hasColumn('users', 'pride_friendly')){
          $table->dropColumn(['pride_friendly']);
        }
      });
    }
}
