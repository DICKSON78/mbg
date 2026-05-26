<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('product_type')->default('physical')->after('purchase_url');
            $table->string('digital_file')->nullable()->after('product_type');
            $table->integer('stock')->nullable()->after('digital_file');
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['product_type', 'digital_file', 'stock']);
        });
    }
};
