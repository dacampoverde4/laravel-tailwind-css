<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('title')->nullable();
			$table->text('content', 65535)->nullable();
			$table->string('image')->nullable();
			$table->string('category')->nullable();
			$table->dateTime('date')->nullable();
			$table->string('location')->nullable();
			$table->text('location_url', 65535)->nullable();
			$table->integer('author_id')->nullable();
			$table->integer('suspend')->default(0);
			$table->integer('feature')->default(0);
			$table->integer('free_tokens')->nullable()->default(0);
			$table->integer('price')->nullable()->default(0);
			$table->text('cover_pic', 65535)->nullable();
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
		Schema::drop('events');
	}

}
