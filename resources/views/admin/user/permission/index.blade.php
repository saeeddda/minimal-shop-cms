@extends('admin.layouts.master')
@section('title', 'ادمین - مجوز های سیستم')

@section('content')
    @include('admin.layouts.breadcrumb',['title'=>'مجوز های سیستم'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mr-3">مجوز های سیستم</h3>
                            <a href="{{ route('admin.user.permission.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus mr-1"></i>افزودن مجوز</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>عنوان نقش</th>
                                            <th>نقش های دارای این مجوز</th>
                                            <th>عملیات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($permissions as $permission)
                                            <tr>
                                                <td>{{ $permission->id }}</td>
                                                <td>{{ $permission->name }}</td>
                                                <td>
                                                    @if(empty($permission->roles()->get()->toArray()))
                                                        این مجوز برای هیچ نقشی انتخاب نشده است
                                                    @else
                                                        <ol>
                                                            @foreach($permission->roles as $role )
                                                                <li>{{ $role->name }}</li>
                                                            @endforeach
                                                        </ol>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('admin.user.permission.destroy', $permission->id) }}" method="POST">
                                                        @csrf
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
