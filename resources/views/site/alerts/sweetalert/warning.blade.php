@if (session('swal-warning'))
    <script>
        Swal.fire({
            title: 'خطا!',
            text: "{{ session('swal-warning') }}",
            icon: 'error',
            confirmButtonText: 'تائید'
        });
    </script>
@endif