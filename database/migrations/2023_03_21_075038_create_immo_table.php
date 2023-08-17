<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImmoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('immo', function (Blueprint $table) {
            $table->id();
            $table->string('code_barre', 12);
            $table->unsignedBigInteger('id_details_reception')->index();
            $table->unsignedBigInteger('id_emplacement')->index()->nullable();
            $table->timestamps();

            $table->foreign('id_details_reception')->references('id')->on('details_reception');
        });
    }

    public function down()
    {
        Schema::dropIfExists('immo');
    }
}
