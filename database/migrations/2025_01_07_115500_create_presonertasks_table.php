<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresonertasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presonertasks', function (Blueprint $table) {
            $table->id();
            $table->integer('task_id');
            $table->string('pin_no');
            $table->string('task_details');
            $table->date('task_date');
            $table->time('start_at');
            $table->time('end_at');
            $table->string('task_evaluate');
            $table->string('remarks');
            $table->string('task_mark');
            $table->string('status');
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
        Schema::dropIfExists('presonertasks');
    }
}
