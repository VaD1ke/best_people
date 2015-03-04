<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToVotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('votes', function(Blueprint $table)
		{
			$table->foreign('who_voted_id')
				->references('id')->on('users')
				->onDelete('cascade');
			$table->foreign('whom_voted_id')
				->references('id')->on('users')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('votes', function(Blueprint $table)
		{
			//
		});
	}

}
