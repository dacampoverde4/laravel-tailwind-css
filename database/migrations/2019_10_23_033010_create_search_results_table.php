<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSearchResultsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('search_results', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('seeking_role')->nullable();
			$table->integer('family_role')->nullable();
			$table->integer('usergroup');
			$table->integer('search_usergroup')->nullable();
			$table->integer('gender')->nullable();
			$table->integer('species_id')->unsigned()->nullable()->default(0);
			$table->integer('minage')->nullable();
			$table->integer('maxage')->nullable();
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
		Schema::drop('search_results');
	}

}
