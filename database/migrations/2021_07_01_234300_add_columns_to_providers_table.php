<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class   AddColumnsToProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('providers', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Country::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('country_code')->nullable();
            $table->string('fcm_token_android')->nullable();
            $table->string('fcm_token_ios')->nullable();
            $table->string('confirmation_code')->nullable();
            $table->string('reset_code')->nullable();
            $table->dateTime('confirmed_at')->nullable();
            $table->dateTime('reset_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('providers', function (Blueprint $table) {
            $table->dropColumn(['country_code','fcm_token_android', 'fcm_token_ios', 'confirmation_code', 'reset_code', 'confirmed_at', 'reset_at']);
            $table->dropConstrainedForeignId('country_id');
        });
    }
}
