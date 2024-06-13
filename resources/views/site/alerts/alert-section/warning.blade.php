@if(session('alert-warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('alert-warning') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
