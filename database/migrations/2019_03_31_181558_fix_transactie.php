<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixTransactie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rekening_transactie', function(Blueprint $table){

            $table->dropForeign(['from']);
            $table->dropForeign(['to']);
            $table->dropColumn('from');
            $table->dropColumn('to');
        });

        Schema::table('rekening_transactie', function(Blueprint $table){
            $table->unsignedBigInteger('to');
            $table->text('from');
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
