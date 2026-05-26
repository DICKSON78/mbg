<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete()->after('service');
            $table->decimal('price', 10, 2)->default(0)->after('service_id');
            $table->string('currency', 10)->default('USD')->after('price');
            $table->time('end_time')->nullable()->after('appointment_time');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropColumn(['service_id', 'price', 'currency', 'end_time']);
        });
    }
};
