@extends('website.layouts.main')
@section('title', 'Products')
@section('meta_description', 'Discover the best global fashion trends. Shop stylish clothing for men & women with fast worldwide delivery.')
@section('meta_keywords', 'fashion store, clothing shop, global fashion, men fashion, women fashion, ecommerce clothing')

@section('content')
    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec ec-breadcrumb section-space-mb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row ec_breadcrumb_inner">
                        <div class="col-md-12 col-sm-12">
                            <!-- ec-breadcrumb-list start -->
                            <ul class="ec-breadcrumb-list text-left">
                                <li class="ec-breadcrumb-item"><a href="index.html"><i class="fi-rr-home"></i></a></li>
                                <li class="ec-breadcrumb-item">Categories</li>
                                <li class="ec-breadcrumb-item active">Mobile Phones</li>
                            </ul>
                            <!-- ec-breadcrumb-list end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Sart Single product -->
    <section class="ec-page-content category-tab section-space-p section-space-mb">
        <div class="container">
            <div class="row">
                <!--  Products Section Start -->
                <div class="ec-pro-rightside ec-common-rightside col-lg-8 order-lg-last col-md-12 order-md-first">
                    <div class="ec-pro-content-sort">
                        <span class="sort-result">Showing: 610 Results</span>
                        <div class="ec-select-inner">
                            <select name="ec-select" id="ec-select">
                                <option selected="" disabled="">Latest</option>
                                <option value="1">Featured</option>
                                <option value="2">Name, A to Z</option>
                                <option value="3">Name, Z to A</option>
                                <option value="4">Price, low to high</option>
                                <option value="5">Price, high to low</option>
                            </select>
                        </div>
                    </div>
                    <div class="row gy-4">
                        <div class="col-lg-4 col-md-6">
                            <div class="ec-product-content p-0 mb-4">
                                <div class="ec-product-inner hot-sale-card">
                                    <div class="ec-pro-image-outer">
                                        <div class="ec-pro-image hot-sale-img">
                                            <a href="product-detail.html" class="image sale-img">
                                                <img class="main-image" src="website/assets/images/product/01.png"
                                                     alt="Product"/>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ec-pro-content text-center">
                                        <a href="product-detail.html">
                                            <h6 class="ec-pro-stitle">Many paisley 2 piece</h6>
                                        </a>
                                        <p class="ec-pro-subtitle">2 PIECE Puff Print | 100% Cotton |
                                            A-Line Cut</p>
                                        <div class="ec-pro-rat-price align-items-center">
                                            <span class="ec-price">
                                                <span class="old-price">Rs.8,450</span>
                                                <span class="new-price">Rs.4,224</span>
                                            </span>
                                        </div>
                                        <div class="ec-pro-size-wrapper">
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="xs">
                                                <label class="form-check-label" for="xs">xs</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="s">
                                                <label class="form-check-label" for="s">s</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="m">
                                                <label class="form-check-label" for="m">m</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="l">
                                                <label class="form-check-label" for="l">l</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="xl">
                                                <label class="form-check-label" for="xl">xl</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="ec-product-content p-0 mb-4">
                                <div class="ec-product-inner hot-sale-card">
                                    <div class="ec-pro-image-outer">
                                        <div class="ec-pro-image hot-sale-img">
                                            <a href="product-detail.html" class="image sale-img">
                                                <img class="main-image" src="website/assets/images/product/02.png"
                                                     alt="Product"/>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ec-pro-content text-center">
                                        <a href="product-detail.html">
                                            <h6 class="ec-pro-stitle">Many paisley 2 piece</h6>
                                        </a>
                                        <p class="ec-pro-subtitle">2 PIECE Puff Print | 100% Cotton |
                                            A-Line Cut</p>
                                        <div class="ec-pro-rat-price align-items-center">
                                            <span class="ec-price">
                                                <span class="old-price">Rs.8,450</span>
                                                <span class="new-price">Rs.4,224</span>
                                            </span>
                                        </div>
                                        <div class="ec-pro-size-wrapper">
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="xs_1">
                                                <label class="form-check-label" for="xs_1">xs</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="s_1">
                                                <label class="form-check-label" for="s_1">s</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="m_1">
                                                <label class="form-check-label" for="m_1">m</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="l_1">
                                                <label class="form-check-label" for="l">l</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="xl_1">
                                                <label class="form-check-label" for="xl_1">xl</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="ec-product-content p-0 mb-4">
                                <div class="ec-product-inner hot-sale-card">
                                    <div class="ec-pro-image-outer">
                                        <div class="ec-pro-image hot-sale-img">
                                            <a href="product-detail.html" class="image sale-img">
                                                <img class="main-image" src="website/assets/images/product/03.png"
                                                     alt="Product"/>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ec-pro-content text-center">
                                        <a href="product-detail.html">
                                            <h6 class="ec-pro-stitle">Many paisley 2 piece</h6>
                                        </a>
                                        <p class="ec-pro-subtitle">2 PIECE Puff Print | 100% Cotton |
                                            A-Line Cut</p>
                                        <div class="ec-pro-rat-price align-items-center">
                                            <span class="ec-price">
                                                <span class="old-price">Rs.8,450</span>
                                                <span class="new-price">Rs.4,224</span>
                                            </span>
                                        </div>
                                        <div class="ec-pro-size-wrapper">
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="xs_2">
                                                <label class="form-check-label" for="xs_2">xs</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="s_2">
                                                <label class="form-check-label" for="s_2">s</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="m_2">
                                                <label class="form-check-label" for="m_2">m</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="l_2">
                                                <label class="form-check-label" for="l_2">l</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="xl_2">
                                                <label class="form-check-label" for="xl_2">xl</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="ec-product-content p-0 mb-4">
                                <div class="ec-product-inner hot-sale-card">
                                    <div class="ec-pro-image-outer">
                                        <div class="ec-pro-image hot-sale-img">
                                            <a href="product-detail.html" class="image sale-img">
                                                <img class="main-image" src="website/assets/images/product/04.png"
                                                     alt="Product"/>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ec-pro-content text-center">
                                        <a href="product-detail.html">
                                            <h6 class="ec-pro-stitle">Many paisley 2 piece</h6>
                                        </a>
                                        <p class="ec-pro-subtitle">2 PIECE Puff Print | 100% Cotton |
                                            A-Line Cut</p>
                                        <div class="ec-pro-rat-price align-items-center">
                                            <span class="ec-price">
                                                <span class="old-price">Rs.8,450</span>
                                                <span class="new-price">Rs.4,224</span>
                                            </span>
                                        </div>
                                        <div class="ec-pro-size-wrapper">
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="xs_3">
                                                <label class="form-check-label" for="xs_3">xs</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="s_3">
                                                <label class="form-check-label" for="s_3">s</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="m_3">
                                                <label class="form-check-label" for="m_3">m</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="l_3">
                                                <label class="form-check-label" for="l_3">l</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="xl_3">
                                                <label class="form-check-label" for="xl_3">xl</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="ec-product-content p-0 mb-4">
                                <div class="ec-product-inner hot-sale-card">
                                    <div class="ec-pro-image-outer">
                                        <div class="ec-pro-image hot-sale-img">
                                            <a href="product-detail.html" class="image sale-img">
                                                <img class="main-image" src="website/assets/images/product/05.png"
                                                     alt="Product"/>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ec-pro-content text-center">
                                        <a href="product-detail.html">
                                            <h6 class="ec-pro-stitle">Many paisley 2 piece</h6>
                                        </a>
                                        <p class="ec-pro-subtitle">2 PIECE Puff Print | 100% Cotton |
                                            A-Line Cut</p>
                                        <div class="ec-pro-rat-price align-items-center">
                                            <span class="ec-price">
                                                <span class="old-price">Rs.8,450</span>
                                                <span class="new-price">Rs.4,224</span>
                                            </span>
                                        </div>
                                        <div class="ec-pro-size-wrapper">
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="xs_4">
                                                <label class="form-check-label" for="xs_4">xs</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="s_4">
                                                <label class="form-check-label" for="s_4">s</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="m_4">
                                                <label class="form-check-label" for="m_4">m</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="l_4">
                                                <label class="form-check-label" for="l_4">l</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="xl_4">
                                                <label class="form-check-label" for="xl_4">xl</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="ec-product-content p-0 mb-4">
                                <div class="ec-product-inner hot-sale-card">
                                    <div class="ec-pro-image-outer">
                                        <div class="ec-pro-image hot-sale-img">
                                            <a href="product-detail.html" class="image sale-img">
                                                <img class="main-image" src="website/assets/images/product/06.png"
                                                     alt="Product"/>
                                            </a>
                                            <div class="ec-pro-actions">
                                                <span class="badge bg-white">Diva</span>
                                            </div>
                                            <div class="ec-pro-actions-sale">
                                                <span class="badge bg-white">50% OFF</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ec-pro-content text-center">
                                        <a href="product-detail.html">
                                            <h6 class="ec-pro-stitle">Many paisley 2 piece</h6>
                                        </a>
                                        <p class="ec-pro-subtitle">2 PIECE Puff Print | 100% Cotton |
                                            A-Line Cut</p>
                                        <div class="ec-pro-rat-price align-items-center">
                                            <span class="ec-price">
                                                <span class="old-price">Rs.8,450</span>
                                                <span class="new-price">Rs.4,224</span>
                                            </span>
                                        </div>
                                        <div class="ec-pro-size-wrapper">
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="xs_5">
                                                <label class="form-check-label" for="xs_5">xs</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="s_5">
                                                <label class="form-check-label" for="s_5">s</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="m_5">
                                                <label class="form-check-label" for="m_5">m</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="l_5">
                                                <label class="form-check-label" for="l_5">l</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="xl_5">
                                                <label class="form-check-label" for="xl_5">xl</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="ec-product-content p-0 mb-4">
                                <div class="ec-product-inner hot-sale-card">
                                    <div class="ec-pro-image-outer">
                                        <div class="ec-pro-image hot-sale-img">
                                            <a href="product-detail.html" class="image sale-img">
                                                <img class="main-image" src="website/assets/images/product/07.png"
                                                     alt="Product"/>
                                            </a>
                                            <div class="ec-pro-actions">
                                                <span class="badge bg-white">Diva</span>
                                            </div>
                                            <div class="ec-pro-actions-sale">
                                                <span class="badge bg-white">50% OFF</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ec-pro-content text-center">
                                        <a href="product-detail.html">
                                            <h6 class="ec-pro-stitle">Many paisley 2 piece</h6>
                                        </a>
                                        <p class="ec-pro-subtitle">2 PIECE Puff Print | 100% Cotton |
                                            A-Line Cut</p>
                                        <div class="ec-pro-rat-price align-items-center">
                                            <span class="ec-price">
                                                <span class="old-price">Rs.8,450</span>
                                                <span class="new-price">Rs.4,224</span>
                                            </span>
                                        </div>
                                        <div class="ec-pro-size-wrapper">
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="xs_6">
                                                <label class="form-check-label" for="xs_6">xs</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="s_6">
                                                <label class="form-check-label" for="s_6">s</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="m_6">
                                                <label class="form-check-label" for="m_6">m</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="l_6">
                                                <label class="form-check-label" for="l_6">l</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="xl_6">
                                                <label class="form-check-label" for="xl_6">xl</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="ec-product-content p-0 mb-4">
                                <div class="ec-product-inner hot-sale-card">
                                    <div class="ec-pro-image-outer">
                                        <div class="ec-pro-image hot-sale-img">
                                            <a href="product-detail.html" class="image sale-img">
                                                <img class="main-image" src="website/assets/images/product/08.png"
                                                     alt="Product"/>
                                            </a>
                                            <div class="ec-pro-actions">
                                                <span class="badge bg-white">Diva</span>
                                            </div>
                                            <div class="ec-pro-actions-sale">
                                                <span class="badge bg-white">50% OFF</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ec-pro-content text-center">
                                        <a href="product-detail.html">
                                            <h6 class="ec-pro-stitle">Many paisley 2 piece</h6>
                                        </a>
                                        <p class="ec-pro-subtitle">2 PIECE Puff Print | 100% Cotton |
                                            A-Line Cut</p>
                                        <div class="ec-pro-rat-price align-items-center">
                                            <span class="ec-price">
                                                <span class="old-price">Rs.8,450</span>
                                                <span class="new-price">Rs.4,224</span>
                                            </span>
                                        </div>
                                        <div class="ec-pro-size-wrapper">
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="xs_7">
                                                <label class="form-check-label" for="xs_7">xs</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="s_7">
                                                <label class="form-check-label" for="s_7">s</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="m_7">
                                                <label class="form-check-label" for="m_7">m</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="l_7">
                                                <label class="form-check-label" for="l_7">l</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="xl_7">
                                                <label class="form-check-label" for="xl_7">xl</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="ec-product-content p-0 mb-4">
                                <div class="ec-product-inner hot-sale-card">
                                    <div class="ec-pro-image-outer">
                                        <div class="ec-pro-image hot-sale-img">
                                            <a href="product-detail.html" class="image sale-img">
                                                <img class="main-image" src="website/assets/images/product/09.png"
                                                     alt="Product"/>
                                            </a>
                                            <div class="ec-pro-actions">
                                                <span class="badge bg-white">Diva</span>
                                            </div>
                                            <div class="ec-pro-actions-sale">
                                                <span class="badge bg-white">50% OFF</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ec-pro-content text-center">
                                        <a href="product-detail.html">
                                            <h6 class="ec-pro-stitle">Many paisley 2 piece</h6>
                                        </a>
                                        <p class="ec-pro-subtitle">2 PIECE Puff Print | 100% Cotton |
                                            A-Line Cut</p>
                                        <div class="ec-pro-rat-price align-items-center">
                                            <span class="ec-price">
                                                <span class="old-price">Rs.8,450</span>
                                                <span class="new-price">Rs.4,224</span>
                                            </span>
                                        </div>
                                        <div class="ec-pro-size-wrapper">
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="xs_8">
                                                <label class="form-check-label" for="xs_8">xs</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="s_8">
                                                <label class="form-check-label" for="s_8">s</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="m_8">
                                                <label class="form-check-label" for="m_8">m</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="l_8">
                                                <label class="form-check-label" for="l_8">l</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="xl_8">
                                                <label class="form-check-label" for="xl_8">xl</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="ec-product-content p-0 mb-4">
                                <div class="ec-product-inner hot-sale-card">
                                    <div class="ec-pro-image-outer">
                                        <div class="ec-pro-image hot-sale-img">
                                            <a href="product-detail.html" class="image sale-img">
                                                <img class="main-image" src="website/assets/images/product/10.png"
                                                     alt="Product"/>
                                            </a>
                                            <div class="ec-pro-actions">
                                                <span class="badge bg-white">Diva</span>
                                            </div>
                                            <div class="ec-pro-actions-sale">
                                                <span class="badge bg-white">50% OFF</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ec-pro-content text-center">
                                        <a href="product-detail.html">
                                            <h6 class="ec-pro-stitle">Many paisley 2 piece</h6>
                                        </a>
                                        <p class="ec-pro-subtitle">2 PIECE Puff Print | 100% Cotton |
                                            A-Line Cut</p>
                                        <div class="ec-pro-rat-price align-items-center">
                                            <span class="ec-price">
                                                <span class="old-price">Rs.8,450</span>
                                                <span class="new-price">Rs.4,224</span>
                                            </span>
                                        </div>
                                        <div class="ec-pro-size-wrapper">
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="xs_9">
                                                <label class="form-check-label" for="xs_9">xs</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="s_9">
                                                <label class="form-check-label" for="s_9">s</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="m_9">
                                                <label class="form-check-label" for="m_9">m</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="l_9">
                                                <label class="form-check-label" for="l_9">l</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="xl_9">
                                                <label class="form-check-label" for="xl_9">xl</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="ec-product-content p-0 mb-4">
                                <div class="ec-product-inner hot-sale-card">
                                    <div class="ec-pro-image-outer">
                                        <div class="ec-pro-image hot-sale-img">
                                            <a href="product-detail.html" class="image sale-img">
                                                <img class="main-image" src="website/assets/images/product/11.png"
                                                     alt="Product"/>
                                            </a>
                                            <div class="ec-pro-actions">
                                                <span class="badge bg-white">Diva</span>
                                            </div>
                                            <div class="ec-pro-actions-sale">
                                                <span class="badge bg-white">50% OFF</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ec-pro-content text-center">
                                        <a href="product-detail.html">
                                            <h6 class="ec-pro-stitle">Many paisley 2 piece</h6>
                                        </a>
                                        <p class="ec-pro-subtitle">2 PIECE Puff Print | 100% Cotton |
                                            A-Line Cut</p>
                                        <div class="ec-pro-rat-price align-items-center">
                                            <span class="ec-price">
                                                <span class="old-price">Rs.8,450</span>
                                                <span class="new-price">Rs.4,224</span>
                                            </span>
                                        </div>
                                        <div class="ec-pro-size-wrapper">
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="xs_10">
                                                <label class="form-check-label" for="xs_10">xs</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="s_10">
                                                <label class="form-check-label" for="s_10">s</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="m_10">
                                                <label class="form-check-label" for="m_10">m</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="l_10">
                                                <label class="form-check-label" for="l_10">l</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="xl_10">
                                                <label class="form-check-label" for="xl_10">xl</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="ec-product-content p-0 mb-4">
                                <div class="ec-product-inner hot-sale-card">
                                    <div class="ec-pro-image-outer">
                                        <div class="ec-pro-image hot-sale-img">
                                            <a href="product-detail.html" class="image sale-img">
                                                <img class="main-image" src="website/assets/images/product/12.png"
                                                     alt="Product"/>
                                            </a>
                                            <div class="ec-pro-actions">
                                                <span class="badge bg-white">Diva</span>
                                            </div>
                                            <div class="ec-pro-actions-sale">
                                                <span class="badge bg-white">50% OFF</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ec-pro-content text-center">
                                        <a href="product-detail.html">
                                            <h6 class="ec-pro-stitle">Many paisley 2 piece</h6>
                                        </a>
                                        <p class="ec-pro-subtitle">2 PIECE Puff Print | 100% Cotton |
                                            A-Line Cut</p>
                                        <div class="ec-pro-rat-price align-items-center">
                                            <span class="ec-price">
                                                <span class="old-price">Rs.8,450</span>
                                                <span class="new-price">Rs.4,224</span>
                                            </span>
                                        </div>
                                        <div class="ec-pro-size-wrapper">
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="xs_11">
                                                <label class="form-check-label" for="xs_11">xs</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="s_11">
                                                <label class="form-check-label" for="s_11">s</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="m_11">
                                                <label class="form-check-label" for="m_11">m</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="l_11">
                                                <label class="form-check-label" for="l_11">l</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="xl_11">
                                                <label class="form-check-label" for="xl_11">xl</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="ec-product-content p-0 mb-4">
                                <div class="ec-product-inner hot-sale-card">
                                    <div class="ec-pro-image-outer">
                                        <div class="ec-pro-image hot-sale-img">
                                            <a href="product-detail.html" class="image sale-img">
                                                <img class="main-image" src="website/assets/images/product/13.png"
                                                     alt="Product"/>
                                            </a>
                                            <div class="ec-pro-actions">
                                                <span class="badge bg-white">Diva</span>
                                            </div>
                                            <div class="ec-pro-actions-sale">
                                                <span class="badge bg-white">50% OFF</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ec-pro-content text-center">
                                        <a href="product-detail.html">
                                            <h6 class="ec-pro-stitle">Many paisley 2 piece</h6>
                                        </a>
                                        <p class="ec-pro-subtitle">2 PIECE Puff Print | 100% Cotton |
                                            A-Line Cut</p>
                                        <div class="ec-pro-rat-price align-items-center">
                                            <span class="ec-price">
                                                <span class="old-price">Rs.8,450</span>
                                                <span class="new-price">Rs.4,224</span>
                                            </span>
                                        </div>
                                        <div class="ec-pro-size-wrapper">
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="xs_12">
                                                <label class="form-check-label" for="xs_12">xs</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="s_12">
                                                <label class="form-check-label" for="s_12">s</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="m_12">
                                                <label class="form-check-label" for="m_12">m</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="l_12">
                                                <label class="form-check-label" for="l_12">l</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="xl_12">
                                                <label class="form-check-label" for="xl_12">xl</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="ec-product-content p-0 mb-4">
                                <div class="ec-product-inner hot-sale-card">
                                    <div class="ec-pro-image-outer">
                                        <div class="ec-pro-image hot-sale-img">
                                            <a href="product-detail.html" class="image sale-img">
                                                <img class="main-image" src="website/assets/images/product/14.png"
                                                     alt="Product"/>
                                            </a>
                                            <div class="ec-pro-actions">
                                                <span class="badge bg-white">Diva</span>
                                            </div>
                                            <div class="ec-pro-actions-sale">
                                                <span class="badge bg-white">50% OFF</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ec-pro-content text-center">
                                        <a href="product-detail.html">
                                            <h6 class="ec-pro-stitle">Many paisley 2 piece</h6>
                                        </a>
                                        <p class="ec-pro-subtitle">2 PIECE Puff Print | 100% Cotton |
                                            A-Line Cut</p>
                                        <div class="ec-pro-rat-price align-items-center">
                                            <span class="ec-price">
                                                <span class="old-price">Rs.8,450</span>
                                                <span class="new-price">Rs.4,224</span>
                                            </span>
                                        </div>
                                        <div class="ec-pro-size-wrapper">
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="xs_13">
                                                <label class="form-check-label" for="xs_13">xs</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="s_13">
                                                <label class="form-check-label" for="s_13">s</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="m_13">
                                                <label class="form-check-label" for="m_13">m</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="l_13">
                                                <label class="form-check-label" for="l_13">l</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="xl_13">
                                                <label class="form-check-label" for="xl_13">xl</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="ec-product-content p-0 mb-4">
                                <div class="ec-product-inner hot-sale-card">
                                    <div class="ec-pro-image-outer">
                                        <div class="ec-pro-image hot-sale-img">
                                            <a href="product-detail.html" class="image sale-img">
                                                <img class="main-image" src="website/assets/images/product/15.png"
                                                     alt="Product"/>
                                            </a>
                                            <div class="ec-pro-actions">
                                                <span class="badge bg-white">Diva</span>
                                            </div>
                                            <div class="ec-pro-actions-sale">
                                                <span class="badge bg-white">50% OFF</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ec-pro-content text-center">
                                        <a href="product-detail.html">
                                            <h6 class="ec-pro-stitle">Many paisley 2 piece</h6>
                                        </a>
                                        <p class="ec-pro-subtitle">2 PIECE Puff Print | 100% Cotton |
                                            A-Line Cut</p>
                                        <div class="ec-pro-rat-price align-items-center">
                                            <span class="ec-price">
                                                <span class="old-price">Rs.8,450</span>
                                                <span class="new-price">Rs.4,224</span>
                                            </span>
                                        </div>
                                        <div class="ec-pro-size-wrapper">
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="xs_14">
                                                <label class="form-check-label" for="xs_14">xs</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="s_14">
                                                <label class="form-check-label" for="s_14">s</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="m_14">
                                                <label class="form-check-label" for="m_14">m</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn">
                                                <input class="form-check-input" type="checkbox" id="l_14">
                                                <label class="form-check-label" for="l_14">l</label>
                                            </div>
                                            <div class="form-check ec-pro-size-btn empty">
                                                <input class="form-check-input" disabled type="checkbox" id="xl_14">
                                                <label class="form-check-label" for="xl_14">xl</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  Products Section End -->

                <!-- Sidebar Area Start -->
                <div class="ec-pro-leftside ec-common-leftside col-lg-4 order-lg-first col-md-12 order-md-last">
                    <div class="ec-sidebar-wrap mt-md-3 mt-4">
                        <!-- Sidebar Category Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-category-wrapper">
                                <div class="ec-category-items">
                                    <h3 class="ec-category-title">Availability</h3>
                                    <div class="ec-category-item">
                                        <input class="form-check-input" type="checkbox" id="in-stock">
                                        <label for="in-stock">In stock</label>
                                    </div>
                                    <div class="ec-category-item">
                                        <input class="form-check-input" type="checkbox" id="out-stock">
                                        <label for="out-stock">Out of stock</label>
                                    </div>
                                </div>
                                <div class="ec-category-items">
                                    <h3 class="ec-category-title">Size</h3>
                                    <div class="d-flex align-items-start">
                                        <div class="w-50">
                                            <div class="ec-category-item">
                                                <input class="form-check-input" type="checkbox" id="xs-size">
                                                <label for="xs-size">XS</label>
                                            </div>
                                            <div class="ec-category-item">
                                                <input class="form-check-input" type="checkbox" id="s-size">
                                                <label for="s-size">S</label>
                                            </div>
                                            <div class="ec-category-item">
                                                <input class="form-check-input" type="checkbox" id="m-size">
                                                <label for="m-size">M</label>
                                            </div>
                                            <div class="ec-category-item">
                                                <input class="form-check-input" type="checkbox" id="l-size">
                                                <label for="l-size">L</label>
                                            </div>
                                            <div class="ec-category-item">
                                                <input class="form-check-input" type="checkbox" id="xl-size">
                                                <label for="xl-size">XL</label>
                                            </div>
                                            <div class="ec-category-item">
                                                <input class="form-check-input" type="checkbox" id="2_3-size">
                                                <label for="2_3-size">2-3 Years</label>
                                            </div>
                                            <div class="ec-category-item">
                                                <input class="form-check-input" type="checkbox" id="3_4-size">
                                                <label for="3_4-size">3-4 Years</label>
                                            </div>
                                        </div>
                                        <div class="w-50">
                                            <div class="ec-category-item">
                                                <input class="form-check-input" type="checkbox" id="4_5-size">
                                                <label for="4_5-size">4-5 Years</label>
                                            </div>
                                            <div class="ec-category-item">
                                                <input class="form-check-input" type="checkbox" id="5_6-size">
                                                <label for="5_6-size">5-6 Years</label>
                                            </div>
                                            <div class="ec-category-item">
                                                <input class="form-check-input" type="checkbox" id="6_7-size">
                                                <label for="6_7-size">6-7 Years</label>
                                            </div>
                                            <div class="ec-category-item">
                                                <input class="form-check-input" type="checkbox" id="7_8-size">
                                                <label for="7_8-size">7-8 Years</label>
                                            </div>
                                            <div class="ec-category-item">
                                                <input class="form-check-input" type="checkbox" id="free-size">
                                                <label for="free-size">Free Size</label>
                                            </div>
                                            <div class="ec-category-item">
                                                <input class="form-check-input" type="checkbox" id="unstitched-size">
                                                <label for="unstitched-size">Unstitched</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ec-category-items">
                                    <h3 class="ec-category-title">Price Range</h3>
                                    <div class="range-slider">
                                        <span class="price-input up-input">
                                            <input type="number" class="left-input" value="0" min="0" max="8000"
                                                   readonly/>
                                            <input type="number" class="right-input" value="8000" min="0" max="8000"
                                                   readonly/>
                                        </span>
                                        <div>
                                            <input value="0" min="0" max="8000" step="10" type="range"/>
                                            <input value="8000" min="0" max="8000" step="10" type="range"/>
                                        </div>
                                        <span class="price-input down-input">
                                            <input type="number" class="left-input" value="0" min="0" max="8000"
                                                   readonly/>
                                            <input type="number" class="right-input" value="8000" min="0" max="8000"
                                                   readonly/>
                                        </span>
                                    </div>
                                </div>
                                <div class="ec-category-items">
                                    <h3 class="ec-category-title">Embellishment</h3>
                                    <div class="ec-category-item">
                                        <input class="form-check-input" type="checkbox" id="digital-prints">
                                        <label for="digital-prints">Digital Prints</label>
                                    </div>
                                    <div class="ec-category-item">
                                        <input class="form-check-input" type="checkbox" id="embriodery-prints">
                                        <label for="embriodery-prints">Embriodery</label>
                                    </div>
                                    <div class="ec-category-item">
                                        <input class="form-check-input" type="checkbox" id="hand-prints">
                                        <label for="hand-prints">Hand Screen Prints</label>
                                    </div>
                                    <div class="ec-category-item">
                                        <input class="form-check-input" type="checkbox" id="solid-prints">
                                        <label for="solid-prints">Solid</label>
                                    </div>
                                </div>
                                <div class="ec-category-items">
                                    <h3 class="ec-category-title">Cut Style</h3>
                                    <div class="ec-category-item">
                                        <input class="form-check-input" type="checkbox" id="line-cut">
                                        <label for="line-cut">A-Line Cut</label>
                                    </div>
                                    <div class="ec-category-item">
                                        <input class="form-check-input" type="checkbox" id="box-cut">
                                        <label for="box-cut">Box Cut</label>
                                    </div>
                                    <div class="ec-category-item">
                                        <input class="form-check-input" type="checkbox" id="flared-cut">
                                        <label for="flared-cut">Flared Cut</label>
                                    </div>
                                    <div class="ec-category-item">
                                        <input class="form-check-input" type="checkbox" id="loose-cut">
                                        <label for="loose-cut">Loose Cut</label>
                                    </div>
                                    <div class="ec-category-item">
                                        <input class="form-check-input" type="checkbox" id="straight-cut">
                                        <label for="straight-cut">Straight Cut</label>
                                    </div>
                                </div>
                                <div class="ec-category-items">
                                    <h3 class="ec-category-title">Piece</h3>
                                    <div class="ec-category-item">
                                        <input class="form-check-input" type="checkbox" id="1-piece">
                                        <label for="1-piece">1 Piece</label>
                                    </div>
                                    <div class="ec-category-item">
                                        <input class="form-check-input" type="checkbox" id="2-piece">
                                        <label for="2-piece">1 Piece</label>
                                    </div>
                                    <div class="ec-category-item">
                                        <input class="form-check-input" type="checkbox" id="3-piece">
                                        <label for="3-piece">3 Piece</label>
                                    </div>
                                </div>
                                <div class="ec-category-items">
                                    <h3 class="ec-category-title">Season</h3>
                                    <div class="ec-category-item">
                                        <input class="form-check-input" type="checkbox" id="fall-season">
                                        <label for="fall-season">Fall</label>
                                    </div>
                                    <div class="ec-category-item">
                                        <input class="form-check-input" type="checkbox" id="spring-season">
                                        <label for="spring-season">Spring</label>
                                    </div>
                                    <div class="ec-category-item">
                                        <input class="form-check-input" type="checkbox" id="summer-season">
                                        <label for="summer-season">Summer</label>
                                    </div>
                                    <div class="ec-category-item">
                                        <input class="form-check-input" type="checkbox" id="winter-season">
                                        <label for="winter-season">Winter</label>
                                    </div>
                                </div>
                                <div class="ec-category-items">
                                    <h3 class="ec-category-title">Product Type</h3>
                                    <div class="d-flex align-items-start">
                                        <div class="w-50">
                                            <div class="ec-category-item">
                                                <input class="form-check-input" type="checkbox" id="ready-wear">
                                                <label for="ready-wear">Ready To Wear</label>
                                            </div>
                                            <div class="ec-category-item">
                                                <input class="form-check-input" type="checkbox" id="casual-wear">
                                                <label for="casual-wear">Casual Wear</label>
                                            </div>
                                            <div class="ec-category-item">
                                                <input class="form-check-input" type="checkbox" id="luxury-wear">
                                                <label for="luxury-wear">Luxury Wear</label>
                                            </div>
                                        </div>
                                        <div class="w-50">
                                            <div class="ec-category-item">
                                                <input class="form-check-input" type="checkbox" id="party-wear">
                                                <label for="party-wear">Party Wear</label>
                                            </div>
                                            <div class="ec-category-item">
                                                <input class="form-check-input" type="checkbox" id="formal-wear">
                                                <label for="formal-wear">Formal Wear</label>
                                            </div>
                                            <div class="ec-category-item">
                                                <input class="form-check-input" type="checkbox" id="collection-wear">
                                                <label for="collection-wear">Collection</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sidebar Category Block -->
                    </div>
                </div>
                <!-- Sidebar Area End -->
            </div>
        </div>
    </section>
    <!-- End Single product -->
@endsection
