<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->text('buyer_address')->nullable()->after('buyer_phone');
            $table->text('buyer_notes')->nullable()->after('buyer_address');
        });
    }

    public function down(): void
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropColumn(['buyer_address', 'buyer_notes']);
        });
    }
};
