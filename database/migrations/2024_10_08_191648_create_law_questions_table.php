<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLawQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('law_questions', function (Blueprint $table) {
            $table->id();
            $table->string('question_id', 255)->nullable();
            $table->text('question_name');
            $table->integer('contest_id');
            $table->text('a');
            $table->text('b');
            $table->text('c');
            $table->text('d');
            $table->boolean('random')->default(0);
            $table->integer('point')->default(1);           
            $table->char('answer', 2);
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
        Schema::dropIfExists('law_questions');
    }
}

