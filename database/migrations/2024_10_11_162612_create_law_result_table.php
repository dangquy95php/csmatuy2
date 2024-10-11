<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLawResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('law_results');
        Schema::create('law_results', function (Blueprint $table) {
            $table->id();
            $table->timestamp("time_start")->nullable();
            $table->timestamp("time_end")->nullable();
            $table->integer('forecast')->default(1);
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
        Schema::dropIfExists('law_results');
    }
}
