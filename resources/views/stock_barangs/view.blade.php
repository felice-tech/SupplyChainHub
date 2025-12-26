@extends('layouts.default')

@section('title', 'View Stock Item')

@section('content')
<div class="page-container">
  <h1>Stock Item Details</h1>

  <p style="margin-bottom:12px;">
    <a href="{{ url('/home/stock-barangs') }}">← Back to list</a>
    &nbsp;|&nbsp;
    <a href="{{ url('/home/stock-barangs/'.$item->id) }}">Edit</a>
  </p>

  <style>
    .detail-table { width:100%; border-collapse: collapse; }
    .detail-table th { text-align:left; width:220px; padding:8px; background:#f7f7f7; }
    .detail-table td { padding:8px; border-bottom:1px solid #eee; }
    .detail-actions { margin-top:14px; }
    .btn { display:inline-block; padding:6px 10px; background:#007bff; color:#fff; text-decoration:none; border-radius:4px; }
    .btn-danger { background:#d9534f; }
  </style>

  <table class="detail-table">
    <tbody>
      <tr><th>Kode</th><td>{{ $item->kode_barang }}</td></tr>
      <tr><th>Nama</th><td>{{ $item->nama_barang }}</td></tr>
      <tr><th>Satuan</th><td>{{ $item->satuan }}</td></tr>
      <tr><th>Harga Beli (satuan)</th><td>{{ number_format($item->harga_beli_satuan ?? 0,2) }}</td></tr>
      <tr><th>Harga Jual (satuan)</th><td>{{ number_format($item->harga_jual_satuan ?? 0,2) }}</td></tr>
      <tr><th>Stok Awal</th><td>{{ $item->stok_awal }}</td></tr>
      <tr><th>Stok Masuk</th><td>{{ $item->stok_masuk }}</td></tr>
      <tr><th>Stok Keluar</th><td>{{ $item->stok_keluar }}</td></tr>
      <tr><th>Quantity</th><td>{{ $item->quantity ?? 0 }}</td></tr>
      <tr><th>Tanggal</th><td>{{ optional($item->tanggal)->format('Y-m-d H:i:s') }}</td></tr>
      <tr><th>Keterangan</th><td>{{ $item->keterangan }}</td></tr>
    </tbody>
  </table>


</div>
@endsection
