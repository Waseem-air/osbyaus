<!DOCTYPE html>
<html lang="en">

{{--head --}}
@include('website.components.head')
<body>
<div id="ec-overlay">
    <div class="ec-ellipsis">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>

{{--Header--}}
@include('website.components.header')

@yield('content')


{{--Footer--}}
@include('website.components.footer')

{{--Shopping Cart--}}
<!-- Cart Sidebar Structure -->
<div class="ec-side-cart-overlay"></div>
<div id="ec-side-cart" class="ec-side-cart">
    <!-- This will be populated dynamically via AJAX -->
    <div class="ec-cart-inner">
        <div class="text-center">
            <i class="fi-rr-spinner spinner" style="font-size: 2rem;"></i>
            <p class="mt-2 text-muted">Loading cart...</p>
        </div>
    </div>
</div>

<!-- Chat Btn Start -->
<a href="" class="chat-btn">
    <i class="ecicon eci-whatsapp"></i>
</a>
<!-- Chat Btn End -->

{{--Scripts Links--}}
@include('website.components.script-links')
@include('website.partials.cart-ajax-js')

</body>
</html>
