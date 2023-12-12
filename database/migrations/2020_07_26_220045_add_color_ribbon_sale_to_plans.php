<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColorRibbonSaleToPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('plans', function (Blueprint $table) {
        if(!Schema::hasColumn('plans', 'plan_color')){
          $table->string('plan_color', 191)->nullable()->after('features');
        }
        if(!Schema::hasColumn('plans', 'best_seller_ribbon')){
          $table->string('best_seller_ribbon', 191)->nullable()->after('plan_color');
        }
        if(!Schema::hasColumn('plans', 'plan_sale')){
          $table->integer('plan_sale')->nullable()->after('best_seller_ribbon');
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
      Schema::table('plans', function (Blueprint $table) {
        if(Schema::hasColumn('plans', 'plan_color')){
          $table->dropColumn(['plan_color']);
        }
        if(Schema::hasColumn('plans', 'best_seller_ribbon')){
          $table->dropColumn(['best_seller_ribbon']);
        }
        if(Schema::hasColumn('plans', 'plan_sale')){
          $table->dropColumn(['plan_sale']);
        }
      });
    }
}
