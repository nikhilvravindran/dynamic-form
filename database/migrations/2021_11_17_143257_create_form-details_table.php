<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('form-details', function (Blueprint $table) {
            $table->id();
            $table->integer('form_id');
            $table->integer('form_field_id');
            $table->string('fieldname');
            $table->string('fieldtype');
            $table->string('fieldlabel');
            $table->string('options');
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
        Schema::dropIfExists('form-fields');
    }
}
