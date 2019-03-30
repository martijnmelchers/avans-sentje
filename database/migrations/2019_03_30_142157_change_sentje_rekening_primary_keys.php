<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeSentjeRekeningPrimaryKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sentje', function(Blueprint $table){
            $table->dropForeign('sentje_nummer_foreign');
            $table->dropColumn('nummer');
        });


        Schema::table('rekeningen', function (Blueprint $table) {
            $table->dropPrimary();
        });

        Schema::table('rekeningen', function (Blueprint $table) {
            $table->bigIncrements('id');
        });
        
        Schema::table('sentje', function (Blueprint $table) {
            $table->unsignedBigInteger('rekening_id');
            $table->foreign("rekening_id")->references("id")->on("rekeningen");
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
