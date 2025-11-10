@extends("admin.layout.main")

@section('styles')
<style>
    .wg-table.table-product-list .wg-product > *:nth-child(1), 
    .wg-table.table-product-list ul.table-title > *:nth-child(1) {
        width: 150px;
        flex-shrink: 0;
    }
    .wg-table.table-product-list .wg-product > *:nth-child(5), 
    .wg-table.table-product-list .wg-product > *:nth-child(4), 
    .wg-table.table-product-list ul.table-title > *:nth-child(5), 
    .wg-table.table-product-list ul.table-title > *:nth-child(4) {
        width: 100px;
        flex-shrink: 0;
    }
    .wg-table.table-product-list .wg-product > *:nth-child(7), 
    .wg-table.table-product-list .wg-product > *:nth-child(6), 
    .wg-table.table-product-list .wg-product > *:nth-child(3), 
    .wg-table.table-product-list ul.table-title > *:nth-child(7), 
    .wg-table.table-product-list ul.table-title > *:nth-child(6), 
    .wg-table.table-product-list ul.table-title > *:nth-child(3) {
        width: 125.33px;
        flex-shrink: 0;
    }
</style>
@endsection
@section('content')
    <!-- main-content -->
                    <div class="main-content">
                        <!-- main-content-wrap -->
                        <div class="main-content-inner">
                            <!-- main-content-wrap -->
                            <div class="main-content-wrap">
                                <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                                    <h3>Transaction History</h3>
                                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                                </div>
                                
                                <div class="search-bar-container">
                                    <!-- Search Form (stay at start) -->
                                    <form class="form-search">
                                        <fieldset class="name">
                                        <input type="text" placeholder="Search here..." name="search" required>
                                        <button type="submit" class="search-icon">
                                            <i class="icon-search"></i>
                                        </button>
                                        </fieldset>
                                    </form>

                                    <!-- Buttons at End -->
                                    <div class="search-actions-end">
                                        <!-- Status Dropdown -->
                                        <div class="dropdown status-dropdown">
                                        <button class="dropdown-btn">
                                            Status : Unpaid <i class="icon-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-content">
                                            <a href="#">Paid</a>
                                            <a href="#">Unpaid</a>
                                            <a href="#">All</a>
                                        </div>
                                        </div>

                                        <!-- Filter Dropdown -->
                                        <div class="dropdown">
                                        <button class="dropdown-btn">
                                            Filter by Recent <i class="icon-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-content">
                                            <a href="#">Newest First</a>
                                            <a href="#">Oldest First</a>
                                            <a href="#">A–Z</a>
                                            <a href="#">Z–A</a>
                                        </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- product-list -->
                                <div class="wg-box mt-5">
                                    <div class="wg-table table-product-list table-transaction-list">
                                        <ul class="table-title flex gap20 mb-14">
                                            <li>
                                                <div class="body-title">ID</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Customer</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Date</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Total</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Method</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Status</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Action</div>
                                            </li>
                                        </ul>
                                        <ul class="flex flex-column">
                                            <li class="wg-product item-row gap20">
                                                <div class="name">
                                                    <h6>#5089</h6>
                                                </div>
                                                <div class="body-text text-main-dark mt-4">Joseph Wheeler</div>
                                                <div class="body-text text-main-dark mt-4">6 April, 2023</div>
                                                <div class="body-text text-main-dark mt-4">RS. 2,564</div>
                                                <div class="body-text text-main-dark mt-4">Bank Transfer</div>
                                                <div>
                                                    <div class="block-stock bg-1 fw-7">Paid</div>
                                                </div>
                                                <div class="body-text text-main-dark mt-4">View Details</div>
                                            </li>
                                            <li class="wg-product item-row gap20">
                                                <div class="name">
                                                    <h6>#5089</h6>
                                                </div>
                                                <div class="body-text text-main-dark mt-4">Joseph Wheeler</div>
                                                <div class="body-text text-main-dark mt-4">6 April, 2023</div>
                                                <div class="body-text text-main-dark mt-4">RS. 2,564</div>
                                                <div class="body-text text-main-dark mt-4">Bank Transfer</div>
                                                <div>
                                                    <div class="block-stock bg-1 fw-7">Paid</div>
                                                </div>
                                                 <div class="body-text text-main-dark mt-4">View Details</div>
                                            </li>
                                           <li class="wg-product item-row gap20">
                                                <div class="name">
                                                    <h6>#5089</h6>
                                                </div>
                                                <div class="body-text text-main-dark mt-4">Joseph Wheeler</div>
                                                <div class="body-text text-main-dark mt-4">6 April, 2023</div>
                                                <div class="body-text text-main-dark mt-4">RS. 2,564</div>
                                                <div class="body-text text-main-dark mt-4">Bank Transfer</div>
                                                <div>
                                                    <div class="block-stock bg-1 fw-7">Paid</div>
                                                </div>
                                                 <div class="body-text text-main-dark mt-4">View Details</div>
                                            </li>
                                            <li class="wg-product item-row gap20">
                                                <div class="name">
                                                    <h6>#5089</h6>
                                                </div>
                                                <div class="body-text text-main-dark mt-4">Joseph Wheeler</div>
                                                <div class="body-text text-main-dark mt-4">6 April, 2023</div>
                                                <div class="body-text text-main-dark mt-4">RS. 2,564</div>
                                                <div class="body-text text-main-dark mt-4">Bank Transfer</div>
                                                <div>
                                                    <div class="block-stock bg-1 fw-7">Paid</div>
                                                </div>
                                                <div class="body-text text-main-dark mt-4">View Details</div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="divider"></div>
                                    <div class="flex items-center justify-between flex-wrap gap10">
                                        <div class="text-tiny">Showing 10 entries</div>
                                        <ul class="wg-pagination">
                                            <li>
                                                <a href="#"><i class="icon-chevron-left"></i></a>
                                            </li>
                                            <li>
                                                <a href="#">1</a>
                                            </li>
                                            <li class="active">
                                                <a href="#">2</a>
                                            </li>
                                            <li>
                                                <a href="#">3</a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="icon-chevron-right"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /product-list -->
                            </div>
                            <!-- /main-content-wrap -->
                        </div>
                        <!-- /main-content-wrap -->
                        
                        <!-- bottom-page -->
                        <div class="bottom-page">
                            <div class="body-text">Copyright © 2024 <a href="../index.html">Ecomus</a>. Design by Themesflat All rights reserved</div>
                        </div>
                        <!-- /bottom-page -->
                    </div>
                    <!-- /main-content -->
@endsection