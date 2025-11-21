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
                    @csrf <!-- Add CSRF token -->

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
                                <input type="number" class="form-control" name="quantity" id="orderQuantity" min="1" value="1" required>
                                <div class="text-danger small mt-1" id="quantityError"></div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Total Amount <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="total_amount" placeholder="Enter Total amount" id="totalAmount" step="0.01" required>
                                <small class="text-muted">Enter the total amount including any additional charges</small>
                            </div>
                        </div>
                    </div>

                    <!-- ===================== CUSTOMER INFORMATION ===================== -->
                    <div class="card p-3 shadow-sm mb-1 border-0 rounded-3">
                        <h6 class="fw-bold mb-3">Customer Information</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Customer Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="customer_name" placeholder="Enter Name" required>
                                <div class="text-danger small mt-1" id="customerNameError"></div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="customer_email" placeholder="Enter Email" required>
                                <div class="text-danger small mt-1" id="customerEmailError"></div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="customer_phone" placeholder="03XX-XXXXXXX" required>
                                <div class="text-danger small mt-1" id="customerPhoneError"></div>
                            </div>
                        </div>
                    </div>

                    <!-- ===================== ORDER DETAILS ===================== -->
                    <div class="card p-3 shadow-sm mb-1 border-0 rounded-3">
                        <h6 class="fw-bold mb-3">Order Details</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Payment Status <span class="text-danger">*</span></label>
                                <select class="form-control" name="payment_status" id="paymentStatus" required>
                                    <option value="pending">Pending</option>
                                    <option value="paid">Paid</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Order Status <span class="text-danger">*</span></label>
                                <select class="form-control" name="order_status" id="orderStatus" required>
                                    <option value="pending">Pending</option>
                                    <option value="processing">Processing</option>
                                    <option value="shipped">Shipped</option>
                                    <option value="delivered">Delivered</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Order Notes</label>
                                <input type="text" class="form-control" name="order_notes" placeholder="Add any order notes..." id="orderNotes">
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="tf-button style-1 w208" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="tf-button style-1 w208 d-flex align-items-center" id="addOrderBtn">
                    <span class="spinner-border spinner-border-sm me-2 d-none" id="orderSpinner"></span>
                    Create Order
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        const addOrderForm = document.getElementById("addOrderForm");
        const addOrderBtn = document.getElementById("addOrderBtn");
        const orderSpinner = document.getElementById("orderSpinner");

        const productSelect = document.getElementById("productSelect");
        const orderQuantity = document.getElementById("orderQuantity");
        const totalAmount = document.getElementById("totalAmount");

        /* ---------------------------------------
            AUTO CALCULATE TOTAL
        --------------------------------------- */
        productSelect.addEventListener("change", calcTotal);
        orderQuantity.addEventListener("input", calcTotal);

        function calcTotal() {
            let selectedProduct = productSelect.options[productSelect.selectedIndex];
            let price = parseFloat(selectedProduct?.dataset.price || 0);
            let qty = parseInt(orderQuantity.value || 1);

            if (price > 0 && qty > 0) {
                totalAmount.value = (price * qty).toFixed(2);
            }
        }

        /* ---------------------------------------
            HANDLE FORM SUBMIT
        --------------------------------------- */
        addOrderBtn.addEventListener("click", function (e) {
            e.preventDefault();

            let errors = validateForm();
            if (errors.length > 0) {
                Swal.fire({
                    icon: "error",
                    title: "Validation Error",
                    html: errors.join("<br>"),
                    confirmButtonText: "Fix Errors"
                });
                return;
            }

            // Start Loading
            addOrderBtn.disabled = true;
            orderSpinner.classList.remove("d-none");

            let formData = new FormData(addOrderForm);

            fetch(`{{ route('admin.create.order') }}`, {
                method: "POST",
                body: formData,
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                },
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: "success",
                            title: "Order Created Successfully",
                            html: `
                             ${data.order.stripe_payment_link
                                ? `<p><strong>Payment Link:</strong></p>
                               <div class="input-group mt-3 mb-3">
                                   <input type="text" class="form-control" value="${data.order.stripe_payment_link}" readonly id="paymentLinkInput">
                                   <button class="btn btn-dark" onclick="copyPaymentLink()">Copy</button>
                               </div>
                               <a href="${data.order.stripe_payment_link}" class="btn btn-primary" target="_blank">Open Payment Page</a>
                              `
                                : `<p>No payment link generated (Paid Order).</p>`}
                              `,
                            confirmButtonText: "Go to Orders"
                        }).then(() => {
                            window.location.href = "{{ route('admin.order.index') }}";
                        });

                        // Close modal
                        let modal = bootstrap.Modal.getInstance(document.getElementById("addOrderModal"));
                        modal.hide();

                        addOrderForm.reset();

                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: data.message || "Something went wrong"
                        });
                    }
                })
                .catch(err => {
                    Swal.fire({
                        icon: "error",
                        title: "Request Failed",
                        text: "Something went wrong. Please try again."
                    });
                })
                .finally(() => {
                    addOrderBtn.disabled = false;
                    orderSpinner.classList.add("d-none");
                });

        });

        /* ---------------------------------------
            VALIDATION FUNCTION
        --------------------------------------- */
        function validateForm() {

            let errors = [];

            const name = addOrderForm.customer_name.value.trim();
            const email = addOrderForm.customer_email.value.trim();
            const phone = addOrderForm.customer_phone.value.trim();
            const qty = orderQuantity.value;
            const total = totalAmount.value;

            removeInputErrors();

            if (!productSelect.value) {
                errors.push("Please select a product.");
                highlightError(productSelect);
            }

            if (!qty || qty < 1) {
                errors.push("Enter a valid quantity.");
                highlightError(orderQuantity);
            }

            if (!total || parseFloat(total) <= 0) {
                errors.push("Enter a valid total amount.");
                highlightError(totalAmount);
            }

            if (!name) {
                errors.push("Customer name is required.");
                highlightError(addOrderForm.customer_name);
            }

            if (!email) {
                errors.push("Customer email is required.");
                highlightError(addOrderForm.customer_email);
            }

            if (!phone) {
                errors.push("Customer phone is required.");
                highlightError(addOrderForm.customer_phone);
            }

            return errors;
        }

        /* ---------------------------------------
           UI ERROR HIGHLIGHTING
        --------------------------------------- */
        function highlightError(field) {
            field.classList.add("is-invalid");
        }

        function removeInputErrors() {
            document.querySelectorAll(".is-invalid").forEach(el => {
                el.classList.remove("is-invalid");
            });
        }

    });

    /* ---------------------------------------
       COPY PAYMENT LINK FUNCTION
    --------------------------------------- */
    function copyPaymentLink() {
        let input = document.getElementById("paymentLinkInput");
        input.select();
        input.setSelectionRange(0, 999999);
        document.execCommand("copy");
        Swal.fire({
            icon: "success",
            title: "Copied!",
            text: "Payment link copied to clipboard",
            timer: 1500,
            showConfirmButton: false
        });
    }
</script>
