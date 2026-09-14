<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Receipt ID {{ $order->id }}</title>
    <style>
        @page { margin: 0px; }
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
            margin: 0;
            padding: 40px;
            font-size: 13px;
            line-height: 1.5;
        }
        
        /* Header */
        .header {
            width: 100%;
            border-bottom: 2px solid #eee;
            padding-bottom: 25px;
            margin-bottom: 35px;
        }
        .header-table { width: 100%; }
        .logo {
            font-size: 26px;
            font-weight: 800;
            color: #000;
            text-transform: uppercase;
            letter-spacing: -0.5px;
        }
        .logo span { color: #0d6efd; }
        .receipt-label {
            text-align: right;
            font-size: 20px;
            font-weight: 300;
            text-transform: uppercase;
            color: #999;
            letter-spacing: 1px;
        }

        /* Top Info Section - Compact */
        .info-table { width: 100%; margin-bottom: 35px; }
        .info-col { vertical-align: top; width: 33%; }
        .label { 
            font-size: 10px; 
            text-transform: uppercase; 
            color: #888; 
            font-weight: bold; 
            margin-bottom: 5px;
            letter-spacing: 0.5px;
        }
        .value { 
            font-size: 13px; 
            font-weight: 600; 
            color: #000; 
            margin-bottom: 12px;
            line-height: 1.6;
        }
        .highlight-value { 
            color: #0d6efd; 
            font-size: 28px; 
            font-weight: 800; 
            letter-spacing: -1px;
        }

        /* Items Table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .items-table th {
            text-align: left;
            padding: 12px 10px;
            background-color: #f8f9fa;
            color: #555;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 10px;
            border-bottom: 2px solid #e9ecef;
            letter-spacing: 0.5px;
        }
        .items-table td {
            padding: 15px 10px;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
            page-break-inside: avoid;
        }
        .items-table tr:nth-child(even) {
            background-color: #fcfcfc;
        }
        
        .product-image {
            width: 50px;
            height: 50px;
            object-fit: contain;
            border-radius: 6px;
            border: 1px solid #eee;
            padding: 3px;
            background: #fff;
        }
        .product-image-placeholder {
            width: 50px;
            height: 50px;
            background: #f8f9fa;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            color: #bbb;
            text-align: center;
            border: 1px solid #eee;
        }

        .product-name { font-weight: 700; color: #000; font-size: 13px; margin-bottom: 4px; }
        .product-desc { font-size: 11px; color: #777; line-height: 1.4; }

        /* Footer / Totals */
        .footer-table { width: 100%; page-break-inside: avoid; margin-top: 10px; }
        .totals-col { width: 40%; float: right; }
        .total-row td { padding: 8px 0; }
        .total-label { text-align: right; color: #666; font-weight: 600; padding-right: 20px; font-size: 12px; }
        .total-value { text-align: right; font-weight: 700; width: 120px; font-size: 13px; }
        .grand-total-label { text-align: right; color: #000; font-size: 14px; font-weight: 800; padding-right: 20px; padding-top: 15px; text-transform: uppercase; }
        .grand-total-value { text-align: right; color: #0d6efd; font-size: 20px; font-weight: 800; padding-top: 15px; }

        .qr-area { text-align: left; padding-top: 15px; }
        .thank-you {
            margin-top: 50px;
            border-top: 1px solid #eee;
            padding-top: 25px;
            text-align: center;
            font-size: 11px;
            color: #999;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <div class="header">
        <table class="header-table">
            <tr>
                <td class="logo">Shendy<span>Store</span></td>
                <td class="receipt-label">Order Receipt</td>
            </tr>
        </table>
    </div>

    <!-- Compact Info Grid -->
    <table class="info-table">
        <tr>
            <td class="info-col">
                <div class="label">Billed To</div>
                <div class="value">
                    <span style="font-weight: 700; color: #333;">Customer : {{ auth()->user()->name }}</span><br>
                    <span style="font-weight: normal; color: #555;">Email : {{ auth()->user()->email }}</span><br>
                    <span style="font-weight: normal; color: #555;">Address : {{ $order->shipping_address }}</span><br>
                    <span style="font-weight: normal; color: #555;">Phone : {{ $order->phone ?? 'N/A' }}</span>
                </div>
            </td>
            <td class="info-col" style="text-align: center;">
                <div class="label">Receipt Details</div>
                <div class="value">
                    <span style="color: #555;">Order ID :</span> <span style="font-weight: 700;">{{ $order->id }}</span><br>
                    <span style="color: #555;">Date :</span> {{ $order->created_at->format('M d, Y') }}<br>
                    <span style="color: #555;">Time :</span> {{ $order->created_at->format('h:i A') }}
                </div>
            </td>
            <td class="info-col" style="text-align: right;">
                <div class="label">Total Amount</div>
                <div class="highlight-value">${{ number_format($order->total, 2) }}</div>
                <div style="margin-top: 8px; display: inline-block; background: #e8f5e9; color: #2e7d32; padding: 4px 10px; border-radius: 4px; font-size: 10px; font-weight: 800; text-transform: uppercase;">
                    PAID IN FULL
                </div>
            </td>
        </tr>
    </table>

    <!-- Items -->
    <table class="items-table">
        <thead>
            <tr>
                <th width="5%"> </th>
                <th width="10%"> </th>
                <th width="45%">Product Details</th>
                <th width="15%" style="text-align: center;">Unit Price</th>
                <th width="10%" style="text-align: center;">Qty</th>
                <th width="15%" style="text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td style="color: #aaa; font-size: 11px;">{{ $loop->iteration }}</td>
                <td>
                    @if($item->product->image && file_exists(public_path($item->product->image)))
                        <img src="{{ public_path($item->product->image) }}" class="product-image" alt="Prd">
                    @else
                        <div class="product-image-placeholder">No Image</div>
                    @endif
                </td>
                <td>
                    <div class="product-name">{{ $item->product->name }}</div>
                    @if($item->product->description)
                        <div class="product-desc">{{ Str::limit($item->product->description, 60) }}</div>
                    @endif
                    <div style="font-size: 10px; color: #999; margin-top: 3px;">Category: {{ $item->product->category->name ?? 'N/A' }}</div>
                </td>
                <td style="text-align: center; color: #444; font-weight: 600;">${{ number_format($item->price, 2) }}</td>
                <td style="text-align: center;">
                    <span style="background: #f0f0f0; padding: 2px 8px; border-radius: 10px; font-weight: 700; font-size: 11px;">{{ $item->quantity }}</span>
                </td>
                <td style="text-align: right; font-weight: 700; color: #000;">
                    ${{ number_format($item->price * $item->quantity, 2) }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer & Totals -->
    <table class="footer-table">
        <tr>
            <td width="60%" style="vertical-align: top;">
                <div class="qr-area">
                    <img src="{{ $qrCode }}" width="100" style="margin-bottom: 5px;" />
                </div>
            </td>
            <td width="40%" style="vertical-align: top;">
                <table width="100%">
                    <tr class="total-row">
                        <td class="total-label">Subtotal</td>
                        <td class="total-value">${{ number_format($order->total, 2) }}</td>
                    </tr>
                    <tr class="total-row">
                        <td class="total-label">Shipping & Handling</td>
                        <td class="total-value" style="color: #28a745;">Free</td>
                    </tr>
                    <tr class="total-row">
                        <td class="total-label">Tax (0%)</td>
                        <td class="total-value">$0.00</td>
                    </tr>
                    <tr><td colspan="2" style="border-bottom: 2px solid #ddd; padding: 5px 0;"></td></tr>
                </table>
            </td>
        </tr>
    </table>

    <div class="thank-you">
        Thank you for shopping with Shendy
    </div>

</body>
</html>
