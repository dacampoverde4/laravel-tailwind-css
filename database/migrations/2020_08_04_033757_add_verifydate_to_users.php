<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVerifydateToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function (Blueprint $table) {
        if(!Schema::hasColumn('users', 'verifydate')){
          $table->dateTime('verifydate')->nullable()->after('verify');
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
        if(Schema::hasColumn('users', 'verifydate')){
          $table->dropColumn(['verifydate']);
        }
      });
    }
}
