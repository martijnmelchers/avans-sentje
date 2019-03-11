<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRekeningenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekeningen', function (Blueprint $table) {
            $table->string('nummer',50);
            $table->string('name');
            $table->double('saldo', 19,4);
            $table->timestamps();
            $table->primary('nummer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekeningen');
    }
}
