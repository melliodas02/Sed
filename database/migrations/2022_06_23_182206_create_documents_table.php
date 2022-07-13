<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('doc_number')->nullable(true);
            $table->text('Description')->nullable(true);
            $table->date('Date');
            $table->unsignedBigInteger('Category');
            $table->unsignedBigInteger('Signatory');
            $table->unsignedBigInteger('Sender')->nullable(true);

            $table->timestamps();

            $table->foreign('Category')->references('id')->on('doc_categories')->onDelete('cascade');
            $table->foreign('Signatory')->references('id')->on('organizations')->onDelete('cascade');
            $table->foreign('Sender')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
