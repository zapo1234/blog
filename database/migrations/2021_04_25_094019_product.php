<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('products', function (Blueprint $table) {
            $table->id(); // L'identifiant
            $table->bigInteger('user_id')->unsigned();
            $table->string('name'); // Le nom ou titre
            $table->text("description"); // La description
            $table->double("price"); // Le prix
            $table->timestamps(); // created_at, updated_at
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
