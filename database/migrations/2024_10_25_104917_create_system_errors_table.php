<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemErrorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('system_errors');
        Schema::create('system_errors', function (Blueprint $table) {
            $table->id();
            $table->text('message')->nullable();
            $table->string('file', 255)->nullable();
            $table->string('line', 255)->nullable();
            $table->string('code', 255)->nullable();
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
        Schema::dropIfExists('system_errors');
    }
}
