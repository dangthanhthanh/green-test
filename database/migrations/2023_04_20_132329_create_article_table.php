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
        Schema::create('article', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable();
            $table->string('slug', 255)->nullable();
            $table->text('description')->nullable();
            $table->string('author')->nullable();
            $table->string('tags')->nullable();
            $table->boolean('is_show')->default(1);
            $table->boolean('is_approved')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('article_category_id');
            $table->foreign('article_category_id')->references('id')->on('article_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article');
    }
};
