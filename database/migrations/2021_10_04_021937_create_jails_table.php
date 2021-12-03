<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jails', function (Blueprint $table) {
            $table->id();

            /*required columns*/
            $table->string('name', 45);
            $table->string('code', 45);
            $table->enum('type', ['low', 'medium', 'high']);
            $table->unsignedBigInteger('capacity');
            $table->boolean('state')->default(true);

            /*nullable columns*/
            $table->string('description')->nullable();

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
        Schema::dropIfExists('jails');
    }
}
