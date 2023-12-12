<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSecondLifeUsersNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('second_life_users_notifications', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('uuid', 50)->nullable();
			$table->string('type', 50)->nullable();
			$table->text('message', 65535)->nullable();
			$table->boolean('read')->default(0)->comment('0:unread, 1:read');
			$table->integer('created_time')->default(0);
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
		Schema::drop('second_life_users_notifications');
	}

}
