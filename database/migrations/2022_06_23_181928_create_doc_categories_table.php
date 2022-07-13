<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('docType');
            $table->timestamps();

            $table->foreign('docType')->references('id')->on('doc_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doc_categories');
    }
}
