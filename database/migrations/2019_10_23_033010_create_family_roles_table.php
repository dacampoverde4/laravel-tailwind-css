<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFamilyRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('family_roles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 50);
			$table->enum('gender', array('male','female'))->nullable()->default('male');
			$table->timestamps();
			$table->integer('sort')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('family_roles');
	}

}
