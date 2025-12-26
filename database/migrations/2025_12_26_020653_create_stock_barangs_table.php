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
        Schema::create('stock_barangs', function (Blueprint $table) {
        $table->id();
        $table->string('kode_barang')->unique(); // Matches 'KB' . numerify
        $table->string('nama_barang');
        $table->string('satuan', 20); // 'pcs', 'set', 'box'
        $table->decimal('harga_beli_satuan', 15, 2); // Use decimal for currency
        $table->decimal('harga_jual_satuan', 15, 2);
        $table->integer('stok_awal')->default(0);
        $table->integer('stok_masuk')->default(0);
        $table->integer('stok_keluar')->default(0);
        $table->dateTime('tanggal');
        $table->text('keterangan')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
