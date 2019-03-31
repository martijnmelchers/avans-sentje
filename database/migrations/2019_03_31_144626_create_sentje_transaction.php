<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSentjeTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sentje_transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sentje_id');

            $table->string('currency');
            $table->double("amount", 19,4);

            $table->double("converted_amount", 19,4);

            $table->string("name");
            $table->text("message");
            $table->string("locatie");

            $table->foreign('sentje_id')->references('id')->on('sentje');

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
        Schema::dropIfExists('sentje_transaction');
    }
}
