<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFeatureUsesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('feature_uses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->boolean('is_subscription_token')->default(0);
			$table->string('token_uses', 191)->nullable();
			$table->integer('userid')->default(0);
			$table->string('featurid', 191)->nullable();
			$table->string('subscriptionid', 191)->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('feature_uses');
	}

}
