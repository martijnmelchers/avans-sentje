<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixRekeningTransacties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rekening_transactie', function(Blueprint $table){
            $table->dropColumn('from');
            $table->dropColumn('to');
        });

        Schema::table('rekening_transactie', function(Blueprint $table){
            $table->unsignedBigInteger('from');
            $table->unsignedBigInteger('to');
            $table->foreign('from')->references('id')->on('rekeningen');
            $table->foreign('to')->references('id')->on('rekeningen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
