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
            $table->string('user_id')->nullable();
            $table->timestamp('staff_out')->nullable()->default(null);
            $table->timestamp('staff_in')->nullable()->default(null);
            $table->string('student_out')->nullable();
            $table->string('student_in')->nullable();
            $table->text('note')->nullable();
            $table->integer('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->integer('count_request');
            $table->integer('auth_id');
            $table->integer('gate_note_id')->default(0);
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
