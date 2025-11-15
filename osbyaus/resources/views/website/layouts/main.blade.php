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
@include('website.components.shopping-cart')
<!-- Chat Btn Start -->
<a href="" class="chat-btn">
    <i class="ecicon eci-whatsapp"></i>
</a>
<!-- Chat Btn End -->

{{--Scripts Links--}}
@include('website.components.script-links')
</body>
</html>
