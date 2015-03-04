<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameFieldsInVotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('votes', function(Blueprint $table)
		{
			$table->renameColumn('who_votes_id', 'who_voted_id');
			$table->renameColumn('whom_votes_id', 'whom_voted_id');
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
