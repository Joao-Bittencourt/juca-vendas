<?php

declare(strict_types=1);

use App\Models\PaymentMethod;
use App\Models\Sale;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PaymentMethod::class);
            $table->foreignIdFor(Sale::class)->nullable();
            $table->string('type');
            $table->string('identifier');
            $table->decimal('amount', 10, 2);
            $table->date('date')->nullable();
            $table->date('due_date')->nullable();
            $table->date('paid_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
