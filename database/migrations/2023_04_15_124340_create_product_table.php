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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->text('information')->nullable();
            $table->float('price')->nullable();
            $table->float('discount_price')->nullable();
            $table->integer('qty')->nullable();
            $table->float('weight')->nullable();
            $table->integer('shipping')->nullable();
            $table->string('image_url', 255)->nullable();
            $table->boolean('status')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('product_category_id')->unsigned();
            $table->foreign('product_category_id')->references('id')->on('product_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
};
