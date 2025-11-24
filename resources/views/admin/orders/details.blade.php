@extends("admin.layout.main")
@section('content')

    <style>
        /* ================= BADGES ================= */
        .order-badge {
            font-weight: 600;
            border-radius: 6px;
            height: 32px;
            width: 90px;
            font-size: 14px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
        }

        .order-badge.pending { background-color: #FFA52F !important; color: white !important; }
        .order-badge.processing { background-color: #FFA52F !important; color: white !important; }
        .order-badge.confirmed { background-color: #17a2b8 !important; color: white !important; }
        .order-badge.shipped { background-color: #007bff !important; color: white !important; }
        .order-badge.delivered { background-color: #28a745 !important; color: white !important; }
        .order-badge.cancelled { background-color: #dc3545 !important; color: white !important; }

        /* ================= ICON ================= */
        .icon-calendar-order {
            font-size: 20px;
            color: #FFA52F;
        }

        /* ================= BUTTONS ================= */
        .btn-action {
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
            padding: 0 16px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-print {
            background-color: #6c757d;
            color: white;
            border: none;
        }

        .btn-print:hover {
            background-color: #5a6268;
            color: white;
        }

        .btn-save {
            background-color: #28a745;
            color: white;
            border: none;
        }

        .btn-save:hover {
            background-color: #218838;
            color: white;
        }

        /* ================= CARDS ================= */
        .order-card {
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            border: 1px solid #eaeaea;
            margin-bottom: 25px;
            overflow: hidden;
        }

        .order-card-header {
            padding: 18px 25px;
            font-weight: 600;
            font-size: 18px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #eaeaea;
        }

        .order-card-date {
            font-weight: 600;
            font-size: 18px;
        }

        .order-card-body {
            padding: 25px;
        }

        /* ================= PRODUCTS TABLE ================= */
        .order-items-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
        }

        .order-items-table th,
        .order-items-table td {
            padding: 15px;
            border: none !important;
        }

        .order-items-table thead tr,
        .order-items-table tbody tr,
        .order-items-table tfoot tr {
            border-bottom: 1px solid #DBDADE;
        }

        .order-items-table thead th,
        .order-items-table tbody td,
        .order-items-table tfoot td {
            border: none !important;
        }

        /* Align Total column to the end */
        .order-items-table th:nth-child(4),
        .order-items-table td:nth-child(4) {
            text-align: right;
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 768px) {
            .btn-action {
                width: 100%;
                margin-bottom: 10px;
            }
            .order-items-table {
                display: block;
                overflow-x: auto;
            }
            .order-card-header {
                padding: 15px;
                font-size: 16px;
            }
            .order-card-body {
                padding: 20px;
            }
        }

        /* ================= CUSTOMER CARD ================= */
        .customer-card {
            background: transparent !important;
            border: 1px solid #E7E7E3 !important;
            border-radius: 12px;
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .customer-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .customer-img {
            width: 56px;
            height: 56px;
            object-fit: cover;
            border-radius: 8px;
        }

        .view-profile-btn {
            height: 38px;
            background-color: #94010E !important;
            color: white !important;
            font-weight: 500;
            font-size: 14px;
            border-radius: 8px;
            border: none;
            transition: all 0.3s ease;
        }

        .view-profile-btn:hover {
            background-color: #7a010b !important;
            color: white !important;
        }

        /* ================= CHECKBOX ================= */
        .custom-check {
            width: 20px !important;
            height: 20px !important;
            cursor: pointer;
        }

        .custom-check:checked {
            background-color: #94010E !important;
            border-color: #94010E !important;
        }

        /* ================= ORDER SUMMARY TABLE ================= */
        .order-table-1 {
            width: 100%;
            border-collapse: collapse;
            font-size: 16px;
            margin-top: 20px;
        }

        .order-table-1 td {
            padding: 12px 15px;
            /* Remove all borders */
            border: none !important;
        }

        .order-table-1 tr:last-child td {
            font-weight: bold;
            font-size: 18px;
            color: #94010E;
            padding-top: 15px;
        }

        .order-table-1 tr:last-child {
            /* Remove border top */
            border-top: 1px solid #eee !important;
        }

        .order-table-1 .label {
            text-align: left;
            color: #666;
        }

        .order-table-1 .value {
            text-align: right;
            font-weight: 500;
        }

        /* ================= PRODUCTS CARD LAYOUT ================= */
        .products-card-container {
            display: flex;
            flex-direction: column;
        }

        .products-table-container {
            width: 100%;
        }

        .order-summary-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .order-summary-wrapper {
            width: 100%;
            max-width: 400px;
        }

        @media (max-width: 576px) {
            .order-table-1 {
                font-size: 16px;
            }

            .order-table-1 td {
                padding: 10px 12px;
            }

            .order-table-1 tr:last-child td {
                font-size: 17px;
            }

            .order-summary-container {
                justify-content: center;
            }

            .order-summary-wrapper {
                max-width: 100%;
            }

            /* Ensure products table maintains 100% width on mobile */
            .order-items-table {
                width: 100%;
                min-width: 100%;
            }
        }
        .p-img{
            width:60px;
            height:60px;
            border-radius: 6px;
            object-fit: cover;
        }
        .notes-textarea {
            resize: none;  /* user cannot resize */
            cursor: not-allowed; /* optional, shows readonly cursor */
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            padding: 12px;
        }

        /* Print styles */
        @media print {
            body {
                font-size: 10pt;
                line-height: 1.3;
                color: #000;
                background: #fff;
                margin: 0;
                padding: 0;
            }

            .no-print {
                display: none !important;
            }

            .order-card {
                box-shadow: none !important;
                border: 1px solid #000 !important;
                margin-bottom: 15px !important;
                page-break-inside: avoid;
                break-inside: avoid;
            }

            .order-card-header {
                background-color: #f8f9fa !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                border-bottom: 1px solid #000 !important;
                padding: 10px 15px !important;
            }

            .customer-card {
                box-shadow: none !important;
                border: 1px solid #000 !important;
                margin-bottom: 15px !important;
                page-break-inside: avoid;
                break-inside: avoid;
            }

            .order-card-body {
                padding: 15px !important;
            }

            .btn-action, .view-profile-btn {
                display: none !important;
            }

            .order-items-table {
                font-size: 9pt;
            }

            .order-items-table th,
            .order-items-table td {
                padding: 8px !important;
            }

            .order-table-1 {
                font-size: 9pt;
            }

            .order-table-1 td {
                padding: 6px 10px !important;
            }

            .order-table-1 tr:last-child td {
                font-size: 11pt;
            }

            /* Ensure tables don't break across pages */
            table {
                page-break-inside: avoid;
                break-inside: avoid;
            }

            /* Adjust margins for print */
            @page {
                margin: 15mm;
                size: A4;
            }

            /* Page breaks */
            .page-break {
                page-break-before: always;
                break-before: always;
            }

            /* Hide checkboxes in print */
            .custom-check {
                display: none !important;
            }

            /* Adjust spacing for print */
            .mt-5 {
                margin-top: 15px !important;
            }

            .mb-3 {
                margin-bottom: 8px !important;
            }

            /* Ensure product images are properly sized */
            .p-img {
                width: 40px !important;
                height: 40px !important;
            }

            /* Make text smaller to fit more content */
            h1 {
                font-size: 16pt !important;
                margin-bottom: 10pt !important;
            }

            h4 {
                font-size: 12pt !important;
            }

            h5 {
                font-size: 10pt !important;
                margin-bottom: 5pt !important;
            }

            p {
                font-size: 9pt !important;
                margin-bottom: 3pt !important;
                line-height: 1.2 !important;
            }

            /* Adjust order badge for print */
            .order-badge {
                width: auto !important;
                padding: 0 8px !important;
                font-size: 8pt !important;
                height: 24px !important;
            }

            /* Improve text alignment */
            .text-right {
                text-align: right !important;
            }

            /* Improve card layout for print */
            .row {
                margin-bottom: 10px !important;
            }

            /* Reduce image sizes */
            .customer-img {
                width: 40px !important;
                height: 40px !important;
            }

            /* Improve table layout */
            .table-responsive {
                overflow-x: visible !important;
            }
        }

        /* Toast notification styles */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
        }

        .toast {
            min-width: 250px;
            padding: 12px 20px;
            border-radius: 6px;
            margin-bottom: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .toast-success {
            background-color: #28a745;
            color: white;
        }

        .toast-error {
            background-color: #dc3545;
            color: white;
        }
    </style>

    <div class="main-content">
        <div class="main-content-inner">
            <div class="container mt-4">

                <h1 class="mb-4">Order Details</h1>

                <!-- ================= ORDER HEADER ================= -->
                <div class="row">
                    <div class="col-12">
                        <div class="order-card">

                            <div class="order-card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                                <div class="d-flex align-items-center flex-wrap mb-2 mb-md-0">
                                    <h4 class="m-0 me-3">Order ID: #{{ $order->order_number ?? $order->id }}</h4>
                                    <span class="order-badge {{ $order->status }}">{{ ucfirst($order->status) }}</span>
                                </div>
                            </div>

                            <div class="order-card-body">

                                <div class="row align-items-center">
                                    <div class="col-12 col-md-6 mb-3 mb-md-0 order-card-date">
                                        <i class="fi fi-rr-calendar icon-calendar-order me-2"></i>
                                        <span class="fw-bold">Order Date: {{ $order->created_at->format('d M Y') }}</span>
                                    </div>

                                    <div class="col-12 col-md-6 d-flex justify-content-md-end flex-wrap gap-2 no-print">
                                        <button id="printBtn" class="btn btn-print btn-action">
                                            <i class="fi fi-rr-print icon-btn me-2"></i> Print
                                        </button>

                                        <button id="saveBtn" class="btn btn-save btn-action">
                                            <i class="fi fi-rr-disk me-2"></i> Save as PDF
                                        </button>
                                    </div>
                                </div>

                                <!-- ========= CUSTOMER & INFO CARDS ========= -->
                                <div class="row mt-5">
                                    <!-- CUSTOMER CARD -->
                                    <div class="col-sm-4">
                                        <div class="customer-card card shadow-none">
                                            <div class="card-body">
                                                <div class="d-flex mb-3">
                                                    <img src="{{ $order->user->profile_photo ? asset('storage/' . $order->user->profile_photo) : asset('admin/images/p-1.svg') }}" class="customer-img me-3" alt="Customer">
                                                    <div>
                                                        <h5 class="m-0 fw-bold mb-3">Customer</h5>
                                                        <p class="mb-3">Full Name: {{ $order->user->full_name ?? $order->customer_name ?? 'N/A' }}</p>
                                                        <p class="mb-3">Email: {{ $order->user->email ?? $order->customer_email ?? 'N/A' }}</p>
                                                        <p class="mb-3">Phone: {{ $order->user->phone ?? $order->customer_phone ?? 'N/A' }}</p>
                                                    </div>
                                                </div>
                                                @if($order->user)
                                                    <a href="{{ route('admin.customer.show', $order->user->id) }}" class="btn view-profile-btn w-100 no-print">View Profile</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ORDER INFO CARD -->
                                    <div class="col-sm-4 mt-3 mt-sm-0">
                                        <div class="customer-card card shadow-none">
                                            <div class="card-body">
                                                <div class="d-flex mb-3">
                                                    <img src="{{ asset('admin/images/p-2.svg') }}" class="customer-img me-3" alt="Order Info">
                                                    <div>
                                                        <h5 class="m-0 fw-bold mb-3">Order Info</h5>
                                                        <p class="mb-3">Shipping: {{ $order->shipping_method ?? 'Standard' }}</p>
                                                        <p class="mb-3">Payment Method: {{ ucfirst($order->payment_method) }}</p>
                                                        <p class="mb-3">Status: {{ ucfirst($order->status) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- DELIVER TO CARD -->
                                    <div class="col-sm-4 mt-3 mt-sm-0">
                                        <div class="customer-card card shadow-none">
                                            <div class="card-body">
                                                <div class="d-flex mb-3">
                                                    <img src="{{ asset('admin/images/p-2.svg') }}"  class="customer-img me-3" alt="Delivery Address">
                                                    <div>
                                                        <h5 class="m-0 fw-bold mb-3">Deliver to</h5>
                                                        <p class="mb-3">Full Name: {{ $order->shipping_full_name }}</p>
                                                        <p class="mb-2">Address: {{ $order->shipping_address }}, {{ $order->shipping_city }}, {{ $order->shipping_state }}, {{ $order->shipping_country }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- ========= PAYMENT + NOTE SECTION ========= -->
                                <div class="row mt-5">
                                    <!-- PAYMENT CARD -->
                                    <div class="col-sm-4">
                                        <div class="customer-card card shadow-none h-100">
                                            <div class="card-body">
                                                <h5 class="m-0 fw-bold mb-3">Payment Details</h5>
                                                <div class="d-flex align-items-center mb-3">
                                                    @if($order->payment_method === 'stripe')
                                                        <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Mastercard-logo.png" style="width:55px;" class="me-3" alt="MasterCard">
                                                        <div>
                                                            <p class="mb-2">Master Card **** **** {{ substr($order->stripe_payment_intent_id, -4) ?? 'XXXX' }}</p>
                                                        </div>
                                                    @else
                                                        <div>
                                                            <p class="mb-2">{{ ucfirst($order->payment_method) }}</p>
                                                            <p class="mb-0">Status: {{ ucfirst($order->payment_status) }}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                                <p class="mb-2">Business Name: {{ $order->billing_first_name }} {{ $order->billing_last_name }}</p>
                                                <p class="mb-2">Phone: {{ $order->billing_phone ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- NOTE AREA -->
                                    <div class="col-sm-8">
                                        <div class="shadow-none h-100">
                                            <div class="card-body">
                                                <h5 class="fw-bold mb-3">Notes</h5>
                                                <div class="form-control notes-textarea" style="height: 100px; overflow-y: auto;">
                                                    {{ $order->order_notes ?? 'No notes available.' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= PRODUCTS TABLE & ORDER SUMMARY ================= -->
                <div class="row">
                    <div class="col-12">
                        <div class="order-card">
                            <div class="order-card-header">Products</div>
                            <div class="order-card-body products-card-container">

                                <!-- Products Table -->
                                <div class="products-table-container">
                                    <div class="table-responsive">
                                        <table class="order-items-table">
                                            <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Item Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($order->items as $item)
                                                <!-- PRODUCT ROW -->
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <input type="checkbox" class="custom-check me-3">
                                                            <div class="rounded me-3">
                                                                @if($item->product && $item->product->mainImage)
                                                                    <img src="{{ asset($item->product->mainImage->image_path) }}" alt="{{ $item->product_name }}" class="p-img">
                                                                @else
                                                                    <img src="{{ asset('admin/images/p-image.svg') }}" alt="Product Image" class="p-img">
                                                                @endif
                                                            </div>
                                                            <div>
                                                                <p class="mb-0">{{ $item->product_name }}</p>
                                                                @if($item->variant_details)
                                                                    <small class="text-muted">{{ $item->variant_details }}</small>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>${{ number_format($item->price, 2) }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>${{ number_format($item->total, 2) }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">No items found for this order.</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Order Summary Table -->
                                <div class="order-summary-container">
                                    <div class="order-summary-wrapper">
                                        <table class="order-table-1">
                                            <tr>
                                                <td class="label">Subtotal</td>
                                                <td class="value">${{ number_format($order->subtotal, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="label">Tax ({{ $order->tax_amount > 0 ? round(($order->tax_amount / $order->subtotal) * 100) : 0 }}%)</td>
                                                <td class="value">${{ number_format($order->tax_amount, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="label">Discount</td>
                                                <td class="value">$0.00</td>
                                            </tr>
                                            <tr>
                                                <td class="label">Shipping Rate</td>
                                                <td class="value">${{ number_format($order->shipping_amount, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="label">Total</td>
                                                <td class="value">${{ number_format($order->total_amount, 2) }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Toast container for notifications -->
    <div class="toast-container"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Print button functionality
            document.getElementById('printBtn').addEventListener('click', function() {
                window.print();
                showToast('Print dialog opened', 'success');
            });

            // Save as PDF button functionality
            document.getElementById('saveBtn').addEventListener('click', function() {
                saveAsPDF();
            });

            // Save as PDF function
            function saveAsPDF() {
                const { jsPDF } = window.jspdf;

                // Show loading message
                showToast('Generating PDF...', 'success');

                // Create a temporary container for PDF content
                const tempContainer = document.createElement('div');
                tempContainer.style.position = 'absolute';
                tempContainer.style.left = '-9999px';
                tempContainer.style.width = '210mm'; // A4 width
                tempContainer.style.padding = '15mm';
                tempContainer.style.backgroundColor = '#fff';
                document.body.appendChild(tempContainer);

                // Clone the main content
                const contentClone = document.querySelector('.main-content-inner').cloneNode(true);

                // Remove no-print elements
                const noPrintElements = contentClone.querySelectorAll('.no-print');
                noPrintElements.forEach(el => el.remove());

                // Add all elements to temp container
                tempContainer.appendChild(contentClone);

                // Generate PDF
                html2canvas(tempContainer, {
                    scale: 2,
                    logging: false,
                    useCORS: true,
                    allowTaint: true,
                    width: tempContainer.offsetWidth,
                    height: tempContainer.offsetHeight
                }).then(canvas => {
                    const imgData = canvas.toDataURL('image/png');
                    const pdf = new jsPDF('p', 'mm', 'a4');
                    const imgWidth = 210; // A4 width in mm
                    const pageHeight = 295; // A4 height in mm
                    const imgHeight = canvas.height * imgWidth / canvas.width;
                    let heightLeft = imgHeight;
                    let position = 0;

                    pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;

                    while (heightLeft >= 0) {
                        position = heightLeft - imgHeight;
                        pdf.addPage();
                        pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                        heightLeft -= pageHeight;
                    }

                    // Generate filename with order ID and date
                    const orderId = document.querySelector('h4').textContent.trim();
                    const date = new Date().toISOString().split('T')[0];
                    const filename = `${orderId}_${date}.pdf`;

                    pdf.save(filename);
                    document.body.removeChild(tempContainer);
                    showToast('PDF saved successfully', 'success');
                }).catch(error => {
                    showToast('Error generating PDF', 'error');
                    // Remove temp container
                    document.body.removeChild(tempContainer);
                });
            }

            // Toast notification function
            function showToast(message, type) {
                const toastContainer = document.querySelector('.toast-container');
                const toast = document.createElement('div');
                toast.className = `toast toast-${type}`;
                toast.textContent = message;

                toastContainer.appendChild(toast);

                // Trigger animation
                setTimeout(() => {
                    toast.style.opacity = '1';
                }, 10);
                setTimeout(() => {
                    toast.style.opacity = '0';
                    setTimeout(() => {
                        toastContainer.removeChild(toast);
                    }, 300);
                }, 3000);
            }
        });
    </script>

@endsection
