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
                            <strong>{{ $order->billing_first_name }} {{ $order->billing_last_name }}</strong>
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
