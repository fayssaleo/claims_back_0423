<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->date("claim_date")->nullable();
            $table->date("incident_date")->nullable();
            $table->string("ClaimOrIncident")->nullable();
            $table->string("status");
            $table->string("incident_report")->nullable();
            $table->string("type")->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {

        Schema::dropIfExists('claims');
    }
};
