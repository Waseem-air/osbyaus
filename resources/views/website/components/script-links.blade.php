<!-- ======================== -->
<!-- Vendor JS -->
<!-- ======================== -->
<script src="{{ asset('website/assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('website/assets/js/vendor/popper.min.js') }}"></script>
<script src="{{ asset('website/assets/js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('website/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
<script src="{{ asset('website/assets/js/vendor/modernizr-3.11.2.min.js') }}"></script>
<!-- ======================== -->
<!-- Plugins JS -->
<!-- ======================== -->
<script src="{{ asset('website/assets/js/plugins/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('website/assets/js/plugins/countdownTimer.min.js') }}"></script>
<script src="{{ asset('website/assets/js/plugins/scrollup.js') }}"></script>
<script src="{{ asset('website/assets/js/plugins/slick.min.js') }}"></script>
<!-- ======================== -->
<!-- Main JS -->
<!-- ======================== -->
<script src="{{ asset('website/assets/js/main.js') }}"></script>

<!-- ======================== -->
<!-- Extra Page Scripts -->
<!-- ======================== -->
<!-- Include SweetAlert2 CSS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include('website.components.flash_messages')
@stack('scripts')

