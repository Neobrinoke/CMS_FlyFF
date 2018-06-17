<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopItemsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shop_items', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('category_id')->index();
			$table->unsignedInteger('shop_id')->index();
			$table->integer('sale_type');
			$table->string('title');
			$table->longText('description')->nullable();
			$table->integer('price');
			$table->string('image_thumbnail');
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
		Schema::dropIfExists('shop_items');
	}
}
