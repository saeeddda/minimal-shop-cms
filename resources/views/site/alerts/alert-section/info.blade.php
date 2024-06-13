@if(session('alert-info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>{{ session('alert-info') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
