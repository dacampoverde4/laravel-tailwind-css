<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVerifyRequestToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function (Blueprint $table) {
        if(!Schema::hasColumn('users', 'verify_request')){
          $table->integer('verify_request')->nullable()->after('pride_friendly');
        }
        if(!Schema::hasColumn('users', 'verify')){
          $table->integer('verify')->nullable()->after('verify_request');
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
        if(Schema::hasColumn('users', 'verify_request')){
          $table->dropColumn(['verify_request']);
        }
        if(Schema::hasColumn('users', 'verify')){
          $table->dropColumn(['verify']);
        }
      });
    }
}
