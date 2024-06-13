@if (session('swal-success'))
    <script>
        Swal.fire({
            title: 'عملیات موفق',
            text: "{{ session('swal-success') }}",
            icon: 'success',
            confirmButtonText: 'تائید'
        });
    </script>
@endif