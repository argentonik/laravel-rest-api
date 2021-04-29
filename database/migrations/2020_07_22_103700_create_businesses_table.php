<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->string('name');
            $table->text('description');
            $table->unsignedBigInteger('category_id');
            $table->tinyInteger('raiting');
            $table->string('phone');
            $table->string('email');
            $table->string('website');
            $table->timestamps();
        });

        Schema::table('businesses', function(Blueprint $table) {
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');    
            $table->foreign('category_id')->references('id')->on('categories')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('businesses');
    }
}
