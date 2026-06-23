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
        Schema::table('menu_items', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->nullable()->change();
            $table->decimal('hot_price', 10, 2)->nullable()->after('price');
            $table->decimal('cold_price', 10, 2)->nullable()->after('hot_price');
            $table->decimal('whole_price', 10, 2)->nullable()->after('cold_price');
            $table->decimal('slice_price', 10, 2)->nullable()->after('whole_price');
            $table->text('notes')->nullable()->after('slice_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropColumn(['hot_price', 'cold_price', 'whole_price', 'slice_price', 'notes']);
            $table->decimal('price', 10, 2)->nullable(false)->change();
        });
    }
};
