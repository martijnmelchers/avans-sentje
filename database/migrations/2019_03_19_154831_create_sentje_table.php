    <?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSentjeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sentje', function (Blueprint $table) {
            $table->string("id");
            $table->string("nummer");
            $table->boolean("fixed_amount")->default(true);
            $table->double("amount", 19,4);
            $table->string("title");

            $table->primary("id");
            $table->foreign("nummer")->references("nummer")->on("rekeningen");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sentje');
    }
}
