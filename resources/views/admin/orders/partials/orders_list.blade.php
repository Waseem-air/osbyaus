<div class="custom-tab-card">
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Total</th>
                <th>Payment</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>
                        <strong>#{{ $order->order_number }}</strong>
                        <br>
                        <small class="text-muted">{{ $order->created_at->diffForHumans() }}</small>
                    </td>
                    <td>
                        <div>
                            <small class="fw-bold">{{ $order->billing_first_name }} {{ $order->billing_last_name }}</small>
                            <br>
                            <small>{{ $order->billing_email }}</small>
                            <br>
                            <small>{{ $order->billing_phone }}</small>
                        </div>
                    </td>
                    <td>
                        {{ $order->created_at->format('M d, Y') }}
                        <br>
                        <small>{{ $order->created_at->format('h:i A') }}</small>
                    </td>
                    <td>
                        <strong>{{ App\Helpers\AppHelper::currency_symbol() }}{{ number_format($order->total_amount, 2) }}</strong>
                    </td>
                    <td>
                        @php
                            $paymentStatusColors = [
                                'paid' => 'success',
                                'pending' => 'warning',
                                'failed' => 'danger'
                            ];
                        @endphp
                        <span class="badge bg-{{ $paymentStatusColors[$order->payment_status] ?? 'secondary' }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>

                        <!-- Payment Link Button -->
                        @if($order->payment_status === 'pending' && $order->stripe_payment_link)
                            <br>
                            <small>
                                <a href="javascript:void(0);"
                                   class="text-primary show-payment-link"
                                   data-payment-link="{{ $order->stripe_payment_link }}"
                                   data-order-number="{{ $order->order_number }}">
                                    <i class="icon-link"></i> Payment Link
                                </a>
                            </small>
                        @endif
                    </td>
                    <td>
                        @php
                            $statusColors = [
                                'pending' => '#FFA52F',
                                'confirmed' => '#0FB7FF',
                                'processing' => '#6f42c1',
                                'shipped' => '#010101',
                                'delivered' => '#28a745',
                                'cancelled' => '#dc3545'
                            ];
                        @endphp
                        <select class="form-select-no-border status-dropdown"
                                data-order-id="{{ $order->id }}"
                                style="background-color: {{ $statusColors[$order->status] }}">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </td>
                    <td>
                        <div class="action-dropdown">
                            <button class="action-btn">
                                <i class="icon-more-vertical"></i>
                            </button>
                            <div class="action-menu">
                                <a href="{{ route('admin.order.show', $order->id) }}">
                                    <i class="icon-eye"></i> View Details
                                </a>
                                <a href="#" class="text-primary edit-order" data-order-id="{{ $order->id }}">
                                    <i class="icon-edit"></i> Edit Order
                                </a>

                                <!-- Show Payment Link in Actions -->
                                @if($order->payment_status === 'pending' && $order->stripe_payment_link)
                                    <a href="javascript:void(0);"
                                       class="text-info show-payment-link"
                                       data-payment-link="{{ $order->stripe_payment_link }}"
                                       data-order-number="{{ $order->order_number }}">
                                        <i class="icon-external-link"></i> Payment Link
                                    </a>
                                @endif

                                <a href="#" class="text-danger delete-order" data-order-id="{{ $order->id }}">
                                    <i class="icon-trash-2"></i> Delete
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center py-4">
                        <i class="icon-package" style="font-size: 3rem; color: #ccc;"></i>
                        <p class="mt-2 text-muted">No orders found</p>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($orders->hasPages())
        <nav aria-label="Page navigation" class="mt-3">
            <ul class="pagination justify-content-end">
                {{ $orders->links() }}
            </ul>
        </nav>
    @endif
</div>

<!-- Add SweetAlert CSS & JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Payment Link Display
        document.querySelectorAll('.show-payment-link').forEach(button => {
            button.addEventListener('click', function() {
                const paymentLink = this.getAttribute('data-payment-link');
                const orderNumber = this.getAttribute('data-order-number');

                Swal.fire({
                    title: `Payment Link - Order #${orderNumber}`,
                    html: `
                    <div class="text-start">
                        <div class="input-group mb-3">
                            <input type="text"
                                   class="form-control"
                                   value="${paymentLink}"
                                   readonly
                                   id="paymentLinkInput-${orderNumber}"
                                   style="font-size: 14px;">
                            <button class="btn btn-outline-primary" type="button" onclick="copyToClipboard('paymentLinkInput-${orderNumber}', this)">
                                Copy
                            </button>
                        </div>
                        <div class="d-grid gap-2">
                            <a href="${paymentLink}"
                               target="_blank"
                               class="tf-button style-1 w208">
                                <i class="icon-external-link"></i> Open Payment Link
                            </a>

                        </div>
                    </div>
                `,
                    width: 600,
                    showCloseButton: true,
                    showConfirmButton: false,
                    customClass: {
                        popup: 'payment-link-popup'
                    }
                });
            });
        });
    });

    // Copy to Clipboard Function
    function copyToClipboard(inputId, button) {
        const input = document.getElementById(inputId);
        input.select();
        input.setSelectionRange(0, 99999);
        document.execCommand('copy');
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="icon-check"></i> Copied!';
        button.classList.remove('btn-outline-primary');
        button.classList.add('btn-success');
        setTimeout(() => {
            button.innerHTML = originalText;
            button.classList.remove('btn-success');
            button.classList.add('btn-outline-primary');
        }, 2000);
    }
</script>

<style>
    .payment-link-popup .swal2-popup {
        border-radius: 12px;
    }

    .form-select-no-border {
        border: none;
        padding: 4px 8px;
        border-radius: 4px;
        color: white;
        font-weight: 500;
        cursor: pointer;
        outline: none;
    }

    .form-select-no-border:focus {
        outline: none;
        box-shadow: none;
    }

    .action-dropdown {
        position: relative;
        display: inline-block;
    }

    .action-btn {
        background: none;
        border: none;
        padding: 5px;
        cursor: pointer;
    }

    .action-menu {
        display: none;
        position: absolute;
        right: 0;
        background: white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border-radius: 6px;
        min-width: 160px;
        z-index: 1000;
    }

    .action-dropdown:hover .action-menu {
        display: block;
    }

    .action-menu a {
        display: block;
        padding: 8px 16px;
        text-decoration: none;
        color: #333;
        border-bottom: 1px solid #f0f0f0;
    }

    .action-menu a:hover {
        background: #f8f9fa;
    }

    .action-menu a:last-child {
        border-bottom: none;
    }

    .badge {
        font-size: 0.75em;
        padding: 4px 8px;
    }

</style>
