<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $invoice_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            padding: 40px;
        }
        
        .header {
            margin-bottom: 30px;
        }
        
        .invoice-title {
            font-size: 32px;
            font-weight: bold;
            color: #000;
            margin-bottom: 10px;
        }
        
        .invoice-info {
            font-size: 11px;
            color: #666;
        }
        
        .invoice-details {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        
        .invoice-left {
            display: table-cell;
            width: 60%;
            vertical-align: top;
        }
        
        .invoice-right {
            display: table-cell;
            width: 40%;
            vertical-align: top;
            text-align: right;
        }
        
        .section-title {
            font-weight: bold;
            font-size: 11px;
            color: #666;
            margin-bottom: 8px;
            text-transform: uppercase;
        }
        
        .billed-to {
            font-size: 13px;
            line-height: 1.6;
        }
        
        .billed-name {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 5px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        thead {
            background-color: #f8f9fa;
        }
        
        th {
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
            color: #666;
            text-transform: uppercase;
            border-bottom: 2px solid #dee2e6;
        }
        
        th.text-right, td.text-right {
            text-align: right;
        }
        
        th.text-center, td.text-center {
            text-align: center;
        }
        
        td {
            padding: 10px 8px;
            border-bottom: 1px solid #dee2e6;
            font-size: 12px;
        }
        
        tbody tr:last-child td {
            border-bottom: 2px solid #dee2e6;
        }
        
        .totals {
            width: 100%;
            margin-top: 20px;
        }
        
        .totals-table {
            float: right;
            width: 300px;
        }
        
        .totals-row {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }
        
        .totals-label {
            display: table-cell;
            text-align: right;
            padding-right: 20px;
            font-size: 12px;
            color: #666;
        }
        
        .totals-value {
            display: table-cell;
            text-align: right;
            font-weight: bold;
            width: 120px;
            font-size: 12px;
        }
        
        .total-final {
            border-top: 2px solid #000;
            padding-top: 10px;
            margin-top: 10px;
        }
        
        .total-final .totals-label,
        .total-final .totals-value {
            font-size: 14px;
            font-weight: bold;
            color: #000;
        }
        
        .clear {
            clear: both;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="invoice-title">INVOICE</div>
        <div class="invoice-info">
            Invoice No. {{ $invoice_number }}<br>
            {{ $date }}
        </div>
    </div>
    
    <div class="invoice-details">
        <div class="invoice-left">
            <div class="section-title">Billed To:</div>
            <div class="billed-to">
                <div class="billed-name">{{ $nama_tujuan }}</div>
                <div>{{ nl2br(e($alamat_tujuan)) }}</div>
            </div>
        </div>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th class="text-center" style="width: 15%;">Quantity</th>
                <th class="text-right" style="width: 20%;">Unit Price</th>
                <th class="text-right" style="width: 20%;">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td class="text-center">{{ $item['quantity'] }}</td>
                <td class="text-right">Rp {{ number_format($item['unit_price'], 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($item['total'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="totals">
        <div class="totals-table">
            <div class="totals-row">
                <div class="totals-label">Subtotal:</div>
                <div class="totals-value">Rp {{ number_format($subtotal, 0, ',', '.') }}</div>
            </div>
            
            <div class="totals-row">
                <div class="totals-label">Tax ({{ $tax }}%):</div>
                <div class="totals-value">Rp {{ number_format($tax_amount, 0, ',', '.') }}</div>
            </div>
            
            <div class="totals-row total-final">
                <div class="totals-label">Total:</div>
                <div class="totals-value">Rp {{ number_format($total, 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</body>
</html>