<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExemptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('exemptions');
        Schema::create('exemptions', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->integer('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer("contest_id");
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
        Schema::dropIfExists('exemptions');
    }
}
