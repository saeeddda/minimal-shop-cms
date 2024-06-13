<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('site.home') }}" target="_blank" class="nav-link">فروشگاه</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="جستجو" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav mr-auto-navbav">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                @if($unseenComment->count() > 0)
                    <span class="badge badge-danger navbar-badge">{{ $unseenComment->count() }}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                @foreach($unseenComment as $comment)
                    <a href="{{ route('admin.content.comment.show', $comment->id) }}" class="dropdown-item p-0 px-2">
                        <!-- Message Start -->
                        <div class="media">
                            <div class="media-body">
                                <h6 class="dropdown-item-title">{{ $comment->user->fullName }}</h6>
                                <p class="text-sm">{{ Str::limit($comment->body, 10) }}</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{ jalaliDate($comment->created_at, '%B %d، %Y') }}</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                @endforeach

                <a href="{{ route('admin.content.comment.index') }}" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                @if($notifications->count() > 0)
                    <span class="badge badge-warning navbar-badge">{{ $notifications->count() }}</span>
                @endif
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{ $notifications->count() }} اعلان</span>
                <div class="dropdown-divider"></div>

                @foreach($notifications as $notification)
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-envelope"></i>
                        {{ $notification['data']['message'] }}
                    </a>
                    <div class="dropdown-divider"></div>
                @endforeach
                <button type="button" id="read_all" class="dropdown-item dropdown-footer">نمایش تمام اعالانات</button>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<script>
    let readAllBtn = document.getElementById('read_all')
    readAllBtn.addEventListener('click', function (){
        $.ajax({
            type: "POST",
            url: "{{ route('admin.notification.readAll') }}",
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function (){
                console.log('ok');
            }
        });
    });
</script>
