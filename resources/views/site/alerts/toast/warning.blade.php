@if(session('toast-warning'))
    <div class="toast toast-warning" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-warning text-white">
            <strong class="mr-auto">خطا</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            {{ session('toast-warning') }}
        </div>
    </div>

    @section('admin-scripts')
        <script>
            jQuery('.toast-warning').toast('show');
        </script>
    @endsection
@endif