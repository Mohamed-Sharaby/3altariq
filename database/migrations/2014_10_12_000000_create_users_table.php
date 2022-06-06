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
            $table->string('name');
            $table->string('country_code');
            $table->string('phone')->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(1);


            $table->string('fcm_token_android')->nullable();
            $table->string('fcm_token_ios')->nullable();

            $table->string('confirmation_code')->nullable();
            $table->string('reset_code')->nullable();
            $table->boolean('is_confirmed')->default(1);

            $table->dateTime('confirmed_at')->nullable();
            $table->dateTime('reset_at')->nullable();

            $table->softDeletes();
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
