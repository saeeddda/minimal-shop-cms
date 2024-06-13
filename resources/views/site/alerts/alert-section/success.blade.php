@if(session('alert-success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('alert-success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
