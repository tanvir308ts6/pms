<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCellUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cell_user', function (Blueprint $table) {
            $table->id();

            /*required columns*/
            $table->unsignedBigInteger('cell_id');
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('cell_user');
    }
}
