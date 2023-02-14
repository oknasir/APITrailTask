<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizTakenAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_taken_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('quiz_taken_id');
            $table->unsignedInteger('quiz_question_id');
            $table->unsignedInteger('quiz_answer_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_taken_answers');
    }
}
