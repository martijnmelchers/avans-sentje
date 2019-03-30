<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableLengthsSecond extends Migration
{
      /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sentje', function (Blueprint $table) {
            $table->dropForeign('sentje_nummer_foreign');
        });

        Schema::table('rekeningen', function (Blueprint $table) {
            $table->string('nummer',216)->change();
            $table->string('name', 216)->change();
        });

        Schema::table('sentje', function (Blueprint $table) {
            $table->string('nummer',216)->change();
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
