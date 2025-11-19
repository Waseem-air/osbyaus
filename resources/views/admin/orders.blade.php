@extends("admin.layout.main")
@section('content')

<style>
/* ================= TAB BUTTONS ================= */
.custom-tab-btns {
    display: flex;
    width: 100%;
    gap: 10px;
}

.custom-tab-btns .tab-btn {
    width: 25%; /* 4 tabs in a row */
    text-align: center;
    padding: 10px 0;
    background: #ffffff;
    border-radius: 14px;
    cursor: pointer;
    font-weight: 500;
    font-size: 16px;
    transition: 0.3s;
}

.custom-tab-btns .tab-btn.active {
    background-color: #94010E1A;
    font-weight: 600;
    color: #94010E;
}

/* ================= CARD ================= */
.custom-tab-card {
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    border-top: none;
    margin-bottom: 20px;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
}

/* ================= RESPONSIVE ================= */
@media (max-width: 768px) {
    .custom-tab-btns {
        flex-direction: column;
    }
    .custom-tab-btns .tab-btn {
        width: 100%;
    }
}
</style>

<div class="main-content">
    <div class="main-content-inner">
        <div class="container mt-4">

        <!-- ================= ORDER TABS ================= -->
        <div class="row">
            <div class="col-12 wg-box-1">
                <div class="custom-tab-btns mb-0">
                    <button class="tab-btn active" data-bs-toggle="tab" data-bs-target="#allOrders">All Orders (441)</button>
                    <button class="tab-btn" data-bs-toggle="tab" data-bs-target="#shipping">Shipping (100)</button>
                    <button class="tab-btn" data-bs-toggle="tab" data-bs-target="#completed">Completed (300)</button>
                    <button class="tab-btn" data-bs-toggle="tab" data-bs-target="#cancel">Cancel (41)</button>
                </div>
            </div>
        </div>
         <!-- Search and Filter Bar -->
                <div class="search-bar-container mb-2 mt-4">
                    <!-- Search Form -->
                    <form class="form-search">
                        <fieldset class="name">
                            <input type="text" id="searchCategory" placeholder="Search categories..." name="search">
                        </fieldset>
                    </form>

                    <!-- Add New Button -->
                    <button class="tf-button style-1 w208" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                        <i class="icon-plus"></i> Add New Category
                    </button>
                </div>
        <!-- ================= ORDER TAB CONTENT ================= -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="tab-content">

                    <div class="tab-pane fade show active" id="allOrders">
                        <div class="custom-tab-card">
                            <h3>All Orders</h3>
                            <p>All orders list goes here…</p>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="shipping">
                        <div class="custom-tab-card">
                            <h3>Shipping Orders</h3>
                            <p>Shipping orders list goes here…</p>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="completed">
                        <div class="custom-tab-card">
                            <h3>Completed Orders</h3>
                            <p>Completed orders list goes here…</p>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="cancel">
                        <div class="custom-tab-card">
                            <h3>Cancelled Orders</h3>
                            <p>Cancelled orders list goes here…</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".custom-tab-btns .tab-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            document.querySelectorAll(".tab-btn").forEach(b => b.classList.remove("active"));
            this.classList.add("active");

            document.querySelectorAll(".tab-pane").forEach(tab => tab.classList.remove("show", "active"));

            document.querySelector(this.dataset.bsTarget).classList.add("show", "active");
        });
    });
});
</script>
@endpush
