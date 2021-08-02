<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_results', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('agent_evaluation_id')->unsigned();
            $table->bigInteger('attribute_id')->unsigned();
            $table->bigInteger('rating_id')->unsigned();
            $table->bigInteger('reason_id')->unsigned();
            $table->bigInteger('query_category_id')->unsigned();
            $table->bigInteger('teamleader_id')->unsigned();
            $table->text('comments');
            $table->decimal('score');
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            $table->foreign('agent_evaluation_id')
            ->references('id')
            ->on('agent_evaluations')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('attribute_id')
            ->references('id')
            ->on('attributes')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('rating_id')
            ->references('id')
            ->on('ratings')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('query_category_id')
            ->references('id')
            ->on('query_categories')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('teamleader_id')
            ->references('id')
            ->on('teamleaders')
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
        Schema::dropIfExists('evaluation_results');
    }
}
