<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class  MakeLocationOptionalInSentjeTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sentje_transaction', function (Blueprint $table) {
            //
            $table->dropColumn('locatie');
            $table->string('location')->nullable()->default("");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sentje_transaction', function (Blueprint $table) {
            //
        });
    }
}
