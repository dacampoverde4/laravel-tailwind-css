<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobListingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('job_listings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 191)->nullable();
			$table->text('description', 65535)->nullable();
			$table->string('category', 150);
			$table->string('tag_title')->nullable();
			$table->string('company_name', 191)->nullable();
			$table->string('image');
			$table->string('designation');
			$table->string('location', 191)->nullable();
			$table->string('job_type', 191)->nullable();
			$table->integer('salary')->nullable();
			$table->string('salary_type', 50)->nullable();
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
		Schema::drop('job_listings');
	}

}
