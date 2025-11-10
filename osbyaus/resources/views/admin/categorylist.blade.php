@extends("admin.layout.main")
@section('styles')

<style>
.wg-table.table-all-category .wg-product > *:nth-child(1), .wg-table.table-all-category ul.table-title > *:nth-child(1) {
width: 281px;
flex-shrink: 0;
}
@media (min-width: 768px) and (max-width: 1199px) {
  .wg-table.table-all-category > ul,
  .wg-table.table-all-category > div {
    min-width: 100% !important;
    width: 100% !important;
  }
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
                                    <h3>Category List</h3>
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
                                    <a class="tf-button style-1 w208" href="{{ url('/addcategory') }}"><i class="icon-plus"></i>Add new</a>
                                </div>

                                <!-- all-category -->
                                <div class="wg-box mt-5">
    <div class="wg-table table-all-category">
        <ul class="table-title flex gap20 mb-14">
            <li><div class="body-title">Category</div></li>
            <li><div class="body-title">Slug</div></li>
            <li><div class="body-title">Status</div></li>
            <li><div class="body-title">Created</div></li>
            <li><div class="body-title">Action</div></li>
        </ul>

        <ul class="flex flex-column">
            @foreach($categories as $category)
            <li class="wg-product item-row gap20">
                <div class="name">
                    <div class="image">
                        <img src="{{ asset('uploads/categories/' . ($category->image ?? 'default.jpg')) }}" 
                             alt="{{ $category->name }}" width="50">
                    </div>
                    <div class="title line-clamp-2 mb-0">
                        <a href="#" class="body-text">{{ $category->name }}</a>
                    </div>
                </div>

                <div class="body-text text-main-dark mt-4">{{ $category->slug }}</div>
                <div class="body-text text-main-dark mt-4">
                    {{ $category->is_active ? 'Active' : 'Inactive' }}
                </div>
                <div class="body-text text-main-dark mt-4">{{ $category->created_at->format('d M Y') }}</div>

               <div class="item-actions">
    <!-- Edit -->
    <a href="{{ route('edit.category', $category->id) }}" title="Edit Category">
        <i class="icon-edit"></i>
    </a>

    <!-- Delete -->
    <a href="{{ route('delete.category', $category->id) }}" 
       onclick="return confirm('Delete this category?')" title="Delete Category">
       <i class="icon-trash-2"></i>
    </a>

    <!-- Preview -->
    <a href="{{ route('category.list') }}#category-{{ $category->id }}" title="Preview Category">
        <i class="icon-eye"></i>
    </a>
</div>


            </li>
            @endforeach
        </ul>
    </div>
</div>

                                <!-- /all-category -->
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