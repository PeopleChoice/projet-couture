<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandeBoutiqueDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commande_boutique_details', function (Blueprint $table) {
            $table->increments("id");
            $table->string('prix');
            $table->string('qt');
            $table->string('id_produit');
            $table->integer('commande_boutique_id')->unsigned();
            $table->foreign('commande_boutique_id')
                ->references('id')->on('commande_boutiques')
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
        Schema::dropIfExists('commande_boutique_details');
    }
}
