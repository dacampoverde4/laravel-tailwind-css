<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
			$table->string('displayname', 191)->nullable();
			$table->string('email', 191)->unique();
			$table->string('group', 191)->nullable();
			$table->string('gender', 191)->nullable();
			$table->string('age', 191)->nullable();
			$table->string('profile_pic', 191)->nullable()->default('default.jpg');
			$table->string('password', 191);
			$table->boolean('verified')->default(0);
			$table->boolean('role_id')->nullable();
			$table->string('designation');
			$table->integer('category_id');
			$table->integer('species_id')->unsigned()->nullable()->default(0);
			$table->boolean('is_online')->default(0);
			$table->dateTime('last_activity')->nullable()->default('2018-07-17 07:16:27');
			$table->integer('securitypin')->nullable();
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
			$table->string('stripe_id', 191)->nullable();
			$table->string('card_brand', 191)->nullable();
			$table->string('card_last_four', 191)->nullable();
			$table->string('is_deleted')->default('false');
			$table->dateTime('trial_ends_at')->nullable();
			$table->text('about_me', 65535);
			$table->integer('suspend');
			$table->boolean('ticketit_admin')->default(0);
			$table->boolean('ticketit_agent')->default(0);
			$table->string('myfuns')->nullable();
			$table->integer('is_notifications_enable')->default(1);
			$table->integer('is_private')->default(0);
			$table->string('otp')->nullable();
			$table->string('uuid', 50)->nullable();
			$table->string('sl_username', 100)->nullable();
			$table->integer('photo_status')->default(0);
			$table->integer('agree')->default(1);
			$table->dateTime('suspend_exp_time')->nullable();
			$table->text('reason', 65535)->nullable();
			$table->string('ip_address', 39)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
