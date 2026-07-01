<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('whatsapp_number')->nullable()->after('description');
            $table->date('viva_date')->nullable()->after('deadline');
            $table->string('budget_range')->nullable()->after('viva_date');
            $table->string('package')->nullable()->after('budget_range');
            $table->boolean('portfolio_permission')->default(false)->after('package');
            $table->string('referred_by')->nullable()->after('portfolio_permission');
            $table->text('additional_notes')->nullable()->after('referred_by');
            $table->string('payment_status')->default('unpaid')->after('status');
            $table->decimal('deposit_amount', 10, 2)->nullable()->after('payment_status');
            $table->decimal('total_amount', 10, 2)->nullable()->after('deposit_amount');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'whatsapp_number',
                'viva_date',
                'budget_range',
                'package',
                'portfolio_permission',
                'referred_by',
                'additional_notes',
                'payment_status',
                'deposit_amount',
                'total_amount',
            ]);
        });
    }
};
