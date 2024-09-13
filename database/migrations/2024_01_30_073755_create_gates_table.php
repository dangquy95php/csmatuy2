<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gates', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->time('staff_out')->nullable();
            $table->time('staff_in')->nullable();
            $table->string('student_out')->nullable();
            $table->string('student_in')->nullable();
            $table->text('note')->nullable();
            $table->integer('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->integer('count_request')->nullable();
            $table->integer('auth_id')->nullable();
            $table->integer('gate_note_id')->nullable();
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
        Schema::dropIfExists('gates');
    }
}
