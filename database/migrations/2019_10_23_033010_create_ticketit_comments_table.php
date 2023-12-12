<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketitCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ticketit_comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('content', 65535);
			$table->text('html')->nullable();
			$table->integer('user_id')->unsigned()->index();
			$table->integer('ticket_id')->unsigned()->index();
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
		Schema::drop('ticketit_comments');
	}

}
