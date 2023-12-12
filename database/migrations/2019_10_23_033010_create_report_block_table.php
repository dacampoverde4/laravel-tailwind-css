<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReportBlockTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('report_block', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('block_id');
			$table->string('reason', 191)->nullable();
			$table->string('type', 191)->nullable();
			$table->text('description', 65535)->nullable();
			$table->boolean('status')->nullable()->default(0)->comment('0:incomplete, 1:complete');
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
		Schema::drop('report_block');
	}

}
