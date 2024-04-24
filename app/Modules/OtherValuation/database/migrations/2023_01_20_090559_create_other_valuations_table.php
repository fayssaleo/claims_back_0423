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
        Schema::create('other_valuations', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("name")->nullable();
            $table->string("currency")->nullable();
            $table->double('value', 20, 4)->nullable();
            $table->double('taux_change', 20, 4)->nullable();
            $table->double('value_valuation', 20, 4)->nullable();

            $table->bigInteger('estimate_id')->unsigned()->nullable();
            $table->foreign('estimate_id')->references('id')->on('estimates')->onDelete('cascade');


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
        Schema::dropIfExists('other_valuations');
    }
};
