<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>
<h2>Invoice for Order #{{ $order->id }}</h2>
<p>Date: {{ $order->created_at }}</p>
<p>Status: {{ ucfirst($order->status) }}</p>
<hr>
<table>
    <thead>
    <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Unit Price ($)</th>
        <th>Subtotal ($)</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->orderItems as $item)
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ number_format($item->price, 2) }}</td>
            <td>{{ number_format($item->quantity * $item->price, 2) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<h3 style="text-align:right">Total: ${{ number_format($order->total, 2) }}</h3>
</body>
</html>
