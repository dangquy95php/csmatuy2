<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugAddictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_addicts', function (Blueprint $table) {
            $table->id();
            $table->string('personal_name');
            $table->string('note')->nullable();
            $table->boolean('type_gate');// 0 ra cong, 1 vao cong
            $table->boolean('kind_of_detox')->default(0);// 0 tu nguyen, 1 bat buoc
            $table->string('name_of_drug_addict')->nullable();
            $table->string('car_number')->nullable();
            $table->integer('auth_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('drug_addicts');
    }
}
