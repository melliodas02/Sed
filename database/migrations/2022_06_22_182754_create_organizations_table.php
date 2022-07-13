<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();

            $table->string('OrganizationName');
            $table->string('OrganizationAbbreviatedName');
            $table->string('OrganizationAddress');
            $table->string('PositionAtWork');
            $table->string('INN');
            $table->string('FirstName');
            $table->string('MiddleName');
            $table->string('LastName');
            $table->string('Phone')->nullable(true);
            $table->string('Email')->nullable(true);
            $table->string('Fax')->nullable(true);

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
        Schema::dropIfExists('organizations');
    }
}
