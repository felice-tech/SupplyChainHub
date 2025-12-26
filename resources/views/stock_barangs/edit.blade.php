@extends('layouts.default')

@section('title', 'Edit Stock Item')

@section('head')
<style>
  .page-container {
    max-width: 900px;
    margin: 0 auto;
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  }

  h1 {
    color: #333;
    margin-bottom: 10px;
    font-size: 28px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .page-subtitle {
    color: #666;
    font-size: 14px;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid #e0e0e0;
  }

  .btn-primary {
    padding: 10px 24px;
    background: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    transition: all 0.3s ease;
    font-weight: 500;
    cursor: pointer;
    font-size: 14px;
  }

  .btn-primary:hover {
    background: #0056b3;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,123,255,0.3);
  }

  .btn-secondary {
    padding: 10px 20px;
    background: #6c757d;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: all 0.3s ease;
    font-weight: 500;
    border: none;
    cursor: pointer;
    font-size: 14px;
    display: inline-block;
  }

  .btn-secondary:hover {
    background: #545b62;
    transform: translateY(-2px);
  }

  .btn-danger {
    padding: 10px 20px;
    background: #dc3545;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: all 0.3s ease;
    font-weight: 500;
    border: none;
    cursor: pointer;
    font-size: 14px;
    display: inline-block;
  }

  .btn-danger:hover {
    background: #c82333;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(220,53,69,0.3);
  }

  .alert {
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-weight: 500;
  }

  .alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
  }

  .alert-danger {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
  }

  .alert-danger ul {
    margin: 10px 0 0 20px;
  }

  .form-section {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 25px;
    margin: 20px 0;
    border: 1px solid #e0e0e0;
  }

  .form-section-title {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #667eea;
  }

  .form-grid { 
    display: grid; 
    grid-template-columns: 220px 1fr; 
    gap: 18px; 
    align-items: center; 
  }

  .form-row { 
    display: contents;
  }

  .form-grid label { 
    font-weight: 600; 
    color: #555;
  }

  .field-error { 
    color: #dc3545; 
    font-size: 0.9em; 
    margin-top: 4px;
    grid-column: 2;
  }

  input[type="number"], 
  input[type="text"], 
  input[type="datetime-local"], 
  select, 
  textarea { 
    width: 100%; 
    padding: 10px 12px;
    box-sizing: border-box;
    border: 2px solid #e0e0e0;
    border-radius: 5px;
    font-size: 14px;
    color: #333;
    background: #fff;
    transition: all 0.3s ease;
  }

  input:focus, 
  select:focus, 
  textarea:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
  }

  input[readonly] {
    background: #e9ecef;
    cursor: not-allowed;
  }

  textarea { 
    min-height: 90px;
    resize: vertical;
  }

  .form-actions { 
    display: flex; 
    gap: 12px; 
    align-items: center;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 2px solid #e0e0e0;
  }

  .quantity-display {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    padding: 12px 20px;
    border-radius: 5px;
    font-weight: 600;
    text-align: center;
  }

  .current-values-info {
    background: #e7f3ff;
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
    border-left: 4px solid #007bff;
  }

  .current-values-info p {
    margin: 5px 0;
    font-size: 14px;
    color: #333;
  }

  .current-values-info strong {
    color: #007bff;
  }

  .delete-section {
    display: flex;
    justify-content: flex-end;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid #e0e0e0;
  }

  .admin-note {
    flex-grow: 1;
    text-align: right;
    color: #888;
    font-size: 12px;
    padding-top: 10px;
  }

  @media (max-width: 768px) { 
    .form-grid { 
      grid-template-columns: 1fr;
      gap: 10px;
    }

    .field-error {
      grid-column: 1;
    }

    .page-container {
      padding: 15px;
    }

    .form-section {
      padding: 15px;
    }

    .form-actions {
      flex-direction: column;
    }

    .form-actions button,
    .form-actions a {
      width: 100%;
      text-align: center;
    }

    .admin-note {
      text-align: center;
    }
  }
</style>
@endsection

