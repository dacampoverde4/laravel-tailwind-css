<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTerminalApiParcelsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('terminal_api_parcels', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('uuid', 50)->nullable();
			$table->string('parcel_name', 191)->nullable();
			$table->string('sl_url', 191)->nullable();
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
		Schema::drop('terminal_api_parcels');
	}

}
