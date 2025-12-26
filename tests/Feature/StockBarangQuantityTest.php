<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\StockBarang;

class StockBarangQuantityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function store_calculates_quantity_for_masuk()
    {
        $response = $this->post('/home/stock-barangs', [
            'kode_barang' => 'TST-001',
            'nama_barang' => 'Test Item',
            'satuan' => 'Pcs',
            'movement' => 'masuk',
            'stok_awal' => 5,
            'stok_masuk' => 3,
            'harga_beli_satuan' => 12.5,
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('stock_barangs', [
            'kode_barang' => 'TST-001',
            'quantity' => 8, // 5 + 3 - 0
        ]);
    }

    /** @test */
    public function update_recomputes_quantity_server_side()
    {
        $item = StockBarang::create([
            'kode_barang' => 'TST-002',
            'nama_barang' => 'Existing',
            'satuan' => 'Box',
            'harga_beli_satuan' => 10,
            'harga_jual_satuan' => 0,
            'stok_awal' => 2,
            'stok_masuk' => 1,
            'stok_keluar' => 0,
            'quantity' => 3,
        ]);

        $response = $this->put('/home/stock-barangs/' . $item->id, [
            'kode_barang' => 'TST-002',
            'nama_barang' => 'Existing',
            'satuan' => 'Box',
            'harga_beli_satuan' => 10,
            'stok_awal' => 2,
            'stok_masuk' => 4,
            'stok_keluar' => 1,
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('stock_barangs', [
            'id' => $item->id,
            'quantity' => 5, // 2 + 4 - 1
        ]);
    }
}
