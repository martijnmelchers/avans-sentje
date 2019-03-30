<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableLengths extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rekening_transactie', function (Blueprint $table) {
            $table->dropForeign('rekening_transactie_from_foreign');
            $table->dropForeign('rekening_transactie_to_foreign');
        });

        Schema::table('sentje', function (Blueprint $table) {
            $table->dropForeign('sentje_nummer_foreign');
        });

        Schema::table('rekeningen', function (Blueprint $table) {
            $table->string('nummer',200)->change();
            $table->string('name', 200)->change();
        });

        Schema::table('sentje', function (Blueprint $table) {
            $table->string('nummer',200)->change();
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
        Schema::table('sentje', function (Blueprint $table) {
            $table->string('nummer')->change();
        });

        Schema::table('rekeningen', function (Blueprint $table) {
            $table->string('nummer',50)->change();
            $table->string('name')->change();
        });
    }
}
