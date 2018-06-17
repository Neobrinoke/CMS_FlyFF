<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shops', function (Blueprint $table) {
			$table->increments('id');
			$table->string('label');
			$table->string('image_thumbnail')->nullable();
			$table->timestamps(1);
			$table->softDeletes('deleted_at', 1);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('shops');
	}
}
