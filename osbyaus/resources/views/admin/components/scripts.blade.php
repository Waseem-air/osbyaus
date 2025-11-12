<!-- Javascript -->
<script src="{{ asset('admin/admin-ecomus/js/jquery.min.js') }}"></script>
<script src="{{ asset('admin/admin-ecomus/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/admin-ecomus/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('admin/admin-ecomus/js/zoom.js') }}"></script>
<script src="{{ asset('admin/admin-ecomus/js/switcher.js') }}"></script>
<script defer src="{{ asset('admin/admin-ecomus/js/theme-settings.js') }}"></script>
<script defer src="{{ asset('admin/admin-ecomus/js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Page-specific scripts -->
@stack('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-category').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault(); // default link action roko
                let url = this.getAttribute('href');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#94010E',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url; // delete route call karo
                    }
                });
            });
        });
    });
</script>

</body>
</html>
