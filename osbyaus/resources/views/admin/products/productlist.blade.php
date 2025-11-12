@extends("admin.layout.main")

@section('content')
    <!-- main-content -->
                    <div class="main-content">
                        <!-- main-content-wrap -->
                        <div class="main-content-inner">
                            <!-- main-content-wrap -->
                            <div class="main-content-wrap">
                                <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                                    <h3>Product List</h3>
                                </div>
                                
                                <div class="search-bar-container">
                                    <!-- Search Form -->
                                    <form class="form-search">
                                        <fieldset class="name">
                                            <input type="text" placeholder="Search here..." name="search" required>
                                            <button type="submit" class="search-icon">
                                                <i class="icon-search"></i>
                                            </button>
                                        </fieldset>
                                    </form>

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

                                    <!-- Filter by Recent Dropdown -->
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

                                    <!-- Add New Button -->
                                    <a class="tf-button style-1 w208" href="add-product.html">
                                        <i class="icon-plus"></i> Add new
                                    </a>
                                </div>

                                <!-- product-list -->
                                <div class="wg-box mt-5">
                                    <div class="wg-table table-product-list">
                                        <ul class="table-title flex gap20 mb-14">
                                            <li>
                                                <div class="body-title">Product</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Price</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Color & size</div>
                                            </li>
                                            <li>
                                                <div class="body-title">Stock</div>
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
                                                    <div class="image">
                                                        <img src="{{ asset('admin/admin-ecomus/images/products/product-1.jpg') }}" alt="">                                          </div>
                                                    <div class="title line-clamp-2 mb-0">
                                                        <a href="#" class="body-text">Main Paislay 3 Piece</a>
                                                        <p>SKU: 68699654</p>
                                                    </div>
                                                </div>
                                                <div class="body-text text-main-dark mt-4">$1,452.500</div>
                                                <div class="size-display-group">
                                                    <!-- Small -->
                                                    <div class="size-display">
                                                        <span class="color-circle" style="background-color: #00B894;"></span>
                                                    </div>

                                                    <!-- Medium -->
                                                    <div class="size-display">
                                                        <span class="color-circle" style="background-color: #F39C12;"></span>
                                                    </div>

                                                    <!-- Large -->
                                                    <div class="size-display">
                                                        <span class="color-circle" style="background-color: #94010E;"></span>
                                                    </div>

                                                    <div class="size-display">
                                                        <p>L/M/S</p>
                                                    </div>
                                                </div>
                                                <div class="body-text text-main-dark mt-4">20</div>
                                                <div>
                                                    <div class="block-stock bg-1 fw-7">Out of stock</div>
                                                </div>
                                                <div class="list-icon-function">
                                                    <div class="item eye">
                                                        <i class="icon-eye"></i>
                                                    </div>
                                                    <div class="item edit">
                                                        <i class="icon-edit-3"></i>
                                                    </div>
                                                    <div class="item trash">
                                                        <i class="icon-trash-2"></i>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="wg-product item-row gap20">
                                                <div class="name">
                                                    <div class="image">
                                                        <img src="{{ asset('admin/admin-ecomus/images/products/product-1.jpg') }}" alt="">                                          </div>
                                                    <div class="title line-clamp-2 mb-0">
                                                        <a href="#" class="body-text">Main Paislay 3 Piece</a>
                                                        <p>SKU: 68699654</p>
                                                    </div>
                                                </div>
                                                <div class="body-text text-main-dark mt-4">$1,452.500</div>
                                                <div class="size-display-group">
                                                    <!-- Small -->
                                                    <div class="size-display">
                                                        <span class="color-circle" style="background-color: #00B894;"></span>
                                                    </div>

                                                    <!-- Medium -->
                                                    <div class="size-display">
                                                        <span class="color-circle" style="background-color: #F39C12;"></span>
                                                    </div>

                                                    <!-- Large -->
                                                    <div class="size-display">
                                                        <span class="color-circle" style="background-color: #94010E;"></span>
                                                    </div>

                                                    <div class="size-display">
                                                        <p>L/M/S</p>
                                                    </div>
                                                </div>
                                                <div class="body-text text-main-dark mt-4">20</div>
                                                <div>
                                                    <div class="block-available bg-1 fw-7">In Stock</div>
                                                </div>
                                                <div class="list-icon-function">
                                                    <div class="item eye">
                                                        <i class="icon-eye"></i>
                                                    </div>
                                                    <div class="item edit">
                                                        <i class="icon-edit-3"></i>
                                                    </div>
                                                    <div class="item trash">
                                                        <i class="icon-trash-2"></i>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="wg-product item-row gap20">
                                                <div class="name">
                                                     <div class="image">
                                                        <img src="{{ asset('admin/admin-ecomus/images/products/product-1.jpg') }}" alt="">                                          </div>
                                                    <div class="title line-clamp-2 mb-0">
                                                        <a href="#" class="body-text">Main Paislay 3 Piece</a>
                                                        <p>SKU: 68699654</p>
                                                    </div>
                                                </div>
                                                <div class="body-text text-main-dark mt-4">$1,452.500</div>
                                                <div class="size-display-group">
                                                    <!-- Small -->
                                                    <div class="size-display">
                                                        <span class="color-circle" style="background-color: #00B894;"></span>
                                                    </div>

                                                    <!-- Medium -->
                                                    <div class="size-display">
                                                        <span class="color-circle" style="background-color: #F39C12;"></span>
                                                    </div>

                                                    <!-- Large -->
                                                    <div class="size-display">
                                                        <span class="color-circle" style="background-color: #94010E;"></span>
                                                    </div>

                                                    <div class="size-display">
                                                        <p>L/M/S</p>
                                                    </div>
                                                </div>
                                                <div class="body-text text-main-dark mt-4">20</div>
                                                <div>
                                                    <div class="block-available bg-1 fw-7">In Stock</div>
                                                </div>
                                                <div class="list-icon-function">
                                                    <div class="item eye">
                                                        <i class="icon-eye"></i>
                                                    </div>
                                                    <div class="item edit">
                                                        <i class="icon-edit-3"></i>
                                                    </div>
                                                    <div class="item trash">
                                                        <i class="icon-trash-2"></i>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="wg-product item-row gap20">
                                                <div class="name">
                                                     <div class="image">
                                                        <img src="{{ asset('admin/admin-ecomus/images/products/product-1.jpg') }}" alt="">                                          </div>
                                                    <div class="title line-clamp-2 mb-0">
                                                        <a href="#" class="body-text">Main Paislay 3 Piece</a>
                                                        <p>SKU: 68699654</p>
                                                    </div>
                                                </div>
                                                <div class="body-text text-main-dark mt-4">$1,452.500</div>
                                                <div class="size-display-group">
                                                    <!-- Small -->
                                                    <div class="size-display">
                                                        <span class="color-circle" style="background-color: #00B894;"></span>
                                                    </div>

                                                    <!-- Medium -->
                                                    <div class="size-display">
                                                        <span class="color-circle" style="background-color: #F39C12;"></span>
                                                    </div>

                                                    <!-- Large -->
                                                    <div class="size-display">
                                                        <span class="color-circle" style="background-color: #94010E;"></span>
                                                    </div>

                                                    <div class="size-display">
                                                        <p>L/M/S</p>
                                                    </div>
                                                </div>
                                                <div class="body-text text-main-dark mt-4">20</div>
                                                <div>
                                                    <div class="block-available bg-1 fw-7">In Stock</div>
                                                </div>
                                                <div class="list-icon-function">
                                                    <div class="item eye">
                                                        <i class="icon-eye"></i>
                                                    </div>
                                                    <div class="item edit">
                                                        <i class="icon-edit-3"></i>
                                                    </div>
                                                    <div class="item trash">
                                                        <i class="icon-trash-2"></i>
                                                    </div>
                                                </div>
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