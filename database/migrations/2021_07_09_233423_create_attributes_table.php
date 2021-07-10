<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->text('attribute');
            $table->decimal('weightage', 2);
            $table->BigInteger('category_id')->unsigned();
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            $table->foreign('category_id')
            ->references('id')
            ->on('categories')
            ->onUpdate('cascade')
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
        Schema::dropIfExists('attributes');
    }
}
