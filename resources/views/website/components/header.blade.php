<!-- Header start  -->
<header class="ec-header">
    <!--Ec Header Top Start -->
    <div class="header-top">
        <div class="container">
            <div class="row align-items-center">
                <!-- Header Top phone Start -->
                <div class="col header-top-left text-center">
                    <!-- Social Start -->
                    <div class="header-top-social">
                        <ul class="mb-0">
                            <li class="list-inline-item">
                                <a href="#">Enjoy Free Shipping Over {{ \App\Helpers\AppHelper::currency_symbol() }}{{ env('FREE_DELIVERY_FEE') ?? 500 }} All Over Pakistan</a>
                            </li>
                        </ul>
                    </div>
                    <!-- Social End -->
                </div>
                <!-- Header Top phone End -->
            </div>
        </div>
    </div>
    <!-- Ec Header Top  End -->

    <!-- Ec Header Bottom  Start -->
    <div class="ec-header-bottom">
        <div class="container position-relative">
            <div class="row">
                <div class="ec-flex">
                    <!-- Ec Header Logo Start -->
                    <div class="align-self-center ec-header-logo d-lg-block d-none">
                        <div class="header-logo">
                            <a href="{{ route('home') }}">
                                <img src="website/assets/images/logo/logo.svg" alt="Site Logo" />
                            </a>
                        </div>
                    </div>
                    <!-- Ec Header Logo End -->

                    <!-- Ec Header Logo Start -->
                    <div class="align-self-center me-auto ec-header-logo d-lg-none">
                        <div class="header-logo">
                            <a href="{{ route('home') }}">
                                <img src="website/assets/images/logo/logo-sm.svg" class="w-100" alt="Site Logo" />
                            </a>
                        </div>
                    </div>
                    <!-- Ec Header Logo End -->

                    <!-- Ec Header Button Start -->
                    <div class="align-self-center ec-header-bottons">
                        <!-- Ec Header Search Start -->
                        <button class="search_submit d-sm-block d-none" type="submit">
                            <i class="fi-rr-search"></i>
                        </button>
                        <!-- Ec Header Search End -->

                        <!-- Header User Start -->
                        <div class="ec-header-user dropdown">

                            @auth
                                <button class="profile dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="fi-rr-user"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    {{-- Role-based dashboard --}}
                                    @if (auth()->user()->role === 'admin')
                                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                                    @elseif (auth()->user()->role === 'seller')
                                        <li><a class="dropdown-item" href="{{ route('seller.dashboard') }}">Seller Dashboard</a></li>
                                    @elseif (auth()->user()->role === 'customer')
                                        <li><a class="dropdown-item" href="{{ route('customer.dashboard') }}">Dashboard</a></li>
                                    @else
                                        <li><a class="dropdown-item" href="{{ route('customer.dashboard') }}">Dashboard</a></li>
                                    @endif
                                    <li>
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button class="dropdown-item text-danger" type="submit">Logout</button>
                                        </form>
                                    </li>

                                </ul>

                            @else
                                <!-- If guest -->
                                <button class="profile dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="fi-rr-user"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                                    <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
                                </ul>
                            @endauth

                        </div>
                        <!-- Header User End -->


                        <!-- Header Wishlisty Start -->
                        <a href="wishlist.html" class="wishlist_submit">
                            <i class="fi-rr-heart"></i>
                        </a>
                        <!-- Header Wishlist End -->

                        <!-- Header Cart Start -->
                        <!-- In your header -->
                        <div class="ec-header-cart">
                            <a href="#ec-side-cart" class="cart_submit ec-side-toggle" style="position: relative;">
                                <i class="fi-rr-shopping-cart"></i>
                                <span class="cart-count-badge" style="display: none;">0</span>
                            </a>
                        </div>
                        <!-- Header Cart End -->
                    </div>

                    <!-- Header menu Start -->
                    <a href="#ec-mobile-menu" class="ec-header-btn ec-side-toggle d-lg-none">
                        <i class="ecicon eci-bars"></i>
                    </a>
                    <!-- Header menu End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Ec Header Button End -->

    <!-- EC Category Menu Start -->
    <div id="ec-main-menu-desk" class="sticky-nav">
        <div class="container position-relative">
            <div class="row m-0">
                <div class="col ec-main-menu-block align-self-center d-none d-lg-block p-0">
                    <div class="ec-main-menu">
                        <ul>
                            <li class="dropdown"><a href="{{ route('products.index')  }}">New Arrival</a></li>
                            <li class="dropdown"><a href="{{ route('products.index')  }}">Ready To Wear</a></li>
                            <li class="dropdown"><a href="{{ route('products.index')  }}">Party Wear</a></li>
                            <li class="dropdown"><a href="{{ route('products.index')  }}">Formal</a></li>
                            <li class="dropdown"><a href="{{ route('products.index')  }}">Casual Wear</a></li>
                            <li class="dropdown">
                                <a href="{{ route('products.index')  }}" class="d-flex align-items-center gap-2">
                                    <img src="website/assets/images/icon/sale.svg" style="height: 20px;" alt="">
                                    Collection
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec Category Menu End -->

    <!-- EC Mobile Menu Start -->
    <div id="ec-mobile-menu" class="ec-side-cart ec-mobile-menu">
        <div class="ec-menu-title">
            <span class="menu_title">Menu</span>
            <button class="ec-close">×</button>
        </div>
        <div class="ec-menu-inner">
            <div class="ec-menu-content">
                <ul>
                    <li class="dropdown"><a href="{{ route('products.index')  }}">New Arrival</a></li>
                    <li class="dropdown"><a href="{{ route('products.index')  }}">Ready To Wear</a></li>
                    <li class="dropdown"><a href="{{ route('products.index')  }}">Party Wear</a></li>
                    <li class="dropdown"><a href="{{ route('products.index')  }}">Formal</a></li>
                    <li class="dropdown"><a href="{{ route('products.index')  }}">Casual Wear</a></li>
                    <li class="dropdown">
                        <a href="{{ route('products.index')  }}" class="d-flex align-items-center gap-2">
                            <img src="website/assets/images/icon/sale.svg" style="height: 20px;" alt="">
                            Collection
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- EC Mobile Menu End -->
</header>
<!-- Header End  -->
