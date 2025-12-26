<?php

namespace App\Http\Controllers;

use App\Models\StockBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = StockBarang::query();
        
        // Get filter parameters
        $filterBy = $request->get('filter_by');
        $filterValue = $request->get('filter_value');
        
        // Apply filters ONLY if both filterBy and filterValue exist
        if ($filterBy && $filterValue) {
            if ($filterBy === 'kode_barang') {
                $query->where('kode_barang', $filterValue);
            } elseif ($filterBy === 'tanggal') {
                // Filter by month and year
                // Expecting format: "2025-01" (Year-Month)
                $query->whereYear('tanggal', substr($filterValue, 0, 4))
                      ->whereMonth('tanggal', substr($filterValue, 5, 2));
            }
        }
        
        // Paginate results with filter parameters preserved
        $items = $query->orderBy('tanggal', 'desc')->paginate(10)->appends($request->query());
        
        // Get distinct kode_barang for dropdown
        $kodeBarangList = StockBarang::select('kode_barang')
            ->distinct()
            ->whereNotNull('kode_barang')
            ->orderBy('kode_barang')
            ->pluck('kode_barang');

        // Get distinct month-year combinations
        $driver = DB::getDriverName();

        if ($driver === 'sqlite') {
            $monthYearList = StockBarang::select(
                    DB::raw("strftime('%Y-%m', tanggal) as month_year")
                )
                ->whereNotNull('tanggal')
                ->distinct()
                ->orderBy('month_year', 'desc')
                ->get()
                ->map(function($item) {
                    $item->month_year_formatted = \Carbon\Carbon::parse($item->month_year . '-01')->format('F Y');
                    return $item;
                });
        } else {
                $monthYearList = StockBarang::select(
                                DB::raw("DATE_FORMAT(tanggal, '%Y-%m') as month_year"),
                                DB::raw("DATE_FORMAT(tanggal, '%M %Y') as month_year_formatted")
                            )
                            ->whereNotNull('tanggal')
                            ->distinct()
                            ->orderBy('month_year', 'desc')
                            ->get();
            }
        return view('stock_barangs.index', compact('items', 'kodeBarangList', 'monthYearList', 'filterBy', 'filterValue'));
    }

    /**
     * Display a HTML view listing all stock barang records.
     */
    public function list()
    {
        $items = StockBarang::orderBy('tanggal', 'desc')->paginate(10);
        return view('stock_barangs.index', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Base validation
        $base = $request->validate([
            'kode_barang' => 'required|string',
            'nama_barang' => 'required|string',
            'satuan' => 'required|string',
            'movement' => 'required|in:masuk,keluar',
            'stok_awal' => 'nullable|integer',
            'tanggal' => 'nullable|date',
            'keterangan' => 'nullable|string',
        ]);

        // Conditional validation depending on movement type
        if ($base['movement'] === 'masuk') {
            $extra = $request->validate([
                'harga_beli_satuan' => 'required|numeric',
                'stok_masuk' => 'required|integer|min:1',
            ]);

            $harga_beli = (float) $extra['harga_beli_satuan'];
            $harga_jual = 0;
            $stok_masuk = (int) $extra['stok_masuk'];
            $stok_keluar = 0;
        } else {
            // keluar
            $extra = $request->validate([
                'harga_jual_satuan' => 'required|numeric',
                'stok_keluar' => 'required|integer|min:1',
            ]);

            $harga_jual = (float) $extra['harga_jual_satuan'];
            $harga_beli = 0;
            $stok_keluar = (int) $extra['stok_keluar'];
            $stok_masuk = 0;
        }

        $stok_awal = isset($base['stok_awal']) ? (int) $base['stok_awal'] : 0;

        // tanggal default to now if not provided
        $tanggal = $base['tanggal'] ?? now();

        // set created_at and updated_at to now()
        $created_at = now();
        $updated_at = now();

        $quantity = $stok_awal + $stok_masuk - $stok_keluar;

        $model = StockBarang::create([
            'kode_barang' => $base['kode_barang'],
            'nama_barang' => $base['nama_barang'],
            'satuan' => $base['satuan'],
            'harga_beli_satuan' => $harga_beli,
            'harga_jual_satuan' => $harga_jual,
            'stok_awal' => $stok_awal,
            'stok_masuk' => $stok_masuk,
            'stok_keluar' => $stok_keluar,
            'quantity' => $quantity,
            'tanggal' => $tanggal,
            'keterangan' => $base['keterangan'] ?? null,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ]);

        return redirect()->route('stock-barangs.index')->with('success', 'Stock item created.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stock_barangs.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockBarang $stock_barang)
    {
        return view('stock_barangs.edit', ['item' => $stock_barang]);
    }

    /**
     * Display the specified resource.
     */
    public function show(StockBarang $stock_barang)
    {
        return view('stock_barangs.view', ['item' => $stock_barang]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockBarang $stock_barang)
    {
        $data = $request->validate([
            'kode_barang' => 'sometimes|required|string|unique:stock_barangs,kode_barang,' . $stock_barang->id,
            'nama_barang' => 'sometimes|required|string',
            'satuan' => 'nullable|string',
            'harga_beli_satuan' => 'nullable|numeric',
            'harga_jual_satuan' => 'nullable|numeric',
            'stok_awal' => 'nullable|integer',
            'stok_masuk' => 'nullable|integer',
            'stok_keluar' => 'nullable|integer',
            'quantity' => 'nullable|integer',
            'tanggal' => 'nullable|date',
            'keterangan' => 'nullable|string',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
        ]);

        // Ensure stok fields are integers (default 0) and recompute quantity server-side
        $stok_awal = isset($data['stok_awal']) ? (int) $data['stok_awal'] : $stock_barang->stok_awal ?? 0;
        $stok_masuk = isset($data['stok_masuk']) ? (int) $data['stok_masuk'] : $stock_barang->stok_masuk ?? 0;
        $stok_keluar = isset($data['stok_keluar']) ? (int) $data['stok_keluar'] : $stock_barang->stok_keluar ?? 0;

        $data['stok_awal'] = $stok_awal;
        $data['stok_masuk'] = $stok_masuk;
        $data['stok_keluar'] = $stok_keluar;

        $data['quantity'] = $stok_awal + $stok_masuk - $stok_keluar;
        $data['updated_at'] = now();


        $stock_barang->update($data);

        return redirect()->route('stock-barangs.index')->with('success', 'Stock item updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockBarang $stock_barang)
    {
        $stock_barang->delete();

        return redirect()->route('stock-barangs.index')->with('success', 'Stock item deleted.');
    }
}