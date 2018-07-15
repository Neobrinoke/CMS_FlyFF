<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('author_id')->index();
            $table->unsignedInteger('assigned_to')->nullable()->index();
            $table->unsignedInteger('category_id')->index();
            $table->string('title');
            $table->longText('content');
            $table->integer('status');
            $table->timestamp('closed_at', 1)->nullable();
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
        Schema::dropIfExists('tickets');
    }
}
