<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailDocsTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_docs_tables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Mail');
            $table->unsignedBigInteger('MailDoc');
            $table->timestamps();

            $table->foreign('Mail')->references('id')->on('mails')->onDelete('cascade');
            $table->foreign('MailDoc')->references('id')->on('mail_docs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mail_docs_tables');
    }
}
