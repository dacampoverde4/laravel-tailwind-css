<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsergroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usergroups', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 191)->nullable();
			$table->string('minage', 191)->nullable();
			$table->string('maxage', 191)->nullable();
			$table->string('genderrole', 191)->nullable();
			$table->string('family_roles', 191)->nullable();
			$table->string('adoption_roles', 191)->nullable();
			$table->string('adoption_request_roles', 191)->nullable();
			$table->integer('sort')->default(0);
			$table->string('membership_plans', 191)->nullable();
			$table->string('tags')->nullable();
			$table->string('searchs')->nullable();
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
		Schema::drop('usergroups');
	}

}
