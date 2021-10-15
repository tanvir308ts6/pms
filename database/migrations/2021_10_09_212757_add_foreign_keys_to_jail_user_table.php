<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToJailUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jail_user', function (Blueprint $table) {
            /*user id and jail id foreign key*/
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('jail_id')
                ->references('id')
                ->on('jails')
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
        Schema::table('jail_user', function (Blueprint $table) {
            $table->dropForeign('jail_user_user_id_foreign');
            $table->dropForeign('jail_user_jail_id_foreign');
        });
    }
}
