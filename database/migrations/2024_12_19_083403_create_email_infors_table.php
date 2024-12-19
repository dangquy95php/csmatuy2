<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailInforsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_infors', function (Blueprint $table) {
            $table->id();
            $table->boolean('seen')->nullable();
            $table->integer('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->integer('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('email_id')->references('id')->on('emails')->onDelete('cascade');
            $table->timestamp("time_seen")->nullable();
            $table->boolean('flag')->default(0);
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
        Schema::dropIfExists('email_infors');
    }
}
