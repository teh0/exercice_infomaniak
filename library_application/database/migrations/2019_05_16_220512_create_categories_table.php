<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Category;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->string('url_logo')->nullable();
            $table->timestamps();
        });

        App\Category::create([
            'name'=>'PHP',
            'slug'=>'php',
        ]);
        App\Category::create([
            'name'=>'JavaScript',
            'slug'=>'javascript',
        ]);
        App\Category::create([
            'name'=>'HTML',
            'slug'=>'html',
        ]);
        App\Category::create([
            'name'=>'CSS',
            'slug'=>'css',
        ]);
        App\Category::create([
            'name'=>'Python',
            'slug'=>'python',
        ]);
        App\Category::create([
            'name'=>'NodeJs',
            'slug'=>'nodejs',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
