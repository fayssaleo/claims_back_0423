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
        Schema::create('equipment_matricules', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("id_equipment")->nullable();
            $table->string("id_automobile")->nullable();
            $table->string("matricule")->nullable();
            $table->string("equipment")->nullable();
            $table->string("brand")->nullable();

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
        Schema::dropIfExists('equipment_matricules');
    }
};
