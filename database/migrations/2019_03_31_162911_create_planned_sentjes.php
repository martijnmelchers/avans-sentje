<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlannedSentjes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planned_sentjes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->text('message');
            $table->double("amount", 19,4);
            $table->date('planned');
            $table->boolean('recurring');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planned_sentjes');
    }
}
