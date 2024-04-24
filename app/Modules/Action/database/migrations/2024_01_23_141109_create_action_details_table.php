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
        Schema::create('action_details', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("oldvalue");
            $table->string("newvalue");
            $table->string("table_name");
            $table->string("column_name");
            $table->string("line_id");
            $table->bigInteger('action_id')->unsigned();
            $table->foreign('action_id')->references('id')->on('actions')
                ->onDelete('cascade');
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
        Schema::dropIfExists('action_details');
    }
};
