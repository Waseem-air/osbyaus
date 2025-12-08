@extends("admin.layout.main")
@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                <h3>Transaction History</h3>
                <div class="text-muted">
                    Total Transactions: {{ $transactions->total() }}
                </div>
            </div>

            <!-- Table version -->
            <div class="wg-box mt-5">
                <div class="table-container table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                            <tr>
                                <td>#{{ $transaction->order_number }}</td>
                                <td>
                                    @if($transaction->user)
                                        {{ $transaction->user->first_name ?? '' }} {{ $transaction->user->last_name ?? '' }}
                                    @else
                                        {{ $transaction->customer_name ?? 'Guest' }}
                                    @endif
                                </td>
                                <td>{{ $transaction->created_at->format('d M, Y') }}</td>
                                <td>{{ \App\Helpers\AppHelper::currency_symbol() }} {{ number_format($transaction->total_amount, 2) }}</td>
                                <td>{{ ucfirst($transaction->payment_method ?? 'N/A') }}</td>
                                <td>
                                    @php
                                        $statusClass = 'bg-3';
                                        $statusText = ucfirst($transaction->status);
                                        
                                        if ($transaction->status == 'completed') {
                                            $statusClass = 'bg-1';
                                        } elseif ($transaction->status == 'processing') {
                                            $statusClass = 'bg-2';
                                        }
                                    @endphp
                                    <span class="block-stock {{ $statusClass }} fw-7">{{ $statusText }}</span>
                                </td>
                                <td>
                                    @php
                                        $paymentClass = 'bg-3';
                                        $paymentText = ucfirst($transaction->payment_status);
                                        
                                        if ($transaction->payment_status == 'paid') {
                                            $paymentClass = 'bg-1';
                                        } elseif ($transaction->payment_status == 'pending') {
                                            $paymentClass = 'bg-2';
                                        }
                                    @endphp
                                    <span class="block-stock {{ $paymentClass }} fw-7">{{ $paymentText }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.order.show', $transaction->id) }}" class="action-btn">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="text-muted">No transactions found.</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($transactions->hasPages())
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10">
                    <div class="text-tiny">
                        Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of {{ $transactions->total() }} entries
                    </div>
                    <div>
                        {{ $transactions->links('vendor.pagination.custom') }}
                    </div>
                </div>
                @endif
            </div>
            <!-- /table version -->
        </div>
    </div>
</div>
@endsection