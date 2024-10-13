<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('contests');
        Schema::create('contests', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200)->unique();
            $table->text('description')->nullable();
            $table->boolean('status')->default(0);
            $table->integer('time_test')->nullable();
            $table->integer('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('contests');
    }
}
