<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            /*unique columns*/
            $table->string('email')->unique();
            $table->string('username', 20)->unique();

            /*required columns*/
            $table->string('first_name', 35);
            $table->string('last_name', 35);
            $table->string('personal_phone', 10);
            $table->string('home_phone', 9);
            $table->string('address', 50);
            $table->string('password');
            $table->boolean('state')->default(true);

            /*nullable columns*/
            $table->date('birthdate')->nullable();
            $table->timestamp('email_verified_at')->nullable();

            /*special columns*/
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
