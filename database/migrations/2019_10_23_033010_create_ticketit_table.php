<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketitTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ticketit', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('subject', 191)->index();
			$table->text('content');
			$table->text('html')->nullable();
			$table->integer('status_id')->unsigned()->index();
			$table->integer('priority_id')->unsigned()->index();
			$table->integer('user_id')->unsigned()->index();
			$table->integer('agent_id')->unsigned()->index();
			$table->integer('category_id')->unsigned()->index();
			$table->timestamps();
			$table->dateTime('completed_at')->nullable()->index();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ticketit');
	}

}
