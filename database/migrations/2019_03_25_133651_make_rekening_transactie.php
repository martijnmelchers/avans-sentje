<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeRekeningTransactie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekening_transactie', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double("amount", 19,4);
            $table->string('from',50);
            $table->string('to', 50);
            $table->timestamps();

            $table->foreign('from')->references('nummer')->on('rekeningen');
            $table->foreign('to')->references('nummer')->on('rekeningen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekening_transactie');
    }
}
