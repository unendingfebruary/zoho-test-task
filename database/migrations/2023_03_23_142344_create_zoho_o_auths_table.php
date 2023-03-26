<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('zoho_oauth', function (Blueprint $table) {
            $table->id();
            $table->string('refresh_token')->index();
            $table->string('access_token');
            $table->timestamp('expires_at');
            $table->string('api_domain')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zoho_oauth');
    }
};
