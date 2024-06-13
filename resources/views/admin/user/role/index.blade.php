@extends('admin.layouts.master')
@section('title', 'ادمین - نقش کاربران')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'نقش کاربران'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mr-3">نقش کاربران</h3>
                            <a href="{{ route('admin.user.role.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus mr-1"></i>افزودن نقش</a>

                            <div class="card-tools">
                                <form action="">
                                    <div class="input-group input-group-sm">
                                        <input type="search" name="search" class="form-control" placeholder="جستجو...">
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>عنوان نقش</th>
                                            <th>دسترسی ها</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($roles as $role)
                                            <tr>
                                                <td>{{ $role->id }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>
                                                    @if(empty($role->permissions()->get()->toArray()))
                                                        برای این نقش دسترسی تعریف نشده است
                                                    @else
                                                        <ol>
                                                            @foreach($role->permissions as $permission )
                                                                <li>{{ $permission->name }}</li>
                                                            @endforeach
                                                        </ol>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.user.role.destroy', $role->id) }}" method="POST">
                                                        @csrf
                                                        <a href="{{ route('admin.user.role.permission-edit', $role->id) }}" class="btn btn-success btn-sm"><i class="fa fa-shield-alt mr-1"></i>دسترسی ها</a>
                                                        <a href="{{ route('admin.user.role.edit', $role->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit mr-1"></i>ویرایش</a>
                                                        @method('DELETE')
                                                        <button type="submit" class="delete_button btn btn-danger btn-sm"><i class="fa fa-trash mr-1"></i>حذف</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="card-tools">
                                <ul class="pagination pagination-sm float-right">
                                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('admin-scripts')
    <script>
        $('.delete_button').on('click', function(event){
            event.preventDefault();

            Swal.fire({
                title: 'آیا از حذف این مورد مطمئن هستید؟',
                showCancelButton: true,
                confirmButtonText: 'حذف',
                cancelButtonText: 'لغو',
                focusConfirm: false,
                focusCancel: true,
                icon: 'info'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).parent().submit();
                }
            });
        });
    </script>
@endsection
