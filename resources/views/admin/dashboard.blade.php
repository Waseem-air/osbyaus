@extends("admin.layout.main")
@section('content')
<style>
    .product-item {
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 10px;
        background: #f8f9fa;
        transition: all 0.3s ease;
        cursor: pointer;
        border: 1px solid #e9ecef;
    }
    .product-item:hover {
        background: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        border-color: #dee2e6;
    }
    .product-item h6 {
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 4px;
        color: #333;
    }
    .product-item .product-code {
        font-size: 12px;
        color: #6c757d;
    }
    .product-price {
        font-size: 14px;
        font-weight: 600;
        color: #28a745;
        white-space: nowrap;
    }
    .wg-box {
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
    }
    .table-responsive {
        border-radius: 8px;
        overflow: hidden;
    }
    .table th {
        font-weight: 600;
        background: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        color: #495057;
    }
    .table td {
        vertical-align: middle;
        border-color: #e9ecef;
    }
    .btn-sm {
        padding: 4px 12px;
        font-size: 12px;
    }
    .badge {
        font-size: 12px;
        padding: 4px 8px;
        border-radius: 4px;
    }
</style>
<!-- main-content -->
<div class="main-content">
    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="tf-section-4 mb-30">
                <!-- chart-default -->
                <div class="wg-chart-default">
                    <div class="top">
                        <div class="flex items-center gap14">
                            <div class="image type-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 48 52" fill="none">
                                    <path d="M19.1094 2.12943C22.2034 0.343099 26.0154 0.343099 29.1094 2.12943L42.4921 9.85592C45.5861 11.6423 47.4921 14.9435 47.4921 18.5162V33.9692C47.4921 37.5418 45.5861 40.8431 42.4921 42.6294L29.1094 50.3559C26.0154 52.1423 22.2034 52.1423 19.1094 50.3559L5.72669 42.6294C2.63268 40.8431 0.726688 37.5418 0.726688 33.9692V18.5162C0.726688 14.9435 2.63268 11.6423 5.72669 9.85592L19.1094 2.12943Z" fill="#22C55E"/>
                                </svg>
                                <span class="icon">
                                    <svg width="19.5" height="19.5" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10 2.25C5.44365 2.25 1.75 5.94365 1.75 10.5C1.75 15.0563 5.44365 18.75 10 18.75C14.5563 18.75 18.25 15.0563 18.25 10.5C18.25 5.94365 14.5563 2.25 10 2.25ZM0.25 10.5C0.25 5.11522 4.61522 0.75 10 0.75C15.3848 0.75 19.75 5.11522 19.75 10.5C19.75 15.8848 15.3848 20.25 10 20.25C4.61522 20.25 0.25 15.8848 0.25 10.5ZM10 3.75C10.4142 3.75 10.75 4.08579 10.75 4.5V5.3157C11.3768 5.42679 11.9745 5.67882 12.4691 6.07178L12.884 6.40137C13.2084 6.65902 13.2624 7.13081 13.0048 7.45514C12.7471 7.77947 12.2753 7.83353 11.951 7.57588L11.5361 7.24629C11.309 7.06586 11.0392 6.93462 10.75 6.85259V9.80961C11.4021 9.91435 12.0381 10.1591 12.5714 10.559C13.3164 11.1178 13.75 11.9035 13.75 12.75C13.75 13.5965 13.3164 14.3822 12.5714 14.941C12.0381 15.3409 11.4021 15.5856 10.75 15.6904V16.5C10.75 16.9142 10.4142 17.25 10 17.25C9.58579 17.25 9.25 16.9142 9.25 16.5V15.6904C8.59794 15.5856 7.96206 15.3409 7.42886 14.941L6.54999 14.2818C6.21862 14.0333 6.15147 13.5632 6.40001 13.2318C6.64854 12.9004 7.11865 12.8333 7.45001 13.0818L8.32888 13.741C8.5864 13.9341 8.90284 14.0771 9.25 14.1616V11.1844C8.63267 11.075 8.03304 10.8274 7.53058 10.4283C6.81822 9.86237 6.41752 9.07872 6.41752 8.25003C6.41752 7.42133 6.81822 6.63768 7.53058 6.07178C8.02533 5.67876 8.6231 5.42672 9.25 5.31565V4.5C9.25 4.08579 9.58579 3.75 10 3.75ZM9.25 6.85252C8.96071 6.93454 8.69081 7.0658 8.46361 7.24629C8.06987 7.55907 7.91752 7.92707 7.91752 8.25003C7.91752 8.57298 8.06987 8.94098 8.46361 9.25376C8.68603 9.43046 8.95518 9.56376 9.25 9.64747V6.85252ZM10.75 11.3384V14.1616C11.0972 14.0772 11.4138 13.9342 11.6713 13.741C12.0978 13.4211 12.25 13.0551 12.25 12.75C12.25 12.4449 12.0978 12.0789 11.6713 11.759C11.4138 11.5658 11.0972 11.4228 10.75 11.3384Z" fill="white"/>
                                    </svg>
                                </span>
                            </div>
                            <div>
                                <div class="flex gap10 items-center">
                                    <div class="body-text mt-2 mb-4">Total Earnings</div>
                                    <div class="box-icon-trending {{ ($revenueGrowthPercentage ?? 0) >= 0 ? 'up' : 'down' }}">
                                        <i class="icon-trending-{{ ($revenueGrowthPercentage ?? 0) >= 0 ? 'up' : 'down' }}"></i>
                                        <div class="body-title number">{{ number_format($revenueGrowthPercentage ?? 0, 2) }}%</div>
                                    </div>
                                </div>
                                <h4>{{ \App\Helpers\AppHelper::currency_symbol() }} {{ number_format($totalRevenue ?? 0, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="wrap-chart">
                        <div class="wrap-line-chart" id="line-chart-1"></div>
                    </div>
                </div>
                <!-- /chart-default -->
                <!-- chart-default -->
                <div class="wg-chart-default">
                    <div class="top">
                        <div class="flex items-center gap14">
                            <div class="image type-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 48 52" fill="none">
                                    <path d="M19.1094 2.12943C22.2034 0.343099 26.0154 0.343099 29.1094 2.12943L42.4921 9.85592C45.5861 11.6423 47.4921 14.9435 47.4921 18.5162V33.9692C47.4921 37.5418 45.5861 40.8431 42.4921 42.6294L29.1094 50.3559C26.0154 52.1423 22.2034 52.1423 19.1094 50.3559L5.72669 42.6294C2.63268 40.8431 0.726688 37.5418 0.726688 33.9692V18.5162C0.726688 14.9435 2.63268 11.6423 5.72669 9.85592L19.1094 2.12943Z" fill="#FF5200"/>
                                </svg>
                                <span class="icon">
                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.99959 1.5C8.34273 1.5 6.99959 2.84315 6.99959 4.5V5.25H12.9996V4.5C12.9996 2.84315 11.6564 1.5 9.99959 1.5ZM14.4996 5.25V4.5C14.4996 2.01472 12.4849 0 9.99959 0C7.51431 0 5.49959 2.01472 5.49959 4.5V5.25H3.51238C2.55283 5.25 1.74813 5.97444 1.64768 6.92872L0.384527 18.9287C0.267993 20.0358 1.13603 21 2.24922 21H17.75C18.8631 21 19.7312 20.0358 19.6147 18.9287L18.3515 6.92872C18.251 5.97444 17.4463 5.25 16.4868 5.25H14.4996ZM12.9996 6.75H6.99959V8.16146C7.22974 8.36745 7.37459 8.66681 7.37459 9C7.37459 9.62132 6.87091 10.125 6.24959 10.125C5.62827 10.125 5.12459 9.62132 5.12459 9C5.12459 8.66681 5.26943 8.36745 5.49959 8.16146V6.75H3.51238C3.32047 6.75 3.15953 6.89489 3.13944 7.08574L1.87628 19.0857C1.85298 19.3072 2.02659 19.5 2.24922 19.5H17.75C17.9726 19.5 18.1462 19.3072 18.1229 19.0857L16.8597 7.08574C16.8396 6.89489 16.6787 6.75 16.4868 6.75H14.4996V8.16146C14.7297 8.36746 14.8746 8.66681 14.8746 9C14.8746 9.62132 14.3709 10.125 13.7496 10.125C13.1283 10.125 12.6246 9.62132 12.6246 9C12.6246 8.66681 12.7694 8.36745 12.9996 8.16146V6.75Z" fill="white"/>
                                    </svg>
                                </span>
                            </div>
                            <div>
                                <div class="flex gap15 items-center">
                                    <div class="body-text mt-2 mb-4">Total Orders</div>
                                    <div class="box-icon-trending {{ ($ordersGrowthPercentage ?? 0) >= 0 ? 'up' : 'down' }}">
                                        <i class="icon-trending-{{ ($ordersGrowthPercentage ?? 0) >= 0 ? 'up' : 'down' }}"></i>
                                        <div class="body-title number">{{ number_format($ordersGrowthPercentage ?? 0, 2) }}%</div>
                                    </div>
                                </div>
                                <h4>{{ number_format($totalOrders ?? 0) }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="wrap-chart">
                        <div class="wrap-line-chart" id="line-chart-2"></div>
                    </div>
                </div>
                <!-- /chart-default -->
                <!-- chart-default -->
                <div class="wg-chart-default">
                    <div class="top">
                        <div class="flex items-center gap14">
                            <div class="image type-white">
                                <svg width="52" height="52" viewBox="0 0 48 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.1084 2.12894C22.2024 0.34261 26.0144 0.342611 29.1084 2.12894L42.4911 9.85544C45.5851 11.6418 47.4911 14.943 47.4911 18.5157V33.9687C47.4911 37.5413 45.5851 40.8426 42.4911 42.6289L29.1084 50.3554C26.0144 52.1418 22.2024 52.1418 19.1084 50.3554L5.72571 42.6289C2.6317 40.8426 0.725712 37.5413 0.725712 33.9687V18.5157C0.725712 14.943 2.6317 11.6418 5.72571 9.85544L19.1084 2.12894Z" fill="#8F77F3"/>
                                </svg>
                                <span class="icon">
                                    <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M4.61976 16.1198C5.51618 15.2233 6.73199 14.7197 7.99973 14.7197H15.9997C17.2675 14.7197 18.4833 15.2233 19.3797 16.1198C20.2761 17.0162 20.7797 18.232 20.7797 19.4997V21.4997C20.7797 21.9305 20.4305 22.2797 19.9997 22.2797C19.5689 22.2797 19.2197 21.9305 19.2197 21.4997V19.4997C19.2197 18.6457 18.8805 17.8267 18.2766 17.2228C17.6727 16.619 16.8537 16.2797 15.9997 16.2797H7.99973C7.14573 16.2797 6.32671 16.619 5.72284 17.2228C5.11898 17.8267 4.77973 18.6457 4.77973 19.4997V21.4997C4.77973 21.9305 4.43051 22.2797 3.99973 22.2797C3.56894 22.2797 3.21973 21.9305 3.21973 21.4997V19.4997C3.21973 18.232 3.72333 17.0162 4.61976 16.1198Z" fill="white"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.9997 4.27973C10.2214 4.27973 8.77973 5.72137 8.77973 7.49973C8.77973 9.27808 10.2214 10.7197 11.9997 10.7197C13.7781 10.7197 15.2197 9.27808 15.2197 7.49973C15.2197 5.72137 13.7781 4.27973 11.9997 4.27973ZM7.21973 7.49973C7.21973 4.85981 9.35981 2.71973 11.9997 2.71973C14.6396 2.71973 16.7797 4.85981 16.7797 7.49973C16.7797 10.1396 14.6396 12.2797 11.9997 12.2797C9.35981 12.2797 7.21973 10.1396 7.21973 7.49973Z" fill="white"/>
                                    </svg>
                                </span>
                            </div>
                            <div>
                                <div class="flex gap9 items-center">
                                    <div class="body-text mt-2 mb-4">Customers</div>
                                    <div class="box-icon-trending up color-violet">
                                        <i class="icon-trending-up"></i>
                                        <div class="body-title number">1.56%</div>
                                    </div>
                                </div>
                                <h4>{{ number_format($totalCustomers ?? 0) }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="wrap-chart">
                        <div class="wrap-line-chart" id="line-chart-3"></div>
                    </div>
                </div>
                <!-- /chart-default -->
                <!-- chart-default -->
                <div class="wg-chart-default">
                    <div class="top">
                        <div class="flex items-center gap14">
                            <div class="image type-white">
                                <svg width="52" height="52" viewBox="0 0 48 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.1084 2.12894C22.2024 0.34261 26.0144 0.342611 29.1084 2.12894L42.4911 9.85544C45.5851 11.6418 47.4911 14.943 47.4911 18.5157V33.9687C47.4911 37.5413 45.5851 40.8426 42.4911 42.6289L29.1084 50.3554C26.0144 52.1418 22.2024 52.1418 19.1084 50.3554L5.72571 42.6289C2.6317 40.8426 0.725712 37.5413 0.725712 33.9687V18.5157C0.725712 14.943 2.6317 11.6418 5.72571 9.85544L19.1084 2.12894Z" fill="#2377FC"/>
                                </svg>
                                <span class="icon">
                                    <svg width="18" height="21" viewBox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10.5 1.5C9.82674 1.5 9.25525 1.94413 9.06623 2.55717C9.02336 2.69622 9 2.84469 9 3H13.5C13.5 2.84469 13.4766 2.69622 13.4338 2.55717C13.2448 1.94413 12.6733 1.5 12 1.5H10.5ZM7.83701 1.61765C8.33669 0.656928 9.3409 0 10.5 0H12C13.1591 0 14.1633 0.656928 14.663 1.61765C14.8877 1.63319 15.1121 1.65026 15.3359 1.66884C16.8752 1.7966 18 3.10282 18 4.60822V15C18 16.6569 16.6569 18 15 18H13.5V19.125C13.5 20.1605 12.6605 21 11.625 21H1.875C0.839466 21 0 20.1605 0 19.125V7.875C0 6.83947 0.839466 6 1.875 6H4.5V4.60822C4.5 3.10283 5.62475 1.7966 7.16405 1.66884C7.38795 1.65026 7.61227 1.63319 7.83701 1.61765ZM7.50702 3.14604C7.43401 3.15177 7.36104 3.15765 7.28812 3.1637C6.56523 3.2237 6 3.84365 6 4.60822V6H11.625C12.6605 6 13.5 6.83947 13.5 7.875V16.5H15C15.8284 16.5 16.5 15.8284 16.5 15V4.60822C16.5 3.84365 15.9348 3.2237 15.2119 3.1637C15.139 3.15765 15.066 3.15177 14.993 3.14604C14.9196 3.90594 14.2792 4.5 13.5 4.5H9C8.22085 4.5 7.58044 3.90594 7.50702 3.14604ZM12 7.875C12 7.66789 11.8321 7.5 11.625 7.5H1.875C1.66789 7.5 1.5 7.66789 1.5 7.875V19.125C1.5 19.3321 1.66789 19.5 1.875 19.5H11.625C11.8321 19.5 12 19.3321 12 19.125V7.875ZM3 10.5C3 10.0858 3.33579 9.75 3.75 9.75H3.7575C4.17171 9.75 4.5075 10.0858 4.5075 10.5V10.5075C4.5075 10.9217 4.17171 11.2575 3.7575 11.2575H3.75C3.33579 11.2575 3 10.9217 3 10.5075V10.5ZM5.25 10.5C5.25 10.0858 5.58579 9.75 6 9.75H9.75C10.1642 9.75 10.5 10.0858 10.5 10.5C10.5 10.9142 10.1642 11.25 9.75 11.25H6C5.58579 11.25 5.25 10.9142 5.25 10.5ZM3 13.5C3 13.0858 3.33579 12.75 3.75 12.75H3.7575C4.17171 12.75 4.5075 13.0858 4.5075 13.5V13.5075C4.5075 13.9217 4.17171 14.2575 3.7575 14.2575H3.75C3.33579 14.2575 3 13.9217 3 13.5075V13.5ZM5.25 13.5C5.25 13.0858 5.58579 12.75 6 12.75H9.75C10.1642 12.75 10.5 13.0858 10.5 13.5C10.5 13.9142 10.1642 14.25 9.75 14.25H6C5.58579 14.25 5.25 13.9142 5.25 13.5ZM3 16.5C3 16.0858 3.33579 15.75 3.75 15.75H3.7575C4.17171 15.75 4.5075 16.0858 4.5075 16.5V16.5075C4.5075 16.9217 4.17171 17.2575 3.7575 17.2575H3.75C3.33579 17.2575 3 16.9217 3 16.5075V16.5ZM5.25 16.5C5.25 16.0858 5.58579 15.75 6 15.75H9.75C10.1642 15.75 10.5 16.0858 10.5 16.5C10.5 16.9142 10.1642 17.25 9.75 17.25H6C5.58579 17.25 5.25 16.9142 5.25 16.5Z" fill="white"/>
                                    </svg>
                                </span>
                            </div>
                            <div>
                                <div class="flex gap10 items-center">
                                    <div class="body-text mt-2 mb-4">Products</div>
                                    <div class="box-icon-trending up color-blue">
                                        <i class="icon-trending-up"></i>
                                        <div class="body-title number">1.56%</div>
                                    </div>
                                </div>
                                <h4>{{ number_format($totalProducts ?? 0) }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="wrap-chart">
                        <div class="wrap-line-chart" id="line-chart-4"></div>
                    </div>
                </div>
                <!-- /chart-default -->
            </div>
            
            <div class="tf-section-2 mb-30">
                <!-- Revenue -->
                <div class="wg-box">
                    <div class="flex items-center justify-between">
                        <h5>Revenue</h5>
                    </div>
                    <div class="flex flex-wrap gap40">
                        <div>
                            <div class="mb-1">
                                <div class="block-legend">
                                    <div class="dot t3"></div>
                                    <div class="text-tiny">Revenue</div>
                                </div>
                            </div>
                            <div class="flex items-center gap12">
                                <h4>{{ \App\Helpers\AppHelper::currency_symbol() }} {{ number_format($totalRevenue ?? 0, 2) }}</h4>
                                <div class="box-icon-trending up">
                                    <i class="icon-trending-up"></i>
                                    <div class="body-title number text-grey">0.56%</div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="mb-1">
                                <div class="block-legend">
                                    <div class="dot t5"></div>
                                    <div class="text-tiny">Order</div>
                                </div>
                            </div>
                            <div class="flex items-center gap12">
                                <h4>{{ number_format($totalOrders ?? 0) }}</h4>
                                <div class="box-icon-trending up">
                                    <i class="icon-trending-up"></i>
                                    <div class="body-title number text-grey">0.56%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="line-chart-7"></div>
                </div>
                <!-- /Revenue -->
            </div>
            
            <!-- Two Column Layout -->
            <div class="row g-3 mb-4">
                <!-- Popular Products Column -->
                <div class="col-lg-5 col-md-6 col-12">
                    <div class="wg-box h-100">
                        <div class="mb-3">
                            <h6 class="fw-bold mb-0">Popular Products</h6>
                            <p class="text-muted small mt-2">
                                @php
                                    $totalSold = isset($popularProducts) ? $popularProducts->sum('total_sold') : 0;
                                @endphp
                                Total {{ $totalSold }} Units Sold
                            </p>
                        </div>
                        
                        <!-- Product List -->
                        <div class="product-list">
                            @if(isset($popularProducts) && $popularProducts->count() > 0)
                                @foreach($popularProducts as $product)
                                <div class="product-item d-flex align-items-center">
                                    @if($product->mainImage)
                                        <img src="{{ asset($product->mainImage->image_path) }}" 
                                             class="rounded me-3" width="46" height="46" alt="{{ $product->name }}">
                                    @else
                                        <img src="https://via.placeholder.com/60" class="rounded me-3" width="46" height="46">
                                    @endif
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 fw-semibold">{{ $product->name }}</h6>
                                        <small class="text-muted">Sold: {{ $product->total_sold ?? 0 }} units</small>
                                    </div>
                                    <div>
                                        <span class="product-price">{{ \App\Helpers\AppHelper::currency_symbol() }} {{ number_format($product->final_price ?? 0, 2) }}</span>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="text-center py-4">
                                    <p class="text-muted">No popular products yet.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Last Transactions Column -->
                <div class="col-lg-7 col-md-6 col-12">
                    <div class="wg-box h-100">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-bold mb-0">Last Transactions</h6>
                            <a href="{{ route('admin.transaction') }}" class="text-primary small">View All</a>
                        </div>
                        
                        <!-- Transactions Table -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="py-2" style="font-size: 13px;">Order #</th>
                                        <th class="py-2" style="font-size: 13px;">Date</th>
                                        <th class="py-2" style="font-size: 13px;">Customer</th>
                                        <th class="py-2" style="font-size: 13px;">Total</th>
                                        <th class="py-2 text-end" style="font-size: 13px;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($latestTransactions) && $latestTransactions->count() > 0)
                                        @foreach($latestTransactions as $transaction)
                                        <tr>
                                            <td class="py-2">#{{ $transaction->order_number }}</td>
                                            <td class="py-2">{{ $transaction->created_at->format('d M Y') }}</td>
                                            <td class="py-2">
                                                @if($transaction->user)
                                                    {{ $transaction->user->first_name ?? 'N/A' }} {{ $transaction->user->last_name ?? '' }}
                                                @else
                                                    {{ $transaction->customer_name ?? 'Guest' }}
                                                @endif
                                            </td>
                                            <td class="py-2 fw-semibold {{ $transaction->payment_status == 'paid' ? 'text-success' : 'text-warning' }}">
                                                {{ \App\Helpers\AppHelper::currency_symbol() }} {{ number_format($transaction->total_amount, 2) }}
                                            </td>
                                            <td class="py-2 text-end">
                                                <span class="badge bg-{{ $transaction->payment_status == 'paid' ? 'success' : 'warning' }}">
                                                    {{ ucfirst($transaction->payment_status) }}
                                                </span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <p class="text-muted">No transactions yet.</p>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Two Column Layout -->
        </div>
        <!-- /main-content-wrap -->
    </div>
    <!-- /main-content-wrap -->
</div>
<!-- /main-content -->
@endsection

@push('scripts')
<script>
    // Prepare monthly data for charts
    const monthlyRevenueData = @json(array_values($monthlyRevenueData ?? []));
    const monthlyOrdersData = @json(array_values($monthlyOrdersData ?? []));
    const monthLabels = @json($monthLabels ?? []);
    
    // Prepare weekly data for charts
    const weeklyLabels = @json($weeklyLabels ?? []);
    const weeklyRevenueChartData = @json($weeklyRevenueChartData ?? []);
    const weeklyOrdersChartData = @json($weeklyOrdersChartData ?? []);
    
    // Chart 1: Monthly Revenue Line Chart
    if (document.getElementById("line-chart-1")) {
        const options1 = {
            series: [{
                name: "Revenue",
                data: monthlyRevenueData
            }],
            chart: {
                height: 120,
                type: "line",
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false
                },
                sparkline: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: "smooth",
                width: 2
            },
            colors: ["#22C55E"],
            grid: {
                show: false,
            },
            xaxis: {
                categories: monthLabels,
                labels: {
                    show: false
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
            },
            yaxis: {
                show: false,
            },
            tooltip: {
                enabled: true,
                x: {
                    show: false
                },
                y: {
                    formatter: function(val) {
                        return "{{ \App\Helpers\AppHelper::currency_symbol() }} " + val.toFixed(2);
                    }
                }
            }
        };
        
        const chart1 = new ApexCharts(document.querySelector("#line-chart-1"), options1);
        chart1.render();
    }
    
    // Chart 2: Weekly Orders Line Chart
    if (document.getElementById("line-chart-2")) {
        const options2 = {
            series: [{
                name: "Orders",
                data: weeklyOrdersChartData
            }],
            chart: {
                height: 120,
                type: "line",
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false
                },
                sparkline: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: "smooth",
                width: 2
            },
            colors: ["#FF5200"],
            grid: {
                show: false,
            },
            xaxis: {
                categories: weeklyLabels,
                labels: {
                    show: false
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
            },
            yaxis: {
                show: false,
            },
            tooltip: {
                enabled: true,
                x: {
                    show: false
                },
                y: {
                    formatter: function(val) {
                        return val + " orders";
                    }
                }
            }
        };
        
        const chart2 = new ApexCharts(document.querySelector("#line-chart-2"), options2);
        chart2.render();
    }
    
    // Chart 3: Customer Growth Chart
    if (document.getElementById("line-chart-3")) {
        // Simulate customer growth data (you can replace with actual data)
        const customerData = [];
        for (let i = 0; i < 12; i++) {
            customerData.push(Math.floor(Math.random() * 100) + 50);
        }
        
        const options3 = {
            series: [{
                name: "Customers",
                data: customerData
            }],
            chart: {
                height: 120,
                type: "line",
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false
                },
                sparkline: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: "smooth",
                width: 2
            },
            colors: ["#8F77F3"],
            grid: {
                show: false,
            },
            xaxis: {
                categories: monthLabels,
                labels: {
                    show: false
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
            },
            yaxis: {
                show: false,
            },
            tooltip: {
                enabled: true,
                x: {
                    show: false
                },
                y: {
                    formatter: function(val) {
                        return val + " customers";
                    }
                }
            }
        };
        
        const chart3 = new ApexCharts(document.querySelector("#line-chart-3"), options3);
        chart3.render();
    }
    
    // Chart 4: Product Performance Chart
    if (document.getElementById("line-chart-4")) {
        // Simulate product performance data
        const productData = [];
        for (let i = 0; i < 12; i++) {
            productData.push(Math.floor(Math.random() * 50) + 20);
        }
        
        const options4 = {
            series: [{
                name: "Products",
                data: productData
            }],
            chart: {
                height: 120,
                type: "line",
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false
                },
                sparkline: {
                    enabled: true
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: "smooth",
                width: 2
            },
            colors: ["#2377FC"],
            grid: {
                show: false,
            },
            xaxis: {
                categories: monthLabels,
                labels: {
                    show: false
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
            },
            yaxis: {
                show: false,
            },
            tooltip: {
                enabled: true,
                x: {
                    show: false
                },
                y: {
                    formatter: function(val) {
                        return val + " products";
                    }
                }
            }
        };
        
        const chart4 = new ApexCharts(document.querySelector("#line-chart-4"), options4);
        chart4.render();
    }
    
    // Chart 7: Main Revenue Chart (Combined Revenue & Orders)
    if (document.getElementById("line-chart-7")) {
        const options7 = {
            series: [{
                name: "Revenue",
                type: "area",
                data: monthlyRevenueData
            }, {
                name: "Orders",
                type: "line",
                data: monthlyOrdersData
            }],
            chart: {
                height: 350,
                type: "line",
                toolbar: {
                    show: true,
                    tools: {
                        download: true,
                        selection: true,
                        zoom: true,
                        zoomin: true,
                        zoomout: true,
                        pan: true,
                        reset: true
                    }
                }
            },
            stroke: {
                curve: "smooth",
                width: [3, 2]
            },
            colors: ["#22C55E", "#FF5200"],
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.3,
                    stops: [0, 90, 100]
                }
            },
            markers: {
                size: 0
            },
            xaxis: {
                categories: monthLabels,
                labels: {
                    style: {
                        colors: "#6B7280",
                        fontSize: "12px"
                    }
                }
            },
            yaxis: [
                {
                    title: {
                        text: "Revenue ({{ \App\Helpers\AppHelper::currency_symbol() }})",
                        style: {
                            color: "#22C55E",
                            fontSize: "12px"
                        }
                    },
                    labels: {
                        formatter: function(val) {
                            return "{{ \App\Helpers\AppHelper::currency_symbol() }} " + val.toLocaleString();
                        },
                        style: {
                            colors: "#6B7280",
                            fontSize: "12px"
                        }
                    }
                },
                {
                    opposite: true,
                    title: {
                        text: "Orders",
                        style: {
                            color: "#FF5200",
                            fontSize: "12px"
                        }
                    },
                    labels: {
                        style: {
                            colors: "#6B7280",
                            fontSize: "12px"
                        }
                    }
                }
            ],
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: function(y) {
                        if (typeof y !== "undefined") {
                            if (this.series.index === 0) {
                                return "{{ \App\Helpers\AppHelper::currency_symbol() }} " + y.toLocaleString();
                            } else {
                                return y + " orders";
                            }
                        }
                        return y;
                    }
                }
            },
            legend: {
                position: "top",
                horizontalAlign: "right",
                fontSize: "14px",
                fontFamily: "Inter, sans-serif",
                fontWeight: 400,
                markers: {
                    width: 10,
                    height: 10,
                    radius: 4
                }
            },
            grid: {
                borderColor: "#E5E7EB",
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            }
        };
        
        const chart7 = new ApexCharts(document.querySelector("#line-chart-7"), options7);
        chart7.render();
    }
    
    // Update percentage indicators with actual growth data
    document.addEventListener('DOMContentLoaded', function() {
        // Update revenue growth percentage
        const revenueGrowth = {{ $revenueGrowthPercentage ?? 0 }};
        const revenueTrendElement = document.querySelector('.wg-chart-default:nth-child(1) .body-title.number');
        if (revenueTrendElement) {
            revenueTrendElement.textContent = revenueGrowth.toFixed(2) + '%';
            
            // Update icon based on growth
            const trendIcon = revenueTrendElement.closest('.box-icon-trending');
            if (trendIcon) {
                if (revenueGrowth >= 0) {
                    trendIcon.classList.remove('down');
                    trendIcon.classList.add('up');
                    trendIcon.querySelector('i').className = 'icon-trending-up';
                } else {
                    trendIcon.classList.remove('up');
                    trendIcon.classList.add('down');
                    trendIcon.querySelector('i').className = 'icon-trending-down';
                }
            }
        }
        
        // Update orders growth percentage
        const ordersGrowth = {{ $ordersGrowthPercentage ?? 0 }};
        const ordersTrendElement = document.querySelector('.wg-chart-default:nth-child(2) .body-title.number');
        if (ordersTrendElement) {
            ordersTrendElement.textContent = ordersGrowth.toFixed(2) + '%';
            
            // Update icon based on growth
            const trendIcon = ordersTrendElement.closest('.box-icon-trending');
            if (trendIcon) {
                if (ordersGrowth >= 0) {
                    trendIcon.classList.remove('down');
                    trendIcon.classList.add('up');
                    trendIcon.querySelector('i').className = 'icon-trending-up';
                } else {
                    trendIcon.classList.remove('up');
                    trendIcon.classList.add('down');
                    trendIcon.querySelector('i').className = 'icon-trending-down';
                }
            }
        }
    });
    
    // Add dropdown functionality for time periods
    function updateCharts(timePeriod) {
        // You can make AJAX calls here to fetch data for different time periods
        console.log('Time period changed to:', timePeriod);
        
        // Example AJAX implementation:
        /*
        fetch(`/admin/dashboard/chart-data?period=${timePeriod}`)
            .then(response => response.json())
            .then(data => {
                // Update charts with new data
                chart1.updateSeries([{ data: data.revenueData }]);
                chart2.updateSeries([{ data: data.ordersData }]);
                // ... update other charts
            });
        */
    }
    
    // Add event listeners to dropdown items
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownItems = document.querySelectorAll('.dropdown-menu a');
        dropdownItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const timePeriod = this.textContent.trim();
                const dropdownButton = this.closest('.dropdown').querySelector('.dropdown-toggle .view-all');
                if (dropdownButton) {
                    dropdownButton.innerHTML = `${timePeriod}<i class="icon-chevron-down"></i>`;
                }
                updateCharts(timePeriod.toLowerCase());
            });
        });
    });
</script>

<!-- Javascript -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-select.min.js"></script>
<script src="js/zoom.js"></script>
<script src="js/morris.min.js"></script>
<script src="js/raphael.min.js"></script>
<script src="js/morris.js"></script>
<script src="js/jvectormap.min.js"></script>
<script src="js/jvectormap-us-lcc.js"></script>
<script src="js/jvectormap-data.js"></script>
<script src="js/jvectormap.js"></script>
<script src="js/apexcharts/apexcharts.js"></script>
<script src="js/apexcharts/line-chart-1.js"></script>
<script src="js/apexcharts/line-chart-2.js"></script>
<script src="js/apexcharts/line-chart-3.js"></script>
<script src="js/apexcharts/line-chart-4.js"></script>
<script src="js/apexcharts/line-chart-5.js"></script>
<script src="js/apexcharts/line-chart-6.js"></script>
<script src="js/apexcharts/line-chart-7.js"></script>
<script src="js/switcher.js"></script>
<script defer src="js/theme-settings.js"></script>
<script src="js/main.js"></script>
@endpush