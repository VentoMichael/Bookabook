<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// TODO:academic_years table problems
class CreateSalesTable extends Migration {

    public function up()
    {
        Schema::create('sales', function(Blueprint $table) {
            $table->increments('id');
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
            $table->float('public-price');
            $table->float('price');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    public function down()
    {
        Schema::drop('sales');
    }
}
