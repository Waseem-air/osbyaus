
<!-- Load More Section -->
<style>
    #load-more-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    /* Loader spinner styling */
    #load-more-loader {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    #load-more-loader .spinner-border {
        width: 3rem;
        height: 3rem;
    }

    #load-more-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 20px;
        font-size: 1.1rem;
        gap: 0.5rem;
    }

    #loaded-count {
        font-size: 0.9rem;
        padding: 0.2rem 0.5rem;
    }

    #end-of-products {
        margin-top: 30px;
        max-width: 400px;
        text-align: center;
    }
</style>

<div class="row gy-4" id="products-grid">
    @foreach($products as $product)
        <div class="col-lg-4 col-md-6">
            @include('website.partials.product-cards')
        </div>
    @endforeach
</div>

<div id="load-more-section">
    <div id="load-more-loader" style="display: none;">
        <div class="spinner-border text-dark" role="status">
            <span class="visually-hidden">Loading more...</span>
        </div>
        <p class="mt-2">Loading more...</p>
    </div>

    <button id="load-more-btn" class="btn btn-outline-dark btn-lg px-4" style="display: none;">
        <i class="fi-rr-refresh"></i> Load More
        <span id="loaded-count" class="badge bg-dark ms-2"></span>
    </button>

    <div id="end-of-products" style="display: none;">
        <div class="alert alert-light border">
            <i class="fi-rr-check-circle text-success me-2"></i>
            <strong>All products loaded!</strong>
            <p class="mb-0 mt-1 text-muted">You've viewed all {{ $products->total() }} products</p>
        </div>
    </div>
</div>
