<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockBarang extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stock_barangs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'satuan',
        'harga_beli_satuan',
        'harga_jual_satuan',
        'quantity',
        'stok_awal',
        'stok_masuk',
        'stok_keluar',
        'tanggal',
        'keterangan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tanggal' => 'datetime',
        'harga_beli_satuan' => 'decimal:2',
        'harga_jual_satuan' => 'decimal:2',
        'quantity' => 'integer',
        'stok_awal' => 'integer',
        'stok_masuk' => 'integer',
        'stok_keluar' => 'integer',
    ];
}
