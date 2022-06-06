<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type',['text','email','number','long_text','file','map','url']);
            $table->longText('ar_value')->nullable();
            $table->longText('en_value')->nullable();
            $table->string('page')->nullable();
            $table->string('slug')->nullable();
            $table->string('ar_title')->nullable();
            $table->string('en_title')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
