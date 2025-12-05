<!-- section-menu-left -->
<div class="section-menu-left">
    <div class="box-logo">
        <a href="{{ route('admin.dashboard') }}" id="site-logo-inner">
            <img class="" id="logo_header" alt="" src="{{ asset('admin/logo/logo.png') }}"
                 data-light="/admin/logo/logo.svg" data-dark="/admin/logo/logo-white.svg">
        </a>
        <div class="button-show-hide">
            <i class="icon-chevron-left"></i>
        </div>
    </div>
    <div class="section-menu-left-wrap">
        <div class="center">
            <div class="center-item">
                <ul class="">
                    <!-- Dashboard -->
                    <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}" class="">
                            <div class="icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2652 3.57566C12.1187 3.42921 11.8813 3.42921 11.7348 3.57566L5.25 10.0605V19.8748C5.25 20.0819 5.41789 20.2498 5.625 20.2498H9V16.1248C9 15.0893 9.83947 14.2498 10.875 14.2498H13.125C14.1605 14.2498 15 15.0893 15 16.1248V20.2498H18.375C18.5821 20.2498 18.75 20.0819 18.75 19.8748V10.0605L12.2652 3.57566ZM20.25 11.5605L21.2197 12.5302C21.5126 12.8231 21.9874 12.8231 22.2803 12.5302C22.5732 12.2373 22.5732 11.7624 22.2803 11.4695L13.3258 2.51499C12.5936 1.78276 11.4064 1.78276 10.6742 2.515L1.71967 11.4695C1.42678 11.7624 1.42678 12.2373 1.71967 12.5302C2.01256 12.8231 2.48744 12.8231 2.78033 12.5302L3.75 11.5605V19.8748C3.75 20.9104 4.58947 21.7498 5.625 21.7498H18.375C19.4105 21.7498 20.25 20.9104 20.25 19.8748V11.5605ZM13.5 20.2498H10.5V16.1248C10.5 15.9177 10.6679 15.7498 10.875 15.7498H13.125C13.3321 15.7498 13.5 15.9177 13.5 16.1248V20.2498Z" fill="#111111"/>
                                </svg>
                            </div>
                            <div class="text">Dashboard</div>
                        </a>
                    </li>
                    
                    <li class="menu-item">
                        <!-- Orders Management -->
                        <a href="{{ url('/admin/orders') }}" class="{{ request()->is('admin/orders*') ? 'active' : '' }}">
                            <div class="icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 7V6C6 3.79 7.79 2 10 2C12.21 2 14 3.79 14 6V7H17C17.55 7 18 7.45 18 8V20C18 21.1 17.1 22 16 22H4C2.9 22 2 21.1 2 20V8C2 7.45 2.45 7 3 7H6ZM8 6V7H12V6C12 4.9 11.1 4 10 4C8.9 4 8 4.9 8 6ZM4 8V20H16V8H4Z" fill="#111111"/>
                                    <path d="M10 12C9.45 12 9 12.45 9 13C9 13.55 9.45 14 10 14C10.55 14 11 13.55 11 13C11 12.45 10.55 12 10 12Z" fill="#111111"/>
                                </svg>
                            </div>
                            <div class="text">Orders Management</div>
                        </a>
                        
                        <!-- Store Details -->
                        <a href="{{ url('/admin/store-details') }}" class="{{ request()->is('admin/store-details*') ? 'active' : '' }}">
                            <div class="icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 9L4 4H20L21 9H3Z" fill="#111111"/>
                                    <path d="M4 10H20V20C20 21.1 19.1 22 18 22H6C4.9 22 4 21.1 4 20V10Z" fill="#111111"/>
                                    <path d="M9 14H15V16H9V14Z" fill="#ffffff"/>
                                </svg>
                            </div>
                            <div class="text">Store Details</div>
                        </a>
                    </li>
                    
                    <li class="menu-item {{ request()->is('admin/transaction*') ? 'active' : '' }}">
                        <a href="{{ url('/admin/transaction') }}" class="">
                            <div class="icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 6H21V8H3V6ZM3 11H21V13H3V11ZM3 16H21V18H3V16Z" fill="#111111"/>
                                    <path d="M7 21L3 17H11L7 21Z" fill="#111111"/>
                                </svg>
                            </div>
                            <div class="text">Transaction</div>
                        </a>
                    </li>
                    
                    <!-- Customers -->
                    <li class="menu-item {{ request()->routeIs('admin.customers.*') || request()->routeIs('admin.customer.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.customer.index') }}" class="">
                            <div class="icon"><i class="icon-users"></i></div>
                            <div class="text">Customers</div>
                        </a>
                    </li>
                    
                    <li class="menu-item has-children {{ request()->routeIs('admin.product.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon"><i class="icon-file-plus"></i></div>
                            <div class="text">Product</div>
                        </a>
                        <ul class="sub-menu" style="display: {{ request()->routeIs('admin.product.*') ? 'block' : 'none' }};">
                            <li class="sub-menu-item {{ request()->routeIs('admin.product.index') ? 'active' : '' }}">
                                <a href="{{ route('admin.product.index') }}" class="">
                                    <div class="text">All Products</div>
                                </a>
                            </li>
                            <li class="sub-menu-item {{ request()->routeIs('admin.product.add') ? 'active' : '' }}">
                                <a href="{{ route('admin.product.add') }}" class="">
                                    <div class="text">Add Product</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- Categories -->
                    <li class="menu-item {{ request()->routeIs('admin.category.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.category.index') }}" class="">
                            <div class="icon"><i class="icon-layers"></i></div>
                            <div class="text">Categories</div>
                        </a>
                    </li>
                    
                    <li class="menu-item has-children {{ request()->routeIs('admin.profile') || request()->routeIs('admin.social-media.*') || request()->routeIs('admin.banner.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon"><i class="icon-file-plus"></i></div>
                            <div class="text">Store Setting</div>
                        </a>
                        <ul class="sub-menu" style="display: {{ request()->routeIs('admin.profile') || request()->routeIs('admin.social-media.*') || request()->routeIs('admin.banner.*') ? 'block' : 'none' }};">
                            <!-- Profile & Security -->
                            <li class="sub-menu-item {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                                <a href="{{ route('admin.profile') }}" class="">
                                    <div class="icon"><i class="icon-user"></i></div>
                                    <div class="text">Profile & Security</div>
                                </a>
                            </li>
                            
                            <li class="sub-menu-item {{ request()->routeIs('admin.social-media.index') ? 'active' : '' }}">
                                <a href="{{ route('admin.social-media.index') }}">
                                    <div class="icon"><i class="icon-share-2"></i></div>
                                    <div class="text">Social Media Links</div>
                                </a>
                            </li>
                            
                            <li class="sub-menu-item {{ request()->routeIs('admin.banner.index') ? 'active' : '' }}">
                                <a href="{{ route('admin.banner.index') }}" class="d-flex align-items-center">
                                    <div class="icon me-2">
                                        <i class="icon-image" style="color:black; font-size:18px;"></i>
                                    </div>
                                    <div class="text">Store Banner</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- Attributes Dropdown -->
                    <li class="menu-item has-children {{ request()->routeIs('admin.color.*') || request()->routeIs('admin.size.*') ? 'active' : '' }}">
                        <a href="javascript:void(0);" class="menu-item-button">
                            <div class="icon">
                                <svg width="24" height="22" viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.5 1.875C0.5 0.839466 1.33947 0 2.375 0H19.625C20.6605 0 21.5 0.839466 21.5 1.875V3.375C21.5 4.29657 20.8351 5.06285 19.9589 5.22035L19.3733 15.1762C19.28 16.7619 17.9669 18 16.3785 18H5.62154C4.03311 18 2.71999 16.7619 2.62671 15.1762L2.04108 5.22035C1.16485 5.06285 0.5 4.29657 0.5 3.375V1.875ZM2.75659 3.75C2.75266 3.74997 2.74873 3.74997 2.74479 3.75H2.375C2.16789 3.75 2 3.58211 2 3.375V1.875C2 1.66789 2.16789 1.5 2.375 1.5H19.625C19.8321 1.5 20 1.66789 20 1.875V3.375C20 3.58211 19.8321 3.75 19.625 3.75H19.2552C19.2513 3.74997 19.2473 3.74997 19.2434 3.75H2.75659ZM3.54541 5.25L4.12412 15.0881C4.17076 15.8809 4.82732 16.5 5.62154 16.5H16.3785C17.1727 16.5 17.8292 15.8809 17.8759 15.0881L18.4546 5.25H3.54541ZM8.24976 8.25C8.24976 7.83579 8.58554 7.5 8.99976 7.5H12.9998C13.414 7.5 13.7498 7.83579 13.7498 8.25C13.7498 8.66421 13.414 9 12.9998 9H8.99976C8.58554 9 8.24976 8.66421 8.24976 8.25Z" fill="#111111"/>
                                </svg>
                            </div>
                            <div class="text">Attributes</div>
                        </a>
                        <ul class="sub-menu" style="display: {{ request()->routeIs('admin.color.*') || request()->routeIs('admin.size.*') ? 'block' : 'none' }};">
                            <!-- Colors -->
                            <li class="sub-menu-item {{ request()->routeIs('admin.color.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.color.index') }}" class="">
                                    <div class="text">Colors</div>
                                </a>
                            </li>
                            
                            <!-- Sizes -->
                            <li class="sub-menu-item {{ request()->routeIs('admin.size.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.size.index') }}" class="">
                                    <div class="text">Sizes</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="menu-item">
                        <a href="#"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <div class="icon">
                                <svg width="24" height="22" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.125 18.6875C8.125 18.903 8.0394 19.1097 7.88702 19.262C7.73465 19.4144 7.52799 19.5 7.3125 19.5H1.625C1.19402 19.5 0.780698 19.3288 0.475951 19.024C0.171205 18.7193 0 18.306 0 17.875V1.625C0 1.19402 0.171205 0.780698 0.475951 0.475951C0.780698 0.171205 1.19402 0 1.625 0H7.3125C7.52799 0 7.73465 0.0856026 7.88702 0.237976C8.0394 0.390349 8.125 0.597012 8.125 0.8125C8.125 1.02799 8.0394 1.23465 7.88702 1.38702C7.73465 1.5394 7.52799 1.625 7.3125 1.625H1.625V17.875H7.3125C7.52799 17.875 7.73465 17.9606 7.88702 18.113C8.0394 18.2653 8.125 18.472 8.125 18.6875ZM19.2623 9.17516L15.1998 5.11266C15.0474 4.9602 14.8406 4.87455 14.625 4.87455C14.4094 4.87455 14.2026 4.9602 14.0502 5.11266C13.8977 5.26511 13.812 5.47189 13.812 5.6875C13.812 5.90311 13.8977 6.10989 14.0502 6.26234L16.7263 8.9375H7.3125C7.09701 8.9375 6.89035 9.0231 6.73798 9.17548C6.5856 9.32785 6.5 9.53451 6.5 9.75C6.5 9.96549 6.5856 10.1722 6.73798 10.3245C6.89035 10.4769 7.09701 10.5625 7.3125 10.5625H16.7263L14.0502 13.2377C13.8977 13.3901 13.812 13.5969 13.812 13.8125C13.812 14.0281 13.8977 14.2349 14.0502 14.3873C14.2026 14.5398 14.4094 14.6255 14.625 14.6255C14.8406 14.6255 15.0474 14.5398 15.1998 14.3873L19.2623 10.3248C19.3379 10.2494 19.3978 10.1598 19.4387 10.0611C19.4796 9.9625 19.5006 9.85678 19.5006 9.75C19.5006 9.64322 19.4796 9.5375 19.4387 9.43886C19.3978 9.34023 19.3379 9.25062 19.2623 9.17516Z" fill="#111111"/>
                                </svg>
                            </div>
                            <div class="text">Log out</div>
                        </a>
                        
                        <!-- Hidden Logout Form -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /section-menu-left -->