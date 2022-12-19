<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('mpn');
            $table->float('price')->nullable();
            $table->float('sale_price')->nullable();
            $table->float('vip_price')->nullable();
            $table->string('stock')->nullable();
            $table->string('availability');
            $table->string('taglia');
            $table->integer('parent_id')->nullable();
            $table->string('title');
            $table->text('description');
            $table->string('link');
            $table->string('image_link');
            $table->string('product_type');
            $table->integer('eta')->nullable();
            $table->string('marche');
            $table->string('genere');
            $table->string('personaggi')->nullable();
            $table->string('colore');
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
        Schema::dropIfExists('products');
    }
};
