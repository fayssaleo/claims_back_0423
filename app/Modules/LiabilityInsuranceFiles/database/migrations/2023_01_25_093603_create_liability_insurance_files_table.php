<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liability_insurance_files', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("filename")->unique();
            $table->string("type");

            $table->bigInteger('equipment_id')->unsigned()->nullable();
            $table->foreign('equipment_id')->references('id')->on('equipment')->onDelete('cascade');

            $table->bigInteger('automobile_id')->unsigned()->nullable();
            $table->foreign('automobile_id')->references('id')->on('automobiles')->onDelete('cascade');

            $table->bigInteger('vessel_id')->unsigned()->nullable();
            $table->foreign('vessel_id')->references('id')->on('vessels')->onDelete('cascade');

            $table->bigInteger('container_id')->unsigned()->nullable();
            $table->foreign('container_id')->references('id')->on('containers')->onDelete('cascade');



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
        Schema::dropIfExists('liability_insurance_files');
    }
};