@section('content')
<div class="page-container">
  <h1>✏️ Edit Stock Item</h1>
  <p class="page-subtitle">Update stock item information</p>

  @if(session('success'))
    <div class="alert alert-success">✅ {{ session('success') }}</div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger">
      <strong>⚠️ Please fix the following errors:</strong>
      <ul>
        @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="current-values-info">
    <p><strong>📦 Current Item:</strong> {{ $item->kode_barang }} - {{ $item->nama_barang }}</p>
    <p><strong>📊 Current Quantity:</strong> {{ $item->quantity }}</p>
  </div>

  <form action="{{ url('/home/stock-barangs/'.$item->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="form-section">
      <div class="form-section-title">📦 Item Information</div>
      <div class="form-grid">
        <div class="form-row">
          <label>Kode Barang</label>
          <input type="text" name="kode_barang" value="{{ old('kode_barang', $item->kode_barang) }}" required>
        </div>
        @error('kode_barang')<div class="field-error">{{ $message }}</div>@enderror

        <div class="form-row">
          <label>Nama Barang</label>
          <input type="text" name="nama_barang" value="{{ old('nama_barang', $item->nama_barang) }}" required>
        </div>
        @error('nama_barang')<div class="field-error">{{ $message }}</div>@enderror

        <div class="form-row">
          <label>Satuan</label>
          <select name="satuan">
            <option value="">-- select satuan --</option>
            <option value="Box" {{ (old('satuan', $item->satuan) === 'Box') ? 'selected' : '' }}>Box</option>
            <option value="Pcs" {{ (old('satuan', $item->satuan) === 'Pcs') ? 'selected' : '' }}>Pcs</option>
          </select>
        </div>
        @error('satuan')<div class="field-error">{{ $message }}</div>@enderror
      </div>
    </div>

    <div class="form-section">
      <div class="form-section-title">💰 Pricing</div>
      <div class="form-grid">
        <div class="form-row">
          <label>Harga Beli (satuan)</label>
          <input type="number" step="0.01" name="harga_beli_satuan" value="{{ old('harga_beli_satuan', $item->harga_beli_satuan) }}">
        </div>
        @error('harga_beli_satuan')<div class="field-error">{{ $message }}</div>@enderror

        <div class="form-row">
          <label>Harga Jual (satuan)</label>
          <input type="number" step="0.01" name="harga_jual_satuan" value="{{ old('harga_jual_satuan', $item->harga_jual_satuan) }}">
        </div>
        @error('harga_jual_satuan')<div class="field-error">{{ $message }}</div>@enderror
      </div>
    </div>

    <div class="form-section">
      <div class="form-section-title">📊 Stock Details</div>
      <div class="form-grid">
        <div class="form-row">
          <label>Stok Awal</label>
          <input type="number" name="stok_awal" value="{{ old('stok_awal', $item->stok_awal) }}">
        </div>
        @error('stok_awal')<div class="field-error">{{ $message }}</div>@enderror

        <div class="form-row">
          <label>Stok Masuk</label>
          <input type="number" name="stok_masuk" value="{{ old('stok_masuk', $item->stok_masuk) }}">
        </div>
        @error('stok_masuk')<div class="field-error">{{ $message }}</div>@enderror

        <div class="form-row">
          <label>Stok Keluar</label>
          <input type="number" name="stok_keluar" value="{{ old('stok_keluar', $item->stok_keluar) }}">
        </div>
        @error('stok_keluar')<div class="field-error">{{ $message }}</div>@enderror

        <div class="form-row">
          <label>Quantity (calculated)</label>
          <input type="number" name="quantity" value="{{ old('quantity', $item->quantity) }}" readonly class="quantity-display">
        </div>
        @error('quantity')<div class="field-error">{{ $message }}</div>@enderror
      </div>
    </div>

    <div class="form-section">
      <div class="form-section-title">📅 Additional Information</div>
      <div class="form-grid">
        <div class="form-row">
          <label>Tanggal</label>
          <input type="datetime-local" name="tanggal" value="{{ old('tanggal', optional($item->tanggal)->format('Y-m-d\TH:i')) }}">
        </div>
        @error('tanggal')<div class="field-error">{{ $message }}</div>@enderror

        <div class="form-row">
          <label>Keterangan</label>
          <textarea name="keterangan">{{ old('keterangan', $item->keterangan) }}</textarea>
        </div>
        @error('keterangan')<div class="field-error">{{ $message }}</div>@enderror
      </div>
    </div>

    <div class="form-actions">
      <button type="submit" class="btn-primary">💾 Update Stock Item</button>
      <a href="{{ url('/home/stock-barangs') }}" class="btn-secondary">❌ Cancel</a>
      <div class="admin-note">
        Only Admin can delete stock items.
      </div>
    </div>
  </form>

  <div class="delete-section">
    <form action="{{ url('/home/stock-barangs/'.$item->id) }}"
          method="POST"
          onsubmit="return confirm('Are you sure you want to delete this stock item? This action cannot be undone.');">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn-danger">
        🗑️ Delete Stock Item
      </button>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
  function updateQuantityEdit() {
    const stokAwal = parseInt(document.querySelector('input[name="stok_awal"]').value || 0, 10);
    const stokMasuk = parseInt(document.querySelector('input[name="stok_masuk"]').value || 0, 10);
    const stokKeluar = parseInt(document.querySelector('input[name="stok_keluar"]').value || 0, 10);
    const qty = stokAwal + stokMasuk - stokKeluar;
    const qEl = document.querySelector('input[name="quantity"]');
    if (qEl) qEl.value = qty;
  }

  document.addEventListener('input', function(e) {
    if (['stok_awal','stok_masuk','stok_keluar'].includes(e.target.name)) {
      updateQuantityEdit();
    }
  });

  document.addEventListener('change', function(e) {
    if (['stok_awal','stok_masuk','stok_keluar'].includes(e.target.name)) {
      updateQuantityEdit();
    }
  });

  // Initial calculation
  updateQuantityEdit();
</script>
@endsection