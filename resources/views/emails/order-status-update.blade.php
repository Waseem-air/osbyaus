<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status Update - {{ config('app.name') }}</title>
    <style>
        /* Reset styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }

        .email-header {
            background-color: #000000;
            color: #ffffff;
            padding: 30px 40px;
            text-align: center;
        }

        .email-header h1 {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .email-body {
            padding: 40px;
        }

        .status-badge {
            display: inline-block;
            padding: 12px 24px;
            background-color: {{ $statusColor }};
            color: #ffffff;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            margin: 20px 0;
        }

        .order-info {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
        }

        .order-info h3 {
            color: #000000;
            margin-bottom: 10px;
            font-size: 15px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }

        .info-item {
            margin-bottom: 8px;
        }

        .info-label {
            font-weight: bold;
            color: #666;
            font-size: 14px;
        }

        .info-value {
            color: #000000;
            font-size: 14px;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .products-table th {
            background-color: #000000;
            color: #ffffff;
            padding: 12px;
            text-align: left;
            font-size: 14px;
            font-weight: bold;
        }

        .products-table td {
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
            font-size: 14px;
        }

        .total-row {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .message-box {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 6px;
            padding: 20px;
            margin: 25px 0;
        }

        .message-box h4 {
            color: #856404;
            margin-bottom: 10px;
        }

        .email-footer {
            background-color: #000000;
            color: #ffffff;
            padding: 30px 40px;
            text-align: center;
            font-size: 14px;
        }

        .footer-links {
            margin: 15px 0;
        }

        .footer-links a {
            color: #ffffff;
            text-decoration: none;
            margin: 0 10px;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        .contact-info {
            color: #cccccc;
            font-size: 13px;
            margin-top: 15px;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .email-body {
                padding: 20px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .products-table {
                font-size: 12px;
            }

            .products-table th,
            .products-table td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
<div class="email-container">
    <!-- Header -->
    <div class="email-header">
        <h1>{{ config('app.name', 'Our Store') }}</h1>
    </div>

    <!-- Body -->
    <div class="email-body">
        <h2>Order Status Update</h2>
        <p>Dear {{ $order->billing_first_name }} {{ $order->billing_last_name }},</p>

        <p>Your order <strong>#{{ $order->order_number }}</strong> status has been updated to:</p>

        <div class="status-badge">
            {{ $statusText }}
        </div>

        @if($customMessage)
            <div class="message-box">
                <h4>📝 Message from {{ config('app.name') }}</h4>
                <p>{{ $customMessage }}</p>
            </div>
        @endif

        <!-- Order Information -->
        <div class="order-info">
            <h3>📦 Order Information</h3>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Order Number</div>
                    <div class="info-value">#{{ $order->order_number }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Order Date</div>
                    <div class="info-value">{{ $order->created_at->format('F d, Y') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Payment Status</div>
                    <div class="info-value" style="text-transform: capitalize;">{{ $order->payment_status }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Total Amount</div>
                    <div class="info-value">{{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($order->total_amount, 2) }}</div>
                </div>
            </div>
        </div>

        <!-- Shipping Address -->
        <div style="margin: 25px 0;">
            <h3 style="color: #000000; margin-bottom: 15px;">📍 Shipping Address</h3>
            <p>
                {{ $order->shipping_first_name }} {{ $order->shipping_last_name }}<br>
                {{ $order->shipping_address }}<br>
                {{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_postal_code }}<br>
                {{ $order->shipping_phone }}<br>
                {{ $order->shipping_email }}
            </p>
        </div>

        <!-- Order Items -->
        <h3 style="color: #000000; margin: 25px 0 15px 0;">🛍️ Order Items</h3>
        <table class="products-table">
            <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>
                        <strong>{{ $item->product_name }}</strong>
                        @if($item->color_name || $item->size_name)
                            <br>
                            <small style="color: #666;">
                                @if($item->color_name) Color: {{ $item->color_name }} @endif
                                @if($item->size_name) | Size: {{ $item->size_name }} @endif
                            </small>
                        @endif
                    </td>
                    <td>{{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($item->discount_price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($item->total, 2) }}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr class="total-row">
                <td colspan="3" style="text-align: right; padding-right: 15px;"><strong>Subtotal:</strong></td>
                <td><strong>{{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($order->subtotal, 2) }}</strong></td>
            </tr>
            @if($order->shipping_amount > 0)
                <tr class="total-row">
                    <td colspan="3" style="text-align: right; padding-right: 15px;"><strong>Shipping:</strong></td>
                    <td><strong>{{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($order->shipping_amount, 2) }}</strong></td>
                </tr>
            @endif
            @if($order->tax_amount > 0)
                <tr class="total-row">
                    <td colspan="3" style="text-align: right; padding-right: 15px;"><strong>Tax:</strong></td>
                    <td><strong>{{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($order->tax_amount, 2) }}</strong></td>
                </tr>
            @endif
            <tr class="total-row">
                <td colspan="3" style="text-align: right; padding-right: 15px;"><strong>Total:</strong></td>
                <td><strong>{{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($order->total_amount, 2) }}</strong></td>
            </tr>
            </tfoot>
        </table>

        <p>Thank you for shopping with us!</p>
        <p><strong>The {{ config('app.name') }} Team</strong></p>
    </div>

    <!-- Footer -->
    <div class="email-footer">
        <div style="margin-bottom: 20px;">
            <strong>{{ config('app.name', 'Our Store') }}</strong>
        </div>

        <div class="footer-links">
            <a href="{{ url('/') }}">Home</a> |
            <a href="{{ url('/products') }}">Shop</a> |
        </div>

        <div class="contact-info">
            <p>
                📞 {{ config('app.contact_phone', '61432488558') }}<br>
                ✉️ {{ config('app.contact_email', 'osbyaus@gmail.com') }}
            </p>
        </div>

        <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #333;">
            <p style="font-size: 12px; color: #999;">
                &copy; {{ date('Y') }} {{ config('app.name', 'OsByAus') }}. All rights reserved.<br>
                 This email was sent to {{ $order->billing_email }} because you placed an order with us.
            </p>
        </div>
    </div>
</div>
</body>
</html>
