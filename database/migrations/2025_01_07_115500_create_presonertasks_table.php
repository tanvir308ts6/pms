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
            $table->string('task_id');
            $table->string('pin_no');
            $table->date('date');
            $table->time('start_at');
            $table->time('end_at');
            $table->text('description')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('marks')->nullable();
            $table->string('task_status');
            $table->string('status')->nullable();
            $table->string('ass_id');
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
