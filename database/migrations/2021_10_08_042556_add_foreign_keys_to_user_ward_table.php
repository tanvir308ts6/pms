<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUserWardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_ward', function (Blueprint $table) {
            /**
             * User id and ward id foreign keys
             */
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::table('user_ward', function (Blueprint $table) {
//            $table->dropForeign(['user_id', 'ward_id']);
            $table->dropForeign('user_ward_user_id_foreign');
            $table->dropForeign('user_ward_ward_id_foreign');
        });
    }
}
