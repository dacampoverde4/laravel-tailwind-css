<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdoptIsDissolveAdoptDissolveByColumnsToTrialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      if (!Schema::hasColumn('trials', 'adopt_is_dissolve')){
          Schema::table('trials', function (Blueprint $table) {
              $table->integer('adopt_is_dissolve')->nullable()->default(0);
          });
      }

      if (!Schema::hasColumn('trials', 'adopt_dissolve_by')){
          Schema::table('trials', function (Blueprint $table) {
              $table->integer('adopt_dissolve_by')->nullable();
          });
      }

      if (!Schema::hasColumn('trials', 'trial_end_reason')){
          Schema::table('trials', function (Blueprint $table) {
              $table->string('trial_end_reason')->nullable();
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
