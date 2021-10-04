<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cells', function (Blueprint $table) {
            $table->id();

            /*required columns*/
            $table->string('name',45);
            $table->string('code');
            $table->enum('type', ['low', 'medium', 'high']);
            $table->string('description');
            $table->unsignedBigInteger('capacity');
            $table->boolean('state')->default(true);

            /*special columns*/
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
        Schema::dropIfExists('cells');
    }
}
