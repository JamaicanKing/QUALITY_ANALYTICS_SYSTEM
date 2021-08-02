<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('username');
            $table->string('email');
            $table->bigInteger('teamleader_id')->unsigned();
            $table->bigInteger('primary_function_id')->unsigned();
            $table->bigInteger('department_id')->unsigned();
            $table->bigInteger('classification_id')->unsigned();
            $table->bigInteger('location_id')->unsigned();
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            
            $table->foreign('teamleader_id')
            ->references('id')
            ->on('teamleaders')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('primary_function_id')
            ->references('id')
            ->on('primary_functions')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('department_id')
            ->references('id')
            ->on('departments')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('classification_id')
            ->references('id')
            ->on('classifications')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('location_id')
            ->references('id')
            ->on('locations')
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
        Schema::dropIfExists('agents');
    }
}
