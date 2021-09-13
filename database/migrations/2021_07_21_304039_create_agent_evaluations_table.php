<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_evaluations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('agent_id')->unsigned();
            $table->date('evaluation_date');
            $table->string('primary_function');
            $table->bigInteger('market_id')->unsigned();
            $table->bigInteger('skillset_id');
            $table->bigInteger('teamleader_id')->unsigned();
            $table->bigInteger('observation_type_id')->unsigned();
            $table->bigInteger('classification_id')->unsigned();
            $table->string('customer_query');
            $table->string('agent_response');
            $table->bigInteger('query_category_id')->unsigned();
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            $table->foreign('agent_id')
            ->references('id')
            ->on('agents')
            ->onUpdate('cascade')
            ->onDelete('cascade');


            $table->foreign('market_id')
            ->references('id')
            ->on('markets')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('teamleader_id')
            ->references('id')
            ->on('teamleaders')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('observation_type_id')
            ->references('id')
            ->on('observation_types')
            ->onUpdate('cascade')
            ->onDelete('cascade');


            $table->foreign('classification_id')
            ->references('id')
            ->on('classifications')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('query_category_id')
            ->references('id')
            ->on('query_categories')
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
        Schema::dropIfExists('agent_evaluations');
    }
}
