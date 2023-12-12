<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWebsiteSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('website_settings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('meta_id')->nullable();
			$table->string('meta_key', 191)->nullable();
			$table->text('meta_value', 65535)->nullable();
			$table->string('type');
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
		Schema::drop('website_settings');
	}

}
