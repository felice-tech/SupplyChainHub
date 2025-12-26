<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Stock Barangs</title>
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
  <style>
    .container { max-width: 1100px; margin: 40px auto; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 8px 10px; border: 1px solid #ddd; }
    th { background:#f5f5f5; }
    .actions a, .actions form { display:inline-block; margin-right:6px; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Stock Barangs</h1>
    <p><a href="{{ url('/home/stock-barangs/create') }}" class="btn btn-primary">Create new</a></p>

    @if($items->isEmpty())
      <p>No records found.</p>
    @else
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Satuan</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Stok Awal</th>
            <th>Stok Masuk</th>
            <th>Stok Keluar</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th class="actions">Actions</th>
          </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
          <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->kode_barang }}</td>
            <td>{{ $item->nama_barang }}</td>
            <td>{{ $item->satuan }}</td>
            <td>{{ number_format($item->harga_beli,2) }}</td>
            <td>{{ number_format($item->harga_jual,2) }}</td>
            <td>{{ $item->stok_awal }}</td>
            <td>{{ $item->stok_masuk }}</td>
            <td>{{ $item->stok_keluar }}</td>
            <td>{{ optional($item->tanggal)->format('Y-m-d') }}</td>
            <td>{{ $item->keterangan }}</td>
            <td class="actions">
              <a href="{{ url('/home/stock-barangs/'.$item->id) }}">View</a>
              <a href="{{ url('/home/stock-barangs/'.$item->id.'/edit') }}">Edit</a>
              <form action="{{ url('/home/stock-barangs/'.$item->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Delete this record?')">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    @endif
  </div>
</body>
</html>
