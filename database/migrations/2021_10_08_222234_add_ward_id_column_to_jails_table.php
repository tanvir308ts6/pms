<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWardIdColumnToJailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jails', function (Blueprint $table) {
            /*ward id foreign key*/
            $table->unsignedBigInteger('ward_id');
            $table->foreign('ward_id')
                ->references('id')
                ->on('wards')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jails', function (Blueprint $table) {
            $table->dropForeign(['ward_id']);
        });
    }
}
