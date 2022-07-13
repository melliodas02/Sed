<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentInDocsSavedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_in_docs_saveds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Document');
            $table->unsignedBigInteger('DocsSaved');
            $table->timestamps();

            $table->foreign('Document')->references('id')->on('documents')->onDelete('cascade');
            $table->foreign('DocsSaved')->references('id')->on('docs_saveds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_in_docs_saveds');
    }
}
