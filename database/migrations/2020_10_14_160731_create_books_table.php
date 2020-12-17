<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('picture')->nullable();
            $table->string('title');
            $table->string('author');
            $table->string('orientation');
            $table->string('academic_years');
            $table->string('publishing_house');
            $table->boolean('is_draft')->default(false);
            $table->string('isbn');
            $table->text('presentation')->nullable();
            $table->smallInteger('public_price');
            $table->smallInteger('proposed_price');
            $table->smallInteger('stock')->unsigned();
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
