<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('username', 20)->unique();
            $table->string('full_name', 500);
            $table->string('email')->unique();
            $table->string('address', 255)->nullable()->default(NULL);
            $table->string('phone_number', 20)->unique()->nullable()->default(NULL);
            $table->string('password');
            $table->string('photo', 1000)->nullable()->default(NULL);
            $table->boolean('active')->default(TRUE);
            $table->boolean('built_in')->default(FALSE);
            $table->string('firebase_token', 255)->nullable()->default(NULL);
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
