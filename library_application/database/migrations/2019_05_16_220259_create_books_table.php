<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->nullable()->unsigned();
            $table->integer('category_id')->nullable()->unsigned();
            $table->string('title');
            $table->string('authors');
            $table->string('small_thumbnail');
            $table->string('large_thumbnail');
            $table->boolean('isBorrowed')->default(false);
            $table->boolean('fromApi')->default(false);
            $table->text('description');
            $table->integer('pageCount');
            $table->string('lang');
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
        Schema::dropIfExists('books');
    }
}
