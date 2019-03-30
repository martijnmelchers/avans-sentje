<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableLengthsThird extends Migration
{
    public function up()
    {
        Schema::table('sentje', function (Blueprint $table) {
            $table->dropForeign('sentje_nummer_foreign');
        });

        Schema::table('rekeningen', function (Blueprint $table) {
            $table->string('nummer',255)->change();
            $table->string('name', 255)->change();
        });

        Schema::table('sentje', function (Blueprint $table) {
            $table->string('nummer',255)->change();
            $table->foreign("nummer")->references("nummer")->on("rekeningen");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
