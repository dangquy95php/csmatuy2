<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_students', function (Blueprint $table) {
            $table->id();
            $table->string('staff_name');
            $table->string('car_number')->nullable();
            $table->string('number_of_drug_addicts')->nullable();
            $table->boolean('type_gate');// 0 ra cong, 1 vao cong
            $table->string('note')->nullable();
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
        Schema::dropIfExists('guest_students');
    }
}
