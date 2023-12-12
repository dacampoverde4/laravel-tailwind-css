<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketitSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ticketit_settings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('lang', 191)->nullable()->unique();
			$table->string('slug', 191)->index();
			$table->text('value', 16777215);
			$table->text('default', 16777215);
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
		Schema::drop('ticketit_settings');
	}

}
