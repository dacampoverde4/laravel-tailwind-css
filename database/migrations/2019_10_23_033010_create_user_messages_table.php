<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_messages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('reciever_id');
			$table->integer('parent_id')->nullable();
			$table->text('message', 65535);
			$table->boolean('is_sent')->default(1);
			$table->integer('is_draft')->default(0);
			$table->boolean('is_reciever_deleted')->default(0);
			$table->boolean('is_sender_deleted')->default(0);
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
		Schema::drop('user_messages');
	}

}
