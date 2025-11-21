<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Complete Your Payment</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 0;
            color: #222;
        }

        .container {
            max-width: 650px;
            margin: 0 auto;
            padding: 0;
        }

        /* HEADER */
        .header {
            background: #000;
            color: #fff;
            padding: 35px 20px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .header h1 {
            margin: 0;
            font-size: 26px;
            font-weight: bold;
        }

        /* CONTENT BOX */
        .content {
            background: #ffffff;
            padding: 30px;
            border-radius: 0 0 10px 10px;
            border: 1px solid #ddd;
        }

        /* PAY BUTTON */
        .payment-button {
            display: inline-block;
            background: #000;
            padding: 8px 20px;
            color: #fff !important;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            border-radius: 4px;
            margin: 10px 0;
        }

        /* ORDER DETAILS BOX */
        .order-details {
            background: #f7f7f7;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 6px;
            margin: 20px 0;
        }

        .order-details p {
            margin: 6px 0;
            font-size: 15px;
        }

        /* NOTES SECTION */
        .note-box {
            background: #fff8e1;
            border-left: 4px solid #ffca28;
            padding: 15px 20px;
            margin-top: 25px;
            border-radius: 6px;
        }

        /* FOOTER */
        .footer {
            text-align: center;
            margin-top: 25px;
            font-size: 13px;
            color: #666;
            padding-bottom: 20px;
        }
    </style>
</head>

<body>
@php use App\Helpers\AppHelper @endphp
<div class="container">
    <!-- HEADER -->
    <div class="header">
        <h1>{{ config('app.name') }}</h1>
        <p style="margin-top:5px; font-size:16px; opacity:0.9;">
            Complete Your Payment
        </p>
        <p style="margin-top:4px; font-size:14px; letter-spacing:1px; opacity:0.8;">
            Order #{{ $order->order_number }}
        </p>
    </div>


    <!-- CONTENT -->
    <div class="content">

        <h2 style="margin-top:0; font-weight:600;">Hello {{ $order->customer_name }},</h2>
        <p>
            Thank you for your order. Your order has been created successfully and is now pending payment.
            Please complete the payment to proceed.
        </p>

        <!-- ORDER DETAILS -->
        <div class="order-details">
            <h3 style="margin-top:0; font-size:18px;">Order Summary</h3>
            <p><strong>Total Amount:</strong> {{ AppHelper::currency_symbol() }}{{ number_format($order->total_amount, 2) }}</p>
            <p><strong>Order Status:</strong> {{ ucfirst($order->status) }}</p>
            <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>
        </div>

        <!-- BUTTON AREA -->
        <div style="text-align:center;">
            <h3 style="font-size:14px;">Pay Now</h3>
            <p>Click below to complete your secure payment:</p>
            <a href="{{ $paymentLink }}" class="payment-button">
                PAY NOW – {{ AppHelper::currency_symbol() }}{{ number_format($order->total_amount, 2) }}
            </a>

            <p style="font-size:12px; margin-top:10px;">
                Or copy this link: <br>
                <a href="{{ $paymentLink }}" style="color:#000; word-break:break-all;">
                    {{ $paymentLink }}
                </a>
            </p>
        </div>

    </div>

    <!-- FOOTER -->
    <div class="footer">
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        <p>This is an automated email. Do not reply.</p>
    </div>

</div>
</body>
</html>

