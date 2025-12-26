<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $record = Invoice::query();

        $items = $record->orderBy('created_at', 'desc')->paginate(10)->appends($request->query());
        return view('invoice.view', compact('items'));
    }

    public function create()
    {
        return view('invoice.form');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'nama_tujuan' => 'required|string|max:255',
            'alamat_tujuan' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.name' => 'required|string',
            'items.*.quantity' => 'required|numeric|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
            'tax' => 'required|numeric|min:0|max:100',
        ]);

        $data = [
            'invoice_number' => 'INV-' . date('Ymd') . '-' . rand(1000, 9999),
            'date' => now()->format('Y-m-d'),
            'nama_tujuan' => $request->nama_tujuan,
            'alamat_tujuan' => $request->alamat_tujuan,
            'items' => $request->items,
            'tax' => $request->tax,
        ];

        // Calculate totals
        $subtotal = 0;
        foreach ($data['items'] as &$item) {
            $item['total'] = $item['quantity'] * $item['unit_price'];
            $subtotal += $item['total'];
        }

        $data['subtotal'] = $subtotal;
        $data['tax_amount'] = $subtotal * ($data['tax'] / 100);
        $data['total'] = $subtotal + $data['tax_amount'];

        

        $invoice = Invoice::create([
            'invoice_number' => $data['invoice_number'],
            'nama_tujuan' => $data['nama_tujuan'],
            'alamat_tujuan' => $data['alamat_tujuan'],
            'items' => json_encode($data['items']),
            'quantity' => array_sum(array_column($data['items'], 'quantity')),
            'price_per_item' => $data['subtotal'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $pdf = Pdf::loadView('invoice.pdf', $data); 
        
        return redirect()->route('invoice.view')->with('success', 'Invoice generated successfully! You can view or print it from the list.');
    }

    public function print($invoice_number)
    {
        $invoice = Invoice::where('invoice_number', $invoice_number)->firstOrFail();

        $items = json_decode($invoice->items, true);
        
        // Recalculate totals
        $subtotal = 0;
        foreach ($items as &$item) {
            if (!isset($item['total'])) {
                $item['total'] = $item['quantity'] * $item['unit_price'];
            }
            $subtotal += $item['total'];
        }

        $tax = $invoice->tax ?? 0;
        $tax_amount = $subtotal * ($tax / 100);
        $total = $subtotal + $tax_amount;

        $data = [
            'invoice_number' => $invoice->invoice_number,
            'date' => $invoice->created_at->format('Y-m-d H:i:s'),
            'nama_tujuan' => $invoice->nama_tujuan,
            'alamat_tujuan' => $invoice->alamat_tujuan,
            'items' => $items,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'tax_amount' => $tax_amount,
            'total' => $total,
        ];

        $pdf = Pdf::loadView('invoice.pdf', $data);
        return $pdf->stream('invoice-' . $data['invoice_number'] . '.pdf');
    }
}