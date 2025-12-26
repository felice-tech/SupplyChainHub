<?php

namespace Database\Factories;

use App\Models\StockBarang;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockBarangFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StockBarang::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $hargaBeli = $this->faker->numberBetween(1000, 100000);
        $hargaJual = $hargaBeli + $this->faker->numberBetween(100, 5000);

        return [
            'kode_barang' => 'KB' . $this->faker->numerify('#####'),
            'nama_barang' => $this->faker->word(),
            'satuan' => $this->faker->randomElement(['pcs', 'set', 'box']),
            'harga_beli_satuan' => $hargaBeli,
            'harga_jual_satuan' => $hargaJual,
            'stok_awal' => $this->faker->numberBetween(0, 500),
            'stok_masuk' => $this->faker->numberBetween(0, 100),
            'stok_keluar' => $this->faker->numberBetween(0, 100),
            'tanggal' => $this->faker->datetime(),
            'keterangan' => $this->faker->sentence(),
        ];
    }
}
