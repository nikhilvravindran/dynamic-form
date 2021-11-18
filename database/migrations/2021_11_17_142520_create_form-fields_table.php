<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form-fields', function (Blueprint $table) {
            $table->id();
            $table->string('fieldname');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('form-fields')->insert(
            ['fieldname' => 'input-text'],
        );
         DB::table('form-fields')->insert(
            ['fieldname' => 'dropdown'],
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('form');
    }
}
