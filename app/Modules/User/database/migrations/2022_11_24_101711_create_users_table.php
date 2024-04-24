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
        Schema::create('users', function (Blueprint $table) {

            $table->bigIncrements("id");
            $table->string("username");
            $table->string("lastName");
            $table->string("firstName");
            $table->string("email");
            $table->string("password");
            $table->string("phoneNumber");
            $table->bigInteger('fonction_id')->unsigned();
            $table->foreign('fonction_id')->references('id')->on('fonctions')->onDelete('cascade');

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
        Schema::dropIfExists('users');
    }
};
