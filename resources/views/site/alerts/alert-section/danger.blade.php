@if(session('alert-danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session('alert-danger') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
