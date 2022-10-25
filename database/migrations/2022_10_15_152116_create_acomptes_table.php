<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcomptesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acomptes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prix');
            $table->integer('details_prestation_id')->unsigned();
            $table->foreign('details_prestation_id')
                ->references('id')->on('details_prestations')
                ->onDelete('cascade');
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
        Schema::dropIfExists('acomptes');
    }
}
