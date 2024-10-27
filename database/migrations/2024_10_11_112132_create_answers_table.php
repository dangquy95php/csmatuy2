<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('answers');
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->string('question_id', 255)->nullable();
            $table->text('question_name');
            $table->integer('contest_id');
            $table->text('answer')->nullable();
            $table->integer('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('result')->nullable();
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
        Schema::dropIfExists('answers');
    }
}
