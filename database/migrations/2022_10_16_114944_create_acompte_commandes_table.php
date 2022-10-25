<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcompteCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acompte_commandes', function (Blueprint $table) {
            $table->increments("id");
            $table->string('prix');
            $table->integer('commande_id')->unsigned();
            $table->foreign('commande_id')
                ->references('id')->on('commande')
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
        Schema::dropIfExists('acompte_commandes');
    }
}
