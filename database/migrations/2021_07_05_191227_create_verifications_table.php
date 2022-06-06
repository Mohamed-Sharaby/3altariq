<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Provider::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('email');
            $table->enum('status',['pending','approved','rejected'])->default('pending');
            $table->string('ssn');
            $table->text('image')->nullable();
            $table->text('ssn_image')->nullable();
            $table->text('licence_image')->nullable();
            $table->text('car_image')->nullable();
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
        Schema::dropIfExists('verifications');
    }
}
