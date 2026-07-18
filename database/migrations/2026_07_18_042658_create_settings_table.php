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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('whatsapp_number'); // digits only, no +, e.g. 6282162599980 — used to build wa.me links
            $table->string('whatsapp_display'); // formatted for display, e.g. +62 821-6259-9980
            $table->string('email');
            $table->string('instagram_handle')->nullable(); // without the leading @
            $table->string('address');
            $table->string('farm_url'); // sister site: Gundaling Farm
            $table->string('pims_url'); // parent hub: PIMS Gundaling
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
