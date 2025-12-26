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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id()->autoincrement()->notnull();
            $table->string('invoice_number')->unique();
            $table->string('nama_tujuan');
            $table->string('alamat_tujuan');
            $table->text('items');
            $table->integer('quantity');
            $table->decimal('price_per_item', 15, 2);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
