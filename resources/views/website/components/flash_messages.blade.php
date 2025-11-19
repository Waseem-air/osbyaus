
<script>
    @if ($errors->any())
    let errorMessages = '';
    @foreach ($errors->all() as $error)
        errorMessages += "{{ $error }}\n";
    @endforeach
    Swal.fire({
        icon: '',
        title: 'Validation Errors',
        text: errorMessages,
    });
    @endif

    @if ($errors->any())
    Swal.fire({
        icon: '',
        title: 'Oops...',
        html: `{!! implode('<br>', $errors->all()) !!}`
    });
    @endif

    @if (session('error'))
    Swal.fire({
        icon: '',
        title: 'Error',
        text: "{{ session('error') }}"
    });
    @endif

    @if (session('success'))
    Swal.fire({
        icon: '',
        title: 'Success',
        text: "{{ session('success') }}"
    });
    @endif

    @if (session('warning'))
    Swal.fire({
        icon: '',
        title: 'Warning',
        text: "{{ session('warning') }}"
    });
    @endif

    @if (session('info'))
    Swal.fire({
        icon: '',
        title: 'Info',
        text: "{{ session('info') }}"
    });
    @endif
</script>
