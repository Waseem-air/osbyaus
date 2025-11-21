<style>
    .form-control {
        outline: 0;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
        width: 100%;
        padding: 15px 22px;
        font-size: 14px;
        font-weight: 600 !important;
        line-height: 20px;
        letter-spacing: -1px;
        background-color: var(--Surface-3);
        border: 0;
        border-radius: 12px;
        color: var(--Surface-2);
        overflow: hidden;
        margin-bottom: 0;
    }
</style>

<div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="addOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow-sm border-0 rounded-3">

            <!-- Modal Header -->
            <div class="modal-header bg-dark text-white border-0">
                <h5 class="modal-title text-white" id="addOrderModalLabel">Create New Order</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body p-4">
                <form id="addOrderForm">
                    <!-- ===================== PRODUCT SELECT ===================== -->
                    <div class="card p-3 shadow-sm mb-1 border-0 rounded-3">
                        <h6 class="fw-bold mb-3">Product Information</h6>
                        <div class="row g-3">
                            <div class="col-md-5">
                                <label class="form-label fw-semibold">Select Product <span class="text-danger">*</span></label>
                                <select class="form-control" name="product_id" id="productSelect" required>
                                    <option value="">-- Choose Product --</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}"
                                                data-price="{{ $product->discount_price ?? $product->price }}">
                                            {{ $product->name }} - ({{ App\Helpers\AppHelper::currency_symbol() }}{{ $product->discount_price ?? $product->price }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="text-danger small mt-1" id="productError"></div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">Quantity <span class="text-danger">*</span></label>
                                <input type="number" class="form-control " name="quantity" id="orderQuantity" min="1" value="1" required>
                                <div class="text-danger small mt-1" id="quantityError"></div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Total Amount</label>
                                <input type="number" class="form-control " name="total_amount" placeholder="Enter Total amount" id="totalAmount" >
                            </div>
                        </div>
                    </div>

                    <!-- ===================== CUSTOMER INFORMATION ===================== -->
                    <div class="card p-3 shadow-sm mb-1 border-0 rounded-3">
                        <h6 class="fw-bold mb-3">Customer Information</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Customer Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control " name="customer_name" placeholder="Enter Name" required>
                                <div class="text-danger small mt-1" id="customerNameError"></div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control " name="customer_email" placeholder="Enter Email" required>
                                <div class="text-danger small mt-1" id="customerEmailError"></div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control " name="customer_phone" placeholder="03XX-XXXXXXX" required>
                                <div class="text-danger small mt-1" id="customerPhoneError"></div>
                            </div>
                        </div>
                    </div>

                    <!-- ===================== ORDER DETAILS ===================== -->
                    <div class="card p-3 shadow-sm mb-1 border-0 rounded-3">
                        <h6 class="fw-bold mb-3">Order Details</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Payment Status</label>
                                <select class="form-control" name="payment_status" id="paymentStatus">
                                    <option value="pending">Pending</option>
                                    <option value="paid">Paid</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Select Order Status</label>
                                <select class="form-control" name="order_status" id="orderStatus">
                                    <option value="delivered">Delivered</option>
                                    <option value="completed">Completed</option>
                                    <option value="pending">Pending</option>
                                    <option value="processing">Processing</option>
                                    <option value="shipped">Shipped</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Order Notes</label>
                                <input type="text" class="form-control " name="order_notes" placeholder="Add any order notes..." id="orderDate">
                            </div>

                        </div>

                    </div>


                </form>
            </div>

            <!-- Modal Footer -->

            <div class="modal-footer">
                <button type="button" class="tf-button style-1 w208" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="tf-button style-1 w208 d-flex align-items-center" id="addCustomerBtn">
                    <span class="spinner-border spinner-border-sm me-2 d-none"></span>
                    Create Order
                </button>
            </div>
        </div>
    </div>
</div>

